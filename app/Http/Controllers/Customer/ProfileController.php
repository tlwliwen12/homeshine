<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('customer.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','email',Rule::unique('users')->ignore(Auth::id())],
            'phone' => 'nullable|max:20',
            'address_line_1' => 'nullable|max:255',
            'address_line_2' => 'nullable|max:255',
            'city' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'postcode' => 'nullable|max:10',
        ]);

        $user = User::find(Auth::id());
        $user->update($request->only([
            'name',
            'email',
            'phone',
            'address_line_1',
            'address_line_2',
            'city',
            'state',
            'postcode',
        ]));

        return back()->with('success', 'Profile updated successfully!');
    }
}
