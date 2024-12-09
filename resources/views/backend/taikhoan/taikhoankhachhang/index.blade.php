@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tài khoản</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả tài khoản khách hàng</h4>
                            <div class="card-header-action">
                                <a href="{{ route('taikhoan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Tạo mới</a>

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
                let mataikhoan = $(this).data('id');

                console.log({
                    mataikhoan: mataikhoan,
                    trangthai: isChecked ? 'true' : 'false'
                });

                $.ajax({
                    url: "{{ route('taikhoan.change-status') }}",
                    method: 'POST',
                    data: {
                        mataikhoan: mataikhoan,
                        trangthai: isChecked ? 'true' : 'false'
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
