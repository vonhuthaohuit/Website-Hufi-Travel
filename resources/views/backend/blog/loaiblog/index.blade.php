@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog Category</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả loại blog</h4>
                            <div class="card-header-action">
                                <a href="{{ route('loaiblog.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Create New</a>
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

    <button id="delete-selected" class="btn btn-danger mb-2">Xóa đã chọn</button>

    <script>
        $(document).ready(function() {
            // Chọn tất cả checkbox
            $('#select-all').on('click', function() {
                $('.delete-checkbox').prop('checked', this.checked);
                toggleDeleteButton(); // Gọi hàm để kiểm tra trạng thái nút xóa
            });

            // Sự kiện khi chọn/bỏ chọn từng checkbox
            $(document).on('change', '.delete-checkbox', function() {
                toggleDeleteButton(); // Gọi hàm để kiểm tra trạng thái nút xóa
            });

            // Hàm kiểm tra trạng thái nút xóa
            function toggleDeleteButton() {
                let selected = $('.delete-checkbox:checked').length;
                if (selected > 0) {
                    $('#delete-selected').show();
                } else {
                    $('#delete-selected').hide();
                }
            }

            // Xử lý sự kiện xóa nhiều
            $('#delete-selected').on('click', function() {
                let ids = [];
                $('.delete-checkbox:checked').each(function() {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    if (confirm('Bạn có chắc chắn muốn xóa các mục đã chọn?')) {
                        $.ajax({
                            url: "{{ route('loaiblog.massDestroy') }}",
                            type: 'DELETE',
                            data: {
                                ids: ids,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                alert(response.message);
                                $('#loaiblogdatatables-table').DataTable().ajax.reload();
                                $('#delete-selected').hide(); // Ẩn nút sau khi xóa
                            }
                        });
                    }
                } else {
                    alert('Vui lòng chọn ít nhất một mục để xóa.');
                }
            });
        });
    </script>
@endpush
