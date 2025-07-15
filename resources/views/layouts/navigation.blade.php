<!-- Sidebar + Topbar Responsive Layout -->
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'block' : 'hidden'" class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-white sm:block sm:relative sm:translate-x-0 transition duration-300">
        <div class="p-4 text-xl font-bold">Admin</div>
        <nav class="space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('pelanggan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('pelanggan.*') ? 'bg-gray-700' : '' }}">
                Data Pelanggan
            </a>
            <a href="{{ route('penggunaan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('penggunaan.*') ? 'bg-gray-700' : '' }}">
                Penggunaan Listrik
            </a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                Pembayaran
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="px-4 mt-6">
            @csrf
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">
                Logout
            </button>
        </form>
    </div>

    <!-- Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar / Navbar -->
        <header class="flex items-center justify-between bg-white px-4 py-3 shadow sm:hidden">
            <h1 class="text-lg font-semibold">Admin Panel</h1>
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path :class="{'hidden': sidebarOpen, 'inline-flex': !sidebarOpen }" class="inline-flex" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </header>

        <!-- Page Content -->
        <main class="p-6 overflow-auto">
            @yield('content')
        </main>
    </div>
</div>
