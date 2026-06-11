<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('profile_image')) {

            $path = $request->file('profile_image')
                ->store('profiles', 'public');

            $user->profile_image = $path;
        }

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
        ]);

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check(
            $request->current_password,
            Auth::user()->password
        )) {
            return back()->with(
                'error',
                'Current password is incorrect.'
            );
        }

        $user = User::findOrFail(Auth::id());
        Auth::user()->update([
            'password' => Hash::make(
                $request->new_password
            )
        ]);

        return back()->with(
            'success',
            'Password updated successfully.'
        );
    }
}
