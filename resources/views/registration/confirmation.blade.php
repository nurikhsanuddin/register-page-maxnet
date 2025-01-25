@extends('registration.layout')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@section('content')
    <!-- Terms Modal -->

    <div class="p-6 md:space-y-6 sm:p-8 ">
        @if (session('error'))
            <div id="alert-3" class="flex p-4 mb-4 text-red-800 border-2 border-red-300 rounded-lg bg-red-50 "
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8  dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div id="alert-3" class="flex p-4 mb-4 text-emerald-800 border-2 border-emerald-300 rounded-lg bg-emerald-50 "
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8  dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="max-w-auto mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Data Pendaftaran</h2>
                <p class="text-sm text-gray-600 mt-2">Mohon periksa kembali data anda sebelum melanjutkan</p>
            </div>

            <!-- Package Info Card -->
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-purple-900 mb-2">Paket Yang Dipilih</h3>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-purple-900">{{ $data->service->service_name }}</span>
                </div>
                <span class="text-lg font-semibold text-error">Rp
                    {{ number_format($data->service->service_price, 0, ',', '.') }}</span>
            </div>

            <!-- Personal Info Card -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Diri</h3>
                    <div class="grid gap-6">
                        <div>
                            <p class="text-sm text-gray-600">Nama Lengkap</p>
                            <p class="text-base font-medium">{{ $data->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="text-base font-medium">{{ $data->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nomor HP</p>
                            <p class="text-base font-medium">+62{{ $data->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nomor KTP</p>
                            <p class="text-base font-medium">{{ $data->ktp_number }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Info Card -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Lokasi Pemasangan</h3>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-1">Alamat Lengkap</p>
                        <p class="text-base">{{ $data->address }}</p>
                    </div>
                    <div id="map" class="h-64 w-full rounded-lg border border-gray-300"></div>
                </div>
            </div>

            <!-- KTP Preview -->
            @if ($data->ktp_file)
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto KTP</h3>
                        <img src="{{ Storage::disk('s3')->temporaryUrl('/ktp/' . $data->ktp_file, now()->addMinutes(5)) }}"
                            class="max-w-full h-auto rounded-lg border border-gray-200">
                    </div>
                </div>
            @endif
            {{-- @dump($data->register_id) --}}
            @if ($data->home_file)
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Depan Rumah</h3>
                        <img src="{{ Storage::disk('s3')->temporaryUrl('/sub_home_temp/' . $data->home_file, now()->addMinutes(5)) }}"
                            class="max-w-full h-auto rounded-lg border border-gray-200">
                    </div>
                </div>
            @endif
            {{-- @dump($data->register_id) --}}
            <!-- Action Buttons -->
            <div class="flex space-x-2 align-center justify-center mb-2">
                <button data-modal-target="termsModal" data-modal-toggle="termsModal"
                    class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full ">
                    <div class="flex space-x-2 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M3 12h13l-3 -3" />
                            <path d="M13 15l3 -3" />
                        </svg>
                        <p>Registrasi</p>
                    </div>
                </button>
            </div>



            <div class="flex space-x-2 align-center justify-center">

                <a href="{{ route('profile') }}"
                    class="w-full text-white bg-gray-900 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    <div class="flex space-x-2 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 14l-4 -4l4 -4" />
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                        </svg>
                        <p>Kembali</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([{{ $data->latitude }}, {{ $data->longitude }}], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add marker for installation location
            L.marker([{{ $data->latitude }}, {{ $data->longitude }}]).addTo(map);

            // Ensure map renders correctly
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        });
    </script>
@endpush
