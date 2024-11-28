<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hóa đơn</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .header {
            text-align: center;
        }

        .details,
        .items,
        .total {
            width: 100%;
            margin-top: 20px;
        }

        .details td {
            padding: 5px 10px;
        }

        .items th,
        .items td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .items th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <h2 class="header">THÔNG TIN HÓA ĐƠN</h2>
        <p class="header"><strong>Ngày lập:</strong> {{ \Carbon\Carbon::parse($hoadon->created_at)->format('d/m/Y') }}
        </p>

        <table class="details">
            <tr>
                <td><strong>Đơn vị bán hàng:</strong> HUFI Travel</td>
                <td><strong>Mã số thuế:</strong> 123456789</td>
            </tr>
            <tr>
                <td><strong>Địa chỉ:</strong> 140 Lê Trọng Tấn, Tân Phú, TP.HCM</td>
                <td><strong>Điện thoại:</strong> 0388533247</td>
            </tr>
        </table>

        <h4>Thông tin khách hàng</h4>
        <table class="details">
            <tr>
                <td><strong>Họ tên người đặt tour:</strong> {{ $hoadon->nguoidaidien ?? 'N/A' }}</td>
                <td><strong>Tên đơn vị:</strong> {{ $hoadon->tendonvi ?? 'N/A' }}</td>
                <td><strong>Mã số thuế:</strong> {{ $hoadon->masothue ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Địa chỉ:</strong> {{ $hoadon->diachidonvi ?? 'N/A' }}</td>
                <td><strong>Điện thoại:</strong> {{ $hoadon->sodienthoai ?? 'N/A' }}</td>
            </tr>
        </table>

        <h4>Chi tiết phiếu đặt tour</h4>
        <table class="items">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên tour</th>
                    <th>Đơn vị tính</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hoadon->phieudattour->chitietphieudattour as $index => $chiTiet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $chiTiet->tour->tentour ?? 'N/A' }}</td>
                        <td>Vé</td>
                        <td>{{ number_format($chiTiet->chitietsotiendat, 0, '', ',') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total">
            <tr>
                <td class="text-right"><strong>Tổng cộng:</strong>
                    {{ number_format($hoadon->phieudattour->tongtienphieudattour, 0, '', ',') }} VNĐ</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Tổng thanh toán:</strong>
                    {{ number_format($hoadon->tongsotien, 0, '', ',') }} VNĐ</td>
            </tr>
        </table>

        <p class="text-right"><strong>Số tiền viết bằng chữ:</strong> {{ convertNumberToWords($hoadon->tongsotien) }}
            đồng</p>
    </div>
</body>

</html>
