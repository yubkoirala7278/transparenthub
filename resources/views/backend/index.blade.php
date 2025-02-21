@extends('backend.layouts.master')
@section('header-links')
    <!-- ApexCharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css">
    {{-- style --}}
    <style>
        .heading {
            background: linear-gradient(transparent 50%, rgb(26, 188, 156, 0.4) 50%);
            padding: 5px 10px;
            border-radius: 5px;
            color: #413e46;
        }

        .card.hover-effect {
            transition: transform 0.3s ease, box-custome-shadow 0.3s ease;
        }

        .card.hover-effect:hover {
            transform: translateY(-5px);
            box-custome-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        /* Custom heading style with an underline */
        .heading {
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .heading::after {
            content: "";
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: #1ABC9C;
            left: 0;
            bottom: 0;
        }

        /* Custom tab styles */
        .nav-tabs .nav-link {
            font-weight: 600;
            color: #6c757d;
        }

        .nav-tabs .nav-link.active {
            color: #1ABC9C;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            background: #fff;
            border-radius: 0 0 5px 5px;
        }

        .custome-shadow {
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        }
    </style>
@endsection
@section('content')
    @if (Auth::user()->hasRole('admin'))
        <div>
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="customTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="ecommerce-tab" data-toggle="tab" href="#ecommerce" role="tab"
                        aria-controls="ecommerce" aria-selected="true">
                        <i class="fas fa-shopping-cart mr-1"></i> Ecommerce
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news"
                        aria-selected="false">
                        <i class="fas fa-newspaper mr-1"></i> News
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="municipalities-tab" data-toggle="tab" href="#municipalities" role="tab"
                        aria-controls="municipalities" aria-selected="false">
                        <i class="fa-solid fa-map-location-dot mr-1"></i> Municipalities
                    </a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="customTabContent">
                <!-- Ecommerce Tab -->
                <div class="tab-pane fade show active" id="ecommerce" role="tabpanel" aria-labelledby="ecommerce-tab">
                    <!-- Stats Cards -->
                    <div class="row mt-2">
                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #1ABC9C;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Total Sales</h5>
                                            <h3>Rs {{ number_format($totalSales, 2) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-primary text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-dollar-sign fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p class="{{ $percentageChangeForSales >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas {{ $percentageChangeForSales >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                        {{ number_format($percentageChangeForSales, 2) }}% from last month
                                    </p>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #2ECC71;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Total Orders</h5>
                                            <h3>{{ number_format($totalOrders) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-success text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-shopping-cart fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p class="{{ $percentageChangeForOrders >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas {{ $percentageChangeForOrders >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                        {{ number_format($percentageChangeForOrders, 2) }}% from last month
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #F1C40F;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Customers</h5>
                                            <h3>{{ number_format($totalCustomers) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-warning text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-users fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p
                                        class="{{ $percentageChangeForCustomer >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas {{ $percentageChangeForCustomer >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                        {{ number_format($percentageChangeForCustomer, 2) }}% from last month
                                    </p>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #3498DB;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Current Month</h5>
                                            <h3>Rs {{ number_format($currentMonthSales, 2) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-info text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-chart-line fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p class="{{ $percentageChangeForSales >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas {{ $percentageChangeForSales >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                        {{ number_format($percentageChangeForSales, 2) }}% from last month
                                    </p>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Charts and Recent Orders -->
                    <div class="row">
                        <!-- Revenue Chart -->
                        <div class="col-md-9 mb-4">
                            <div class="card custome-shadow border-0" style="border-radius: 10px">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">Revenue Overview</h5>
                                </div>
                                <div class="card-body">
                                    <div id="revenueChart"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders -->
                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow border-0" style="border-radius: 10px">
                                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                    <h5 class="card-title mb-0">Recent Orders</h5>
                                    <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-primary">View
                                        All</a>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group list-group-flush">
                                        @if (count($recentOrders) > 0)
                                            @foreach ($recentOrders as $key => $order)
                                                <li
                                                    class="list-group-item d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Order #{{ $key + 1 }}</h6>
                                                        <small class="text-muted">{{ $order->first_name }}
                                                            {{ $order->last_name }} -
                                                            <strong>${{ number_format($order->total_amount, 2) }}</strong></small>
                                                    </div>
                                                    <span
                                                        class="badge badge-{{ $order->status == 'delivered'
                                                            ? 'success'
                                                            : ($order->status == 'pending'
                                                                ? 'warning'
                                                                : ($order->status == 'shipped'
                                                                    ? 'primary'
                                                                    : 'danger')) }}">
                                                        <i
                                                            class="fas fa-{{ $order->status == 'delivered'
                                                                ? 'check-circle'
                                                                : ($order->status == 'pending'
                                                                    ? 'clock'
                                                                    : ($order->status == 'shipped'
                                                                        ? 'truck'
                                                                        : 'times-circle')) }}"></i>
                                                        {{ ucfirst($order->status) }}
                                                    </span>

                                                </li>
                                            @endforeach
                                        @else
                                            <p class="d-block text-center">No recent orders to display..</p>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Top Products -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card custome-shadow border-0" style="border-radius: 10px">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Top Selling Products</h5>
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View
                                        All</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Total Sold</th>
                                                    <th>Total Revenue</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($topSellingProducts->count() > 0)
                                                    @foreach ($topSellingProducts as $product)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset($product->product->feature_image) }}"
                                                                    class="mr-2" alt="{{ $product->product->name }}"
                                                                    height="40">
                                                                {{ $product->product->name }}
                                                            </td>
                                                            <td><strong>${{ number_format($product->product->price, 2) }}</strong>
                                                            </td>
                                                            <td>{{ $product->total_qty_sold }}</td>
                                                            <td><strong>${{ number_format($product->total_revenue, 2) }}</strong>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="text-center">
                                                        <td colspan="4">No products to display..</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- News Tab -->
                <div class="tab-pane fade " id="news" role="tabpanel" aria-labelledby="news-tab">
                    <!-- Statistics Cards -->
                    <div class="row mt-2">
                        <!-- Total News -->
                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #F1C40F;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Total News</h5>
                                            <h3>{{ number_format($totalNews) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-warning text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-newspaper fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p class="{{ $percentageChangeForNews >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i class="fas fa-arrow-{{ $percentageChangeForNews >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($percentageChangeForNews) }}% from last month
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- Most Popular News -->
                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #1ABC9C;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Most Popular</h5>
                                            <h3>{{ number_format($mostViewedCount) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-primary text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-fire fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p
                                        class="{{ $percentageChangeForMostViewed >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas fa-arrow-{{ $percentageChangeForMostViewed >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($percentageChangeForMostViewed) }}% from last month
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- Trending News -->
                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #E74C3C;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Trending News</h5>
                                            <h3>{{ number_format($totalTrendingNews) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-danger text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-chart-line fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p
                                        class="{{ $percentageChangeForTrendingNews >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas fa-arrow-{{ $percentageChangeForTrendingNews >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($percentageChangeForTrendingNews) }}% from last month
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- News Categories -->
                        <div class="col-md-3 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #3498DB;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">News Categories</h5>
                                            <h3>{{ number_format($totalCategories) }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-info text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-th-list fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    <p
                                        class="{{ $percentageChangeForCategories >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                        <i
                                            class="fas fa-arrow-{{ $percentageChangeForCategories >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($percentageChangeForCategories) }}% from last month
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row">
                        <!-- News Trend Over Time (Line Chart) -->
                        <div class="col-md-8">
                            <div class="card custome-shadow border-0">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">News Trend Over Time</h5>
                                </div>
                                <div class="card-body">
                                    <div id="newsTrendChart"></div>
                                </div>
                            </div>
                        </div>
                        <!-- News Categories Distribution (Pie Chart) -->
                        <div class="col-md-4">
                            <div class="card custome-shadow border-0">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">News Categories</h5>
                                </div>
                                <div class="card-body">
                                    <div id="newsCategoriesChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Municipalities Tab -->
                <div class="tab-pane fade " id="municipalities" role="tabpanel" aria-labelledby="municipalities-tab">
                    <!-- Statistics Cards -->
                    <div class="row mt-2">
                        <!-- Total Province -->
                        <div class="col-md-4 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #F1C40F;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Total Province</h5>
                                            <h3>{{ $totalProvinces }}</h3> <!-- Dynamic province count -->
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-warning text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-globe-americas fa-2x text-white"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Most District -->
                        <div class="col-md-4 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #1ABC9C;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Total District</h5>
                                            <h3>{{ $totalDistricts }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-primary text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">

                                            <i class="fas fa-map fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Total Municapility -->
                        <div class="col-md-4 mb-4">
                            <div class="card custome-shadow hover-effect"
                                style="border-radius: 10px; border-left: 5px solid #E74C3C;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="text-muted">Total Municipality</h5>
                                            <h3>{{ $totalMunicipalities }}</h3>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center bg-danger text-white p-0"
                                            style="width: 60px; height: 60px; clip-path: circle();">
                                            <i class="fas fa-building fa-2x text-white"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- [ Main Content ] end -->
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchRevenueData();
            fetchNewsTrendData();
            fetchNewsCategoriesData();
        });
        // =============Line Chart to display revenue data from products sell=================
        function fetchRevenueData() {
            fetch("{{ url('/admin/get-revenue-data') }}")
                .then(response => response.json())
                .then(data => {
                    let months = [];
                    let revenueData = [];
                    // Loop for all 12 months
                    for (let m = 1; m <= 12; m++) {
                        // Create short month name (Jan, Feb, etc.)
                        let date = new Date(2022, m - 1, 1);
                        let monthName = date.toLocaleString('default', {
                            month: 'short'
                        });
                        months.push(monthName);
                        revenueData.push(data[m] || 0); // Use 0 if there's no revenue for the month
                    }

                    var options = {
                        series: [{
                            name: 'Revenue',
                            data: revenueData
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            },
                            dropshadow: {
                                enabled: true,
                                color: '#1ABC9C',
                                top: 5,
                                left: 5,
                                blur: 8,
                                opacity: 0.3
                            }
                        },
                        colors: ['#1ABC9C'],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'light',
                                shadeIntensity: 0.4,
                                gradientToColors: ['#A7E5D8'],
                                inverseColors: false,
                                opacityFrom: 0.01,
                                opacityTo: 0.02,
                                stops: [0, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 4,
                            colors: ['#1ABC9C']
                        },
                        markers: {
                            size: 6,
                            colors: ['#ffffff'],
                            strokeColors: '#0E8070',
                            strokeWidth: 3,
                            hover: {
                                size: 9
                            }
                        },
                        xaxis: {
                            categories: months,
                            labels: {
                                style: {
                                    colors: '#6B7280',
                                    fontSize: '14px',
                                    fontWeight: 600
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#6B7280',
                                    fontSize: '14px',
                                    fontWeight: 600
                                }
                            }
                        },
                        grid: {
                            borderColor: '#E5E7EB',
                            strokeDashArray: 4
                        },
                        tooltip: {
                            theme: 'dark',
                            y: {
                                formatter: function(value) {
                                    return "Rs " + value.toLocaleString();
                                }
                            },
                            marker: {
                                show: true
                            }
                        },
                        responsive: [{
                            breakpoint: 1000,
                            options: {
                                chart: {
                                    height: 300
                                }
                            }
                        }]
                    };

                    var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
                    chart.render();
                })
                .catch(error => console.error('Error fetching revenue data:', error));
        }
        // =============end of Line Chart to display revenue data from products sell=================

        // =============Line Chart for News Trend Over Time=========================
        function fetchNewsTrendData() {
            fetch("{{ url('/admin/get-news-trend-data') }}")
                .then(response => response.json())
                .then(data => {
                    // Build arrays for all 12 months
                    let months = [];
                    let newsData = [];
                    for (let m = 1; m <= 12; m++) {
                        // Get short month name using any reference year (2022 here)
                        let date = new Date(2022, m - 1, 1);
                        let monthName = date.toLocaleString('default', {
                            month: 'short'
                        });
                        months.push(monthName);
                        newsData.push(data[m] || 0);
                    }

                    var newsTrendOptions = {
                        chart: {
                            type: 'line',
                            height: 350,
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            },
                            dropshadow: {
                                enabled: true,
                                color: '#1ABC9C',
                                top: 5,
                                left: 5,
                                blur: 10,
                                opacity: 0.3
                            }
                        },
                        series: [{
                            name: 'News Published',
                            data: newsData
                        }],
                        xaxis: {
                            categories: months,
                            labels: {
                                style: {
                                    colors: '#a2aab3',
                                    fontSize: '14px',
                                    fontWeight: 600,
                                    fontFamily: "'Helvetica', sans-serif"
                                }
                            }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 4
                        },
                        markers: {
                            size: 8,
                            colors: ['#ffffff'],
                            strokeColors: '#1ABC9C',
                            strokeWidth: 4,
                            hover: {
                                size: 10,
                                strokeColor: '#1ABC9C',
                                strokeWidth: 4
                            }
                        },
                        colors: ['#1ABC9C'],
                        tooltip: {
                            theme: 'dark',
                            x: {
                                show: true,
                                formatter: function(value) {
                                    return "Month: " + value;
                                }
                            },
                            y: {
                                formatter: function(value) {
                                    return value + " News Published";
                                }
                            },
                            marker: {
                                show: true
                            }
                        },
                        grid: {
                            show: true,
                            borderColor: '#f1f1f1',
                            strokeDashArray: 4,
                            position: 'back',
                            xaxis: {
                                lines: {
                                    show: true,
                                    opacity: 0.2
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: true,
                                    opacity: 0.2
                                }
                            }
                        },
                        responsive: [{
                            breakpoint: 1000,
                            options: {
                                chart: {
                                    height: 300
                                }
                            }
                        }]
                    };

                    var newsTrendChart = new ApexCharts(document.querySelector("#newsTrendChart"), newsTrendOptions);
                    newsTrendChart.render();
                })
                .catch(error => console.error('Error fetching news trend data:', error));
        }
        // =============end of Line Chart for News Trend Over Time=========================

        // =============Pie Chart for News Categories Distribution=====================
        function fetchNewsCategoriesData() {
            fetch("{{ url('/admin/get-news-categories-data') }}")
                .then(response => response.json())
                .then(data => {
                    // data returned should have the format:
                    // { labels: [ 'Politics', 'Sports', ... ], series: [ 44, 33, ... ] }
                    var newsCategoriesOptions = {
                        chart: {
                            type: 'pie',
                            height: 350,
                        },
                        series: data.series,
                        labels: data.labels,
                        colors: ['#4285F4', '#DB4437', '#F4B400', '#0F9D58', '#AB47BC'],
                        tooltip: {
                            theme: 'dark'
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                colors: '#6B7280',
                                useSeriesColors: false
                            }
                        },
                        responsive: [{
                            breakpoint: 600,
                            options: {
                                chart: {
                                    height: 300
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };

                    var newsCategoriesChart = new ApexCharts(document.querySelector("#newsCategoriesChart"),
                        newsCategoriesOptions);
                    newsCategoriesChart.render();
                })
                .catch(error => console.error('Error fetching news categories data:', error));
        }
        // =============end of Pie Chart for News Categories Distribution=====================
    </script>
@endpush
