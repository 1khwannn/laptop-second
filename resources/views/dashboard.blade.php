<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Dashboard Penawaran Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white dark:bg-slate-900 shadow sm:rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Penawaran Laptop</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pantau status pengajuan jual laptop bekas Anda di sini.</p>
                    </div>
                    <a href="/jual-laptop" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm px-4 py-2 rounded-xl transition">
                        + Jual Laptop Lagi
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($myOffers as $offer)
                        <div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/60 rounded-2xl p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <span class="text-xs font-bold text-slate-400">#BUY-{{ str_pad($offer->id, 4, '0', STR_PAD_LEFT) }}</span>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">{{ $offer->brand->name ?? '' }} {{ $offer->model_name }}</h4>
                                <div class="flex flex-wrap items-center gap-4 mt-2 text-xs">
                                    <p class="text-slate-500 dark:text-slate-400">
                                        Ekspektasi Anda: <strong class="text-slate-700 dark:text-slate-200">Rp {{ number_format($offer->expected_price, 0, ',', '.') }}</strong>
                                    </p>
                                    @if($offer->admin_offer_price)
                                        <p class="text-indigo-600 dark:text-indigo-400 font-semibold">
                                            Tawaran Toko: Rp {{ number_format($offer->admin_offer_price, 0, ',', '.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                                <!-- Status Badge -->
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    @if($offer->status == 'pending') bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-400 dark:border dark:border-amber-800
                                    @elseif($offer->status == 'accepted') bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-400 dark:border dark:border-emerald-800
                                    @elseif($offer->status == 'completed') bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-400 dark:border dark:border-blue-800
                                    @else bg-rose-100 text-rose-700 dark:bg-rose-950 dark:text-rose-400 dark:border dark:border-rose-800 @endif">
                                    {{ strtoupper($offer->status) }}
                                </span>

                                <!-- Tombol Chat WA Admin jika status Deal / Accepted / Completed -->
                                @if(in_array($offer->status, ['accepted', 'completed']))
                                    @php
                                        $adminWa = "6281234567890"; // Ganti dengan nomor WhatsApp Toko
                                        $waMsg = rawurlencode("Halo Admin LaptopSecond, saya ingin menindaklanjuti penawaran laptop " . $offer->model_name . " (No. Penawaran: #BUY-" . str_pad($offer->id, 4, '0', STR_PAD_LEFT) . ") yang sudah Disetujui.");
                                    @endphp
                                    <a href="https://wa.me/{{ $adminWa }}?text={{ $waMsg }}" target="_blank"
                                       class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-sm">
                                        💬 Hubungi Toko
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 border border-dashed border-slate-300 dark:border-slate-700 rounded-2xl">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada penawaran laptop yang Anda kirimkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>