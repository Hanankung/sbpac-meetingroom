<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>เข้าสู่ระบบสำหรับเจ้าหน้าที่ | ระบบจองห้องประชุม ศอ.บต.</title>
    <link rel="icon" type="image/png" href="{{ asset('image/sbpac-logo.jpg') }}?v=2">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font Sarabun --}}
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Sarabun", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #ffffff;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        .login-card {
            width: 520px;
            max-width: 95%;
            border-radius: 16px;
            border: none;
            background-color: #FFFBFB;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .login-logo-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
        }

        .login-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-title-th {
            font-weight: 700;
            font-size: 18px;
            margin: 0;
        }

        .login-title-en {
            font-size: 12px;
            margin: 0;
            color: #666;
        }

        .btn-login {
            background-color: #6f6f6f;
            border: none;
            border-radius: 999px;
            padding: 10px 40px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background-color: #5a5a5a;
        }

        .form-label {
            font-size: 13px;
            color: #444;
        }

        .form-control {
            border-radius: 8px;
            font-size: 14px;
        }

        .text-error {
            font-size: 13px;
        }

        /* ทำให้พื้นที่โลโก้ + ชื่อ กลายเป็นลิงก์ */
        .click-home {
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .click-home:hover {
            opacity: 0.85;
        }
    </style>

</head>

<body>

    <div class="container login-wrapper d-flex justify-content-center align-items-center">

        <div class="card login-card p-4 p-md-5">

            {{-- ✅ คลิกโลโก้ + ชื่อ แล้วกลับหน้า index --}}
            <a href="{{ url('/') }}" class="click-home">
                <div class="login-logo-wrapper">
                    <div class="login-logo">
                        <img src="{{ asset('image/sbpac-logo.jpg') }}" alt="ศอ.บต.">
                    </div>
                    <div>
                        <p class="login-title-th mb-1">ศูนย์อำนวยการบริหารจังหวัดชายแดนภาคใต้</p>
                        <p class="login-title-en mb-0">Southern Border Provinces Administrative Centre</p>
                    </div>
                </div>
            </a>

            {{-- ฟอร์ม Login --}}
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">email</label>
                    <input type="email" name="email" class="form-control" placeholder="email"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="text-danger text-error mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="password" required>
                    @error('password')
                        <div class="text-danger text-error mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @if (session('error'))
                    <div class="alert alert-danger py-2 text-center text-error">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-login text-white">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>