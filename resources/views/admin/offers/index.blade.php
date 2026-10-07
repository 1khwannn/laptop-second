<x-app-layout>
    <div class="py-12 bg-slate-900 min-h-screen text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl">
                <h1 class="text-xl font-black mb-6 flex items-center gap-2">
                    🛡️ Panel Admin: Kelola Penawaran & Trade-In
                </h1>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-900/50 border border-emerald-500 text-emerald-300 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="border-b border-slate-700 text-slate-400 text-xs uppercase">
                                <th class="p-3">User</th>
                                <th class="p-3">Laptop / Detail</th>
                                <th class="p-3">Estimasi Harga</th>
                                <th class="p-3">Kontak WA</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Aksi / Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            @forelse($offers as $offer)
                                <tr class="hover:bg-slate-750">
                                    <td class="p-3">
                                        <div class="font-bold">{{ $offer->user->name ?? 'Tamu' }}</div>
                                        <div class="text-xs text-slate-400">{{ $offer->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="p-3">
                                        <div class="font-semibold text-blue-400">{{ $offer->model_name }}</div>
                                        <div class="text-xs text-slate-400">{{ $offer->condition_description }}</div>
                                    </td>
                                    <td class="p-3 font-mono text-emerald-400">
                                        Rp {{ number_format($offer->expected_price, 0, ',', '.') }}
                                    </td>
                                    <td class="p-3">
                                        <a href="https://wa.me/{{ $offer->phone_number }}" target="_blank" class="text-xs bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1 rounded-lg inline-block">
                                            💬 {{ $offer->phone_number }}
                                        </a>
                                    </td>
                                    <td class="p-3">
                                        @if($offer->status == 'pending')
                                            <span class="px-2.5 py-1 text-xs bg-amber-500/20 text-amber-400 border border-amber-500/30 rounded-full font-semibold">Pending</span>
                                        @elseif($offer->status == 'accepted')
                                            <span class="px-2.5 py-1 text-xs bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full font-semibold">Disetujui</span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs bg-rose-500/20 text-rose-400 border border-rose-500/30 rounded-full font-semibold">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        <form action="{{ route('admin.offers.updateStatus', $offer->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="bg-slate-900 border border-slate-700 text-xs rounded-lg p-1.5 text-white">
                                                <option value="pending" {{ $offer->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="accepted" {{ $offer->status == 'accepted' ? 'selected' : '' }}>Setujui</option>
                                                <option value="rejected" {{ $offer->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
                                            </select>
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-xs px-3 py-1.5 rounded-lg font-semibold">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-8 text-slate-400">Belum ada pengajuan penawaran atau trade-in masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>