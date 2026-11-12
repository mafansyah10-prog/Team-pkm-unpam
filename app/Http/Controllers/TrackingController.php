<?php

namespace App\Http\Controllers;

use App\Services\DocklyPortal;
use App\Services\DocklyUnauthorized;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function __construct(private DocklyPortal $dockly)
    {
    }

    public function showLogin(Request $request)
    {
        if ($request->session()->get('dockly_portal.token')) {
            return redirect()->route('tracking.index');
        }

        return view('tracking.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $r = $this->dockly->login($data['email'], $data['password']);
        if (! $r['ok']) {
            $msg = $r['status'] === 401 ? 'Email atau kata sandi salah.' : $r['message'];

            return back()->withInput($request->only('email'))->withErrors(['email' => $msg]);
        }

        $request->session()->regenerate();
        $request->session()->put('dockly_portal', [
            'token' => $r['token'],
            'name' => $r['user']['name'] ?? '',
            'customer' => $r['user']['customer_name'] ?? '',
        ]);

        return redirect()->route('tracking.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('dockly_portal');
        $request->session()->regenerateToken();

        return redirect()->route('tracking.login');
    }

    public function index(Request $request)
    {
        try {
            $res = $this->dockly->get($this->token(), '/portal/jobs');
        } catch (DocklyUnauthorized) {
            return $this->sessionExpired($request);
        }
        abort_unless($res->successful(), 502, 'Data tracking tidak dapat dimuat.');

        return view('tracking.index', ['jobs' => $res->json('data') ?? []]);
    }

    public function show(Request $request, int $id)
    {
        try {
            $job = $this->dockly->get($this->token(), "/portal/jobs/{$id}");
            if ($job->status() === 404) {
                abort(404);
            }
            abort_unless($job->successful(), 502, 'Data tracking tidak dapat dimuat.');
            $docs = $this->dockly->get($this->token(), "/portal/jobs/{$id}/documents");
        } catch (DocklyUnauthorized) {
            return $this->sessionExpired($request);
        }

        return view('tracking.show', [
            'job' => $job->json('data'),
            'docs' => $docs->successful() ? ($docs->json('data') ?? []) : [],
        ]);
    }

    public function document(Request $request, int $id, int $doc)
    {
        try {
            $res = $this->dockly->download($this->token(), "/portal/jobs/{$id}/documents/{$doc}/download");
        } catch (DocklyUnauthorized) {
            return $this->sessionExpired($request);
        }
        abort_unless($res->successful(), $res->status() === 404 ? 404 : 502);

        $type = strtolower(trim(explode(';', (string) $res->header('Content-Type'))[0]));
        $disposition = $res->header('Content-Disposition') ?: 'attachment';
        // Pratinjau (?preview=1): hanya PDF & gambar (bukan SVG/HTML) yang boleh tampil inline; selain itu tetap unduh.
        if ($request->boolean('preview') && ($type === 'application/pdf' || in_array($type, ['image/png', 'image/jpeg', 'image/gif', 'image/webp'], true))) {
            $disposition = preg_replace('/^\s*attachment/i', 'inline', $disposition);
        }

        return response($res->body(), 200, [
            'Content-Type' => $type ?: 'application/octet-stream',
            'Content-Disposition' => $disposition,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, no-store',
        ]);
    }

    private function token(): string
    {
        return (string) session('dockly_portal.token');
    }

    private function sessionExpired(Request $request)
    {
        $request->session()->forget('dockly_portal');

        return redirect()->route('tracking.login')->withErrors(['email' => 'Sesi berakhir, silakan masuk kembali.']);
    }
}
