<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Jual Beli & Tukar Tambah Laptop Second Berkualitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 px-8 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">💻 LaptopSecond Store</h1>
        <div class="space-x-6 flex items-center">
            <a href="/" class="text-blue-600 font-semibold">Katalog</a>
            <a href="/kalkulator-estimasi" class="text-gray-600 hover:text-blue-600">Kalkulator Estimasi</a>
            @auth
                <a href="/dashboard" class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg font-medium">Dashboard Saya</a>
            @else
                <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">Login / Masuk</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-16 px-6 text-center">
        <h2 class="text-4xl font-extrabold mb-4">Cari & Jual Laptop Second Bergaransi QC 15 Poin</h2>
        <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-8">Solusi terbaik untuk upgrade perangkat atau jual laptop bekas dengan estimasi instan dan transparan.</p>
        <div class="flex justify-center gap-4">
            <a href="/jual-laptop" class="bg-white text-blue-700 font-bold px-6 py-3 rounded-xl shadow-lg hover:bg-blue-50 transition">Jual / Tukar Tambah Laptop Anda</a>
        </div>
    </header>

    <!-- Katalog Produk Section -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <h3 class="text-2xl font-bold mb-6 text-gray-900">Showcase Laptop Ready Stock</h3>

        @if($laptops->isEmpty())
            <div class="bg-white p-12 text-center rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-lg">Belum ada unit laptop yang tersedia di katalog saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($laptops as $laptop)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <span class="text-xs bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full">{{ $laptop->condition_grade }}</span>
                        <h4 class="font-bold text-lg mt-3 text-gray-900">{{ $laptop->title }}</h4>
                        <p class="text-sm text-gray-500 mt-1">{{ $laptop->processor }} • RAM {{ $laptop->ram }} • SSD {{ $laptop->storage }}</p>
                        
                        <div class="mt-6 flex justify-between items-center">
                            <div>
                                <span class="text-xs text-gray-400 block">Harga Spesial</span>
                                <span class="text-xl font-black text-blue-600">Rp {{ number_format($laptop->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="/katalog/{{ $laptop->slug }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">Detail & QC</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>