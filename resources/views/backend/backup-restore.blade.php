@extends('backend.layouts.master')

@section('content')

    <div class="container">
        <div class="header">
            <h1>Backup and Restore Interface</h1>
        </div>
        <div class="grid">
            <div class="card">
                <h2>Backup</h2>
                <p>Click the button below to start the backup process.</p>
                <form action="{{ route('backup.create') }}" method="GET">
                    <button>
                        <i class="fas fa-cloud-upload-alt"></i> Start Backup
                    </button>
                </form>

            </div>
            <div class="card">
                <h2>Restore</h2>
                <p>Click the button below to start the restore process.</p>
                <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="backup_file" class="border border-gray-300 rounded p-2 mb-4">
                    <button>
                        <i class="fas fa-cloud-download-alt"></i> Start Restore
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
        <div class="footer">
            <p>&copy; 2024 Backup and Restore Interface. All rights reserved.</p>
        </div>
    </div>
@endsection
