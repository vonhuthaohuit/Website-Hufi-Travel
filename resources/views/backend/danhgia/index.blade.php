@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản lý đánh giá</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả đánh giá</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let madanhgia = $(this).data('id');

                console.log({
                    madanhgia: madanhgia,
                    tinhtrang: isChecked ? 'true' : 'false'
                });

                $.ajax({
                    url: "{{ route('danhgia.change-status') }}",
                    method: 'POST',
                    data: {
                        madanhgia: madanhgia,
                        tinhtrang: isChecked ? 'true' : 'false'
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
