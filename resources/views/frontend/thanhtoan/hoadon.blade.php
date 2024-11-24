@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Danh sách hóa đơn</h2>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('hoadon.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm hóa đơn
                    </a>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT Hóa đơn</th>
                            <th>Tên tour</th>
                            <th>Tên khách hàng</th>
                            <th>Mức áp dụng giá</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hoaDons as $hoaDonIndex => $hoaDon)
                            @php
                                $hoaDonStt = ($hoaDons->currentPage() - 1) * $hoaDons->perPage() + $hoaDonIndex + 1;
                                $kiemTraSTT = true;
                            @endphp
                            @foreach ($hoaDon->phieudattour->chitietphieudattour as $chiTiet)
                                <tr>
                                    @if ($kiemTraSTT)
                                        <td rowspan="{{ $hoaDon->phieudattour->chitietphieudattour->count() }}">
                                            {{ $hoaDonStt }}</td>
                                        @php $kiemTraSTT = false; @endphp
                                    @endif
                                    <td>{{ $hoaDon->phieudattour->tour->tentour }}</td>
                                    <td>{{ $chiTiet->khachhang->hoten }}</td>
                                    <td>{{ number_format($hoaDon->tongsotien, 2) }}</td>
                                    @if ($loop->first)
                                        <td rowspan="{{ $hoaDon->phieudattour->chitietphieudattour->count() }}"
                                            class="text-center align-middle">
                                            <a href="{{ route('hoadon.edit', $hoaDon->mahoadon) }}"
                                                class="btn btn-warning btn-sm mb-1" title="Sửa hóa đơn">
                                                <i class="bi bi-pencil-square"></i> Sửa
                                            </a>

                                            <form action=" {{ route('hoadon.destroy', $hoaDon->mahoadon) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-1"
                                                    title="Xóa hóa đơn"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này?')">
                                                    <i class="bi bi-trash"></i> Xóa
                                                </button>
                                            </form>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right"><strong>Tổng số tiền:</strong></td>
                                <td><strong>{{ number_format($hoaDon->tongsotien, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Tổng số lượng:</strong></td>
                                <td>{{ $hoaDon->phieudattour->tongsoluong }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Trạng thái thanh toán:</strong></td>
                                <td>{{ $hoaDon->trangthaithanhtoan }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Phương thức thanh toán:</strong></td>
                                <td>{{ $hoaDon->phuongthucthanhtoan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $hoaDons->links('frontend.layouts.phantrang') }}
                </div>
            </div>
        </div>
    </div>
@endsection
