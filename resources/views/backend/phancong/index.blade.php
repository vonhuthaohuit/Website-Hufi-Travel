@extends('backend.nhanvien.layouts.master')

@section('content')
  <div class="container py-4">
    <div class="row">
      <!-- Job Listings -->
      <div class="col-md-7">
        <div class="card mb-4 border-success">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <img
                src="https://storage.googleapis.com/a1aa/image/38KUJFnBK3a7KdsA6j8kDgoVdTZ6UzeX5Idyb46zRCt5gT3JA.jpg"
                alt="Company logo"
                class="rounded-circle mr-3"
                width="50"
                height="50"
              />
              <div>
                <h5 class="text-success font-weight-bold mb-1">
                  Lập Trình Viên PHP (Laravel)
                </h5>
                <p class="text-muted mb-1">
                  CÔNG TY CỔ PHẦN GIẢI PHÁP PHẦN MỀM BIPLUS VIỆT NAM
                </p>
                <div class="text-muted small">
                  <span class="mr-2"><i class="fas fa-map-marker-alt"></i> Hà Nội</span>
                  <span><i class="fas fa-briefcase"></i> 3 năm</span>
                </div>
                <p class="text-muted small">Software Engineer</p>
              </div>
            </div>
            <div class="d-flex justify-content-end align-items-center mt-3">
              <div>
                <button class="btn btn-success mr-2">Xem nhanh</button>
                <button class="btn btn-success">
                  <i class="fas fa-heart"></i> Phân công
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Additional job cards similar to the first one can follow here -->
      </div>
      <!-- Sidebar -->
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách nhân viên tham gia </h5>
            {{-- <div class="bg-light p-3 rounded mb-3">
              <h6 class="text-primary font-weight-bold">
                Công ty CP Đầu tư và Dịch vụ Đất...
              </h6>
              <span class="badge badge-success">Spotlight Company</span>
            </div> --}}
            <div class="mb-3">
              <h6 class="font-weight-bold">Nhân viên phụ trách tour</h6>
              <div class="text-muted small">
                <span class="mr-2 " style="color:black;font-weight:700;font-size:16px"></i> Võ Trọng Hào</span>
                <span class="mr-2 " style="color:black;font-weight:700;font-size:16px"></i> Võ Trọng Hào</span>
              </div>
            </div>
            <div class="mb-3">
              <h6 class="font-weight-bold">Hướng dẫn viên du lịch</h6></h6>
              <div class="text-muted small">
                <span class="mr-2 " style="color:black;font-weight:700;font-size:16px"></i> Võ Trọng Hào</span>
              </div>
            </div>
            <div class="mb-3">
              <h6 class="font-weight-bold">Tài xế</h6>
              <span class="mr-2" style="color:black;font-weight:700" style="font-size: 16px"></i> Võ Trọng Hào</span>
            </div>
            {{-- <button class="btn btn-success w-100">Tìm hiểu ngay</button> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
