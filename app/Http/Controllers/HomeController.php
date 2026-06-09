<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Redirect logged-in users by role
        if (Auth::check()) {

            return match (Auth::user()->role) {
                'customer' => redirect('/customer/dashboard'),
                'cleaner' => redirect('/cleaner/dashboard'),
                'admin' => redirect('/admin/dashboard'),
                default => view('home'),
            };
        }

        return view('home');
    }
}
