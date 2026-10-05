<x-app-layout>
    <div class="bg-ivory min-h-screen">
        <div class="max-w-6xl mx-auto px-8 py-10">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <p class="font-mono text-xs tracking-widest uppercase text-gold-deep mb-1">Katalog</p>
                    <h1 class="font-serif text-3xl font-semibold text-gray-900">Daftar Laptop</h1>
                </div> <a href="{{ route('products.create') }}"
                    class="bg-gray-900 text-white px-6 py-3 text-sm tracking-wide hover:bg-gold-deep transition"> +
                    Tambah Laptop </a>
            </div>
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded mb-6">
                    {{ session('success') }}</div>
                @endif <div class="bg-white border border-gray-200">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 bg-ivory">
                                <th class="p-4 text-left font-mono text-xs uppercase tracking-wider text-gray-500">Nama
                                </th>
                                <th class="p-4 text-left font-mono text-xs uppercase tracking-wider text-gray-500">
                                    Kategori</th>
                                <th class="p-4 text-left font-mono text-xs uppercase tracking-wider text-gray-500">Harga
                                </th>
                                <th class="p-4 text-left font-mono text-xs uppercase tracking-wider text-gray-500">Stok
                                </th>
                                <th class="p-4 text-left font-mono text-xs uppercase tracking-wider text-gray-500">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b border-gray-100 hover:bg-ivory/50 transition">
                                    <td class="p-4"> <a href="{{ route('products.show', $product->id) }}"
                                            class="font-serif font-semibold text-gray-900 hover:text-gold-deep">
                                            {{ $product->name }} </a> </td>
                                    <td class="p-4 text-sm text-gray-600">{{ $product->category->name ?? '-' }}</td>
                                    <td class="p-4 font-mono text-sm text-gray-900">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $product->stock }}</td>
                                    <td class="p-4 text-sm space-x-3"> <a
                                            href="{{ route('products.edit', $product->id) }}"
                                            class="text-gold-deep hover:underline">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin mau hapus laptop ini?')">
                                            @csrf @method('DELETE') <button type="submit"
                                                class="text-red-500 hover:underline">Hapus</button> </form>
                                    </td>
                            </tr> @empty <tr>
                                    <td colspan="5" class="p-10 text-center text-gray-400">Belum ada laptop</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</x-app-layout>
