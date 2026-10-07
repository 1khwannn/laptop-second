<x-app-layout>
    <div class="py-12 bg-slate-900 min-h-screen text-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 shadow-xl">
                <h1 class="text-2xl font-black text-center mb-2">🔄 Simulasi & Tukar Tambah (Trade-In)</h1>
                <p class="text-xs text-slate-400 text-center mb-8">Tukar laptop lama Anda dengan unit baru yang tersedia di katalog toko kami.</p>

                <form action="{{ route('trade-in.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Pilih Laptop Toko yang Diinginkan -->
                    <div class="p-4 bg-slate-900 border border-slate-700 rounded-xl">
                        <label class="block text-xs font-bold text-blue-400 uppercase tracking-wider mb-2">1. Pilih Laptop Toko yang Ingin Dibeli</label>
                        <select name="target_laptop_id" required class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white">
                            <option value="">-- Pilih Unit Impian Anda di Katalog --</option>
                            @foreach($availableLaptops as $lap)
                                <option value="{{ $lap->id }}">{{ $lap->title }} — Rp {{ number_format($lap->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data Laptop Lama Pengguna -->
                    <div class="p-4 bg-slate-900 border border-slate-700 rounded-xl space-y-4">
                        <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-2">2. Data Laptop Lama Anda (Yang Ingin Ditukar)</label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Merek Laptop Lama</label>
                                <select name="brand_id" required class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white">
                                    <option value="">Pilih Merek</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Tipe / Seri Laptop Lama</label>
                                <input type="text" name="model_name" placeholder="Contoh: Asus Vivobook 14 A416" required class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white">
                            </div>

                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Estimasi Harga Jual Laptop Lama Anda</label>
                                <input type="number" name="estimated_price" placeholder="Contoh: 3500000" required class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white">
                            </div>

                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Nomor WhatsApp Anda</label>
                                <input type="text" name="phone_number" placeholder="081234567890" required class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl transition text-sm shadow-lg">
                        🚀 Kirim Pengajuan Tukar Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>