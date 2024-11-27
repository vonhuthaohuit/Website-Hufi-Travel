@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div>
            <h3 style="text-align:center">Top Popular Destinations</h3>
            <canvas id="horizontalBarChart" width="400" height="200"></canvas>
        </div>
        <div>
            <h3 style="text-align:center">Top Popular Destinations</h3>
            <canvas id="horizontalBarChart1" width="400" height="200"></canvas>
        </div>

    </div>

@endsection

@push('scripts')
<script>
    // Dữ liệu từ server
    const labels = @json($labels);
    const values = @json($values);

    // Cấu hình biểu đồ
    const data = {
        labels: labels,
        datasets: [{
        //    label: 'Number of Bookings',
            data: values,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(321, 105, 12, 0.2)'
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
    const horizontalBarChart1 = new Chart(
        document.getElementById('horizontalBarChart1'),
        config
    );
</script>
@endpush
