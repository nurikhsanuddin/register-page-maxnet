@extends('layout.app')

@section('section')
<section class="font-opens w-full p-2">
    <div class="flex flex-col justify-center mx-auto md:w-[700px]">
        <div class="w-full rounded-lg px-8  overflow-hidden bg-white shadow-2xl">
            <div class="px-2 pt-8">
                <div class="flex justify-between items-center mb-4">
                    <img src="{{ asset('storage/icon.png') }}" class="w-32 h-auto md:w-16 lg:w-20" alt="Icon">
                    @if ($billing->status == 'UNPAID' || $billing->status == 'OVERDUE' )
                    <span
                        class="bg-red-200 text-red-800 text-xs font-medium md:text-sm lg:text-base px-2.5 py-1 self-center rounded">
                        {{ $billing->status }}
                    </span>
                    @else
                    <span
                        class="bg-green-200 text-green-800 text-xs font-medium md:text-sm lg:text-base px-2.5 py-1 self-center rounded">
                        {{ $billing->status }}
                    </span>
                    @endif
                </div>
                <div class="flex justify-between mb-6">
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-sm text-slate-500">Invoice No.</h3>
                        <p class="font-semibold text-md">{{ $billing->invoice_no }}</p>
                    </div>
                    <div class="flex flex-col text-right">
                        <h3 class="font-semibold text-sm text-right text-slate-500">Batas Waktu</h3>
                        <p class="font-semibold text-md text-right">
                            {{ \Carbon\Carbon::parse($due_date)->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="font-semibold text-slate-100 text-center bg-purple-maxnet">
                <h3 class="text-white">DETAIL TAGIHAN</h3>
            </div>

            <div class="mb-4">
                <ul class="divide-y divide-gray-200">
                    @foreach ($billing_detail as $detail)
                    @if ($detail->subscription_id !== null)
                    <li class="py-2">
                        <div class="flex justify-between">
                            <div scope="row" class="py-2 font-medium text-sm text-gray-900 whitespace-nowrap">
                                <h3 class="uppercase">
                                    {{ $detail->subscription->Service->service_name . ' - ID ' .
                                    $detail->subscription->subscription_id }}
                                </h3>
                                <p class="text-slate-500">
                                    Billing Period -
                                    {{
                                    \Carbon\Carbon::parse($detail->subscription->start_date)->addMonth($detail->index_month)->format('F
                                    Y') }}
                                </p>
                            </div>
                            <p class="py-2 text-sm font-bold">
                                {{ 'Rp. ' . number_format($detail->subscription->Service->service_price, 0, ',', '.') .
                                ',-' }}
                            </p>
                        </div>
                    </li>
                    @else
                    <li class="py-2">
                        <div class="flex justify-between">
                            <div scope="row" class="py-2 font-medium text-sm text-gray-900 whitespace-nowrap">
                                <h3 class="uppercase">
                                    {{ $detail->billing_name }}
                                </h3>
                                <p class="text-slate-500">
                                    {{ $detail->billing_description }}
                                </p>
                            </div>
                            <p class="py-2 text-sm font-bold">
                                {{ 'Rp.' . number_format($detail->billing_price, 0, ',', '.') . ',-' }}
                            </p>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <?php $inv = $detail->uuid  ?>
            <div class="px-4 pb-8 flex justify-between">
                <a href="https://invoice.maxnetplus.id/invoice/download/{{$detail->invoice_no}}"
                    class="mr-2 mb-2 px-5 py-2.5 text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm text-center inline-flex items-center">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                        <path
                            d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
                    </svg>
                    <span class="hidden ml-3 md:block">Cetak Invoice</span>
                </a>
                <div class="text-right">
                    <h3 class="font-semibold text-md text-slate-500 uppercase">Total Tagihan</h3>
                    <h2 class="font-extrabold text-2xl mb-2">
                        {{ 'Rp.' . number_format($billing->grand_total, 0, ',', '.') . ',-' }}
                    </h2>
                    <p class="text-xs">
                        <span class="text-red-500 text-xs">*</span>
                        @if ($billing->tax)
                        Sudah Termasuk PPN (11%)
                        @else
                        Belum Termasuk PPN (11%)
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endpush