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
                                <button id="delete-selected" class="btn btn-danger" style="display: none;"><i class='far fa-trash-alt'></i> Xóa đã
                                    chọn</button>
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
            $('#select-all').on('click', function() {
                $('.delete-checkbox').prop('checked', this.checked);
                toggleDeleteButton();
            });

            $(document).on('change', '.delete-checkbox', function() {
                toggleDeleteButton();
            });

            function toggleDeleteButton() {
                let selected = $('.delete-checkbox:checked').length;
                if (selected > 0) {
                    $('#delete-selected').show();
                } else {
                    $('#delete-selected').hide();
                }
            }

            $('#delete-selected').on('click', function() {
                let ids = [];
                $('.delete-checkbox:checked').each(function() {
                    ids.push($(this).data('id'));
                });

                console.log(ids);

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
                                $('#delete-selected').hide();
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
