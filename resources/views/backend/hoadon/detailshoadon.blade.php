<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
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
    <div class="d-flex justify-content-end mb-3 no-print">
        <a href="{{ route('hoadon.print', $hoadon->mahoadon) }}" class="btn btn-primary">In hóa đơn</a>
    </div>

    <div class="invoice-container">
        <h2 class="header">THÔNG TIN HÓA ĐƠN</h2>
        <p class="header"><strong>Ngày lập:</strong>
            {{ \Carbon\Carbon::parse($hoadon->created_at)->format('d/m/Y') ?? '' }}
        </p>

        <table class="details">
            <tr>
                <td><strong>Đơn vị bán hàng:</strong> {{ 'HUFI Travel' ?? 'N/A' }}</td>
                <td><strong>Mã số thuế:</strong> {{ '123456789' ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="text-truncate"><strong>Địa chỉ:</strong>
                    {{ '140 Lê Trọng Tấn, Phường Tây Thạnh, Quận Tân Phú, TP.HCM' ?? 'N/A' }}</td>
                <td><strong>Điện thoại:</strong> {{ '0388533247' ?? 'N/A' }}</td>
            </tr>
        </table>

        <h4 class="mt-3">Thông tin khách hàng</h4>
        <table class="details">
            <tr>
                <td><strong>Họ tên người đặt tour:</strong> {{ $hoadon->nguoidaidien ?? 'N/A' }}</td>
                <td><strong>Tên đơn vị:</strong> {{ $hoadon->tendonvi ?? 'N/A' }}</td>
                <td><strong>Mã số thuế:</strong> {{ $hoadon->masothue ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Địa chỉ:</strong> {{ $hoadon->diachidonvi ?? 'N/A' }}</td>
                <td><strong>Điện thoại: {{ $sodienthoai }}</strong></td>
            </tr>
        </table>

        <h4 class="mt-4">Chi tiết phiếu đặt tour</h4>
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
                        <td>{{ str_replace(',', ' ', number_format($chiTiet->chitietsotiendat, 0, '', ',')) }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total">
            <tr>
                <td class="text-right"><strong>Tổng cộng</strong>
                    {{ str_replace(',', ' ', number_format($hoadon->phieudattour->tongtienphieudattour, 0, '', ',')) }}
                    VNĐ
                </td>
            </tr>
            <tr>
                <td class="text-right"><strong>Tổng thanh toán:</strong>
                    {{ str_replace(',', ' ', number_format($hoadon->tongsotien, 0, '', ',')) }} VNĐ
                </td>
            </tr>
        </table>

        <p class="text-right"><strong>Số tiền viết bằng chữ:</strong> {{ convertNumberToWords($hoadon->tongsotien) }}
            đồng</p>
    </div>

</body>

</html>
