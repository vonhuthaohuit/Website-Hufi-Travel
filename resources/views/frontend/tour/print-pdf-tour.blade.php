<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Cấu hình chung cho body */
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        /* Container chính của invoice */
        .container-xl {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Phần header của invoice */
        .header {
            text-align: center;
        }

        /* Chi tiết tour, items và tổng kết */
        .details,
        .items,
        .total {
            width: 100%;
            margin-top: 20px;
        }

        /* Phần chi tiết tour */
        .details td {
            padding: 5px 10px;
        }

        /* Phần bảng items */
        .items th,
        .items td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .items th {
            background-color: #f2f2f2;
        }

        /* Căn phải cho các phần tử có class .text-right */
        .text-right {
            text-align: right;
        }

        /* Cấu hình khi in ra PDF */
        @media print {
            .no-print {
                display: none !important;
            }

            .container-xl {
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
                padding: 10px;
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

            .justify {
                text-align: justify;
            }

            img {
                display: block;
                max-width: 100%;
                height: auto;
                page-break-before: always;
                /* Optional: ensures each image starts on a new page */
            }
        }
    </style>
</head>

<body>
    <div class="container-xl">
        <h3 class="header">{{ $tour->tentour }}</h3>
        <img src="{{ asset($tour->hinhdaidien) }}" alt="{{ $tour->tentour }}">

        <div class="details">
            <h5><strong>Mô tả tour</strong></h5>
            <p class="justify">{{ $tour->motatour }}</p>

            <h5><strong>Chi tiết tour</strong></h5>
            @foreach ($tour->chuongtrinhtour as $item)
                <h5>{!! $item->tieude !!}</h5>
                <p class="justify">{!! $item->mota !!}</p>
            @endforeach
        </div>
    </div>
</body>

</html>
