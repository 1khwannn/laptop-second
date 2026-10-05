<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaptopSecond - Layanan Jual Beli & Tukar Tambah Laptop Bekas</title>

    <!-- Google Fonts & Tailwind CSS (via Vite) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-extrabold text-blue-600 flex items-center gap-2 tracking-tight">
                <span class="bg-blue-600 text-white p-1.5 rounded-lg text-sm">💻</span> LaptopSecond
            </a>

            <div class="flex items-center gap-3">
                <a href="#jual-laptop" class="hidden sm:inline-block text-sm font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition">
                    Jual Laptop Anda
                </a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 px-3 py-2">Dashboard</a>
                    @if(in_array(auth()->user()->email, ['admin@laptop.com', 'admin@gmail.com']))
                        <a href="{{ url('/admin') }}" class="text-sm font-semibold bg-gray-900 text-white px-3.5 py-2 rounded-xl hover:bg-gray-800 transition">Admin Panel</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 px-3 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 shadow-md shadow-blue-200 transition">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-b from-blue-900 via-blue-800 to-indigo-900 text-white py-16 px-4 text-center relative overflow-hidden">
        <div class="max-w-3xl mx-auto relative z-10">
            <span class="bg-blue-500/30 text-blue-200 border border-blue-400/30 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
                LAYANAN JUAL BELI & BUYBACK
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Jual atau Beli Laptop Bekas Mudah & Cepat
            </h1>
            <p class="text-blue-100 text-sm md:text-base max-w-2xl mx-auto mb-8 opacity-90">
                Dapatkan estimasi penawaran harga terbaik untuk laptop lama Anda atau jelajahi unit laptop second bergaransi toko kami.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#jual-laptop" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-blue-600/40 transition flex items-center gap-2 text-sm">
                    ⚡ Jual Laptop Saya
                </a>
                <a href="#katalog" class="bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-3 rounded-xl border border-white/20 backdrop-blur-md transition text-sm">
                    🔍 Lihat Katalog Stok
                </a>
            </div>
        </div>
    </header>

    <!-- Section: Pilih Brand (Gaya Teknisigo) -->
    <section id="jual-laptop" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
            
            <!-- Step Indicator Bar -->
            <div class="mb-8">
                <div class="flex justify-between items-center max-w-2xl mx-auto text-xs font-bold text-gray-400">
                    <div class="flex items-center gap-2 text-blue-600">
                        <span class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">1</span>
                        <span>Brand</span>
                    </div>
                    <div class="h-0.5 flex-1 bg-gray-200 mx-3"></div>
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold">2</span>
                        <span>Spesifikasi</span>
                    </div>
                    <div class="h-0.5 flex-1 bg-gray-200 mx-3"></div>
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold">3</span>
                        <span>Kondisi</span>
                    </div>
                    <div class="h-0.5 flex-1 bg-gray-200 mx-3"></div>
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold">4</span>
                        <span>Estimasi</span>
                    </div>
                </div>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900">Ingin Jual Laptop? Pilih Brand Dulu</h2>
                <p class="text-xs md:text-sm text-gray-500 mt-1">Klik brand laptop yang ingin Anda tawarkan ke toko kami</p>
            </div>

            <!-- Brand Cards Grid (Visual ala Teknisigo) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @foreach($brands as $brand)
                    <a href="{{ route('offers.create', ['brand' => $brand->id]) }}" 
   class="bg-slate-950/70 hover:bg-blue-950/60 border border-slate-800 hover:border-blue-500/60 rounded-xl p-4 flex flex-col items-center justify-center gap-2 group transition duration-200 shadow-sm">
                        <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-xl font-black text-gray-800 group-hover:text-blue-600 group-hover:scale-110 transition">
                            {{ substr($brand->name, 0, 1) }}
                        </div>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-blue-600">{{ $brand->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Katalog Produk Toko -->
    <main id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Katalog Laptop Ready Stok</h2>
                <p class="text-sm text-gray-500">Unit laptop second pilihan, sudah lolos pengujian dan bergaransi.</p>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('home') }}#katalog" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tipe laptop..." 
                       class="border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm px-4 py-2 w-full md:w-64 shadow-sm">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm">
                    Cari
                </button>
            </form>
        </div>

        <!-- Laptop Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($laptops as $laptop)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col group">
                    
                    <!-- Image Container -->
                    <div class="h-52 bg-gray-100 relative overflow-hidden flex items-center justify-center">
                        @if($laptop->image)
                            <img src="{{ asset('storage/' . $laptop->image) }}" alt="{{ $laptop->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="text-center p-4">
                                <span class="text-gray-300 text-5xl font-black">💻</span>
                                <p class="text-xs text-gray-400 mt-1">Foto Belum Tersedia</p>
                            </div>
                        @endif

                        <span class="absolute top-3 right-3 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider shadow-sm">
                            Grade {{ $laptop->condition_grade }}
                        </span>
                    </div>

                    <!-- Laptop Detail Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-extrabold text-blue-600 uppercase tracking-widest">{{ $laptop->brand->name }}</span>
                            <h3 class="text-base font-bold text-gray-900 mt-0.5 mb-3 line-clamp-1 group-hover:text-blue-600 transition">{{ $laptop->title }}</h3>

                            <!-- Specs Grid -->
                            <div class="grid grid-cols-2 gap-2 text-xs bg-gray-50 p-3 rounded-xl mb-4 border border-gray-100 text-gray-600">
                                <div><span class="font-semibold text-gray-800">Processor:</span> {{ $laptop->processor }}</div>
                                <div><span class="font-semibold text-gray-800">RAM:</span> {{ $laptop->ram }}</div>
                                <div><span class="font-semibold text-gray-800">Storage:</span> {{ $laptop->storage }}</div>
                                <div><span class="font-semibold text-gray-800">Layar:</span> {{ $laptop->screen_size ?? '14 Inch' }}</div>
                            </div>
                        </div>

                        <!-- Price & Action -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Harga Jual</span>
                                <div class="text-lg font-extrabold text-blue-600">
                                    Rp {{ number_format($laptop->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20membeli%20laptop%20{{ urlencode($laptop->title) }}" 
                               target="_blank" 
                               class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-md shadow-emerald-200 flex items-center gap-1.5">
                                <span>💬</span> Beli via WA
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-gray-300">
                    <span class="text-4xl">🔍</span>
                    <h3 class="text-base font-bold text-gray-800 mt-2">Unit Tidak Ditemukan</h3>
                    <p class="text-xs text-gray-500 mt-1">Belum ada stok laptop yang sesuai dengan kriteria pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $laptops->links() }}
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-xs border-t border-gray-800">
        <p>© 2026 LaptopSecond. Tampilan terinspirasi dari <a href="https://layanan.teknisigo.com/kalkulator-laptop-bekas" target="_blank" class="text-blue-400 underline">Teknisigo</a>.</p>
    </footer>

</body>
</html>