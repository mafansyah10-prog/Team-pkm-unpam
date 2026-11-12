<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Klien API portal customer Dockly. Token Dockly disimpan di session server (tidak pernah dikirim ke browser);
 * pembatasan "customer hanya melihat job miliknya" dipaksa oleh Dockly, bukan di sini.
 */
class DocklyPortal
{
    private function http(?string $token = null): PendingRequest
    {
        $req = Http::baseUrl(rtrim(config('services.dockly.url'), '/'))
            ->timeout(config('services.dockly.timeout'))
            ->acceptJson();

        return $token ? $req->withToken($token) : $req;
    }

    /** @return array{ok:bool,status:int,message:?string,token:?string,user:?array} */
    public function login(string $email, string $password): array
    {
        try {
            $res = $this->http()->post('/portal-auth/login', ['email' => $email, 'password' => $password]);
        } catch (ConnectionException $e) {
            return ['ok' => false, 'status' => 503, 'message' => 'Layanan tracking sedang tidak tersedia. Coba beberapa saat lagi.', 'token' => null, 'user' => null];
        }

        if ($res->successful()) {
            return ['ok' => true, 'status' => 200, 'message' => null, 'token' => $res->json('token'), 'user' => $res->json('portalUser')];
        }

        return ['ok' => false, 'status' => $res->status(), 'message' => $res->json('message') ?: 'Login gagal.', 'token' => null, 'user' => null];
    }

    /** GET ke API portal. Melempar DocklyUnauthorized bila token ditolak (kedaluwarsa/akun dinonaktifkan). */
    public function get(string $token, string $path): Response
    {
        try {
            $res = $this->http($token)->get($path);
        } catch (ConnectionException $e) {
            abort(503, 'Layanan tracking sedang tidak tersedia. Coba beberapa saat lagi.');
        }
        if (in_array($res->status(), [401, 403], true)) {
            throw new DocklyUnauthorized();
        }

        return $res;
    }

    /** Unduh dokumen lewat server ini (token tidak keluar ke browser; file maks 10 MB). */
    public function download(string $token, string $path): Response
    {
        try {
            $res = $this->http($token)->get($path);
        } catch (ConnectionException $e) {
            abort(503, 'Layanan tracking sedang tidak tersedia. Coba beberapa saat lagi.');
        }
        if (in_array($res->status(), [401, 403], true)) {
            throw new DocklyUnauthorized();
        }

        return $res;
    }
}
