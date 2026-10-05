<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-white leading-tight">
                {{ __('Dashboard Pelanggan') }}
            </h2>
            <a href="{{ route('offers.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-md shadow-blue-600/30">
                + Ajukan Penawaran Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-950/80 border border-emerald-800 text-emerald-300 rounded-xl text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-xl sm:rounded-2xl p-6">
                <h3 class="text-lg font-bold text-white mb-4">Riwayat Penawaran Laptop Saya</h3>

                @if($offers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="text-xs uppercase bg-slate-950 text-slate-400 border-b border-slate-800">
                                <tr>
                                    <th class="p-4">Tanggal</th>
                                    <th class="p-4">Merek / Seri</th>
                                    <th class="p-4">Spesifikasi</th>
                                    <th class="p-4">Harga Ekspektasi</th>
                                    <th class="p-4">Tawaran Toko</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/60">
                                @foreach($offers as $offer)
                                    <tr class="hover:bg-slate-950/40">
                                        <td class="p-4 text-xs text-slate-400">{{ $offer->created_at->format('d M Y, H:i') }}</td>
                                        <td class="p-4 font-bold text-white">
                                            <span class="text-blue-400 text-xs block">{{ $offer->brand->name ?? '-' }}</span>
                                            {{ $offer->model_name }}
                                        </td>
                                        <td class="p-4 text-xs">
                                            {{ $offer->processor }} | {{ $offer->ram }} | {{ $offer->storage }}
                                        </td>
                                        <td class="p-4 font-semibold text-slate-200">
                                            Rp {{ number_format($offer->expected_price, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 font-extrabold text-blue-400">
                                            @if($offer->admin_offer_price)
                                                Rp {{ number_format($offer->admin_offer_price, 0, ',', '.') }}
                                            @else
                                                <span class="text-slate-500 font-normal italic">Belum direview</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-slate-800 text-slate-300 border-slate-700',
                                                    'negotiating' => 'bg-amber-950 text-amber-400 border-amber-800',
                                                    'accepted' => 'bg-blue-950 text-blue-400 border-blue-800',
                                                    'rejected' => 'bg-rose-950 text-rose-400 border-rose-800',
                                                    'completed' => 'bg-emerald-950 text-emerald-400 border-emerald-800',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[11px] font-bold border {{ $statusClasses[$offer->status] ?? 'bg-slate-800 text-slate-300' }}">
                                                {{ ucfirst($offer->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-12 text-center text-slate-500 border border-dashed border-slate-800 rounded-xl">
                        <p class="text-sm">Anda belum pernah mengajukan penawaran jual laptop.</p>
                        <a href="{{ route('offers.create') }}" class="mt-3 inline-block text-xs font-bold text-blue-400 hover:underline">
                            + Ajukan Penawaran Sekarang
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>