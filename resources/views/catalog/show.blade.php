<x-app-layout>
    <div class="bg-ivory min-h-screen">
        <div class="max-w-2xl mx-auto px-8 py-10"> <a href="{{ route('catalog.index') }}"
                class="font-mono text-xs text-gray-500 hover:text-gold-deep">&larr; Kembali ke Katalog</a>
            <div class="mt-6 bg-white border border-gray-200 p-8">
                <div class="flex justify-between items-start mb-1">
                    <p class="font-mono text-xs tracking-widest uppercase text-gold-deep">
                        {{ $product->category->name ?? '-' }}</p> <span
                        class="font-mono text-xs border border-gold-pale bg-ivory text-gold-deep px-3 py-1">{{ $product->condition }}</span>
                </div>
                <h1 class="font-serif text-3xl font-semibold text-gray-900 mb-1">{{ $product->name }}</h1>
                <p class="text-gray-500 text-sm mb-6">{{ $product->brand }}</p>
                <div class="mb-6">
                    <h2 class="font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Spesifikasi</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $product->specs }}</p>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 pt-6 mb-8">
                    <div>
                        <p class="font-mono text-xs uppercase tracking-wider text-gray-500 mb-1">Harga</p>
                        <p class="font-serif text-2xl font-bold text-gray-900">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-mono text-xs uppercase tracking-wider text-gray-500 mb-1">Stok</p>
                        <p class="font-serif text-2xl font-bold text-gray-900">{{ $product->stock }}</p>
                    </div>
                </div> <a href="{{ route('orders.create', $product->id) }}"
                    class="block text-center bg-gray-900 text-white px-6 py-4 text-sm tracking-wide hover:bg-gold-deep transition">
                    Beli Sekarang </a>
            </div>
        </div>
    </div>
</x-app-layout>
