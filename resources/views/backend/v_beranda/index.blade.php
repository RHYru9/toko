@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-top">
                    <h5 class="card-title">{{ $judul }}</h5>

                    @php
                        $user = Auth::guard('user')->user();
                    @endphp

                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">
                            Selamat Datang, {{ $user->nama ?? 'Guest' }}
                        </h4>

                        Aplikasi Toko Online dengan hak akses yang anda miliki sebagai
                        <b>
                            @if ($user && $user->role == 1)
                                Super Admin
                            @elseif ($user && $user->role == 0)
                                Admin
                            @else
                                Tidak Dikenal
                            @endif
                        </b>

                        ini adalah halaman utama dari aplikasi Web Programming. Studi Kasus Toko Online.

                        <hr>
                        <p class="mb-0">Kuliah..? BSI Aja !!!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Site Analysis Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-top">
                    <div class="mb-4">
                        <h3 class="mb-1">Site Analysis</h3>
                        <h6 class="text-muted">Overview of Latest Month</h6>
                    </div>

                    <div class="row">
                        <!-- Main Chart - Left Section (8 columns) -->
                        <div class="col-lg-8">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <canvas id="waveChart"></canvas>
                                <div class="chart-legend"
                                    style="position: absolute; top: 10px; right: 10px; display: flex; flex-direction: column;">
                                    <div class="legend-item"
                                        style="display: flex; align-items: center; margin-bottom: 5px;">
                                        <div class="legend-color"
                                            style="width: 12px; height: 12px; margin-right: 5px; background-color: #f0956f;">
                                        </div>
                                        <div class="legend-text" style="font-size: 12px;">sin(x)</div>
                                    </div>
                                    <div class="legend-item"
                                        style="display: flex; align-items: center; margin-bottom: 5px;">
                                        <div class="legend-color"
                                            style="width: 12px; height: 12px; margin-right: 5px; background-color: #6fb7f0;">
                                        </div>
                                        <div class="legend-text" style="font-size: 12px;">cos(x)</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Cards - Right Section (4 columns) -->
                        <div class="col-lg-4">
                            <div class="row">
                                <!-- Total Users Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-dark text-white h-100">
                                        <div class="card-body text-center py-4">
                                            <i class="fas fa-users mb-2" style="font-size: 24px;"></i>
                                            <h2 class="mt-2">{{ $totalCustomers ?? '2540' }}</h2>
                                            <p class="mb-0">Total Users</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- New Users Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-dark text-white h-100">
                                        <div class="card-body text-center py-4">
                                            <i class="fas fa-user-plus mb-2" style="font-size: 24px;"></i>
                                            <h2 class="mt-2">{{ $totalCustomers > 0 ? '0' : '0' }}</h2>
                                            <p class="mb-0">New Users</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Shop Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-dark text-white h-100">
                                        <div class="card-body text-center py-4">
                                            <i class="fas fa-shopping-cart mb-2" style="font-size: 24px;"></i>
                                            <h2 class="mt-2">{{ $totalProducts ?? '656' }}</h2>
                                            <p class="mb-0">Total Shop</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Orders Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-dark text-white h-100">
                                        <div class="card-body text-center py-4">
                                            <i class="fas fa-tag mb-2" style="font-size: 24px;"></i>
                                            <h2 class="mt-2">{{ $totalOrders ?? '9540' }}</h2>
                                            <p class="mb-0">Total Orders</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Orders Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-dark text-white h-100">
                                        <div class="card-body text-center py-4">
                                            <i class="fas fa-th mb-2" style="font-size: 24px;"></i>
                                            <h2 class="mt-2">{{ $orderStatusData[0] ?? '100' }}</h2>
                                            <p class="mb-0">Pending Orders</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Online Orders Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-dark text-white h-100">
                                        <div class="card-body text-center py-4">
                                            <i class="fas fa-globe mb-2" style="font-size: 24px;"></i>
                                            <h2 class="mt-2">{{ $orderStatusData[1] ?? '8540' }}</h2>
                                            <p class="mb-0">Online Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card {
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .bg-dark {
                background-color: #343a40 !important;
            }

            .text-white h2 {
                font-size: 2rem;
                font-weight: 600;
            }

            .text-white p {
                font-size: 14px;
                opacity: 0.8;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pastikan Chart.js sudah dimuat
                if (typeof Chart === 'undefined') {
                    console.error('Chart.js is not loaded');
                    return;
                }

                const canvas = document.getElementById('waveChart');

                if (!canvas) {
                    console.error('Canvas element not found');
                    return;
                }

                const ctx = canvas.getContext('2d');

                // Generate data points
                const points = 40; // Kurangi jumlah titik
                const labels = [];
                const sinData = [];
                const cosData = [];

                for (let i = 0; i <= points; i++) {
                    const x = (4 * Math.PI * i) / points; // Gunakan 4π untuk 2 gelombang penuh (2 atas, 2 bawah)
                    labels.push(i % 5 === 0 ? (x / Math.PI).toFixed(1) + 'π' : '');
                    sinData.push(Math.sin(x));
                    cosData.push(Math.cos(x));
                }

                const chartData = {
                    labels: labels,
                    datasets: [{
                            label: 'sin(x)',
                            data: sinData,
                            borderColor: '#e07b52',
                            backgroundColor: 'rgba(224, 123, 82, 0.1)',
                            pointBorderColor: '#e07b52',
                            pointBackgroundColor: '#fff',
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            borderWidth: 2,
                            tension: 0.55, // <--- bikin garis lengkung halus
                            spanGaps: true
                        },
                        {
                            label: 'cos(x)',
                            data: cosData,
                            borderColor: '#54a4e3',
                            backgroundColor: 'rgba(84, 164, 227, 0.1)',
                            pointBorderColor: '#54a4e3',
                            pointBackgroundColor: '#fff',
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            borderWidth: 2,
                            tension: 0.55,
                            spanGaps: true
                        }
                    ]
                };

                const chartOptions = {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        x: {
                            type: 'linear',
                            title: {
                                display: true,
                                text: 'x'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'y'
                            }
                        }
                    }
                };


                const config = {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(200, 200, 200, 0.2)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#333'
                                }
                            },
                            y: {
                                min: -1.1,
                                max: 1.1,
                                grid: {
                                    color: 'rgba(200, 200, 200, 0.2)',
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: 0.5,
                                    callback: function(value) {
                                        if (value === 0) return '0.0';
                                        if (value === 1) return '1.0';
                                        if (value === -1) return '-1.0';
                                        if (value === 0.5) return '0.5';
                                        if (value === -0.5) return '-0.5';
                                        return value;
                                    },
                                    color: '#333'
                                }
                            }
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        }
                    }
                };

                new Chart(ctx, config);
            });
        </script>
    @endpush
@endsection
