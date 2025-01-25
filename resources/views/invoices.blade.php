@extends('layout.app')

@section('section')
<section class="font-opens w-full p-2">
    <div class="flex flex-col justify-center mx-auto my-28 md:w-[700px]">
        <div id="card-container">
            <div class="mb-4">
                @if (count($billing) > 0)
                {{-- Menampilkan invoice terakhir --}}
                @php
                $latestInvoice = $billing->first();
                // dd($latestInvoice);
                @endphp
                <a href="{{ route('invoice', ['id' => $latestInvoice->invoice_no]) }}">
                    <div class="mb-6">
                        <div class="flex justify-between items-center py-3 px-6 rounded-t-lg bg-purple-500">
                            <h3 class="text-lg text-white">
                                <span class="font-semibold">{{ $latestInvoice->invoice_no }}</span>
                            </h3>
                            @if ($latestInvoice->status == 'UNPAID' || $latestInvoice->status == 'OVERDUE')
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 p-2 rounded dark:bg-red-900 dark:text-red-300">{{
                                $latestInvoice->status }}</span>
                            @elseif ($latestInvoice->status == 'PAID')
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{
                                $latestInvoice->status }}</span>
                            @endif
                        </div>
                        <div class="w-full rounded-b-lg overflow-hidden bg-white shadow-2xl">
                            <div class="px-8 pt-6 pb-4 md:space-y-2 w-full">
                                <div class="flex justify-between w-full">
                                    <h2 class="text-md font-semibold text-slate-600 max-w-full">
                                        {{ $latestInvoice->service_description }}
                                    </h2>
                                </div>
                                <h1 class="font-extrabold text-2xl mb-1">{{ 'Rp.' .
                                    number_format($latestInvoice->grand_total, 0, ',',
                                    '.') . ',-' }}</h1>
                                <p class="text-xs w-full"></p>
                                <div class="flex justify-between py-3 px-6 bg-gray-200 w-full">
                                    @if ($latestInvoice->status == 'UNPAID')
                                    <h3 class="text-sm">Bayar Sebelum</h3>
                                    @elseif ($latestInvoice->status == 'PAID')
                                    <h3 class="text-sm px-4">Sudah Dibayar</h3>
                                    @endif
                                    <h3 class="font-semibold">{{
                                        \Carbon\Carbon::parse($latestInvoice->created_at)->format('d M Y') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                {{-- Tombol untuk menampilkan semua riwayat invoice --}}
                <div class="text-center mb-6">
                    <button id="show-invoices-btn"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                        SHOW INVOICE ALL
                    </button>
                </div>
                {{-- Semua riwayat invoice (tersembunyi secara default) --}}
                <div id="all-invoices" class="hidden">
                    @foreach ($billing as $invoice)
                    <a href="{{ route('invoice', ['id' => $invoice->invoice_no]) }}">
                        <div class="mb-6">
                            <div class="flex justify-between items-center py-3 px-6 rounded-t-lg bg-purple-500">
                                <h3 class="text-lg text-white">
                                    <span class="font-semibold">{{ $invoice->invoice_no }}</span>
                                </h3>
                                @if ($invoice->status == 'UNPAID' || $invoice->status == 'OVERDUE')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 p-2 rounded dark:bg-red-900 dark:text-red-300">{{
                                    $invoice->status }}</span>
                                @elseif ($invoice->status == 'PAID')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{
                                    $invoice->status }}</span>
                                @endif
                            </div>
                            <div class="w-full rounded-lg overflow-hidden bg-white shadow-2xl">
                                <div class="px-8 pt-6 pb-4 md:space-y-2 w-full">
                                    <div class="flex justify-between w-full">
                                        <h2 class="text-md font-semibold text-slate-600 max-w-full">
                                            {{ $invoice->service_description }}
                                        </h2>
                                    </div>
                                    <h1 class="font-extrabold text-2xl mb-1">{{ 'Rp.' .
                                        number_format($invoice->grand_total, 0, ',', '.') . ',-' }}</h1>
                                    <p class="text-xs w-full">

                                    </p>
                                    <div class="flex justify-between py-3 px-6 bg-gray-200 w-full">
                                        @if ($invoice->status == 'UNPAID')
                                        <h3 class="text-sm">Bayar Sebelum</h3>
                                        @elseif ($invoice->status == 'PAID')
                                        <h3 class="text-sm px-4">Sudah Dibayar</h3>
                                        @endif
                                        <h3 class="font-semibold">{{
                                            \Carbon\Carbon::parse($invoice->created_at)->format('d M
                                            Y') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="mb-6">
                    <div class="w-full rounded-lg overflow-hidden bg-white p-2 shadow-2xl">
                        <h2 class="text-md text-center font-semibold">Belum Ada Invoice</h2>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.getElementById('show-invoices-btn').addEventListener('click', function() {
        var allInvoices = document.getElementById('all-invoices');
        if (allInvoices.classList.contains('hidden')) {
            allInvoices.classList.remove('hidden');
            this.textContent = 'HIDE INVOICE ALL';
        } else {
            allInvoices.classList.add('hidden');
            this.textContent = 'SHOW INVOICE ALL';
        }
    });
</script>
@endpush