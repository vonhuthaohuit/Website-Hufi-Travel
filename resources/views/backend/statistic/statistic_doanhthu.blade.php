@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <h3>Top Popular Destinations</h3>
        <canvas id="horizontalBarChart" width="400" height="200"></canvas>
    </div>
@endsection

@push('scripts')
<script>
    // Dữ liệu từ server
    const labels =  ['Hà Nội', 'Hồ Chí Minh', 'Đà Nẵng'];
    const dataValues =  [120, 95, 80] ;       

    // Cấu hình biểu đồ
    const data = {
        labels: labels,
        datasets: [{
            label: 'Number of Bookings',
            data: dataValues,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Tạo biểu đồ
    const config = {
        type: 'bar',
        data: data,
        options: {
            indexAxis: 'y', // Cột ngang
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    };

    // Khởi tạo Chart.js
    const horizontalBarChart = new Chart(
        document.getElementById('horizontalBarChart'),
        config
    );
</script>
@endpush
