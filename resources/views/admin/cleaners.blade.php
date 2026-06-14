@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Page Header -->
    <div class="page-header">

        <h1 class="page-title">
            Manage Cleaners
        </h1>

        <p class="page-subtitle">
            Review and manage all registered cleaners.
        </p>

    </div>

    <!-- Success Message -->
    @if(session('success'))

        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- Statistics -->
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-secondary">
                                Total Cleaners
                            </small>

                            <h3 class="fw-bold mb-0 mt-2">
                                {{ $totalCleaners }}
                            </h3>

                        </div>

                        <div class="icon-box bg-primary-subtle text-primary">

                            <i class="bi bi-people-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-secondary">
                                Approved
                            </small>

                            <h3 class="fw-bold text-success mb-0 mt-2">
                                {{ $approvedCleaners }}
                            </h3>

                        </div>

                        <div class="icon-box bg-success-subtle text-success">

                            <i class="bi bi-check-circle-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-secondary">
                                Pending
                            </small>

                            <h3 class="fw-bold text-warning mb-0 mt-2">
                                {{ $pendingCleaners }}
                            </h3>

                        </div>

                        <div class="icon-box bg-warning-subtle text-warning">

                            <i class="bi bi-hourglass-split"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-secondary">
                                Rejected
                            </small>

                            <h3 class="fw-bold text-danger mb-0 mt-2">
                                {{ $rejectedCleaners }}
                            </h3>

                        </div>

                        <div class="icon-box bg-danger-subtle text-danger">

                            <i class="bi bi-x-circle-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Search -->
    <div class="section-card mb-4">

        <div class="card-body p-4">

            <form method="GET" action="/admin/cleaners">

                <div class="row g-3">

                    <div class="col-lg-10">

                        <div class="input-group">

                            <span class="input-group-text bg-white border-end-0 rounded-start-pill">

                                <i class="bi bi-search"></i>

                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control border-start-0 rounded-end-pill"
                                   placeholder="Search cleaner name or email..."
                                   value="{{ request('search') }}">

                        </div>

                    </div>

                    <div class="col-lg-2 d-grid">

                        <button class="btn btn-primary rounded-pill">

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Status Filters -->
    <div class="d-flex flex-wrap gap-2 mb-4">

        <a href="/admin/cleaners"
           class="btn btn-dark rounded-pill">

            All

        </a>

        <a href="/admin/cleaners?status=approved"
           class="btn btn-success rounded-pill">

            Approved

        </a>

        <a href="/admin/cleaners?status=pending"
           class="btn btn-warning rounded-pill">

            Pending

        </a>

        <a href="/admin/cleaners?status=rejected"
           class="btn btn-danger rounded-pill">

            Rejected

        </a>

    </div>

    <!-- Cleaner Cards -->
    <div class="row g-4">

        @forelse($cleaners as $cleaner)

            <div class="col-md-6 col-xl-4">

                <div class="section-card h-100">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">

                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width:90px;height:90px;">

                                <i class="bi bi-person-fill fs-1 text-primary"></i>

                            </div>

                        </div>

                        <h5 class="fw-bold text-center mb-1">

                            {{ $cleaner->name }}

                        </h5>

                        <p class="text-secondary text-center mb-3">

                            {{ $cleaner->email }}

                        </p>

                        <div class="text-center mb-4">

                            @if($cleaner->approval_status == 'approved')

                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                    Approved

                                </span>

                            @elseif($cleaner->approval_status == 'pending')

                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">

                                    Pending Approval

                                </span>

                            @else

                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">

                                    Rejected

                                </span>

                            @endif

                        </div>

                        <div class="d-grid gap-2">

                            @if($cleaner->approval_status == 'pending')

                                <div class="d-flex gap-2">

                                    <form method="POST"
                                          action="/admin/cleaners/{{ $cleaner->id }}/approve"
                                          class="w-100">

                                       @csrf

                                        <button class="btn btn-success rounded-pill w-100">

                                            <i class="bi bi-check-lg me-1"></i>
                                            Approve

                                        </button>

                                    </form>

                                    <form method="POST"
                                          action="/admin/cleaners/{{ $cleaner->id }}/reject"
                                          class="w-100">

                                        @csrf

                                        <button class="btn btn-danger rounded-pill w-100">

                                            <i class="bi bi-x-lg me-1"></i>
                                            Reject

                                        </button>

                                    </form>

                                </div>

                            @endif

                            <!-- View -->
                            <button class="btn btn-outline-primary rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewCleaner{{ $cleaner->id }}">

                                <i class="bi bi-eye me-1"></i>
                                View Details

                            </button>

                            <!-- Delete -->
                            <button class="btn btn-outline-danger rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCleaner{{ $cleaner->id }}">

                                <i class="bi bi-trash me-1"></i>
                                Delete Account

                            </button>

                        </div>

                    </div>

                </div>

            </div>

             <!-- VIEW CLEANER -->
<div class="modal fade"
     id="viewCleaner{{ $cleaner->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content rounded-4 border-0">

            <div class="modal-header">

                <h5 class="modal-title">

                    Cleaner Details

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <p>
                    <strong>Name:</strong>
                    {{ $cleaner->name }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $cleaner->email }}
                </p>

                <p>
                    <strong>Phone:</strong>
                    {{ $cleaner->phone ?? '-' }}
                </p>

                <p>
                    <strong>Gender:</strong>
                    {{ $cleaner->gender ?? '-' }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ ucfirst($cleaner->approval_status) }}
                </p>

                <p>
                    <strong>Joined:</strong>
                    {{ $cleaner->created_at->format('d M Y') }}
                </p>

            </div>

        </div>

    </div>

</div>

<!-- DELETE CLEANER -->
<div class="modal fade"
     id="deleteCleaner{{ $cleaner->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content rounded-4 border-0">

            <div class="modal-body text-center p-4">

                <i class="bi bi-trash fs-1 text-danger"></i>

                <h4 class="fw-bold mt-3">

                    Delete Cleaner?

                </h4>

                <p class="text-secondary">

                    This action cannot be undone.

                </p>

                <div class="d-flex gap-2">

                    <button type="button"
                            class="btn btn-light rounded-pill w-100"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <form method="POST"
                          action="/admin/cleaners/{{ $cleaner->id }}"
                          class="w-100">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger rounded-pill w-100">

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

        @empty

            <div class="col-12">

                <div class="section-card p-5 text-center">

                    <i class="bi bi-person-badge fs-1 text-secondary"></i>

                    <h4 class="fw-bold mt-3">

                        No Cleaners Found

                    </h4>

                    <p class="text-secondary mb-0">

                        No cleaners matched your search criteria.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
