<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .active-link {
            background-color: #495057;
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-white">Admin Panel</h4>

            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active-link' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('pelanggan.index') }}" class="{{ request()->is('admin/pelanggan*') ? 'active-link' : '' }}">
                <i class="bi bi-people-fill me-2"></i> Data Pelanggan
            </a>
            <a href="{{ route('penggunaan.index') }}" class="{{ request()->is('admin/penggunaan*') ? 'active-link' : '' }}">
                <i class="bi bi-lightning-charge-fill me-2"></i> Penggunaan Listrik
            </a>
            <a href="{{ route('pembayaran.index') }}" class="{{ request()->is('admin/pembayaran*') ? 'active-link' : '' }}">
                <i class="bi bi-credit-card-2-front-fill me-2"></i> Pembayaran
            </a>
            <a href="{{ route('admin.tagihan') }}"><i class="bi bi-exclamation-circle me-2"></i>Tagihan Pelanggan</a>


            <hr class="text-white">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 mt-2">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>

        <!-- Content -->
        <div class="flex-grow-1 p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
