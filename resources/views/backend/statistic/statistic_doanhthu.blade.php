@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div>
            <h1>Thống kê doanh số</h1>
        </div>
        <div>
            <canvas id="customerChart" style="max-width: 500px; max-height: 500px;"></canvas>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            // Cấu hình và render biểu đồ
            const config = {
                type: 'doughnut', // Loại biểu đồ (có thể là 'bar', 'line', 'pie', ...)
                data: data,
            };

            // Render biểu đồ trên canvas
            const customerChart = new Chart(
                document.getElementById('customerChart'),
                config
            );
        });
    </script>
@endpush
