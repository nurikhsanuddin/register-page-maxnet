@extends('layout.app')

@section('section')
<section class="font-opens flex-1 overflow-y-auto mt-28">
    <div class="flex flex-col min-h-screen justify-center px-4 mx-auto md:w-[700px]">
        @foreach ($subscriptions as $index => $subscription)
        <div id="card-container" class="mb-6">
            <div class="w-full rounded-lg overflow-hidden bg-white shadow-2xl">
                <div class="flex flex-col p-4 mt-2">

                    <h3 class="text-sm font-bold truncate text-gray-400">{{ $subscription->subscription_id }}</h3>

                    <h2 class="text-md font-semibold text-slate-600 max-w-full">
                        {{ $subscription->service->service_description }}
                    </h2>
                    <h1 class="text-lg font-extrabold text-slate-800 truncate lg:text-2xl">
                        {{ $subscription->service->service_speed . ' MBPS ' }} -
                        {{ 'Rp.' . number_format($subscription->subscription_price ??
                        $subscription->service->service_price, 0, ',', '.') . ',-' }}
                    </h1>
                    <p class="text-sm text-slate-600">
                        {{ $subscription->subscription_address }}
                    </p>
                </div>
                <div class="flex justify-between py-3 px-6 
                    @if ($subscription->subscription_status == 'ACTIVE') bg-green-500
                    @elseif (
                        $subscription->subscription_status == 'DECLINE' ||
                        $subscription->subscription_status == 'DISMANTLE' ||
                        $subscription->subscription_status == 'SUSPEND')
                    bg-red-500
                    @else
                    bg-blue-500 @endif">
                    <h3 class="text-sm font-bold text-center text-white">{{ $subscription->subscription_status }}</h3>
                    <p id="siteStatus-{{ $index }}">
                        <a href="http://{{ $subscription->subscription_id ?? '8.8.8.8' }}" target="_blank"
                            class="border-red-500 bg-red-200 text-sm font-medium px-2.5 py-0.2 w-[7.5rem] my-2rem text-center rounded border flex items-center justify-center">
                            <box-icon name='globe' color='#ef4444' style="margin-right: 0.5rem;"></box-icon>
                            Loading...
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@push('scripts')
<script>
    function updateSiteStatus(subscriptionId, index) {
        $.ajax({
            url: `{{ url('/checkActive') }}/${subscriptionId}`,
            method: 'GET',
            success: function(response) {
                var statusText = response.status == 1 ? 'Online' : 'Offline';
                var statusColor = response.status == 1 ? 'bg-green-200' : 'bg-red-200';
                var textColor = response.status == 1 ? 'text-green-800' : 'text-red-800';
                var borderColor = response.status == 1 ? 'border-green-400' : 'border-red-400';
                var iconName = response.status == 1 ? 'globe' : 'no-signal';
                var colorIcon = response.status == 1 ? '#22c55e' : '#FF6347';

                // Perbarui tampilan status online atau offline
                $(`#siteStatus-${index}`).html(`
                    <a href="http://${response.ip}" target="_blank"
                        class="${statusColor} text-sm ${textColor} font-medium px-2.5 py-0.2 w-[7.5rem] my-2rem text-center rounded border ${borderColor} flex items-center justify-center">
                        <box-icon name='${iconName}' color='${colorIcon}' style="margin-right: 0.5rem;"></box-icon>
                        ${statusText}
                    </a>
                `);
            },
            error: function() {
                console.log('Error fetching site status.');
            }
        });
    }

    $(document).ready(function() {
        @foreach ($subscriptions as $index => $subscription)
            updateSiteStatus("{{ $subscription->subscription_id }}", {{ $index }});
        @endforeach
    });

    function goBack() {
        window.history.back();
    }
</script>
@endpush