@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('tour.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Tạo mới</a>
                                <a id="create-new-btn" href="{{ route('tour.index') }}" class="btn btn-primary"
                                    class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
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
                let matour = $(this).data('id');

                console.log({
                    matour: matour,
                    tinhtrang: isChecked ? 'true' : 'false'
                });

                $.ajax({
                    url: "{{ route('tour.change-status') }}",
                    method: 'POST',
                    data: {
                        matour: matour,
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
