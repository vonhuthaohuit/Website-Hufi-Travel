@extends('backend.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Phiếu hủy</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Xác nhận hủy tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phieuhuytour.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('phieuhuytour.update', $phieuhuy->maphieuhuytour) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="maphieudattour" value="{{ $phieuhuy->maphieudattour }}">

                                <div class="form-group">
                                    <label>Tên tour</label>
                                    <span name="tentour" class="form-control">{{ $phieuhuy->tentour }}</span>
                                </div>

                                <div class="form-group">
                                    <label>Khách hàng yêu cầu hủy</label>
                                    <input type="text" name="nguoidaidien" class="form-control" value="{{ $phieuhuy->nguoidaidien }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Lý do hủy</label>
                                    <input type="text" name="lydohuy" class="form-control" value="{{ $phieuhuy->lydohuy }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Ngày hủy</label>
                                    <span class="form-control" name="ngayhuy">{{ $phieuhuy->ngayhuy }}</span>
                                </div>

                                <button type="submmit" class="btn btn-primary">Xác nhận hủy tour</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
