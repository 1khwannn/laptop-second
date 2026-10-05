<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            {{ $laptop->title }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Gambar Laptop -->
                <div class="bg-slate-950 border border-slate-800 rounded-xl overflow-hidden flex items-center justify-center">
                    @if($laptop->photo)
                        <img src="{{ asset('storage/' . $laptop->photo) }}" alt="{{ $laptop->title }}" class="w-full h-auto object-cover">
                    @else
                        <span class="text-slate-600 py-24 font-bold">Tidak ada foto</span>
                    @endif
                </div>

                <!-- Detail & WhatsApp -->
                <div class="flex flex-col justify-between">
                    <div>
                        <span class="bg-blue-950 text-blue-400 text-xs font-bold px-3 py-1 rounded-full border border-blue-800">
                            {{ $laptop->brand->name }}
                        </span>
                        
                        <h1 class="text-2xl font-black text-white mt-3 mb-2">{{ $laptop->title }}</h1>
                        <div class="text-3xl font-extrabold text-blue-400 mb-6">
                            Rp {{ number_format($laptop->price, 0, ',', '.') }}
                        </div>

                        <div class="bg-slate-950 border border-slate-800 rounded-xl p-4 text-xs text-slate-300 space-y-2 mb-6">
                            <p><strong class="text-slate-400">Processor:</strong> {{ $laptop->processor }}</p>
                            <p><strong class="text-slate-400">RAM:</strong> {{ $laptop->ram }}</p>
                            <p><strong class="text-slate-400">Storage:</strong> {{ $laptop->storage }}</p>
                            @if($laptop->gpu)
                                <p><strong class="text-slate-400">VGA/GPU:</strong> {{ $laptop->gpu }}</p>
                            @endif
                            <p><strong class="text-slate-400">Kondisi Fisik:</strong> <span class="text-emerald-400 font-semibold">{{ $laptop->condition_grade }}</span></p>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi & Kelengkapan</h4>
                            <p class="text-sm text-slate-300 whitespace-pre-line">{{ $laptop->description ?? 'Tidak ada catatan tambahan.' }}</p>
                        </div>
                    </div>

                    <!-- Tombol Chat WA -->
                    <a href="{{ $waUrl }}" target="_blank" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-center py-4 rounded-xl flex items-center justify-center gap-2 transition shadow-lg shadow-emerald-600/20">
                        💬 Beli Sekarang via WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>