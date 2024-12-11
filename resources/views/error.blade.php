{{-- @extends('frontend.layouts.app')

@section('renderBody')
    <style>
        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .error-message {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .error-title {
            color: #e74c3c;
            font-size: 36px;
            font-weight: bold;
        }

        .error-description {
            font-size: 18px;
            color: #555;
            margin-top: 15px;
        }

        .error-code {
            font-size: 16px;
            color: #777;
            margin-top: 20px;
        }

        .btn-back-home {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-back-home:hover {
            background-color: #2980b9;
        }
    </style>
    <div class="error-container">
        <div class="error-message">
            <h1 class="error-title">Đã có lỗi xảy ra!</h1>
            <p class="error-code">Mã lỗi: <strong>{{ $errorCode }}</strong></p>
            <a href="{{ url('/') }}" class="btn-back-home">Quay lại trang chủ</a>
        </div>
    </div>
@endsection --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
</head>
<body>
    <style>
        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .error-message {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .error-title {
            color: #e74c3c;
            font-size: 36px;
            font-weight: bold;
        }

        .error-description {
            font-size: 18px;
            color: #555;
            margin-top: 15px;
        }

        .error-code {
            font-size: 16px;
            color: #777;
            margin-top: 20px;
        }

        .btn-back-home {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-back-home:hover {
            background-color: #2980b9;
        }
    </style>
    <div class="error-container">
        <div class="error-message">
            <h1 class="error-title">Đã có lỗi xảy ra!</h1>
            <p class="error-code">Mã lỗi: <strong>{{ $errorCode }}</strong></p>
            <a href="{{ url('/') }}" class="btn-back-home">Quay lại trang chủ</a>
        </div>
    </div>
</body>
</html>
