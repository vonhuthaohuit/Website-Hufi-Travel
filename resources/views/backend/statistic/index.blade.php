@extends('backend.layouts.master')
<style>
    #PieChart {
        max-width: 700px; /* Chiều rộng tối đa */
        max-height: 700px; /* Chiều cao tối đa */
        margin: 0 auto;    /* Căn giữa biểu đồ */
    }
</style>
@section('content')
    <div class="container">
        <div>
            <h3 style="text-align:center">Số lượng khách hàng</h3>
            <canvas id="customerChart"></canvas>
        </div>
        <div>
            <h3 style="text-align:center">Tỷ lệ khách hàng theo độ tuổi</h3>
            <canvas id="PieChart" width="875" height="875"></canvas>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        fetch('/admin/statistic/khachhang')
            .then(response => response.json())
            .then(data => {
                // Kiểm tra xem dữ liệu có hợp lệ không
                if (Array.isArray(data) && data.length > 0) {
                    const labels = data.map(item => item.ngay_gia_nhap); // Mảng ngày gia nhập
                    const customerCounts = data.map(item => item.so_luong_khach_hang); // Mảng số lượng khách hàng

                    const ctx = document.getElementById('customerChart').getContext('2d');

                    // Tạo biểu đồ đường với Chart.js
                    const customerChart = new Chart(ctx, {
                        type: 'line', // Loại biểu đồ
                        data: {
                            labels: labels, // Ngày gia nhập
                            datasets: [{
                                label: 'Số lượng khách hàng',
                                data: customerCounts, // Số lượng khách hàng
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 2,
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                tooltip: {
                                    enabled: true
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Ngày gia nhập'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Số lượng khách hàng'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    console.error('Dữ liệu không hợp lệ:', data);
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));
    </script>

    <script>
        const labels = @json($labels).map(label => `${label} tuổi`);
        const values = @json($values);
        const data = {
            labels: labels,
            datasets: [{
                data: values, // Dữ liệu số lượng khách hàng
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut', // Hoặc 'bar', 'doughnut', tùy mục đích
            data: data,
        };

        const ageChart = new Chart(
            document.getElementById('PieChart'),
            config
        );
    </script>
@endpush
