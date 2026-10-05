<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            💻 Form Penawaran Jual Laptop
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 md:p-8">
                
                <p class="text-sm text-slate-400 mb-6">
                    Isi detail spesifikasi dan kondisi laptop bekas Anda di bawah ini untuk mendapatkan penawaran harga terbaik dari toko kami.
                </p>

                <form action="{{ route('offers.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Brand -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Merek Laptop *</label>
                        <select name="brand_id" required class="w-full bg-slate-950 border-slate-800 text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">
                            <option value="">-- Pilih Merek --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $selectedBrand == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Model Name -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Tipe / Seri Laptop *</label>
                        <input type="text" name="model_name" placeholder="Contoh: Lenovo Legion 5 15ACH6H" required value="{{ old('model_name') }}"
                               class="w-full bg-slate-950 border-slate-800 text-white placeholder-slate-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">
                        @error('model_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Specs Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Processor *</label>
                            <input type="text" name="processor" placeholder="Ryzen 7 5800H" required value="{{ old('processor') }}"
                                   class="w-full bg-slate-950 border-slate-800 text-white placeholder-slate-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">RAM *</label>
                            <input type="text" name="ram" placeholder="16GB DDR4" required value="{{ old('ram') }}"
                                   class="w-full bg-slate-950 border-slate-800 text-white placeholder-slate-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Storage *</label>
                            <input type="text" name="storage" placeholder="512GB SSD" required value="{{ old('storage') }}"
                                   class="w-full bg-slate-950 border-slate-800 text-white placeholder-slate-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">
                        </div>
                    </div>

                    <!-- Expected Price -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Ekspektasi Harga Anda (Rp) *</label>
                        <input type="number" name="expected_price" placeholder="Contoh: 8500000" required value="{{ old('expected_price') }}"
                               class="w-full bg-slate-950 border-slate-800 text-white placeholder-slate-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">
                    </div>

                    <!-- Condition Description -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Deskripsi Kondisi & Kelengkapan *</label>
                        <textarea name="condition_description" rows="4" placeholder="Jelaskan kondisi fisik (mulus/baret), kesehatan baterai, kelengkapan (dus, charger), serta jika ada minus..." required
                                  class="w-full bg-slate-950 border-slate-800 text-white placeholder-slate-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm p-3">{{ old('condition_description') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex justify-end gap-3">
                        <a href="{{ route('dashboard') }}" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-sm transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm shadow-lg shadow-blue-600/30 transition">
                            🚀 Kirim Penawaran
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>