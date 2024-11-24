<div>
    <p><strong>Mã hóa đơn:</strong> {{ $hoaDon->mahoadon }}</p>
    <p><strong>Tên khách hàng:</strong> {{ $hoaDon->nguoidaidien }}</p>
    <p><strong>Tên tour:</strong>
        {{ $hoaDon->phieudattour && $hoaDon->phieudattour->tour ? $hoaDon->phieudattour->tour->tentour : 'N/A' }}
    </p>
    <p><strong>Tổng số tiền:</strong> {{ number_format($hoaDon->tongsotien, 0, ',', '.') }} VND</p>
    <p><strong>Phương thức thanh toán:</strong> {{ $hoaDon->phuongthucthanhtoan }}</p>
    <p><strong>Trạng thái thanh toán:</strong> {{ $hoaDon->trangthaithanhtoan ? 'Đã thanh toán' : 'Chưa thanh toán' }}
    </p>
    <p><strong>Ngày tạo:</strong> {{ $hoaDon->created_at }}</p>
</div>
