@extends('backend.layouts.master')

@section('content')
    <style>
        /* #ListNhanVien {
                            padding: 15px;
                            position: sticky;
                            top: 20px;
                            z-index: 1000;
                        }

                        .loading {
                            text-align: center;
                            padding: 20px;
                            font-size: 18px;
                            font-weight: bold;
                            color: #007bff;
                            animation: spin 1s linear infinite;
                        }

                        .employee-item {
                            display: flex;
                            flex-direction: column;
                            padding: 10px;
                            margin-bottom: 15px;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            background-color: #f9f9f9;
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        }

                        .employee-item:hover {
                            transform: scale(1.05);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        }

                        .employee-info {
                            display: flex;
                            margin-bottom: 8px;
                            justify-content: space-between;
                        }

                        .info-label {
                            font-weight: bold;
                            color: #333;
                        }

                        .info-value {
                            color: #555;
                            font-style: italic;
                        } */



        #ListNhanVien {
            padding: 15px;
            display: none;
            position: absolute;
            z-index: 1000;
            width: 40%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .loading {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            animation: spin 1s linear infinite;
        }

        .employee-item {
            display: flex;
            flex-direction: column;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .employee-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .employee-info {
            display: flex;
            margin-bottom: 8px;
            justify-content: space-between;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #555;
            font-style: italic;
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>Phân công nhân viên</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <!-- Phần thông tin Tour -->
                <div class="col-md-7">
                    @foreach ($tour as $tourItem)
                        <div class="card mb-4 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($tourItem->hinhdaidien) }}" alt="" class="rounded-circle mr-3"
                                        width="120" height="120" />
                                    <div>
                                        <input type="text" hidden name="tour_id" value="{{ $tourItem->matour }}">
                                        <h5 class="text-black font-weight-bold mb-1">
                                            {{ $tourItem->tentour }}
                                        </h5>
                                        <p class="text-muted mb-1 description">
                                            {{ $tourItem->motatour }}
                                        </p>
                                        <div class="text-muted small">
                                            <span class="mr-2"><i class="fas fa-map-marker-alt"></i> -
                                                {{ $tourItem->noikhoihanh }}</span>
                                            <span><i class="fas fa-calendar-alt"></i> - {{ $tourItem->thoigiandi }} ngày</span>
                                        </div>

                                        <p class="text-muted small">{{ $tourItem->tenloai }}</p>

                                        <div class="d-flex justify-content-end align-items-center mt-3">
                                            <div class="md-6">

                                                <a href="{{ route('phancongnhanvien.index', ['tour_id' => $tourItem->matour]) }}"
                                                    class="btn btn-outline-primary mr-2">
                                                    <i class="fas fa-heart"></i> Phân công
                                                </a>
                                                <button class="btn btn-primary btn-assign"
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
                    <div class="card-body">
                        <h5 class="card-title">Danh sách nhân viên tham gia</h5>
                        <div class="mb-3" id="employeeList">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
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

        // Lấy tất cả các nút phân công
        let assignButtons = document.querySelectorAll('.btn-assign');
        let employeeList = document.getElementById('ListNhanVien');
        let employeeListContainer = document.getElementById('employeeList');
        let loadingIndicator = document.createElement('div');
        loadingIndicator.classList.add('loading');
        loadingIndicator.innerHTML = 'Đang tải...';

        // Thêm sự kiện click cho các nút phân công
        assignButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let tourId = this.getAttribute('data-tour-id');
                if (!tourId) {
                    console.error('Tour ID is missing');
                    return; // Nếu không có tourId, dừng hàm
                }

                // Hiển thị loading indicator khi đang tải
                employeeListContainer.innerHTML = '';
                employeeListContainer.appendChild(loadingIndicator);

                // Lấy vị trí của tour được chọn
                let parentCard = this.closest('.card');
                let tourPosition = parentCard.getBoundingClientRect().top + window.scrollY;

                // Đặt vị trí của danh sách nhân viên
                employeeList.style.top = `${tourPosition - 70}px`;
                employeeList.style.right = `0`;
                employeeList.style.position = 'absolute';
                employeeList.style.zIndex = 1000;

                // Thực hiện gọi API để lấy danh sách nhân viên
                fetch(`/admin/phancongnhanvien/dsNhanVien/${tourId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Xóa loading indicator khi nhận được dữ liệu
                        employeeListContainer.innerHTML = '';

                        // Kiểm tra nếu không có nhân viên nào
                        if (data.length === 0) {
                            employeeListContainer.innerHTML =
                                '<p>Không có nhân viên nào tham gia tour này.</p>';
                            return;
                        }

                        // Duyệt qua nhân viên và hiển thị
                        data.forEach(employee => {
                            let employeeItem = document.createElement('div');
                            employeeItem.classList.add('employee-item');
                            // Nội dung của mỗi nhân viên
                            employeeItem.innerHTML = `
                        <div class="employee-info">
                            <div class="info-label"><strong>Tên:</strong></div>
                            <div class="info-value">${employee.hoten}</div>
                        </div>
                        <div class="employee-info">
                            <div class="info-label"><strong>Chức vụ:</strong></div>
                            <div class="info-value">${employee.tenchucvu}</div>
                        </div>
                    `;

                            // Thêm vào danh sách nhân viên
                            employeeListContainer.appendChild(employeeItem);
                        });

                        // Hiển thị phần danh sách nhân viên
                        employeeList.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        employeeListContainer.innerHTML = '<p>Lỗi khi tải dữ liệu.</p>';
                    });
            });
        });
    </script>
@endpush
