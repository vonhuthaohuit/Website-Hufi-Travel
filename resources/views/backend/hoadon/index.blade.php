@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Danh sách hóa đơn</h2>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('hoadon.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm hóa đơn
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="hoaDon-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã hóa đơn</th>
                                <th>Tên tour</th>
                                <th>Người đại diện</th>
                                <th>Tổng số tiền</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('frontend/images/logo.png') }}" alt="Hufi Travel" width="70">
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            let table = $('#hoaDon-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('hoadon.index') !!}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '10%'
                    },
                    {
                        data: 'mahoadon',
                        name: 'mahoadon',
                        width: '10%'
                    },
                    {
                        data: 'tentour',
                        name: 'tentour',
                        width: '30%'
                    },
                    {
                        data: 'nguoidaidien',
                        name: 'nguoidaidien',
                        width: '20%'
                    },
                    {
                        data: 'tongsotien',
                        name: 'tongsotien',
                        width: '15%',
                        render: function(data, type, row) {
                            return data + ' VNĐ';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '25%',
                        className: 'text-center'
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                responsive: true,
                autoWidth: false,
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
                    error: function() {
                        $('#modal-content').html(
                            '<p>Không thể tải dữ liệu. Vui lòng thử lại.</p>');
                    }
                });
            });
        });
    </script>
@endpush
