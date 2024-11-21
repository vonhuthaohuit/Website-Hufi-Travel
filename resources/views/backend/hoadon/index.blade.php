@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Danh sách hóa đơn</h2>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('hoadon.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm hóa đơn
                    </a>
                </div>

                <table id="hoaDon-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã hoá đơn</th>
                            <th>Tên tour</th>
                            <th>Tên khách hàng</th>
                            <th>Tổng số tiền</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade show" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Hoá đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#hoaDon-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('hoadon.index') !!}',
            columns: [{
                    data: 'mahoadon',
                    name: 'mahoadon'
                },
                {
                    data: 'tentour',
                    name: 'tentour'
                },
                {
                    data: 'nguoidaidien',
                    name: 'nguoidaidien'
                },
                {
                    data: 'tongsotien',
                    name: 'tongsotien'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'desc']
            ],
        });

        $(document).on('click', '.show-details', function() {
            const id = $(this).data('id');
            const url = `hoadon/${id}`;

            $('#detailsModal').modal('show');
            $('#modal-content').html('<p>Đang tải dữ liệu...</p>');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modal-content').html(response.html);
                },
                error: function(xhr) {
                    $('#modal-content').html('<p>Không thể tải dữ liệu. Vui lòng thử lại.</p>');
                }
            });
        });
    </script>
@endpush
