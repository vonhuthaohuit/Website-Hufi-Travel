@extends('backend.layouts.master')
@section('content')
    <div class="container">
        <div class="header">
            <h1>Giao diện sao lưu và phục hồi dữ liệu</h1>
        </div>
        <div class="grid">
            <div class="card">
                <h2>Sao lưu</h2>
                <p>Chọn vào nút ở dưới để bắt đầu quá trình sao lưu dữ liệu.</p>
                <form action="{{ route('backup.create') }}" method="GET">
                    <button type="submit">
                        <i class="fas fa-cloud-upload-alt"></i> Sao lưu ngay
                    </button>
                </form>
                <div class="custom-hr"></div>
                <form action="{{ route('backup.schedule') }}" method="POST">
                    @csrf
                    <p>Chọn vào thời gian ở dưới để bắt đầu sao lưu dữ liệu theo lịch.</p>
                    <div class="schedule-options">

                        <label for="backup-time">Chọn giờ :</label>
                        <input type="time" id="backup-time" name="backup_time">
                        <label for="backup-frequency">Chọn tần suất :</label>
                        <select name="backup_frequency" id="backup_frequency">
                            <option value="daily">Hàng ngày</option>
                            <option value="weekly">Hàng tuần</option>
                            <option value="monthly">Hàng tháng</option>
                        </select>
                    </div>
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
                    <div class="form-group" id="monthly_options" style="display: none;">
                        <label for="backup_day_of_month">Ngày trong tháng :</label>
                        <input type="number" name="backup_day_of_month" id="backup_day_of_month" class="form-control"
                            min="1" max="31">
                    </div>
                    <button type="submit">
                        <i class="fas fa-cloud-download-alt"></i>Sao lưu theo lịch
                    </button>
                </form>
                <form action="{{ route('backup.remove') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-cloud-download-alt"></i>Xoá lịch trước đó
                    </button>
                </form>
            </div>
            <div class="card">
                <h2>Phục hồi</h2>
                <p>Chọn vào nút ở dưới để bắt đầu quá trình phục hồi dữ liệu.</p>
                <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="backup_file" class="border border-gray-300 rounded p-2 mb-4">
                    <button>
                        <i class="fas fa-cloud-download-alt"></i> Bắt đầu phục hồi
                    </button>

                </form>

            </div>
        </div>

    </div>
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
