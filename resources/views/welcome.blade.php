<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased text-black">
    @if (Route::has('login'))
    <header class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-purple-500 to-indigo-600  text-white px-6 py-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo di kiri -->
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/sportcenter2.png') }}" alt="Logo Gundar" class="h-20 w-auto object-contain">
            </a>

            <!-- Login/Register di kanan -->
            <nav class="flex items-center gap-4">
                @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                    Dashboard
                </a>
                @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                    Log in
                </a>

                @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="bg-pink-600 text-white p-2 rounded-md transition-all duration-500 ease-in-out hover:bg-pink-700 hover:scale-105 hover:opacity-90">
                    Register
                </a>
                @endif
                @endauth
            </nav>
        </div>
    </header>
    @endif

    <main class="min-h-screen bg-[url(../../public/images/olgar.png)] bg-cover bg-center pt-32 px-6">


        <div class="max-w-6xl mx-auto px-4 space-y-8">
            <!-- Hero Section -->
            <div class="bg-white shadow rounded-xl p-6 mt-6 opacity-0 animate-fade-in-down">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Selamat Datang di Sport Center</h2>
                <p class="text-gray-600 text-justify sm:text-center leading-relaxed">
                    Sport Center Kampus hadir untuk mendukung gaya hidup sehat dan aktif bagi seluruh civitas akademika.
                    Kami menyediakan fasilitas olahraga yang modern, nyaman, dan mudah diakses.
                    Jadikan olahraga bagian dari rutinitas harianmu untuk menjaga kebugaran, memperkuat semangat sportivitas, dan membangun kebersamaan.
                    Manfaatkan semua fasilitas dengan bijak!
                </p>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-0 animate-fade-in">
                <!-- Jadwal Ketersediaan -->
                <div class="bg-white shadow rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-gray-800 text-center md:text-left mb-4">Jadwal Ketersediaan Lapangan</h2>
                    <ul class="text-gray-600 space-y-1 text-center md:text-left">
                        <li><strong>Senin – Jumat:</strong> 09.00 – 20.00</li>
                        <li><strong>Sabtu:</strong> 08.00 – 17.00</li>
                        <li><strong>Minggu:</strong> Tutup</li>
                    </ul>
                </div>

                <!-- Tata Cara Penyewaan -->
                <div class="bg-white shadow rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-gray-800 text-center md:text-left mb-4">Tata Cara Penyewaan</h2>
                    <ol class="list-decimal text-gray-600 list-inside space-y-2 text-center md:text-left">
                        <li class="hover:text-blue-600 transition duration-200">Login / buat akun</li>
                        <li class="hover:text-blue-600 transition duration-200">Pilih jenis dan jadwal lapangan</li>
                        <li class="hover:text-blue-600 transition duration-200">Upload file KRS yang aktif</li>
                        <li class="hover:text-blue-600 transition duration-200">Tunggu konfirmasi dari admin</li>
                        <li class="hover:text-blue-600 transition duration-200">Gunakan lapangan sesuai jadwal</li>
                    </ol>
                </div>
            </div>
        </div>

    </main>



</body>


</html>