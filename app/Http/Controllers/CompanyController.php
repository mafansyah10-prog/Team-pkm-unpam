<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\GalleryItem;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\CompanySetting;
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
        $teamMembers = TeamMember::orderBy('sort_order')->get();
        return view('pages.team', compact('teamMembers'));
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
}
