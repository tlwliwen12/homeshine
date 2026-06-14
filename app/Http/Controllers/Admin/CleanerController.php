<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\CleanerApprovedNotification;

class CleanerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'cleaner');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');

            });
        }

        if ($request->filled('status')) {

            $query->where(
                'approval_status',
            $request->status
            );
        }

        $cleaners = $query
            ->latest()
            ->get();

        $totalCleaners = User::where(
            'role',
            'cleaner'
        )->count();

        $approvedCleaners = User::where(
            'role',
            'cleaner'
        )->where(
            'approval_status',
            'approved'
        )->count();

        $pendingCleaners = User::where(
            'role',
            'cleaner'
        )->where(
            'approval_status',
            'pending'
        )->count();

        $rejectedCleaners = User::where(
            'role',
            'cleaner'
        )->where(
            'approval_status',
            'rejected'
        )->count();

        return view(
            'admin.cleaners',
            compact(
                'cleaners',
                'totalCleaners',
                'approvedCleaners',
                'pendingCleaners',
                'rejectedCleaners'
            )
        );
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

    public function destroy($id)
    {
        $cleaner = User::findOrFail($id);

        if ($cleaner->role !== 'cleaner') {
            abort(404);
        }

        if ($cleaner->bookings()->exists()) {
            return back()->with(
                'error',
                'Cannot delete cleaner with existing bookings.'
            );
        }

        $cleaner->delete();

        return back()->with(
            'success',
            'Cleaner account deleted successfully.'
        );
    }
}
