@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div>
            <canvas id="customerChart"></canvas>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        // Lấy dữ liệu từ server (giả sử trả về JSON từ API)
    fetch('/admin/statistic/khachhang')
    .then(response => response.json())
    .then(data => {
        // Kiểm tra xem dữ liệu có hợp lệ không
        if (Array.isArray(data) && data.length > 0) {
            // Lấy thông tin ngày gia nhập và số lượng khách hàng từ dữ liệu
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
                        tension: 0.3 // Làm mượt đường
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
@endpush
