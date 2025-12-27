<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- BOOTSTRAP --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          crossorigin="anonymous"
          referrerpolicy="no-referrer">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1f1f1f;
            color: white;
            position: fixed;
            padding: 20px 10px;
            overflow-y: auto;
        }

        .sidebar h4 {
            padding-left: 15px;
            margin-bottom: 25px;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            color: #ccc;
            font-size: 15px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #373737;
            color: #ffc107;
        }

        .sidebar i {
            margin-right: 10px;
            width: 18px;
            text-align: center;
        }

        .content {
            margin-left: 260px;
            padding: 25px;
        }

        footer {
            margin-left: 260px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h4>
        <i class="fa-solid fa-mobile-screen-button"></i>
        TELECOM 77
    </h4>

    <a href="/">
        <i class="fa-solid fa-house"></i>
        Home
    </a>

    <hr class="text-white">

    <h6 class="text-warning ps-3">DATA</h6>

    <a href="/customer">
        <i class="fa-solid fa-users"></i>
        Data Customer
    </a>

    <a href="/barang">
        <i class="fa-solid fa-mobile"></i>
        Data Unit HP
    </a>

    <a href="/penjualan">
        <i class="fa-solid fa-cart-shopping"></i>
        Data Penjualan
    </a>

    <a href="/master-service">
        <i class="fa-solid fa-screwdriver-wrench"></i>
        Data Jasa Service
    </a>

    <a href="/service">
        <i class="fa-solid fa-wrench"></i>
        Data Service HP
    </a>

    <hr class="text-white">

    <h6 class="text-warning ps-3">LAPORAN</h6>

    <a href="/laporan/penjualan">
        <i class="fa-solid fa-receipt"></i>
        Laporan Penjualan
    </a>

    <a href="/laporan/service">
        <i class="fa-solid fa-gear"></i>
        Laporan Service
    </a>

    <a href="/laporan/pendapatan">
        <i class="fa-solid fa-coins"></i>
        Rekap Pendapatan
    </a>

    <a href="/laporan/top-customer">
        <i class="fa-solid fa-trophy"></i>
        Top Customer
    </a>
</div>

<div class="content">
    @yield('content')
</div>

<footer class="bg-dark py-4 text-white mt-4">
    <div class="container text-center">
        <small>
            TELECOM 77 – Toko HP Terpercaya <br>
            Jl. Dago XXI No.14, Bandung – Jawa Barat 40135 <br>
            © 2024 TELECOM 77. All Rights Reserved. <br><br>
            Sistem Informasi Penjualan & Perbaikan HP <br>
            Deffa Kiane Basyar – 2023130015
        </small>
    </div>
</footer>

</body>
</html>
