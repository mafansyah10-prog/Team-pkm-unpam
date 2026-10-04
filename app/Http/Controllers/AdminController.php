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
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['sort_order'] = Service::count() + 1;

        Service::create($data);
        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function serviceDelete($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
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
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['sort_order'] = Product::count() + 1;

        Product::create($data);
        return redirect()->back()->with('success', 'Produk logistik berhasil ditambahkan!');
    }

    public function productDelete($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'nullable|string',
        ]);

        $data['sort_order'] = TeamMember::count() + 1;

        TeamMember::create($data);
        return redirect()->back()->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function teamDelete($id)
    {
        TeamMember::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Anggota tim berhasil dihapus!');
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
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $data['sort_order'] = GalleryItem::count() + 1;

        GalleryItem::create($data);
        return redirect()->back()->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function galleryDelete($id)
    {
        GalleryItem::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!');
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
            'title' => 'required|string|max:255',
            'client' => 'nullable|string',
            'route' => 'nullable|string',
            'cargo_type' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['sort_order'] = Portfolio::count() + 1;

        Portfolio::create($data);
        return redirect()->back()->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function portfolioDelete($id)
    {
        Portfolio::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
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
        foreach ($request->except('_token') as $key => $value) {
            CompanySetting::set($key, $value);
        }
        return redirect()->back()->with('success', 'Pengaturan website berhasil disimpan!');
    }
}
