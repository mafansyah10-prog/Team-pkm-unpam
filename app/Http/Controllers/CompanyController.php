<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Department;
use App\Models\GalleryItem;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\CompanySetting;
use App\Models\PackagingGroup;
use App\Models\PackagingItem;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function about()
    {
        $teamMembers = TeamMember::orderBy('sort_order')->take(4)->get();
        $galleryItems = GalleryItem::orderBy('sort_order')->take(6)->get();
        return view('pages.about', compact('teamMembers', 'galleryItems'));
    }

    public function team()
    {
        $departments = Department::with(['members' => function ($query) {
            $query->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        $teamMembers = TeamMember::with('departmentModel')->orderBy('sort_order')->get();
        return view('pages.team', compact('teamMembers', 'departments'));
    }

    public function gallery(Request $request)
    {
        $category = $request->get('category');
        $query = GalleryItem::orderBy('sort_order');
        if ($category) {
            $query->where('category', $category);
        }
        $galleryItems = $query->get();
        $categories = GalleryItem::select('category')->distinct()->pluck('category');

        return view('pages.gallery', compact('galleryItems', 'categories', 'category'));
    }

    public function portfolio()
    {
        $portfolios = Portfolio::orderBy('sort_order')->get();
        return view('pages.portfolio', compact('portfolios'));
    }

    public function portfolioDetail($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        $otherPortfolios = Portfolio::where('id', '!=', $portfolio->id)->take(3)->get();
        return view('pages.portfolio-detail', compact('portfolio', 'otherPortfolios'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('pages.testimonials', compact('testimonials'));
    }

    public function packagingGuide()
    {
        $groups = PackagingGroup::with('activeItems')->orderBy('sort_order')->get();

        $packagingGroups = $groups->map(function ($group) {
            return [
                'id'    => $group->slug,
                'title' => $group->title,
                'icon'  => $group->icon ?: 'fa-box',
                'desc'  => $group->desc ?: '',
                'cards' => $group->activeItems->map(fn($item) => $item->toCard())->values()->toArray(),
            ];
        })->filter(fn($g) => count($g['cards']) > 0)->values()->toArray();

        return view('pages.packaging-guide', compact('packagingGroups'));
    }
}
