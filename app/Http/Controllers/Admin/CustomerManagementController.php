<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
