<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Jual / Tukar Tambah Laptop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-3xl mx-auto px-4 py-10">
        <a href="/dashboard" class="text-blue-600 font-semibold mb-6 inline-block">&larr; Kembali ke Dashboard</a>
        
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Formulir Pengajuan Penawaran Laptop</h1>
            <p class="text-gray-500 text-sm mb-6">Isi spesifikasi laptop Anda dengan jujur agar admin dapat memberikan estimasi harga terbaik.</p>

            <form action="{{ route('offers.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul / Model Laptop</label>
                    <input type="text" name="title" required placeholder="Contoh: ASUS TUF Gaming F15 Second" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prosesor</label>
                        <input type="text" name="processor" required placeholder="Contoh: Intel Core i5-11400H" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">RAM</label>
                        <input type="text" name="ram" required placeholder="Contoh: 8GB DDR4" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penyimpanan (Storage)</label>
                        <input type="text" name="storage" required placeholder="Contoh: 512GB SSD NVMe" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga yang Diinginkan (Rp)</label>
                        <input type="number" name="expected_price" required placeholder="Contoh: 6500000" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Minus / Kondisi Fisik</label>
                    <textarea name="description" rows="3" placeholder="Sebutkan jika ada lecet pemakaian atau kendala minor..." class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3.5 rounded-xl font-bold hover:bg-blue-700 transition shadow-md">
                    Kirim Penawaran ke Admin
                </button>
            </form>
        </div>
    </div>
</body>
</html>