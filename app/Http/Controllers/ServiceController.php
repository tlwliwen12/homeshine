<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $this->adminCheck();

        $services = Service::all();

        return view('admin.services', compact('services'));
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('services.show', compact('service'));
    }

    public function create()
    {
        $this->adminCheck();

        return view('admin.create_service');
    }

    public function store(Request $request)
    {
        $this->adminCheck();

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $path = public_path('images/services');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $imageName = time().'.'.$request->image->extension();

            $request->image->move($path, $imageName);
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
            ->with('success', 'Service added successfully!');
    }

    public function edit($id)
    {
        $this->adminCheck();

        $service = Service::findOrFail($id);

        return view('admin.edit_service', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $this->adminCheck();

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $service = Service::findOrFail($id);

        $imageName = $service->image;

        if ($request->hasFile('image')) {

            // delete old image
            if (
                $service->image &&
                file_exists(public_path('images/services/'.$service->image))
            ) {
                unlink(public_path('images/services/'.$service->image));
            }

            $path = public_path('images/services');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $imageName = time().'.'.$request->image->extension();

            $request->image->move($path, $imageName);
        }

        $service->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'image' => $imageName
        ]);

        return redirect('/admin/services')
            ->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $this->adminCheck();

        $service = Service::findOrFail($id);

        // delete image
        if (
            $service->image &&
            file_exists(public_path('images/services/'.$service->image))
        ) {
            unlink(public_path('images/services/'.$service->image));
        }

        $service->delete();

        return redirect('/admin/services')
            ->with('success', 'Service deleted successfully!');
    }

    private function adminCheck()
    {
        if (!Auth::check() || Auth::user()->role != 'admin') {
            abort(403);
        }
    }
}
