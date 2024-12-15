@extends('frontend.layouts.app')

@push('style')
    <style>
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .heading-primary,
        .heading-secondary,
        .heading-tertiary {
            color: #007bff;
        }

        .list {
            margin-left: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #ddd;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
        }

        .text-cancel {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            padding: 20px;
        }
    </style>
@endpush

@section('renderBody')
    <div class="container-xl text-cancel pt-5">
        <h2 class="heading-secondary">I. Điều kiện hủy tour</h2>
        <p>Khách hàng có quyền yêu cầu hủy tour trong các trường hợp sau đây:</p>
        <ul class="list">
            <li>Có lý do cá nhân đặc biệt, chẳng hạn như vấn đề sức khỏe, công việc, hoặc các yếu tố khách quan khác.</li>
            <li>Công ty thay đổi lịch trình, điểm đến, hoặc các dịch vụ đã cam kết mà không thông báo trước cho khách hàng.
            </li>
            <li>Các yếu tố bất khả kháng như thiên tai, dịch bệnh, hoặc các yêu cầu từ cơ quan chức năng khiến chuyến đi
                không thể thực hiện.</li>
        </ul>

        <h2 class="heading-secondary">II. Quy trình yêu cầu hủy tour</h2>
        <ol>
            <li>
                <strong>Thông báo hủy tour:</strong>
                <p>Khách hàng phải gửi yêu cầu hủy tour trực tiếp qua email, hotline, hoặc thông qua hệ thống đặt tour trên
                    website của công ty. Yêu cầu hủy tour cần kèm theo các thông tin:</p>
                <ul class="list">
                    <li>Mã tour đã đặt.</li>
                    <li>Họ và tên người đặt.</li>
                    <li>Ngày đặt tour.</li>
                    <li>Ngày khởi hành.</li>
                    <li>Lý do hủy tour (nếu có).</li>
                </ul>
            </li>
            <li>
                <strong>Xác nhận hủy tour:</strong>
                <p>Sau khi nhận được yêu cầu hủy tour, công ty sẽ xác nhận lại thông tin với khách hàng qua email hoặc điện
                    thoại trong vòng <strong>24 giờ làm việc</strong>.</p>
            </li>
            <li>
                <strong>Thời gian xử lý hoàn tiền:</strong>
                <p>Sau khi yêu cầu hủy tour được xác nhận, công ty sẽ tiến hành hoàn tiền (nếu có) trong vòng <strong>7-14
                        ngày làm việc</strong>, tùy theo phương thức thanh toán ban đầu của khách hàng.</p>
            </li>
        </ol>

        <h2 class="heading-secondary">III. Quy định về hoàn tiền khi hủy tour</h2>
        <p>Việc hoàn tiền khi hủy tour sẽ được áp dụng theo số ngày khách hàng yêu cầu hủy trước ngày khởi hành. Cụ thể:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Thời gian hủy trước ngày khởi hành</th>
                    <th>Phần trăm hoàn tiền (%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hơn 30 ngày</td>
                    <td>100%</td>
                </tr>
                <tr>
                    <td>Từ 16 đến 30 ngày</td>
                    <td>70%</td>
                </tr>
                <tr>
                    <td>Từ 8 đến 15 ngày</td>
                    <td>30%</td>
                </tr>
                <tr>
                    <td>Từ 4 đến 7 ngày</td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td>Ít hơn 4 ngày</td>
                    <td>0%</td>
                </tr>
            </tbody>
        </table>

        <h2 class="heading-secondary">IV. Trường hợp công ty hủy tour</h2>
        <p>Nếu công ty buộc phải hủy tour vì lý do bất khả kháng hoặc lý do nội bộ, khách hàng sẽ được hoàn tiền 100% hoặc
            đổi sang tour khác.</p>

        <h2 class="heading-secondary">V. Thông tin liên hệ</h2>
        <p>Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ, vui lòng liên hệ:</p>
        <ul class="list">
            <li><strong>Hotline:</strong> 0329 951 368</li>
            <li><strong>Email:</strong> contact@hufitravel.com</li>
            <li><strong>Địa chỉ:</strong> 140 Lê Trọng Tấn, Tây Thạnh, Tân Phú, TP. Hồ Chí Minh.</li>
        </ul>
    </div>
@endsection
