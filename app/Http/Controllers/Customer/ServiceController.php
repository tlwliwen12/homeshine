<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Review;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('category', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $services = $query->latest()->get();

        return view('customer.services', compact('services'));
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        $reviews = Review::where('service_id', $id)
            ->latest()
            ->get();

        return view('services.show', compact('service', 'reviews'));
    }
}
