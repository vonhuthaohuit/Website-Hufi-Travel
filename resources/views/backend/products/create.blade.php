@extends('backend.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Thêm sản phẩm</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group">
                                    <label>Tên SP</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Thương Hiệu</label>
                                            <select id="inputState" class="form-control main-category" name="brand">
                                                <option value="">Select</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Loại</label>
                                            <select id="inputState" class="form-control sub-category" name="type">
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->type_id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Chất liệu</label>
                                    <input name="material" class="form-control"{{ old('material') }}>
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Giá</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
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
            $('.main-category').change(function() {
                let id = $(this).val();

            })
        })
    </script>

@endpush
