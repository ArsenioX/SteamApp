<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form | @yield('title', 'Edit Data')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[#0f172a] text-white font-sans min-h-screen">

    {{-- Navbar Full Width (Hanya Logo) --}}
    <nav class="bg-[#1e293b] px-6 py-3 w-full shadow-md">
        <div class="flex items-center gap-2">
            <div class="bg-purple-600 text-white px-2 py-1 rounded-full text-sm">
                🎮
            </div>
            <span class="text-white font-bold text-lg">ShopGaming Admin</span>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <main class="max-w-6xl mx-auto px-4 py-10">

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="text-purple-400 hover:underline">&larr; Kembali</a>
        </div>

        {{-- Konten Blade --}}
        <div class="bg-[#1a1a2e] p-6 rounded-xl shadow-xl border border-purple-800">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="bg-[#1e293b] text-gray-400 text-center py-4 mt-6 rounded-xl">
            <p>&copy; 2025 ShopGaming. All rights reserved.</p>
            <p>Designed with ❤️ by Ahmad Dhani</p>
        </footer>

    </main>

    {{-- Scripts --}}
    @yield('scripts')

</body>

</html>