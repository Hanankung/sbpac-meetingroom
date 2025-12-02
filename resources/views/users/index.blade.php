<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>ระบบจองห้องประชุม ศอ.บต.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>

</head>

<body class="bg-white">

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center text-center">

        <!-- โลโก้ -->
        <img src="{{ asset('image/sbpac-logo.jpg') }}" alt="ศอ.บต." style="width: 250px;">

        <h2 class="mt-4 fw-bold">ศูนย์อำนวยการบริหารจังหวัดชายแดนภาคใต้</h2>
        <h5 class="text-muted">Southern Border Provinces Administrative Centre</h5>

        <!-- ปุ่มจองห้อง -->
        <a href="{{ route('calendar') }}"
            class="btn mt-4 px-4 py-2 rounded-pill text-white d-flex align-items-center gap-2"
            style="background-color: #25A6D5; font-size: 18px;">
            จองห้องประชุม
            <i class="bi bi-arrow-right-circle" style="font-size: 20px;"></i>
        </a>

    </div>

</body>

</html>
