<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            💻 Form Penawaran Jual Laptop
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-8 shadow-xl">
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500 text-emerald-400 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('offers.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Pilih Brand -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                            Merek Laptop
                        </label>
                        <select name="brand_id" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ (old('brand_id', $selectedBrand) == $brand->id) ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tipe / Seri Laptop -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                            Tipe / Seri Laptop
                        </label>
                        <input type="text" name="model_name" value="{{ old('model_name') }}" required placeholder="Contoh: Asus ROG Strix G512LI / Lenovo Ideapad Slim 3" 
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('model_name') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Spesifikasi -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Processor</label>
                            <input type="text" name="processor" value="{{ old('processor') }}" required placeholder="Intel Core i5 Gen 11" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">RAM</label>
                            <input type="text" name="ram" value="{{ old('ram') }}" required placeholder="8 GB" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Storage</label>
                            <input type="text" name="storage" value="{{ old('storage') }}" required placeholder="512 GB SSD" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <!-- Kondisi & Kelengkapan -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                            Kondisi Fisik & Kelengkapan
                        </label>
                        <textarea name="condition_description" rows="4" required placeholder="Contoh: Kondisi 90% mulus, charger ori ada, dus ada, minus baterai agak drop." 
                                  class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('condition_description') }}</textarea>
                    </div>

                    <!-- Ekspektasi Harga -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                            Ekspektasi Harga Penjualan (Rp)
                        </label>
                        <input type="number" name="expected_price" value="{{ old('expected_price') }}" required placeholder="5000000" 
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 rounded-xl transition">
                        Kirim Penawaran ke Admin
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>