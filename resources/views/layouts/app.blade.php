<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div x-data="{ open: false }" class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out" :class="open ? 'translate-x-0' : '-translate-x-full'">
        <a href="{{ route('dashboard') }}" class="text-white text-2xl font-semibold px-4">Admin Panel</a>
        <nav class="mt-10">
            <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-900' : '' }}">Dashboard</a>
            <a href="{{ route('pelanggan.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('pelanggan.*') ? 'bg-gray-900' : '' }}">Data Pelanggan</a>
            <a href="{{ route('penggunaan.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('penggunaan.*') ? 'bg-gray-900' : '' }}">Penggunaan Listrik</a>
            <a href="{{ route('pembayaran.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-white">Pembayaran</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="px-4 mt-6">
            @csrf
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </aside>

    <!-- Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="flex items-center justify-between bg-white p-4 shadow-md md:hidden">
            <button @click="open = !open" class="text-gray-500 focus:outline-none focus:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="text-lg font-semibold text-gray-700">Admin</div>
        </header>

        <!-- Main -->
        <main class="flex-1 p-6">
            @yield('content')
            @if (session('success'))
    <div class="max-w-4xl mx-auto mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow">
            {{ session('success') }}
        </div>
    </div>
@endif

        </main>
    </div>
</div>

</body>
</html>
