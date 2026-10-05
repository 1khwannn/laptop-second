<x-app-layout>
    <div class="bg-ivory min-h-screen">
        <div class="max-w-6xl mx-auto px-8 py-10">
            <p class="font-mono text-xs tracking-widest uppercase text-gold-deep mb-1">Katalog</p>
            <h1 class="font-serif text-3xl font-semibold text-gray-900 mb-8">Laptop Tersedia</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-gray-200 border border-gray-200">
                @forelse($products as $product)
                    <a href="{{ route('catalog.show', $product->id) }}"
                        class="bg-white p-6 hover:shadow-lg transition block">
                        <div class="flex justify-between items-start mb-3"> <span
                                class="font-mono text-xs border border-gold-pale bg-ivory text-gold-deep px-2 py-1">{{ $product->condition }}</span>
                        </div>
                        <p class="font-mono text-xs uppercase text-gray-400 mb-1">{{ $product->brand }}</p>
                        <h2 class="font-serif text-xl font-semibold text-gray-900 mb-4">{{ $product->name }}</h2>
                        <div class="border-t border-gray-100 pt-4">
                            <p class="font-serif text-lg font-bold text-gray-900">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                </a> @empty <div class="col-span-3 bg-white p-10 text-center text-gray-400">Belum ada laptop
                        tersedia</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
