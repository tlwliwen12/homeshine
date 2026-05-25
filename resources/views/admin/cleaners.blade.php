@extends('admin.layout')

@section('content')

<div class="custom-card p-4">

    <h3 class="fw-bold mb-4">
        Manage Cleaners
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table align-middle">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th width="220">Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($cleaners as $cleaner)

            <tr>

                <td>{{ $cleaner->name }}</td>

                <td>{{ $cleaner->email }}</td>

                <td>

                    @if($cleaner->approval_status == 'approved')
                        <span class="badge bg-success">
                            Approved
                        </span>

                    @elseif($cleaner->approval_status == 'pending')
                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                    @else
                        <span class="badge bg-danger">
                            Rejected
                        </span>
                    @endif

                </td>

                <td>

                    @if($cleaner->approval_status == 'pending')

                    <div class="d-flex gap-2">

                        <form method="POST"
                              action="/admin/cleaners/{{ $cleaner->id }}/approve">

                            @csrf

                            <button class="btn btn-success btn-sm">
                                Approve
                            </button>

                        </form>

                        <form method="POST"
                              action="/admin/cleaners/{{ $cleaner->id }}/reject">

                            @csrf

                            <button class="btn btn-danger btn-sm">
                                Reject
                            </button>

                        </form>

                    </div>

                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="4" class="text-center">
                    No cleaners found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
