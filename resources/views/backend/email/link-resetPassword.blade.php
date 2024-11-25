<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Email</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Căn chỉnh và định dạng chung */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Container của khung */
        .container {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
        }

        /* Card chính */
        .card {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header */
        .header h1 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 1rem;
            display: block;
        }

        /* Button */
        /* Button */
        .button {
            display: inline-block;
            background-color: #4299e1;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            margin-top: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: none;
        }

        .button:hover {
            background-color: #3182ce;
            transform: translateY(-2px);
            /* Hiệu ứng nâng nút khi hover */
        }

        .button:active {
            transform: translateY(1px);
            /* Hiệu ứng nhấn nút */
        }


        .button:hover {
            background-color: #3182ce;
        }

        /* Footer */
        .footer a {
            color: #4299e1;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Text styles */
        p {
            color: #4a5568;
            margin-bottom: 1rem;
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="40">
                <h1>Đặt Lại Mật Khẩu</h1>
            </div>
            <p>Xin chào,</p>
            <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Hãy nhấn vào nút bên dưới để tiến
                hành đặt lại mật khẩu:</p>
            <button class="button">
                <a href="{{ route('auth.reset', $token) }}" style="color: white; text-decoration: none;">Đặt Lại Mật
                    Khẩu</a>
            </button>

            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này hoặc liên hệ với bộ phận hỗ trợ để được
                giúp đỡ.</p>
            <p>Trân trọng,<br> Đội ngũ hỗ trợ của chúng tôi</p>
            <div class="footer">
                <a href="https://example.com">Truy cập trang web của chúng tôi</a>
            </div>
        </div>
    </div>
</body>

</html>
