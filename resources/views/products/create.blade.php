<x-app-layout>
    <div class="bg-ivory min-h-screen">
        <div class="max-w-2xl mx-auto px-8 py-10"> <a href="{{ route('products.index') }}"
                class="font-mono text-xs text-gray-500 hover:text-gold-deep">&larr; Kembali ke Daftar</a>
            <p class="font-mono text-xs tracking-widest uppercase text-gold-deep mt-4 mb-1">Katalog</p>
            <h1 class="font-serif text-3xl font-semibold text-gray-900 mb-8">Tambah Laptop</h1>
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-4 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div> @endif <form method="POST" action="{{ route('products.store') }}"
                    class="bg-white border border-gray-200 p-8 space-y-5"> @csrf <div> <label
                            class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Kategori</label>
                        <select name="category_id"
                            class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select> </div>
                    <div> <label class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Nama
                            Laptop</label> <input type="text" name="name"
                            class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none"> </div>
                    <div> <label
                            class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Brand</label>
                        <input type="text" name="brand"
                            class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none"> </div>
                    <div> <label
                            class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Spesifikasi</label>
                        <textarea name="specs" rows="3" class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none"></textarea>
                    </div>
                    <div> <label
                            class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Kondisi</label>
                        <input type="text" name="condition" placeholder="Contoh: Mulus 95%"
                            class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none"> </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div> <label
                                class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Harga</label>
                            <input type="number" name="price"
                                class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none"> </div>
                        <div> <label
                                class="block font-mono text-xs uppercase tracking-wider text-gray-500 mb-2">Stok</label>
                            <input type="number" name="stock" value="1"
                                class="border border-gray-300 w-full p-3 focus:border-gold focus:outline-none"> </div>
                    </div> <button type="submit"
                        class="bg-gray-900 text-white px-8 py-3 text-sm tracking-wide hover:bg-gold-deep transition">
                        Simpan Laptop </button>
                </form>
        </div>
    </div>
</x-app-layout>
