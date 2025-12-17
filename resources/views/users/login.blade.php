{{-- resources/views/users/login.blade.php --}}
<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>เข้าสู่ระบบพนักงาน | ระบบจองห้องประชุม ศอ.บต.</title>
    <link rel="icon" type="image/png" href="{{ asset('image/cropped-logo.png') }}?v=2">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            margin-bottom: 10px;
        }

        .login-logo {
            width: 76px;
            height: 76px;
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

        .page-title {
            font-weight: 800;
            font-size: 20px;
            margin: 14px 0 4px;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 13px;
            margin: 0 0 18px;
        }

        .btn-login {
            background-color: #198754; /* ✅ ต่างจากแอดมิน: ใช้เขียว */
            border: none;
            border-radius: 999px;
            padding: 10px 42px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .btn-login:hover {
            background-color: #157347;
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

        .click-home {
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .click-home:hover {
            opacity: 0.85;
        }

        .hint-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #0f5132;
            background: #d1e7dd;
            border: 1px solid #badbcc;
            padding: 6px 10px;
            border-radius: 999px;
            margin-bottom: 14px;
        }
    </style>
</head>

<body>

    <div class="container login-wrapper d-flex justify-content-center align-items-center">

        <div class="card login-card p-4 p-md-5">

            {{-- ✅ คลิกโลโก้ + ชื่อ แล้วกลับหน้าแรก --}}
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

            {{-- <div class="page-title">เข้าสู่ระบบพนักงาน</div>
            <p class="page-subtitle">กรอกอีเมลหรือเลขบัตรประชาชน และรหัสผ่านที่เจ้าหน้าที่กำหนด</p>

            <div class="hint-pill">
                <i class="bi bi-shield-lock"></i>
                สำหรับพนักงาน/ผู้ใช้งานทั่วไป
            </div> --}}

            {{-- ฟอร์ม Login --}}
            <form method="POST" action="{{ route('user.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">อีเมล หรือ เลขบัตรประชาชน</label>
                    <input name="login"
                           class="form-control"
                           value="{{ old('login') }}"
                           placeholder="เช่น name@sbpac.go.th หรือ 1234567890123"
                           required autofocus>
                    @error('login')
                        <div class="text-danger text-error mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                    @error('password')
                        <div class="text-danger text-error mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ✅ error จาก controller (เช่น “อีเมลหรือรหัสผ่านไม่ถูกต้อง”) --}}
                @if (session('error'))
                    <div class="alert alert-danger py-2 text-center text-error">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- ✅ error รวม (กรณี validate fail แล้วอยากโชว์อันแรก) --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2 text-center text-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-login text-white">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>
