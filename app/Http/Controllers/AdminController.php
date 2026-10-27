<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Product;
use App\Models\TeamMember;
use App\Models\Department;
use App\Models\GalleryItem;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\CompanySetting;
use App\Models\PackagingGroup;
use App\Models\PackagingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $packagingCount = 0;
        try {
            if (!Schema::hasTable('packaging_items') || !Schema::hasTable('packaging_groups')) {
                Artisan::call('migrate', ['--force' => true]);
            }
            $packagingCount = PackagingItem::count();
        } catch (\Throwable $e) {
            $packagingCount = 0;
        }

        $stats = [
            'services' => Service::count(),
            'products' => Product::count(),
            'team' => TeamMember::count(),
            'gallery' => GalleryItem::count(),
            'portfolios' => Portfolio::count(),
            'testimonials' => Testimonial::count(),
            'packaging' => $packagingCount,
            'unread_messages' => ContactMessage::pending()->where('is_read', false)->count(),
            'pending_messages' => ContactMessage::pending()->count(),
            'history_messages' => ContactMessage::history()->count(),
        ];

        $recentMessages = ContactMessage::pending()->orderBy('created_at', 'desc')->take(5)->get();

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

    // 3. Team & Department Management
    public function team()
    {
        $departments = Department::withCount('members')
            ->with(['members' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();
        $team = TeamMember::with('departmentModel')->orderBy('sort_order')->get();
        return view('admin.team', compact('team', 'departments'));
    }

    public function teamStore(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'department_id'    => 'required|exists:departments,id',
            'email'            => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'responsibilities' => 'nullable|string',
            'authorities'      => 'nullable|string',
            'bio'              => 'nullable|string',
            'sort_order'       => 'nullable|integer',
        ]);

        $dept = Department::findOrFail($data['department_id']);
        $data['department'] = $dept->name;
        if (array_key_exists('email', $data)) {
            $data['email'] = !empty($data['email']) ? trim($data['email']) : null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/team', 'public');
        }

        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = TeamMember::count() + 1;
        }

        TeamMember::create($data);
        return redirect()->back()->with('success', 'Anggota tim "' . $data['name'] . '" berhasil ditambahkan ke ' . $dept->name . '!');
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
            'name'             => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'department_id'    => 'required|exists:departments,id',
            'email'            => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'remove_image'     => 'nullable',
            'responsibilities' => 'nullable|string',
            'authorities'      => 'nullable|string',
            'bio'              => 'nullable|string',
            'sort_order'       => 'nullable|integer',
        ]);

        $dept = Department::findOrFail($data['department_id']);
        $data['department'] = $dept->name;
        if (array_key_exists('email', $data)) {
            $data['email'] = !empty($data['email']) ? trim($data['email']) : null;
        }

        if ($request->hasFile('image')) {
            if ($member->image && !str_starts_with($member->image, 'http')) {
                Storage::disk('public')->delete($member->image);
            }
            $data['image'] = $request->file('image')->store('uploads/team', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($member->image && !str_starts_with($member->image, 'http')) {
                Storage::disk('public')->delete($member->image);
            }
            $data['image'] = null;
        }

        $member->update($data);
        return redirect()->back()->with('success', 'Data anggota tim "' . $member->name . '" berhasil diperbarui!');
    }

    // 3.1 Department Category CRUD & Reordering
    public function departmentStore(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'leader_name'  => 'nullable|string|max:255',
            'leader_title' => 'nullable|string|max:255',
            'sort_order'   => 'nullable|integer',
            'is_executive' => 'nullable',
            'color'        => 'nullable|string',
        ]);

        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug ?: 'dept-' . time();
        $counter = 1;
        while (Department::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $data['slug'] = $slug;
        $data['is_executive'] = in_array($request->input('is_executive'), [1, '1', true, 'true'], true);
        
        if (!empty($data['color'])) {
            $rawColor = trim($data['color']);
            if (!str_starts_with($rawColor, '#')) {
                $rawColor = '#' . $rawColor;
            }
            $data['color'] = strtolower($rawColor);
        } else {
            $data['color'] = '#b91c1c';
        }

        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = (Department::max('sort_order') ?? 0) + 1;
        }

        $dept = Department::create($data);

        // Auto-create leader as TeamMember if provided
        if (!empty($data['leader_name'])) {
            TeamMember::create([
                'name'          => $data['leader_name'],
                'position'      => !empty($data['leader_title']) ? $data['leader_title'] : 'Manager of ' . $dept->name,
                'department_id' => $dept->id,
                'department'    => $dept->name,
                'sort_order'    => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Kategori departemen "' . $data['name'] . '" berhasil ditambahkan!');
    }

    public function departmentUpdate(Request $request, $id = null)
    {
        $targetId = $id ?: ($request->input('department_id') ?: $request->input('id'));
        $dept = Department::findOrFail($targetId);
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'leader_name'  => 'nullable|string|max:255',
            'leader_title' => 'nullable|string|max:255',
            'sort_order'   => 'nullable|integer',
            'is_executive' => 'nullable',
            'color'        => 'nullable|string',
        ]);

        $data['is_executive'] = in_array($request->input('is_executive'), [1, '1', true, 'true'], true);
        
        if (!empty($data['color'])) {
            $rawColor = trim($data['color']);
            if (!str_starts_with($rawColor, '#')) {
                $rawColor = '#' . $rawColor;
            }
            $data['color'] = strtolower($rawColor);
        } else {
            $data['color'] = $dept->color ?? '#b91c1c';
        }

        if (isset($data['sort_order']) && $data['sort_order'] !== null) {
            $data['sort_order'] = (int) $data['sort_order'];
        }

        $oldLeaderName = $dept->leader_name;
        $dept->update($data);

        // Keep existing members' string department synced
        TeamMember::where('department_id', $dept->id)->update(['department' => $dept->name]);

        // Sync leader as TeamMember if leader_name is provided
        if (!empty($data['leader_name'])) {
            $leaderTitle = !empty($data['leader_title']) ? $data['leader_title'] : 'Manager of ' . $dept->name;
            $leaderMember = TeamMember::where('department_id', $dept->id)
                ->where(function($q) use ($oldLeaderName, $data) {
                    if ($oldLeaderName) {
                        $q->where('name', $oldLeaderName)->orWhere('name', $data['leader_name']);
                    } else {
                        $q->where('name', $data['leader_name']);
                    }
                })->first();

            if ($leaderMember) {
                $leaderMember->update([
                    'name'       => $data['leader_name'],
                    'position'   => $leaderTitle,
                    'department' => $dept->name,
                ]);
            } else {
                TeamMember::create([
                    'name'          => $data['leader_name'],
                    'position'      => $leaderTitle,
                    'department_id' => $dept->id,
                    'department'    => $dept->name,
                    'sort_order'    => 1,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Kategori departemen "' . $dept->name . '" berhasil diperbarui!');
    }

    public function departmentDelete($id)
    {
        $dept = Department::findOrFail($id);
        $name = $dept->name;

        // Disassociate members so data is not corrupted
        TeamMember::where('department_id', $id)->update([
            'department_id' => null,
            'department' => 'Tanpa Kategori'
        ]);

        $dept->delete();
        return redirect()->back()->with('success', 'Kategori departemen "' . $name . '" berhasil dihapus!');
    }

    public function departmentMove($id, $direction)
    {
        $current = Department::findOrFail($id);
        $currentOrder = (int) $current->sort_order;

        if ($direction === 'up') {
            $target = Department::where('sort_order', '<', $currentOrder)
                ->orderBy('sort_order', 'desc')
                ->first();
        } else {
            $target = Department::where('sort_order', '>', $currentOrder)
                ->orderBy('sort_order', 'asc')
                ->first();
        }

        if ($target) {
            $targetOrder = (int) $target->sort_order;
            // Swap sort_order
            $current->update(['sort_order' => $targetOrder]);
            $target->update(['sort_order' => $currentOrder]);
            return redirect()->back()->with('success', 'Posisi card box "' . $current->name . '" berhasil dipindahkan!');
        }

        return redirect()->back()->with('info', 'Posisi card box sudah berada di batas urutan.');
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

    // 7. Contact Messages & Complaints Management + History
    public function messages(Request $request)
    {
        $activeMessages = ContactMessage::pending()->orderBy('created_at', 'desc')->get();
        $historyMessages = ContactMessage::history()->orderByRaw('COALESCE(resolved_at, deleted_at, updated_at) DESC')->get();
        
        $activeTab = $request->query('tab', 'active');
        
        $stats = [
            'active_count'   => $activeMessages->count(),
            'unread_count'   => $activeMessages->where('is_read', false)->count(),
            'history_count'  => $historyMessages->count(),
            'resolved_count' => $historyMessages->where('status', 'resolved')->count(),
            'deleted_count'  => $historyMessages->where('status', 'deleted')->count(),
        ];

        // Format riwayat pengaduan untuk kalender interaktif
        $historyEvents = $historyMessages->map(function ($msg) {
            $eventDate = ($msg->resolved_at ?? $msg->deleted_at ?? $msg->created_at)?->timezone('Asia/Jakarta')->format('Y-m-d') 
                ?? $msg->created_at?->timezone('Asia/Jakarta')->format('Y-m-d');
            return [
                'id' => $msg->id,
                'name' => $msg->name,
                'company' => $msg->company,
                'subject' => $msg->subject,
                'status' => $msg->status,
                'date' => $eventDate,
                'created_date' => $msg->created_at?->timezone('Asia/Jakarta')->format('Y-m-d'),
                'formatted_date' => $msg->formatted_date,
                'formatted_resolved_at' => $msg->formatted_resolved_at,
                'formatted_deleted_at' => $msg->formatted_deleted_at,
                'handled_by' => $msg->handled_by,
                'resolution_notes' => $msg->resolution_notes,
                'deleted_reason' => $msg->deleted_reason,
            ];
        });

        return view('admin.messages', compact('activeMessages', 'historyMessages', 'historyEvents', 'activeTab', 'stats'));
    }

    public function messageToggleRead($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->is_read = !$msg->is_read;
        $msg->save();
        return redirect()->back()->with('success', 'Status baca laporan berhasil diperbarui!');
    }

    public function messageResolve(Request $request, $id)
    {
        $msg = ContactMessage::findOrFail($id);
        $notes = $request->input('resolution_notes');
        $adminName = Auth::user()->name ?? 'Administrator';

        $msg->status = 'resolved';
        $msg->is_read = true;
        $msg->resolved_at = Carbon::now('Asia/Jakarta');
        $msg->handled_by = $adminName;
        $msg->resolution_notes = $notes;
        $msg->save();

        return redirect()->route('admin.messages', ['tab' => 'history'])
            ->with('success', 'Laporan dari "' . $msg->name . '" telah selesai ditangani dan dicatat ke Riwayat (History)!');
    }

    public function messageDelete(Request $request, $id)
    {
        $msg = ContactMessage::findOrFail($id);
        
        // Pindahkan ke riwayat sebagai laporan yang dihapus / diarsipkan
        $msg->status = 'deleted';
        $msg->deleted_at = Carbon::now('Asia/Jakarta');
        $msg->deleted_reason = $request->input('reason', 'Dihapus dari inbox aktif');
        $msg->save();

        return redirect()->back()->with('success', 'Laporan dari "' . $msg->name . '" berhasil dihapus dari inbox aktif dan dipindahkan ke Riwayat (History).');
    }

    public function messageRestore($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->status = 'pending';
        $msg->deleted_at = null;
        $msg->resolved_at = null;
        $msg->save();

        return redirect()->route('admin.messages', ['tab' => 'active'])
            ->with('success', 'Laporan dari "' . $msg->name . '" berhasil dipulihkan kembali ke Inbox Aktif!');
    }

    public function messageForceDelete($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $name = $msg->name;
        $msg->delete();

        return redirect()->back()->with('success', 'Laporan dari "' . $name . '" telah dihapus secara permanen dari sistem.');
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

        foreach ($request->except(['_token', 'hero_banner', 'about_image', 'social_media']) as $key => $value) {
            CompanySetting::set($key, $value);
        }

        // Process dynamic social media list
        if ($request->has('social_media')) {
            $rawSocial = $request->input('social_media');
            $socialArray = is_array($rawSocial) ? $rawSocial : json_decode($rawSocial, true);
            if (is_array($socialArray)) {
                CompanySetting::set('social_media', json_encode(array_values($socialArray)));
                
                // Keep backward compatibility for individual platform keys
                foreach ($socialArray as $sm) {
                    $platform = strtolower($sm['platform'] ?? '');
                    if (str_contains($platform, 'facebook')) {
                        CompanySetting::set('facebook_url', $sm['url'] ?? '#');
                    } elseif (str_contains($platform, 'instagram')) {
                        CompanySetting::set('instagram_url', $sm['url'] ?? '#');
                    } elseif (str_contains($platform, 'linkedin')) {
                        CompanySetting::set('linkedin_url', $sm['url'] ?? '#');
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Pengaturan website, kontak, dan akun sosial media berhasil disimpan!');
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
        $fonnteToken  = env('FONNTE_TOKEN') ?: CompanySetting::get('fonnte_token', '');
        $mailUsername = CompanySetting::get('mail_username') ?: env('MAIL_USERNAME', '');
        $mailPassword = CompanySetting::get('mail_password') ?: env('MAIL_PASSWORD', '');
        $mailHost     = CompanySetting::get('mail_host') ?: env('MAIL_HOST', 'smtp.gmail.com');
        $mailPort     = CompanySetting::get('mail_port') ?: env('MAIL_PORT', '587');

        return view('admin.profile', compact(
            'user',
            'fonnteToken',
            'mailUsername',
            'mailPassword',
            'mailHost',
            'mailPort'
        ));
    }

    /**
     * Update admin profile (Name, and Gmail SMTP OTP Settings).
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => 'required|string|max:255',
            'mail_username' => 'required|email|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_host'     => 'nullable|string|max:255',
            'mail_port'     => 'nullable|string|max:10',
        ], [
            'name.required'          => 'Nama administrator wajib diisi.',
            'mail_username.required' => 'Alamat Gmail Administrator wajib diisi.',
            'mail_username.email'    => 'Format alamat Gmail tidak valid.',
            'mail_password.required' => 'Sandi Aplikasi Google (16 Digit) wajib diisi.',
        ]);

        $user->name  = $request->name;
        $user->email = trim($request->mail_username);
        $user->save();

        CompanySetting::set('mail_username', trim($request->mail_username));
        CompanySetting::set('mail_password', trim($request->mail_password));
        CompanySetting::set('mail_host', trim($request->input('mail_host', 'smtp.gmail.com')));
        CompanySetting::set('mail_port', trim($request->input('mail_port', '587')));

        return redirect()->back()->with('success', 'Pengaturan Pengiriman OTP Administrator berhasil diperbarui! Kode OTP 6-digit sekarang otomatis dikirimkan ke Gmail: ' . $user->email);
    }

    // ── 9. Packaging Guide Management ──────────────────────────────────────────
    public function packaging()
    {
        try {
            if (!Schema::hasTable('packaging_groups') || !Schema::hasTable('packaging_items')) {
                Artisan::call('migrate', ['--force' => true]);
            }

            $items = PackagingItem::with('group')
                ->orderBy('group_id')
                ->orderBy('sort_order')
                ->get();
                
            $groups = PackagingGroup::withCount('items')
                ->orderBy('sort_order')
                ->get();
        } catch (\Throwable $e) {
            $items = collect();
            $groups = collect();
        }

        return view('admin.packaging', compact('items', 'groups'));
    }

    public function runMigrations()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('optimize:clear');
            return redirect()->route('admin.dashboard')->with('success', 'Migrasi database berhasil dijalankan!');
        } catch (\Throwable $e) {
            return redirect()->route('admin.dashboard')->withErrors(['migration' => 'Error migrasi: ' . $e->getMessage()]);
        }
    }

    public function packagingStore(Request $request)
    {
        $data = $request->validate([
            'group_id'   => 'required|exists:packaging_groups,id',
            'code'       => 'required|string|max:10',
            'ceisa'      => 'required|string|max:255',
            'title'      => 'required|string|max:255',
            'desc'       => 'required|string',
            'example'    => 'nullable|string|max:255',
            'tips'       => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active'  => 'nullable',
        ], [
            'group_id.required' => 'Kategori/grup kemasan wajib dipilih.',
            'code.required'     => 'Kode kemasan CEISA wajib diisi (misal: CT, PX, DR).',
            'ceisa.required'    => 'Nama resmi CEISA wajib diisi (misal: Carton, Pallet).',
            'title.required'    => 'Judul kemasan wajib diisi.',
            'desc.required'     => 'Deskripsi teknis kemasan wajib diisi.',
        ]);

        $data['code'] = strtoupper(trim($data['code']));
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = PackagingItem::where('group_id', $data['group_id'])->count() + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/packaging', 'public');
        }

        PackagingItem::create($data);

        return redirect()->back()->with('success', 'Kemasan ' . $data['code'] . ' - ' . $data['title'] . ' berhasil ditambahkan ke katalog!');
    }

    public function packagingUpdate(Request $request, $id)
    {
        $item = PackagingItem::findOrFail($id);

        $data = $request->validate([
            'group_id'   => 'required|exists:packaging_groups,id',
            'code'       => 'required|string|max:10',
            'ceisa'      => 'required|string|max:255',
            'title'      => 'required|string|max:255',
            'desc'       => 'required|string',
            'example'    => 'nullable|string|max:255',
            'tips'       => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active'  => 'nullable',
        ], [
            'group_id.required' => 'Kategori/grup kemasan wajib dipilih.',
            'code.required'     => 'Kode kemasan CEISA wajib diisi.',
            'ceisa.required'    => 'Nama resmi CEISA wajib diisi.',
            'title.required'    => 'Judul kemasan wajib diisi.',
            'desc.required'     => 'Deskripsi teknis kemasan wajib diisi.',
        ]);

        $data['code'] = strtoupper(trim($data['code']));
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($item->image && str_starts_with($item->image, 'uploads/')) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('uploads/packaging', 'public');
        }

        $item->update($data);

        return redirect()->back()->with('success', 'Data kemasan ' . $item->code . ' berhasil diperbarui!');
    }

    public function packagingDelete($id)
    {
        $item = PackagingItem::findOrFail($id);
        $code = $item->code;

        if ($item->image && str_starts_with($item->image, 'uploads/')) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Kemasan ' . $code . ' berhasil dihapus!');
    }

    public function packagingGroupStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon'  => 'nullable|string|max:50',
            'desc'  => 'nullable|string',
        ]);

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (PackagingGroup::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $data['slug'] = $slug;
        $data['icon'] = $data['icon'] ?: 'fa-box';
        $data['sort_order'] = PackagingGroup::count() + 1;

        PackagingGroup::create($data);

        return redirect()->back()->with('success', 'Kategori kemasan "' . $data['title'] . '" berhasil ditambahkan!');
    }

    public function packagingGroupUpdate(Request $request, $id)
    {
        $group = PackagingGroup::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon'  => 'nullable|string|max:50',
            'desc'  => 'nullable|string',
        ]);

        if (empty($data['icon'])) {
            $data['icon'] = 'fa-box';
        }

        $group->update($data);

        return redirect()->back()->with('success', 'Kategori kemasan "' . $group->title . '" berhasil diperbarui!');
    }

    public function packagingGroupDelete($id)
    {
        $group = PackagingGroup::findOrFail($id);
        $itemCount = $group->items()->count();
        $title = $group->title;

        if ($itemCount > 0) {
            return redirect()->back()->withErrors([
                'group' => 'Kategori "' . $title . '" memiliki ' . $itemCount . ' kemasan di dalamnya. Hapus atau pindahkan kemasan tersebut sebelum menghapus kategori ini.'
            ]);
        }

        $group->delete();

        return redirect()->back()->with('success', 'Kategori kemasan "' . $title . '" berhasil dihapus!');
    }
}
