<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;

class CustomerManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where(
            'role',
            'customer'
        );

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'phone',
                    'like',
                    '%' . $request->search . '%'
                );

            });
        }

        $customers = $query
            ->latest()
            ->get();

        return view(
            'admin.customers',
            compact('customers')
        );
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Customer deleted successfully.'
        );
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);

        $bookings = Booking::where(
            'user_id',
            $customer->id
        )
        ->latest()
        ->get();

        $totalBookings = $bookings->count();

        $totalSpending = $bookings
            ->where('payment_status', 'Paid')
            ->sum(function ($booking) {
                return $booking->service->price;
            });

        return view(
            'admin.customer-details',
            compact(
                'customer',
                'bookings',
                'totalBookings',
                'totalSpending'
            )
        );
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);

        return view(
            'admin.customer-edit',
            compact('customer')
        );
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|max:20',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect('/admin/customers/'.$id)
            ->with(
                'success',
                'Customer updated successfully.'
            );
    }

    public function suspend($id)
    {
        $customer = User::findOrFail($id);

        $customer->update([
            'status' => 'Suspended'
        ]);

        return back()->with(
            'success',
           'Customer suspended.'
        );
    }

    public function activate($id)
    {
        $customer = User::findOrFail($id);

        $customer->update([
            'status' => 'Active'
        ]);

        return back()->with(
            'success',
            'Customer activated.'
        );
    }

    public function statistics()
    {
        $totalCustomers = User::where(
            'role',
            'customer'
        )->count();

        $activeCustomers = User::where(
            'role',
            'customer'
        )
        ->where('status', 'Active')
        ->count();

        $suspendedCustomers = User::where(
            'role',
            'customer'
        )
        ->where('status', 'Suspended')
        ->count();

        $newCustomers = User::where(
            'role',
            'customer'
        )
        ->whereMonth(
            'created_at',
            now()->month
        )
        ->count();

        $topCustomers = User::where(
            'role',
            'customer'
        )
        ->get()
        ->map(function ($customer) {

            $customer->total_spent =
                \App\Models\Booking::where(
                    'user_id',
                    $customer->id
                )
                ->where('payment_status', 'Paid')
                ->get()
                ->sum(function ($booking) {

                    return $booking->service->price;

                });

            return $customer;

        })
        ->sortByDesc('total_spent')
        ->take(5);

    $monthlyCustomers = [];

    for ($i = 1; $i <= 12; $i++) {

        $monthlyCustomers[] = User::where(
            'role',
            'customer'
        )
        ->whereMonth('created_at', $i)
        ->count();
    }

    $monthlyRevenue = [];

    for ($i = 1; $i <= 12; $i++) {

        $monthlyRevenue[] = Booking::where(
            'payment_status',
            'Paid'
        )
        ->whereMonth('updated_at', $i)
        ->get()
        ->sum(function ($booking) {

            return $booking->service->price;

        });
    }

    $bookingStatuses = [
        Booking::where('status', 'Pending')->count(),
        Booking::where('status', 'Approved')->count(),
        Booking::where('status', 'Completed')->count(),
        Booking::where('status', 'Cancelled')->count(),
    ];

    return view(
        'admin.customer-statistics',
        compact(
            'totalCustomers',
            'activeCustomers',
            'suspendedCustomers',
            'newCustomers',
            'topCustomers',
            'monthlyCustomers',
            'monthlyRevenue',
            'bookingStatuses'
        )
    );
    }
}
