@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hóa đơn</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <h2 class="mb-4">Danh sách hóa đơn</h2>
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('hoadon.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Thêm hóa đơn
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="hoaDon-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        {{-- <th>Mã hóa đơn</th> --}}
                                        <th>Tên tour</th>
                                        <th>Người đại diện</th>
                                        <th>Tổng số tiền</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
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
                        width: '5%'
                    },
                    // {
                    //     data: 'mahoadon',
                    //     name: 'mahoadon',
                    //     width: '10%'
                    // },
                    {
                        data: 'tentour',
                        name: 'tentour',
                        width: '30%'
                    },
                    {
                        data: 'nguoidaidien',
                        name: 'nguoidaidien',
                        width: '10%'
                    },
                    {
                        data: 'tongsotien',
                        name: 'tongsotien',
                        width: '15%',
                        render: function(data, type, row) {
                            let formattedNumber = data.toLocaleString().replace(/,/g, ' ');
                            return formattedNumber + ' VNĐ';
                        }
                    },
                    {
                        data: 'trangthaithanhtoan',
                        name: 'trangthaithanhtoan',
                        width: '15%',
                        render: function(data, type, row) {
                            return data === 'Đã thanh toán' ? '<span class="badge badge-success">' +
                                data +
                                '</span>' : '<span class="badge badge-danger">' + data + '</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%',
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
