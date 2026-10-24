<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'form_type' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:10',
            'reference_no' => 'nullable|string|max:100',
            'client_time' => 'nullable|string|max:100',
        ]);

        $category = $request->input('service_type', 'Pengaduan Layanan');
        $refNo = $request->input('reference_no');
        $rating = $request->input('rating');
        $clientTime = $request->input('client_time');

        $subject = "[PENGADUAN & MASUKAN] " . ($request->input('subject') ?: $category);
        
        $formattedMessage = $validated['message'];
        if ($refNo) {
            $formattedMessage .= "\n\n[Nomor B/L / Resi / Kontainer: " . $refNo . "]";
        }
        if ($rating) {
            $formattedMessage .= "\n[Tingkat Kepuasan: " . $rating . "/5 Bintang]";
        }
        if ($clientTime) {
            $formattedMessage .= "\n[Waktu Pengiriman Perangkat: " . $clientTime . "]";
        }

        // Waktu real pengiriman di zona waktu Indonesia (Asia/Jakarta / WIB)
        $realNow = Carbon::now('Asia/Jakarta');

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'],
            'service_type' => 'Pengaduan & Masukan',
            'subject' => $subject,
            'message' => $formattedMessage,
            'created_at' => $realNow,
            'updated_at' => $realNow,
        ]);

        return redirect()->route('contact')->with('success', 'Terima kasih atas laporan dan masukan Anda! Tim Penjaminan Mutu & Manajemen CTL Line akan segera meninjau dan menindaklanjutinya demi peningkatan mutu layanan.');
    }
}
