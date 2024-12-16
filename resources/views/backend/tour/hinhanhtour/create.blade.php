@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hình ảnh tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm hình ảnh mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('hinhanhtour.index', ['tour_id' => $tour->matour]) }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('hinhanhtour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
      {{-- <div class="form-group">
                                    <label>Tên hình ảnh</label>
                                    <input type="text" class="form-control" name="tenhinh" required
                                        value="{{ old('tenhinh') }}">
                                </div> --}}
                                <input type="hidden" name="matour" value="{{ $tour->matour }}">
                                <input type="hidden" name="tenhinh" value="{{ $tour->tentour }}" hidden>



                                <div class="form-group">
                                    <label>Hình ảnh tour</label>
                                    <input type="file" class="form-control" name="duongdan[]" multiple>
                                </div>

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
