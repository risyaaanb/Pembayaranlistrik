<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pelanggan - Listrik App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #0d6efd;
            padding-top: 1rem;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 0.75rem 1.25rem;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0b5ed7;
            font-weight: bold;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="d-flex flex-column flex-md-row">
    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-white text-center mb-4">👤 Pelanggan</h5>

        <a href="{{ route('pelanggan.dashboard') }}" class="{{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
        <a href="{{ route('pelanggan.tagihan') }}" class="{{ request()->routeIs('pelanggan.tagihan') ? 'active' : '' }}">
            <i class="bi bi-receipt me-2"></i>Tagihan
        </a>
        <a href="{{ route('pelanggan.riwayat') }}" class="{{ request()->routeIs('pelanggan.riwayat') ? 'active' : '' }}">
            <i class="bi bi-clipboard-data me-2"></i>Riwayat
        </a>
        <a href="{{ route('pelanggan.profil') }}" class="{{ request()->routeIs('pelanggan.profil') ? 'active' : '' }}">
    <i class="bi bi-person me-2"></i>Profil
</a>
        <a href="{{ route('pelanggan.profil.edit') }}" class="{{ request()->routeIs('pelanggan.profil.edit') ? 'active' : '' }}">
            <i class="bi bi-pencil-square me-2"></i>Edit Profil
        </a>

        <hr class="text-white mx-3">

        <form method="POST" action="{{ route('logout') }}" class="px-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content w-100">
        {{-- Alert Sukses/Error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Halaman Konten --}}
        @yield('content')
    </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
