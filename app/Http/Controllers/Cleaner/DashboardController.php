<?php

namespace App\Http\Controllers\Cleaner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('cleaner.dashboard');
    }
}
