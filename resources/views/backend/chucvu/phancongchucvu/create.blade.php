@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chức vụ</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm chức vụ cho nhân viên</h4>
                            <div class="card-header-action">

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('phancongchucvu.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chức vụ</label>
                                            <select class="form-control" name="machucvu">
                                                <option value="">Chọn chức vụ</option>
                                                @foreach ($chucvu as $chucvuItem)
                                                    <option value="{{ $chucvuItem->machucvu }}">{{ $chucvuItem->tenchucvu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="manhanvien" value="{{ $nhanvien->manhanvien }}">
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
