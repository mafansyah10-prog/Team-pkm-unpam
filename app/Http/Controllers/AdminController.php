<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Product;
use App\Models\TeamMember;
use App\Models\GalleryItem;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'services' => Service::count(),
            'products' => Product::count(),
            'team' => TeamMember::count(),
            'gallery' => GalleryItem::count(),
            'portfolios' => Portfolio::count(),
            'testimonials' => Testimonial::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }

    // 1. Services Management
    public function services()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services', compact('services'));
    }

    public function serviceStore(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string',
            'description'       => 'required|string',
            'icon'              => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_featured'       => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/services', 'public');
        } else {
            unset($data['image']);
        }

        $data['slug']       = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['sort_order'] = Service::count() + 1;

        Service::create($data);
        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function serviceDelete($id)
    {
        $service = Service::findOrFail($id);
        if ($service->image && !str_starts_with($service->image, 'http')) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }

    public function serviceUpdate(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string',
            'description'       => 'required|string',
            'icon'              => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && !str_starts_with($service->image, 'http')) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('uploads/services', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');

        $service->update($data);
        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    // 2. Products Management
    public function products()
    {
        $products = Product::orderBy('sort_order')->get();
        return view('admin.products', compact('products'));
    }

    public function productStore(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|string',
            'short_description' => 'required|string',
            'description'       => 'required|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_featured'       => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/products', 'public');
        } else {
            unset($data['image']);
        }

        $data['slug']       = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['sort_order'] = Product::count() + 1;

        Product::create($data);
        return redirect()->back()->with('success', 'Produk logistik berhasil ditambahkan!');
    }

    public function productDelete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|string',
            'short_description' => 'required|string',
            'description'       => 'required|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('uploads/products', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');

        $product->update($data);
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    // 3. Team Management
    public function team()
    {
        $team = TeamMember::orderBy('sort_order')->get();
        return view('admin.team', compact('team'));
    }

    public function teamStore(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'email'      => 'nullable|email',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/team', 'public');
        } else {
            unset($data['image']);
        }

        $data['sort_order'] = TeamMember::count() + 1;

        TeamMember::create($data);
        return redirect()->back()->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function teamDelete($id)
    {
        $member = TeamMember::findOrFail($id);
        if ($member->image && !str_starts_with($member->image, 'http')) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();
        return redirect()->back()->with('success', 'Anggota tim berhasil dihapus!');
    }

    public function teamUpdate(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'email'      => 'nullable|email',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($member->image && !str_starts_with($member->image, 'http')) {
                Storage::disk('public')->delete($member->image);
            }
            $data['image'] = $request->file('image')->store('uploads/team', 'public');
        }

        $member->update($data);
        return redirect()->back()->with('success', 'Anggota tim berhasil diperbarui!');
    }

    // 4. Gallery Management
    public function gallery()
    {
        $gallery = GalleryItem::orderBy('sort_order')->get();
        return view('admin.gallery', compact('gallery'));
    }

    public function galleryStore(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'description' => 'nullable|string',
        ]);

        $data['image']      = $request->file('image')->store('uploads/gallery', 'public');
        $data['sort_order'] = GalleryItem::count() + 1;

        GalleryItem::create($data);
        return redirect()->back()->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function galleryDelete($id)
    {
        $item = GalleryItem::findOrFail($id);
        if ($item->image && !str_starts_with($item->image, 'http')) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!');
    }

    public function galleryUpdate(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && !str_starts_with($item->image, 'http')) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('uploads/gallery', 'public');
        }

        $item->update($data);
        return redirect()->back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    // 5. Portfolios Management
    public function portfolios()
    {
        $portfolios = Portfolio::orderBy('sort_order')->get();
        return view('admin.portfolios', compact('portfolios'));
    }

    public function portfolioStore(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'client'      => 'nullable|string',
            'route'       => 'nullable|string',
            'cargo_type'  => 'nullable|string',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/portfolios', 'public');
        } else {
            unset($data['image']);
        }

        $data['slug']       = Str::slug($data['title']);
        $data['sort_order'] = Portfolio::count() + 1;

        Portfolio::create($data);
        return redirect()->back()->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function portfolioDelete($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->image && !str_starts_with($portfolio->image, 'http')) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();
        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
    }

    public function portfolioUpdate(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'client'      => 'nullable|string',
            'route'       => 'nullable|string',
            'cargo_type'  => 'nullable|string',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($portfolio->image && !str_starts_with($portfolio->image, 'http')) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('uploads/portfolios', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $portfolio->update($data);
        return redirect()->back()->with('success', 'Portofolio berhasil diperbarui!');
    }

    // 6. Testimonials Management
    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials', compact('testimonials'));
    }

    public function testimonialStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data['is_featured'] = true;
        Testimonial::create($data);
        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function testimonialDelete($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus!');
    }

    public function testimonialUpdate(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial->update($data);
        return redirect()->back()->with('success', 'Testimoni berhasil diperbarui!');
    }

    // 7. Contact Messages Management
    public function messages()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function messageToggleRead($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->is_read = !$msg->is_read;
        $msg->save();
        return redirect()->back()->with('success', 'Status pesan diperbarui!');
    }

    public function messageDelete($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }

    // 8. Website Settings
    public function settings()
    {
        $settings = CompanySetting::pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'hero_banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);

        if ($request->hasFile('hero_banner')) {
            $oldBanner = CompanySetting::get('hero_banner');
            if ($oldBanner && !str_starts_with($oldBanner, 'http')) {
                Storage::disk('public')->delete($oldBanner);
            }
            $bannerPath = $request->file('hero_banner')->store('uploads/banners', 'public');
            CompanySetting::set('hero_banner', $bannerPath);
        }

        if ($request->hasFile('about_image')) {
            $oldAboutImg = CompanySetting::get('about_image');
            if ($oldAboutImg && !str_starts_with($oldAboutImg, 'http')) {
                Storage::disk('public')->delete($oldAboutImg);
            }
            $aboutImgPath = $request->file('about_image')->store('uploads/about', 'public');
            CompanySetting::set('about_image', $aboutImgPath);
        }

        foreach ($request->except(['_token', 'hero_banner', 'about_image']) as $key => $value) {
            CompanySetting::set($key, $value);
        }
        return redirect()->back()->with('success', 'Pengaturan website dan profil perusahaan berhasil disimpan!');
    }

    /**
     * Update admin account password.
     */
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required'     => 'Password baru wajib diisi.',
            'new_password.min'          => 'Password baru minimal 6 karakter.',
            'new_password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password admin berhasil diperbarui! Silakan gunakan password baru ini untuk login berikutnya.');
    }

    /**
     * Show the admin profile & OTP contact settings page.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update admin profile (Name, Gmail, WhatsApp/Phone).
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:50',
        ], [
            'name.required'  => 'Nama administrator wajib diisi.',
            'email.required' => 'Alamat Gmail/Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Alamat email ini sudah digunakan oleh akun lain.',
            'phone.required' => 'Nomor WhatsApp / Telepon wajib diisi untuk verifikasi OTP.',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Profil Administrator berhasil diperbarui! Nomor WhatsApp (' . $user->phone . ') dan Gmail (' . $user->email . ') ini sekarang otomatis terhubung untuk pengiriman kode OTP reset password.');
    }
}
