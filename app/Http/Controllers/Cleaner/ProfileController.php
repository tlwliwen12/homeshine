<?php

namespace App\Http\Controllers\Cleaner;

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
        return view('cleaner.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','email',Rule::unique('users')->ignore(Auth::id())],
            'phone' => 'nullable|max:20',
            'bank_name' => 'nullable|max:100',
            'bank_account_name' => 'nullable|max:255',
            'bank_account_number' => 'nullable|max:30',
            'gender' => 'nullable',
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
            'bank_name' => $request->bank_name,
            'bank_account_name' => $request->bank_account_name,
            'bank_account_number' => $request->bank_account_number,
            'gender' => $request->gender,
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

        if (Hash::check(
            $request->new_password,
            Auth::user()->password
        )) {
            return back()->with(
                'error',
                'New password cannot be the same as your current password.'
            );
        }

        $user = User::findOrFail(Auth::id());
        $user->update([
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
