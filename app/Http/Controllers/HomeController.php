<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Product;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::where('is_featured', true)->orderBy('sort_order')->take(4)->get();
        $featuredProducts = Product::where('is_featured', true)->orderBy('sort_order')->take(3)->get();
        $latestPortfolios = Portfolio::orderBy('sort_order')->take(3)->get();
        $testimonials = Testimonial::where('is_featured', true)->take(4)->get();

        return view('pages.home', compact(
            'featuredServices',
            'featuredProducts',
            'latestPortfolios',
            'testimonials'
        ));
    }
}
