<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');

            });
        }

        if ($request->filled('category')) {

            $query->where(
                'category',
                $request->category
            );
        }

        $services = $query
            ->withCount('bookings')
            ->latest()
            ->get();

        $totalServices = Service::count();

        $totalBookings = \App\Models\Booking::count();

        $popularService = Service::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->first();

        return view(
            'admin.services',
            compact(
                'services',
                'totalServices',
                'totalBookings',
                'popularService'
            )
        );
    }

    public function create()
    {
        return view('admin.create_service');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'duration' => 'required',
            'image' => 'nullable|image'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' .
                $request->image->extension();

            $request->image->move(
                public_path('images/services'),
                $imageName
            );
        }

        Service::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'image' => $imageName
        ]);

        return redirect('/admin/services')
            ->with('success', 'Service created.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view(
            'admin.edit_service',
            compact('service')
        );
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'duration' => 'required',
            'image' => 'nullable|image'
        ]);

        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('images/services'),
                $imageName
            );

           $data['image'] = $imageName;
        }

        $service->update($data);

        return redirect('/admin/services')
            ->with('success','Service updated successfully.');
    }

    public function destroy($id)
    {
        Service::destroy($id);

        return back()->with(
            'success',
            'Service deleted.'
        );
    }
}
