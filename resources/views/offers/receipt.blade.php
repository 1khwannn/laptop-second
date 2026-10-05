<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Buyback - #LAP-{{ str_pad($offer->id, 4, '0', STR_PAD_LEFT) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
        
        <!-- Header Nota -->
        <div class="flex justify-between items-start border-b border-slate-200 pb-6 mb-6">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">💻 LAPTOP SECOND</h1>
                <p class="text-xs text-slate-500 mt-1">Pusat Jual Beli & Buyback Laptop Bekas Berkualitas</p>
                <p class="text-xs text-slate-500">Jl. Raya Bogor No. 123 | WA: 0812-3456-7890</p>
            </div>
            <div class="text-right">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase">
                    BUYBACK DEAL
                </span>
                <p class="text-xs text-slate-500 mt-2">No. Nota: <strong>#BUY-{{ str_pad($offer->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
                <p class="text-xs text-slate-500">Tanggal: {{ $offer->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Detail Perangkat -->
        <div class="mb-6">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Detail Unit Laptop</h2>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 text-sm space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-500">Merek / Tipe:</span>
                    <span class="font-bold text-slate-900">{{ $offer->brand->name ?? '-' }} {{ $offer->model_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Spesifikasi:</span>
                    <span class="font-semibold text-slate-700">{{ $offer->processor }} | {{ $offer->ram }} RAM | {{ $offer->storage }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Kondisi Fisik:</span>
                    <span class="text-slate-700 italic max-w-xs text-right">{{ $offer->condition_description }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Pembayaran -->
        <div class="border-t border-slate-200 pt-4 mb-8">
            <div class="flex justify-between items-center bg-blue-50 p-4 rounded-xl border border-blue-200">
                <span class="text-sm font-bold text-blue-900">Total Nominal Buyback (Disepakati):</span>
                <span class="text-2xl font-black text-blue-600">
                    Rp {{ number_format($offer->admin_offer_price ?? $offer->expected_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="grid grid-cols-2 gap-8 text-center text-xs text-slate-600 pt-6 border-t border-slate-100 mb-8">
            <div>
                <p class="mb-12">Pihak Penjual (Pelanggan),</p>
                <p class="font-bold text-slate-900">( {{ $offer->user->name ?? 'Pelanggan' }} )</p>
            </div>
            <div>
                <p class="mb-12">Pihak Pembeli (Admin Toko),</p>
                <p class="font-bold text-slate-900">( Admin LaptopSecond )</p>
            </div>
        </div>

        <!-- Tombol Cetak (Hilang saat diprint) -->
        <div class="no-print text-center pt-4 border-t border-slate-200 flex justify-center gap-3">
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm px-6 py-2.5 rounded-xl transition">
                🖨️ Cetak / Simpan PDF
            </button>
            <button onclick="window.close()" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-sm px-6 py-2.5 rounded-xl transition">
                Tutup
            </button>
        </div>

    </div>

</body>
</html>