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
                    <button>
                        <i class="fas fa-cloud-upload-alt"></i> Bắt đầu sao lưu
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
            <div class="mt-8">
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
