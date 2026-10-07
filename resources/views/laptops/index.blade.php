<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Laptop Second Berkualitas & Bergaransi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow p-4 flex justify-between items-center px-8">
        <h1 class="text-xl font-bold text-blue-600">Store Laptop Second</h1>
        <div class="space-x-4">
            <a href="/" class="text-blue-600 font-semibold">Katalog</a>
            <a href="/estimator" class="text-gray-600 hover:text-blue-600">Jual / Tukar Tambah</a>
            <a href="/dashboard" class="text-gray-600 hover:text-blue-600">Dashboard Penawaran</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-extrabold mb-6">Showcase Laptop Ready Stock & QC Lolos Uji</h2>
        
        <!-- Grid Katalog -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($laptops as $laptop)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition">
                <div class="p-6">
                    <span class="text-xs bg-green-100 text-green-700 font-semibold px-2.5 py-1 rounded-full">{{ $laptop->condition_grade }}</span>
                    <h3 class="font-bold text-lg mt-3 text-gray-900">{{ $laptop->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $laptop->processor }} | RAM {{ $laptop->ram }} | SSD {{ $laptop->storage }}</p>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-600">Rp {{ number_format($laptop->price, 0, ',', '.') }}</span>
                        <a href="/laptop/{{ $laptop->slug }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Detail & QC</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>