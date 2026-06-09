<?php

namespace App\Http\Controllers\Cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;

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
        ]);

        $user = User::find(Auth::id());
        $user->update($request->only([
            'name',
            'email',
            'phone',
            'bank_name',
            'bank_account_name',
            'bank_account_number',
            'gender',
        ]));

        return back()->with('success', 'Profile updated successfully!');
    }
}
