@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5">

        <div>

            <h2 class="fw-bold mb-1">
                Customer Statistics
            </h2>

            <p class="text-secondary mb-0">
                Monitor customer growth, activity and spending trends
            </p>

        </div>

        <div>

            <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">

                {{ $totalCustomers }} Total Customers

            </span>

        </div>

    </div>

    {{-- Statistics Cards --}}
    <div class="row g-4 mb-5">

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Customers
                            </small>

                            <h2 class="fw-bold mt-2 mb-0">

                                {{ $totalCustomers }}

                            </h2>

                        </div>

                        <div class="bg-primary bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-people-fill fs-3 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Active Customers
                            </small>

                            <h2 class="fw-bold text-success mt-2 mb-0">

                                {{ $activeCustomers }}

                            </h2>

                        </div>

                        <div class="bg-success bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-person-check-fill fs-3 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Suspended
                            </small>

                            <h2 class="fw-bold text-danger mt-2 mb-0">

                                {{ $suspendedCustomers }}

                            </h2>

                        </div>

                        <div class="bg-danger bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-person-x-fill fs-3 text-danger"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                New This Month
                            </small>

                            <h2 class="fw-bold text-info mt-2 mb-0">

                                {{ $newCustomers }}

                            </h2>

                        </div>

                        <div class="bg-info bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-person-plus-fill fs-3 text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Top Spending Customers --}}
    <div class="card border-0 shadow-sm rounded-4 mb-5">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h4 class="fw-bold mb-1">
                        Top Spending Customers
                    </h4>

                    <p class="text-secondary mb-0">
                        Highest customer spending records
                    </p>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>Customer</th>
                            <th>Email</th>
                            <th>Total Spending</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($topCustomers as $customer)

                        <tr>

                            <td class="fw-semibold">

                                {{ $customer->name }}

                            </td>

                            <td>

                                {{ $customer->email }}

                            </td>

                            <td>

                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                    RM {{ number_format($customer->total_spent, 2) }}

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center py-4 text-muted">

                                No customer spending data available.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Charts --}}
    <div class="row g-4">

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">

                        Monthly Customer Registrations

                    </h5>

                    <canvas id="customerChart"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">

                        Monthly Revenue

                    </h5>

                    <canvas id="revenueChart"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

new Chart(
    document.getElementById('customerChart'),
    {
        type: 'bar',
        data: {
            labels: [
                'Jan','Feb','Mar','Apr',
                'May','Jun','Jul','Aug',
                'Sep','Oct','Nov','Dec'
            ],
            datasets: [{
                label: 'Customers',
                data: @json($monthlyCustomers),
                borderWidth: 1
            }]
        }
    }
);

new Chart(
    document.getElementById('revenueChart'),
    {
        type: 'line',
        data: {
            labels: [
                'Jan','Feb','Mar','Apr',
                'May','Jun','Jul','Aug',
                'Sep','Oct','Nov','Dec'
            ],
            datasets: [{
                label: 'Revenue (RM)',
                data: @json($monthlyRevenue),
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        }
    }
);

</script>

@endsection
