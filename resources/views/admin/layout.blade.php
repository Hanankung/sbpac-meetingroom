<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'ระบบจองห้องประชุม ศอ.บต.')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Google Font: Sarabun (ฟอนต์ราชการ) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Sarabun", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .sidebar {
            width: 220px;
            background-color: #4a4a4a;
            color: #ffffff;
            min-height: 100vh;
        }

        .sidebar .section-title {
            font-size: 12px;
            text-transform: uppercase;
            opacity: 0.7;
            padding: 8px 16px;
            margin-top: 16px;
        }

        .sidebar a.menu-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a.menu-item:hover {
            background-color: #5b5b5b;
        }

        .sidebar a.menu-item i {
            font-size: 16px;
        }

        .topbar {
            height: 70px;
            background-color: #dcdcdc;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .topbar-logo-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
            /* ถ้ารูปเป็นทรงเหลี่ยม จะช่วยให้ตัดพื้นหลัง */
            margin-right: 12px;
        }

        .topbar-logo-wrapper img {
            height: 52px;
            /* ปรับให้พอดีกับวง */
        }

        /* .topbar img {
            height: 50px;
            margin-right: 12px;
        } */

        .topbar-title-th {
            font-weight: 700;
            font-size: 18px;
            margin: 0;
        }

        .topbar-title-en {
            font-size: 12px;
            margin: 0;
        }

        .main-logo {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            object-fit: cover;
            /* ให้รูปเต็มวง */
            background-color: #000;
            /* เผื่อรูปมีพื้นขาว จะดูกลมชัดขึ้น */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- แถวบนโลโก้ + ชื่อหน่วยงาน --}}
    <header class="topbar">
        <div class="topbar-logo-wrapper">
            <img src="{{ asset('image/sbpac-logo.jpg') }}" alt="ศอ.บต." class="main-logo">
        </div>
        <div>
            <p class="topbar-title-th">ศูนย์อำนวยการบริหารจังหวัดชายแดนภาคใต้</p>
            <p class="topbar-title-en">Southern Border Provinces Administrative Centre</p>
        </div>
    </header>


    <div class="d-flex">
        {{-- Sidebar เมนูด้านซ้าย --}}
        <aside class="sidebar">
            <div class="section-title">เมนูหลัก</div>
            <a href="{{ route('admin.index') }}" class="menu-item">
                <i class="bi bi-house-door-fill"></i>
                <span>ปฏิทินการใช้ห้อง</span>
            </a>


            <div class="section-title">รายการ</div>
            <a href="{{ route('admin.rooms') }}" class="menu-item">
                <i class="bi bi-calendar2-check"></i>
                <span>ห้องประชุม</span>
            </a>
            <a href="{{ route('admin.bookings.history') }}" class="menu-item">
                <i class="bi bi-clock-history"></i>
                <span>ประวัติการจอง</span>
            </a>

            <div class="section-title">บุคคล</div>
            <a href="#" class="menu-item">
                <i class="bi bi-person-circle"></i>
                <span>สำหรับเจ้าหน้าที่</span>
            </a>
        </aside>

        {{-- เนื้อหาหลักของแต่ละหน้า --}}
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
