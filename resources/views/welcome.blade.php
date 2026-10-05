<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LaptopSecond') }} - Pusat Laptop Bekas Berkualitas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased">

    <!-- Header / Navbar -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="text-xl font-extrabold tracking-tight text-white flex items-center gap-2">
                💻 <span class="text-blue-500">Laptop</span>Second
            </a>

            <nav class="flex items-center gap-6 text-sm font-semibold">
                <a href="{{ route('catalog.index') }}" class="text-slate-300 hover:text-white transition">Katalog Stok</a>
                @auth
                    <a href="{{ route('offers.create') }}" class="text-slate-300 hover:text-white transition">Jual Laptop</a>
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-xl transition">Dashboard Saya</a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-xl transition">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-20 px-4 max-w-7xl mx-auto text-center">
        <span class="bg-blue-950 text-blue-400 border border-blue-800 text-xs font-bold px-4 py-1.5 rounded-full inline-block mb-4">
            ✨ Beli & Jual Laptop Bekas Garansi Resmi
        </span>
        <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6">
            Cari Laptop Bekas Mulus <br><span class="text-blue-500">Atau Mau Jual Laptop Lama?</span>
        </h1>
        <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto mb-8">
            Dapatkan laptop bekas berkualitas tinggi dengan harga transparan, atau ajukan penawaran jual laptop bekas Anda dalam hitungan menit.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('catalog.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-8 py-3.5 rounded-xl transition shadow-lg shadow-blue-600/30">
                🛒 Lihat Stok Ready
            </a>
            <a href="{{ route('offers.create') }}" class="bg-slate-800 hover:bg-slate-700 text-white font-bold px-8 py-3.5 rounded-xl border border-slate-700 transition">
                💰 Mau Jual Laptop Saya
            </a>
        </div>
    </section>

    <!-- Brand Filter List -->
    <section class="py-8 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-xs font-bold uppercase tracking-wider text-slate-500 mb-6">Merek Laptop Tersedia</p>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($brands as $brand)
                    <a href="{{ route('catalog.index', ['brand' => $brand->id]) }}" 
                       class="bg-slate-950 hover:border-blue-500 border border-slate-800 text-slate-300 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2">
                        <span>{{ $brand->name }}</span>
                        <span class="bg-slate-800 text-slate-400 text-[10px] px-2 py-0.5 rounded-md">{{ $brand->laptops_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Laptops Grid -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-bold text-white">🔥 Unit Laptop Ready Stock</h2>
                <p class="text-xs text-slate-400 mt-1">Stok diperbarui secara real-time</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300">
                Lihat Semua Katalog &rarr;
            </a>
        </div>

        @if($featuredLaptops->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredLaptops as $laptop)
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden hover:border-slate-700 transition flex flex-col">
                        <div class="h-48 bg-slate-950 overflow-hidden relative">
                            @if($laptop->photo)
                                <img src="{{ asset('storage/' . $laptop->photo) }}" alt="{{ $laptop->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-700 font-bold">No Image</div>
                            @endif
                            <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                                {{ $laptop->brand->name }}
                            </span>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-lg text-white mb-2">{{ $laptop->title }}</h3>
                                <div class="text-xs text-slate-400 space-y-1 mb-4">
                                    <p>💻 {{ $laptop->processor }}</p>
                                    <p>⚡ {{ $laptop->ram }} | 💾 {{ $laptop->storage }}</p>
                                </div>
                            </div>

                            <div>
                                <div class="text-xl font-extrabold text-blue-400 mb-4">
                                    Rp {{ number_format($laptop->price, 0, ',', '.') }}
                                </div>
                                <a href="{{ route('catalog.show', $laptop->slug) }}" class="block text-center bg-slate-800 hover:bg-blue-600 text-white font-bold text-xs py-3 rounded-xl transition">
                                    Detail Produk
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-slate-900 border border-slate-800 rounded-2xl">
                <p class="text-slate-400 text-sm">Belum ada stok laptop yang diinput oleh Admin.</p>
            </div>
        @endif
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-800 bg-slate-900 py-8 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} LaptopSecond - Aplikasi PKL Web Penjualan & Buyback Laptop.
    </footer>

</body>
</html>