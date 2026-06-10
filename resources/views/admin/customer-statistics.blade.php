@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">

            Customer Statistics

        </h2>

        <p class="text-secondary">

            Monitor customer growth and activity

        </p>

    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h6>Total Customers</h6>

                    <h2 class="fw-bold">

                        {{ $totalCustomers }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h6>Active</h6>

                    <h2 class="fw-bold text-success">

                        {{ $activeCustomers }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h6>Suspended</h6>

                    <h2 class="fw-bold text-danger">

                        {{ $suspendedCustomers }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h6>New This Month</h6>

                    <h2 class="fw-bold text-primary">

                        {{ $newCustomers }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <h4 class="fw-bold mb-3">

                Top Spending Customers

            </h4>

            <table class="table">

                <thead>

                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Total Spending</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($topCustomers as $customer)

                    <tr>

                        <td>

                            {{ $customer->name }}

                        </td>

                        <td>

                            {{ $customer->email }}

                        </td>

                        <td class="fw-bold text-success">

                            RM {{ number_format($customer->total_spent, 2) }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="row mt-4">

        <!-- Customer Registration -->

        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">

                        Monthly Customer Registrations

                    </h5>

                    <canvas id="customerChart"></canvas>

                </div>

            </div>

        </div>

        <!-- Revenue -->

        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">

                        Monthly Revenue

                    </h5>

                    <canvas id="revenueChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <h5 class="fw-bold mb-3">

                Booking Status Distribution

            </h5>

            <canvas id="bookingChart"></canvas>

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
                data: @json($monthlyCustomers)
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
                data: @json($monthlyRevenue)
            }]
        }
    }
);

new Chart(
    document.getElementById('bookingChart'),
    {
        type: 'pie',
        data: {
            labels: [
                'Pending',
                'Approved',
                'Completed',
                'Cancelled'
            ],
            datasets: [{
                data: @json($bookingStatuses)
            }]
        }
    }
);

</script>

@endsection
