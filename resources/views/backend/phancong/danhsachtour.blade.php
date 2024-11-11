@extends('backend.layouts.master')

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Phần thông tin Tour -->
            <div class="col-md-7">
                @foreach ($tour as $tourItem)
                    <div class="card mb-4 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ $tourItem->hinhdaidien }}" alt="Company logo" class="rounded-circle mr-3"
                                    width="50" height="50" />
                                <div>
                                    <input type="text" hidden name="tour_id" value="{{ $tourItem->matour }}">
                                    <h5 class="text-success font-weight-bold mb-1">
                                        {{ $tourItem->tentour }}
                                    </h5>
                                    <p class="text-muted mb-1 description">
                                        {{ $tourItem->motatour }}
                                    </p>
                                    <div class="text-muted small">
                                        <span class="mr-2"><i
                                                class="fas fa-map-marker-alt"></i>{{ $tourItem->noikhoihanh }}</span>
                                        <span><i class="fas fa-briefcase"></i> 3 năm</span>
                                    </div>

                                    <p class="text-muted small">{{ $tourItem->tenloai }}</p>

                                    <div class="d-flex justify-content-end align-items-center mt-3">
                                        <div class="md-6">

                                            <a href="{{ route('phancongnhanvien.index', ['tour_id' => $tourItem->matour]) }}"
                                                class="btn btn-success mr-2">
                                                <i class="fas fa-heart"></i> Phân công
                                            </a>
                                            <button class="btn btn-success btn-assign"
                                                data-tour-id="{{ $tourItem->matour }}">Xem nhanh</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Phần danh sách nhân viên -->
            <div class="col-md-5" id="ListNhanVien" style="display:none;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách nhân viên tham gia</h5>
                        <div class="mb-3" id="employeeList">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let descriptions = document.querySelectorAll('.description');
        let maxLength = 150;
        descriptions.forEach(description => {
            if (description.textContent.length > maxLength) {
                description.textContent = description.textContent.substring(0, maxLength) + '...';
            }
        });
    </script>
    <script>
        // Lấy tất cả các nút phân công
        let assignButtons = document.querySelectorAll('.btn-assign');
        // Lấy phần danh sách nhân viên
        let employeeList = document.getElementById('ListNhanVien');

        // Thêm sự kiện click cho các nút phân công
        assignButtons.forEach(button => {
            button.addEventListener('click', function() {
                event.preventDefault();
                let tourId = this.getAttribute('data-tour-id');
                if (!tourId) {
                    console.error('Tour ID is missing');
                    return; // Nếu không có tourId, dừng hàm
                }
                console.log(tourId);
                fetch(`/admin/phancongnhanvien/dsNhanVien/${tourId}`)
                    .then(response => response.json())
                    .then(data => {

                        let employeeList = document.getElementById('employeeList');
                        employeeList.innerHTML = '';

                        // Duyệt qua nhân viên và để hiển thị
                        data.forEach(employee => {
                            let employeeItem = document.createElement('div');
                            employeeItem.classList.add(
                            'employee-item');
                            // Nội dung của mỗi nhân viên
                            employeeItem.innerHTML = `
                <span><strong>Tên:</strong> ${employee.hoten}</span>
                <span><strong>Chức vụ:</strong> ${employee.tenchucvu}</span>
            `;

                            // Thêm vào danh sách nhân viên
                            employeeList.appendChild(employeeItem);
                        });
                    })
                    .catch(error => console.error('Error:', error));
                // Chuyển trạng thái hiển thị của phần danh sách nhân viên
                if (employeeList.style.display === 'none') {
                    employeeList.style.display = 'block'; // Hiển thị
                } else {
                    employeeList.style.display = 'none'; // Ẩn đi nếu đã hiển thị
                }
            });
        });
    </script>
@endpush
