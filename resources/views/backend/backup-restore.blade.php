@extends('backend.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sao lưu phục hồi</h1>
        </div>

        <div class="backup-container">
            <div class="backup-grid">
                <div class="backup-card">
                    <h2>Sao lưu</h2>
                    <p>Chọn vào nút ở dưới để bắt đầu quá trình sao lưu dữ liệu.</p>
                    <form action="{{ route('backup.create') }}" method="GET">
                        <button type="submit" class="btn-backup text-light">
                            <i class="fas fa-cloud-upload-alt"></i> Sao lưu ngay
                        </button>
                    </form>
                    <div class="custom-hr"></div>
                    <form action="{{ route('backup.schedule') }}" method="POST">
                        @csrf
                        <p>Chọn vào thời gian ở dưới để bắt đầu sao lưu dữ liệu theo lịch.</p>
                        <div class="backup-schedule-options">
                            <div class="form-group" id="weekly_options" style="display: none;margin-bottom:-5px">
                                <label for="backup_day">Ngày trong tuần :</label>
                                <select name="backup_day" id="backup_day" class="form-control">
                                    <option value="Sunday">Chủ nhật</option>
                                    <option value="Monday">Thứ 2</option>
                                    <option value="Tuesday">Thứ 3</option>
                                    <option value="Wednesday">Thứ 4</option>
                                    <option value="Thursday">Thứ 5</option>
                                    <option value="Friday">Thứ 6</option>
                                    <option value="Saturday">Thứ 7</option>
                                </select>
                            </div>
                            <label for="backup-time">Chọn giờ :</label>
                            <input type="time" id="backup-time" name="backup_time">
                            <label for="backup-frequency">Chọn tần suất :</label>
                            <select name="backup_frequency" id="backup_frequency">
                                <option value="daily">Hàng ngày</option>
                                <option value="weekly">Hàng tuần</option>
                                <option value="monthly">Hàng tháng</option>
                            </select>
                        </div>
                        <div class="form-group" id="monthly_options" style="display: none;">
                            <label for="backup_day_of_month">Ngày trong tháng :</label>
                            <input type="number" name="backup_day_of_month" id="backup_day_of_month" class="form-control"
                                min="1" max="31">
                        </div>
                        <button type="submit" class="btn-backup text-light">
                            <i class="fas fa-cloud-download-alt"></i>Sao lưu theo lịch
                        </button>
                        <form action="{{ route('backup.remove') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-backup text-light">
                                <i class="fas fa-cloud-download-alt"></i>Xoá lịch trước đó
                            </button>
                        </form>
                    </form>
                </div>
                <div class="backup-card">
                    <h2>Phục hồi</h2>
                    <p>Chọn vào nút ở dưới để bắt đầu quá trình phục hồi dữ liệu.</p>
                    <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="backup_file" class="backup-file-upload">
                        <button class="btn-backup text-light">
                            <i class="fas fa-cloud-download-alt"></i> Bắt đầu phục hồi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="section">
        <div class="section-header">
            <h1>Blog</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa blog</h4>
                            <div class="card-header-action">
                                <a href="{{ route('blog.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog.update', $blog->mablogtour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $blog->mablogtour }}" name="mablogtour">

                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" name="tieude" value="{{ $blog->tieude }}">
                                </div>

                                <div class="form-group">
                                    <label>Nội dung blog</label>
                                    <textarea class="form-control summernote" name="noidung">{{ $blog->noidung }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hình ảnh đại diện blog</label>
                                            <input type="file" class="form-control" name="hinhanh">
                                            <img src="{{ asset($blog->hinhanh) }}" width="100" alt="Current Image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Loại blog</label>
                                            <select class="form-control" name="maloaiblog">
                                                @foreach ($loaiblog as $loaiblogItem)
                                                    <option value="{{ $loaiblogItem->maloaiblog }}"
                                                        {{ $blog->maloaiblog == $loaiblogItem->maloaiblog ? 'selected' : '' }}>
                                                        {{ $loaiblogItem->tenloaiblog }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="trangthaiblog">
                                                <option value="0" {{ $blog->trangthaiblog == 0 ? 'selected' : '' }}>
                                                    Không
                                                    hoạt động
                                                </option>
                                                <option value="1" {{ $blog->trangthaiblog == 1 ? 'selected' : '' }}>
                                                    Hoạt
                                                    động
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section> --}}

    @push('scripts')
        <script>
            document.getElementById('backup_frequency').addEventListener('change', function() {
                var frequency = this.value;
                document.getElementById('weekly_options').style.display = (frequency === 'weekly') ? 'block' : 'none';
                document.getElementById('monthly_options').style.display = (frequency === 'monthly') ? 'block' : 'none';
                if (frequency !== 'monthly') {
                    document.getElementById('backup_day_of_month').required = false;
                } else {
                    document.getElementById('backup_day_of_month').required = true;
                }
            });
        </script>
    @endpush
@endsection
