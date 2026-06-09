<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\CleanerApprovedNotification;

class CleanerController extends Controller
{
    public function index()
    {
        $cleaners = User::where('role', 'cleaner')->get();

        return view('admin.cleaners', compact('cleaners'));
    }

    public function approve($id)
    {
        $cleaner = User::findOrFail($id);

        $cleaner->update([
            'approval_status' => 'approved'
        ]);

        $cleaner->notify(
            new CleanerApprovedNotification()
        );

        return back()->with(
            'success',
            'Cleaner approved successfully.'
        );
    }

    public function reject($id)
    {
        $cleaner = User::findOrFail($id);

        $cleaner->update([
            'approval_status' => 'rejected'
        ]);

        return back()->with('success', 'Cleaner rejected successfully.');
    }
}
