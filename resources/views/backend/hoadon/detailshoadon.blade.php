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

        @media print {
            body * {
                visibility: hidden;
                /* Ẩn tất cả các phần tử trên trang */
            }

            .invoice-container,
            .invoice-container * {
                visibility: visible;
                /* Chỉ hiển thị phần tử .invoice-container */
            }

            .invoice-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .header,
            .details,
            .items,
            .total {
                width: 100%;
                margin-top: 10px;
            }

            .items th,
            .items td {
                border: 1px solid #000;
                padding: 6px;
                text-align: center;
            }

            .items th {
                background-color: #f2f2f2;
            }

            .text-right {
                text-align: right;
            }

            .text-truncate {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }


        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-end mb-3 no-print">
        <a href="{{ route('hoadon.print', $hoaDon->mahoadon) }}" class="btn btn-primary">In hóa đơn</a>
    </div>

    <div class="invoice-container">
        <h2 class="header">THÔNG TIN HÓA ĐƠN</h2>
        <p class="header"><strong>Ngày lập:</strong>
            {{ \Carbon\Carbon::parse($hoaDon->created_at)->format('d/m/Y') ?? '' }}
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

        <h4>Thông tin khách hàng</h4>
        <table class="details">
            <tr>
                <td><strong>Họ tên người đặt tour:</strong> {{ $hoaDon->nguoidaidien ?? 'N/A' }}</td>
                <td><strong>Tên đơn vị:</strong> {{ $hoaDon->tendonvi ?? 'N/A' }}</td>
                <td><strong>Mã số thuế:</strong> {{ $hoaDon->masothue ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Địa chỉ:</strong> {{ $hoaDon->diachidonvi ?? 'N/A' }}</td>
                <td><strong>Điện thoại:</strong> {{ '333' ?? 'N/A' }}</td>
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
                @foreach ($hoaDon->phieudattour->chitietphieudattour as $index => $chiTiet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $hoaDon->phieudattour->tour->tentour }}</td>
                        <td>Vé</td>
                        <td>{{ $chiTiet->chitietsotiendat }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total">
            <tr>
                <td class="text-right"><strong>Tổng cộng</strong>
                    {{ number_format($hoaDon->phieudattour->tongtienphieudattour) }} VNĐ</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Tổng thanh toán:</strong>
                    {{ number_format($hoaDon->tongsotien) }} VNĐ</td>
            </tr>
        </table>

        <p><strong>Số tiền viết bằng chữ:</strong> {{ convertNumberToWords($hoaDon->tongsotien) }} đồng</p>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const printButton = document.querySelector(".no-print a");
                printButton.addEventListener("click", function(event) {
                    event.preventDefault();
                    window.print();
                });
            });
        </script>
    @endpush
</body>

</html>
