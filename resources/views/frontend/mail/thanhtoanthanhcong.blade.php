<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Xác nhận đặt tour thành công</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.5;
        }

        .invoice-container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 24px;
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .details {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .details td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .details th {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }

        .items {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 14px;
        }

        .items th,
        .items td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .items th {
            background-color: #4CAF50;
            color: white;
        }

        .items td {
            text-align: center;
        }

        .total {
            width: 100%;
            margin-top: 30px;
            text-align: right;
        }

        .total td {
            padding: 10px;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-right strong {
            font-size: 16px;
            color: #333;
        }

        p.text-right {
            font-size: 14px;
            margin-top: 15px;
            font-style: italic;
        }

        p.header {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p.header strong {
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <h2 class="header">THÔNG TIN HÓA ĐƠN</h2>
        @if ($hoadon && $hoadon->created_at)
            <p class="header"><strong>Ngày lập:</strong>
                {{ \Carbon\Carbon::parse($hoadon->created_at)->format('d/m/Y') }}
            </p>
        @else
            <p class="header"><strong>Ngày lập:</strong> Không có dữ liệu</p>
        @endif
        </p>

        <table class="details">
            <tr>
                <td><strong>Đơn vị bán hàng:</strong> HUFI Travel</td>
                <td><strong>Mã số thuế:</strong> 123456789</td>
            </tr>
            <tr>
                <td><strong>Địa chỉ:</strong> 140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, TP.HCM</td>
                <td><strong>Điện thoại:</strong> 0388533247</td>
            </tr>
        </table>

        <h4>Thông tin khách hàng</h4>
        <table class="details">
            <tr>
                <td><strong>Người đặt tour:</strong> {{ $hoadon->nguoidaidien ?? 'N/A' }}</td>
                <td><strong>Tên đơn vị:</strong> {{ $hoadon->tendonvi ?? 'N/A' }}</td>
                <td><strong>Mã số thuế:</strong> {{ $hoadon->masothue ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Địa chỉ:</strong> {{ $hoadon->diachidonvi ?? 'N/A' }}</td>
                <td><strong>Điện thoại:</strong> {{ $sodienthoai }}</td>
            </tr>
        </table>

        <h4>Chi tiết phiếu đặt tour</h4>
        <table class="items">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>CCCD</th>
                    <th>Địa chỉ</th>
                    <th>Đơn vị tính</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hoadon->phieudattour->chitietphieudattour as $index => $chiTiet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $chiTiet->khachhang->hoten }}</td>
                        <td>{{ $chiTiet->khachhang->cccd }}</td>
                        <td>{{ $chiTiet->khachhang->diachi ?? 'Không có' }}</td>
                        <td>Vé</td>
                        <td>{{ number_format($chiTiet->chitietsotiendat, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total">
            <tr>
                <td class="text-right"><strong>Tổng cộng:</strong>
                    {{ number_format($hoadon->phieudattour->tongtienphieudattour, 0, ',', '.') }} VNĐ
                </td>
            </tr>
            <tr>
                <td class="text-right"><strong>Tổng thanh toán:</strong>
                    {{ number_format($hoadon->tongsotien, 0, ',', '.') }} VNĐ
                </td>
            </tr>
        </table>

        <p class="text-right"><strong>Số tiền viết bằng chữ:</strong> {{ convertNumberToWords($hoadon->tongsotien) }}
            đồng</p>
    </div>
</body>

</html>
