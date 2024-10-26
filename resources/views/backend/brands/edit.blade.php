@extends('backend.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cập nhật thương hiệu</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('brands.update',$brand->brand_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên Thương Hiệu</label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name" value="{{ $brand->brand_name }}" />

                                </div>
                                <div class="form-group">
                                    <label for="inputState">Quốc gia</label>
                                    <select id="inputState" class="form-control" name="country">
                                        <option value="">Select</option>
                                        <option value="{{ $brand->country }}">{{ $brand->country }}</option>
                                        <option value="Việt Nam">Việt Nam</option>
                                        <option value="Hàn Quốc">Hàn Quốc</option>
                                        <option value="Nhật Bản">Nhật Bản</option>
                                        <option value="Trung Quốc">Trung Quốc</option>
                                        <option value="Mỹ">Mỹ</option>
                                        <option value="Pháp">Pháp</option>
                                        <option value="Anh">Anh</option>
                                        <option value="Nga">Nga</option>
                                        <option value="Ý">Ý</option>
                                        <option value="Đức">Đức</option>
                                        <option value="Tây Ban Nha">Tây Ban Nha</option>
                                        <option value="Thái Lan">Thái Lan</option>
                                        <option value="Úc">Úc</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Thụy Sĩ">Thụy Sĩ</option>
                                        <option value="Thụy Điển">Thụy Điển</option>
                                        <option value="Hà Lan">Hà Lan</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('styles')
    <script>

    <script>

@endpush
