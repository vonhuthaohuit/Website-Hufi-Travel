@extends('backend.layouts.master')

<style>
    .tour-statistics {
        padding: 20px;
        background-color: #fff;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .statistical {
        gap: 20px;
    }

    #ageDistributionChart {
        max-width: 500px;
        max-height: 500px;
        margin: 0 auto;
    }
</style>

@section('content')
    <section class="section pb-5">
        <div class="section-header">
            <h1>Thống kê</h1>
        </div>
        <div class="section-body">
            <!-- Hàng đầu tiên: Biểu đồ 1 và 2 -->
            <div class="d-flex w-100 statistical col-md-12">
                <div class="tour-statistics w-100">
                    <h3 style="text-align:center">Tour phổ biến</h3>
                    <canvas id="popularToursChart"></canvas>
                </div>
                <div class="tour-statistics">
                    <h3 style="text-align:center">Tỷ lệ khách hàng theo độ tuổi</h3>
                    <canvas id="ageDistributionChart"></canvas>
                </div>
            </div>

            <!-- Hàng thứ hai: Biểu đồ 3 và 4 -->
            <div class="d-flex mt-4 col-md-12">
                <div class="tour-statistics w-100">
                    <h3 style="text-align:center">Số lượng khách hàng</h3>
                    <canvas id="customerCountChart"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Dữ liệu từ server
        const tourLabels = @json($tourLabels);
        const tourValues = @json($tourValues);

        const ageLabels = @json($ageLabels).map(label => `${label} tuổi`);
        const ageValues = @json($ageValues);



        // 1. Biểu đồ Tour phổ biến
        new Chart(document.getElementById('popularToursChart'), {
            type: 'bar',
            data: {
                labels: tourLabels,
                datasets: [{
                    data: tourValues,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                indexAxis: 'x',
                scales: {
                    x: { ticks: { display: false } },
                    y: { beginAtZero: true }
                }
            }
        });

        // 2. Biểu đồ Tỷ lệ khách hàng theo độ tuổi
        new Chart(document.getElementById('ageDistributionChart'), {
            type: 'pie',
            data: {
                labels: ageLabels,
                datasets: [{
                    data: ageValues,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: { display: true, position: 'top' }
                }
            }
        });

        // 3. Biểu đồ Số lượng khách hàng (Dữ liệu từ API)
        fetch('/admin/statistic/khachhang')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    const customerLabels = data.map(item => item.ngay_gia_nhap);
                    const customerCounts = data.map(item => item.so_luong_khach_hang);

                    new Chart(document.getElementById('customerCountChart'), {
                        type: 'line',
                        data: {
                            labels: customerLabels,
                            datasets: [{
                                label: 'Số lượng khách hàng',
                                data: customerCounts,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 2,
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: true, position: 'top' }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Ngày gia nhập' } },
                                y: { title: { display: true, text: 'Số lượng khách hàng' }, beginAtZero: true }
                            }
                        }
                    });
                } else {
                    console.error('Dữ liệu không hợp lệ:', data);
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));
    </script>
@endpush
