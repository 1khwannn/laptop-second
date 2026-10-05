<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            🛒 Katalog Laptop Bekas Ready Stock
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter Bar -->
            <form method="GET" action="{{ route('catalog.index') }}" class="mb-8 flex flex-col md:flex-row gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tipe laptop..." 
                       class="bg-slate-900 border-slate-800 text-white rounded-xl text-sm px-4 py-3 w-full md:w-1/3 focus:ring-blue-500">
                
                <select name="brand" onchange="this.form.submit()" class="bg-slate-900 border-slate-800 text-white rounded-xl text-sm px-4 py-3 w-full md:w-1/4 focus:ring-blue-500">
                    <option value="">-- Semua Brand --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm px-6 py-3 rounded-xl transition">
                    Filter
                </button>
            </form>

            <!-- Laptop Cards Grid -->
            @if($laptops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($laptops as $laptop)
                        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden hover:border-slate-700 transition flex flex-col">
                            <div class="h-48 bg-slate-950 overflow-hidden relative">
                                @if($laptop->photo)
                                    <img src="{{ asset('storage/' . $laptop->photo) }}" alt="{{ $laptop->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-700 font-bold">No Image</div>
                                @endif
                                <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                                    {{ $laptop->brand->name }}
                                </span>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white mb-2">{{ $laptop->title }}</h3>
                                    <div class="text-xs text-slate-400 space-y-1 mb-4">
                                        <p>💻 {{ $laptop->processor }}</p>
                                        <p>⚡ {{ $laptop->ram }} | 💾 {{ $laptop->storage }}</p>
                                        <p>✨ Kondisi: <span class="text-emerald-400 font-semibold">{{ $laptop->condition_grade }}</span></p>
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xl font-extrabold text-blue-400 mb-4">
                                        Rp {{ number_format($laptop->price, 0, ',', '.') }}
                                    </div>
                                    <a href="{{ route('catalog.show', $laptop->slug) }}" class="block text-center bg-slate-800 hover:bg-blue-600 text-white font-bold text-xs py-3 rounded-xl transition">
                                        Lihat Detail & Beli
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $laptops->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-slate-900 border border-slate-800 rounded-2xl">
                    <p class="text-slate-400 text-sm">Belum ada stok laptop bekas yang tersedia saat ini.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>