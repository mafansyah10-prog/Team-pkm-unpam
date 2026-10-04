<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('pages.services', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $allServices = Service::where('id', '!=', $service->id)->get();
        return view('pages.service-detail', compact('service', 'allServices'));
    }
}
