@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Thêm nhân viên vào tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $tour->tentour }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phancongnhanvien.index', ['tour_id' => $tour->matour]) }}"
                                    class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <form action="{{ route('phancongnhanvien.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chức vụ</label>
                                                <select id="chucvu-select" class="form-control" name="tenchucvu">
                                                    <option value="Tài xế">Tài xế</option>
                                                    <option value="Hướng dẫn viên">Hướng dẫn viên</option>
                                                    <option value="Thu ngân">Thu ngân</option>
                                                    <option value="Nhân viên phụ trách">Nhân viên phụ trách</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nhiệm vụ</label>
                                                <input type="text" class="form-control" id="nhiemvu-input" value=""
                                                    required name="nhiemvu">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="tour_id" value="{{ $tour->matour }}">

                                    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Danh Sách Nhân Viên</h2>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200 rounded-lg"
                                            id="nhanvien-table">
                                            <thead class="bg-blue-100">
                                                <tr>
                                                    <th
                                                        class="py-3 px-6 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">
                                                        Chọn</th>

                                                    <th
                                                        class="py-3 px-6 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">
                                                        Tên Nhân Viên</th>
                                                    <th
                                                        class="py-3 px-6 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">
                                                        Bằng cấp</th>
                                                    <th
                                                        class="py-3 px-6 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">
                                                        Chức Vụ</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">

                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Xác nhận</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Any additional JavaScript can go here
        });
    </script>
    <script>
        document.getElementById('chucvu-select').addEventListener('change', function() {
            const tenChucVu = this.value;
            if (tenChucVu) {
                // Gọi AJAX để lấy danh sách nhân viên theo chức vụ
                loadNhanVienTheoChucVu(tenChucVu);
                document.getElementById('nhiemvu-input').value = tenChucVu;
            } else {
                // Xóa dữ liệu cũ nếu không có chức vụ được chọn
                document.querySelector('#nhanvien-table tbody').innerHTML = '';
            }
        });

        function loadNhanVienTheoChucVu(tenchucvu) {
            $.ajax({
                url: "/admin/chon-nhan-vien/" + tenchucvu,
                method: 'GET',
                success: function(data) {
                    let html = '';
                    data.forEach(data => {
                        html += `<tr class="hover:bg-blue-50">
                              <td class="py-4 px-6 whitespace-nowrap text-gray-700">
                                <input type="checkbox" name="nhanvien[]" value="${data.manhanvien}" class="form-checkbox h-5 w-5 text-blue-600">
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-700">${data.hoten}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-700">${data.bangcap}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-700">${data.tenchucvu}</td>
                         </tr>`;
                    });
                    $('#nhanvien-table tbody').html(html);
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Không thể tải dữ liệu nhân viên. Vui lòng thử lại sau.');
                }
            });
        }
        loadNhanVienTheoChucVu('Tài Xế');
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngừng hành động mặc định của form (tải lại trang)
            const selectedNhanVien = [];
            // Lấy tất cả các checkbox đã được chọn
            document.querySelectorAll('input[name="nhanvien[]"]:checked').forEach(function(checkbox) {
                selectedNhanVien.push(checkbox.value);
            });

            if (selectedNhanVien.length === 0) {
                alert('Vui lòng chọn ít nhất một nhân viên.');
                return;
            }

            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: '/admin/phan-cong-nhan-vien', // Địa chỉ đến controller xử lý
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Đảm bảo bảo mật CSRF
                    tour_id: '{{ $tour->matour }}',
                    chucvu: document.getElementById('chucvu-select').value, // Lấy chức vụ từ select
                    nhanvien: selectedNhanVien, // Mảng nhân viên đã chọn
                },
                success: function(response) {
                    alert('Nhân viên đã được phân công thành công!');
                    // Bạn có thể chuyển hướng hoặc thực hiện hành động khác nếu cần
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            });
        });
    </script>
@endpush
