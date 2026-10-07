<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $laptop->title }} - Detail & QC</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-4xl mx-auto px-4 py-10">
        <a href="/" class="text-blue-600 font-semibold mb-6 inline-block">&larr; Kembali ke Katalog Utama</a>
        
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">{{ $laptop->brand->name ?? 'Brand' }}</span>
            <h1 class="text-3xl font-extrabold mt-2 text-gray-900">{{ $laptop->title }}</h1>
            <p class="text-gray-500 text-sm mt-1">Serial Number (SN): <span class="font-mono font-bold text-gray-700">{{ $laptop->serial_number }}</span></p>

            <div class="my-6 text-3xl font-black text-blue-600">
                Rp {{ number_format($laptop->price, 0, ',', '.') }}
            </div>

            <!-- Sertifikat QC Digital -->
            <div class="border-t border-gray-100 pt-6 mt-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Sertifikat Inspeksi QC Digital (15 Poin)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50/50 p-6 rounded-xl border border-blue-100">
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Kondisi Baterai</p>
                        <p class="font-bold text-gray-900">{{ $laptop->battery_health ?? 'Normal (Aman)' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Kondisi Layar</p>
                        <p class="font-bold text-gray-900">{{ $laptop->screen_condition ?? 'Lolos Uji Tanpa Dead Pixel' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Keyboard & Port</p>
                        <p class="font-bold text-gray-900">{{ $laptop->keyboard_status ?? 'Berfungsi Normal 100%' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Grade Fisik</p>
                        <p class="font-bold text-gray-900">{{ $laptop->condition_grade }}</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Pesan WhatsApp -->
            <div class="mt-8">
                @php
                    $waText = "Halo Admin, saya ingin memesan laptop *{$laptop->title}* (SN: {$laptop->serial_number}) seharga Rp " . number_format($laptop->price, 0, ',', '.') . ". Mohon info ketersediaannya.";
                    $waLink = "https://wa.me/6281234567890?text=" . urlencode($waText);
                @endphp
                <a href="{{ $waLink }}" target="_blank" class="block w-full bg-green-600 text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-green-700 transition shadow-md">
                    Pesan / Booking via WhatsApp
                </a>
            </div>
        </div>
    </div>
</body>
</html>