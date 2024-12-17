@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cập nhật model hình ảnh</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <h4><strong>Chú ý Quan Trọng!</strong></h4>
                        <p>
                            Đây là khu vực nhạy cảm dành cho việc cập nhật và điều chỉnh các mô hình AI liên quan đến tính năng tìm kiếm bằng hình ảnh.
                            Việc thao tác sai hoặc không đúng quy trình tại đây có thể gây ra những ảnh hưởng nghiêm trọng, bao gồm nhưng không giới hạn ở:
                        </p>
                        <ul>
                            <li>Làm gián đoạn hoạt động của hệ thống tìm kiếm AI.</li>
                            <li>Gây ra lỗi hoặc sai lệch trong kết quả tìm kiếm hình ảnh.</li>
                            <li>Ảnh hưởng đến dữ liệu người dùng và trải nghiệm tổng thể của khách hàng.</li>
                        </ul>
                        <p>
                            <strong>Chỉ những cá nhân đã được đào tạo đầy đủ và có sự hướng dẫn cụ thể từ bộ phận kỹ thuật mới được phép thao tác tại khu vực này.</strong>
                            Mọi hoạt động thực hiện phải tuân theo quy trình đã được phê duyệt, và cần có sự giám sát trực tiếp từ bộ phận kỹ thuật hoặc quản lý dự án.
                        </p>
                        <p>
                            <strong>Lưu ý:</strong> Nếu bạn không có quyền hoặc chưa được hướng dẫn cụ thể về chức năng này, vui lòng <strong>không thực hiện bất kỳ thay đổi nào</strong>.
                            Nếu có thắc mắc, hãy liên hệ ngay với bộ phận hỗ trợ kỹ thuật để được hướng dẫn chi tiết.
                        </p>
                        <p>
                            Việc tự ý sử dụng mà không có sự phê duyệt hoặc giám sát sẽ bị coi là hành động vi phạm nghiêm trọng và có thể dẫn đến các biện pháp xử lý kỷ luật theo quy định.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center mt-4">
                        <a href="{{ route('upload.model.ai') }}" class="btn btn-lg btn-primary">
                            <i class="fas fa-upload"></i> Upload Model AI
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
    </section>
@endsection
