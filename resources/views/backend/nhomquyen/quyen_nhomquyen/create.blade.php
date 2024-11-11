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
                            <h4>Thêm quyền vào nhóm</h4>
                            <div class="card-header-action">

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('quyen_nhomquyen.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phân quyền</label>
                                            <select class="form-control" name="maquyen">
                                                <option value="">Chọn quyền</option>
                                                @foreach ($quyen as $quyenItem)
                                                    <option value="{{ $quyenItem->maquyen }}">{{ $quyenItem->tenquyen }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="manhomquyen" value="{{ $nhomquyen->manhomquyen }}">
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Any additional JavaScript can go here
        });
    </script>
@endpush
