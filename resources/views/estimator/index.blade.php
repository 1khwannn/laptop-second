<x-app-layout>
    <div class="py-12 bg-slate-900 min-h-screen text-white">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 shadow-xl">
                <h1 class="text-2xl font-black text-center mb-2">🧮 Kalkulator Estimasi Harga Laptop</h1>
                <p class="text-xs text-slate-400 text-center mb-8">Dapatkan perkiraan kisaran harga beli toko sebelum mengajukan penawaran resmi.</p>

                <form id="estimatorForm" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-2">Merek Laptop</label>
                            <select name="brand_id" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-2">Tipe Prosesor</label>
                            <select name="processor" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                <option value="i3">Intel Core i3 / Ryzen 3</option>
                                <option value="i5">Intel Core i5 / Ryzen 5</option>
                                <option value="i7">Intel Core i7 / Ryzen 7</option>
                                <option value="other">Lainnya / Dual Core</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-2">Kapasitas RAM (GB)</label>
                            <select name="ram" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                <option value="4">4 GB</option>
                                <option value="8" selected>8 GB</option>
                                <option value="16">16 GB</option>
                                <option value="32">32 GB</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-2">Jenis Penyimpanan</label>
                            <select name="storage_type" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                <option value="ssd">SSD (M.2 / NVMe / SATA)</option>
                                <option value="hdd">HDD Biasa</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-2">Kondisi Fisik & Fungsi</label>
                            <select name="condition" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                <option value="mulus">Mulus (Like New / Normal Total)</option>
                                <option value="sedang">Lecet Pemakaian Wajar</option>
                                <option value="minus_ringan">Minus Ringan (Baterai Drop/Speaker Cempreng)</option>
                                <option value="minus_berat">Minus Berat (Layar Baret/Keyboard Sebagian Off)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-2">Kelengkapan</label>
                            <select name="completeness" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                <option value="fullset">Fullset (Laptop + Charger + Dus Box)</option>
                                <option value="charger_unit">Unit + Charger Ori</option>
                                <option value="batangan">Batangan (Unit Laptop Saja)</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" onclick="calculateEstimate()" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 rounded-xl transition text-sm">
                        ⚡ Hitung Estimasi Harga
                    </button>
                </form>

                <!-- Box Hasil Estimasi -->
                <div id="resultBox" class="hidden mt-8 p-6 bg-blue-950/60 border border-blue-500/50 rounded-2xl text-center">
                    <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider">Perkiraan Harga Buyback Toko</p>
                    <div class="text-3xl font-black text-blue-400 mt-2">
                        Rp <span id="minPrice">0</span> - Rp <span id="maxPrice">0</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-3 mb-6">Harga akhir ditentukan setelah inspeksi fisik & kelengkapan oleh Admin.</p>
                    <a href="/jual-laptop" class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs px-6 py-3 rounded-xl transition">
                        📩 Ajukan Penawaran Resmi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateEstimate() {
            const form = document.getElementById('estimatorForm');
            const formData = new FormData(form);

            fetch('{{ route("estimator.calculate") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('minPrice').innerText = data.min_price;
                document.getElementById('maxPrice').innerText = data.max_price;
                document.getElementById('resultBox').classList.remove('hidden');
            });
        }
    </script>
</x-app-layout>