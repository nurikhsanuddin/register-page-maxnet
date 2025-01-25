{{-- @dump($errors) --}}
@extends('registration.layout')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/2.4.0/Control.Geocoder.css" />
    <style>
        #map {
            min-height: 400px;
            width: 100%;
            border-radius: 0.5rem;
            z-index: 1;
        }
    </style>
@endpush

@section('content')
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
                {{-- <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8  dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button> --}}
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
        <form class="space-y-6 md:space-y-8" action="{{ route('profile.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <!-- Personal Information Section -->
                <div class="p-4 bg-white rounded-lg border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label for="name"
                                class="block text-sm font-medium @error('name') text-red-500 @else text-gray-700 @enderror">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', $data->name) }}" id="name"
                                class="w-full p-2.5 text-sm rounded-lg border @error('name') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                                required>
                            @error('name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label for="email"
                                class="block text-sm font-medium @error('email') text-red-500 @else text-gray-700 @enderror">
                                E-mail
                            </label>
                            <input type="email" name="email" value="{{ old('email', $data->email) }}" id="email"
                                class="w-full p-2.5 text-sm rounded-lg border @error('email') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                                required>
                            @error('email')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="space-y-2">
                            <label for="phone"
                                class="block text-sm font-medium @error('phone') text-red-500 @else text-gray-700 @enderror">
                                Nomor HP
                            </label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-100 border border-e-0 border-gray-300 rounded-s-lg">
                                    +62
                                </span>
                                <input type="text" name="phone" value="{{ old('phone', $data->phone) }}" id="phone"
                                    placeholder="851234567899"
                                    class="w-full p-2.5 text-sm rounded-lg border @error('phone') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                                    required>
                                {{-- <input type="text" name="phone" value="{{ old('phone', $data->phone) }}" id="phone"
                                    placeholder="851234567899"
                                    class="w-full p-2.5 text-sm rounded-lg border @error('phone') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                                    required> --}}
                            </div>

                            @error('phone')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- KTP Number Field -->
                        <div class="space-y-2">
                            <label for="ktp_number"
                                class="block text-sm font-medium @error('ktp_number') text-red-500 @else text-gray-700 @enderror">
                                Nomor KTP
                            </label>
                            <input type="text" name="ktp_number" value="{{ old('ktp_number', $data->ktp_number) }}"
                                id="ktp_number" placeholder="12345678"
                                class="w-full p-2.5 text-sm rounded-lg border @error('ktp_number') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                                required>
                            @error('ktp_number')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- KTP File Upload -->
                    <div class="mt-4 space-y-2">
                        <label for="ktp_file"
                            class="block text-sm font-medium @error('ktp_file') text-red-500 @else text-gray-700 @enderror">
                            Upload Foto/Scan KTP
                        </label>
                        @if ($data->ktp_file)
                            <img class="max-w-full object-cover h-auto rounded-lg"
                                src="{{ Storage::disk('s3')->temporaryUrl('/ktp/' . $data->ktp_file, now()->addMinutes(5)) }}">
                        @endif
                        <input type="file" name="ktp_file" id="ktp_file" accept="image/*"
                            class="w-full p-2.5 text-sm rounded-lg border @error('ktp_file') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                            {{ $data->ktp_number ? '' : 'required' }}>
                        @error('ktp_file')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-4 space-y-2">
                        <label for="home_file"
                            class="block text-sm font-medium @error('home_file') text-red-500 @else text-gray-700 @enderror">
                            Upload Foto Depan Rumah
                        </label>
                        @if ($data->home_file)
                            <img class="max-w-full object-cover h-auto rounded-lg"
                                src="{{ Storage::disk('s3')->temporaryUrl('/sub_home_temp/' . $data->home_file, now()->addMinutes(5)) }}">
                        @endif
                        <input type="file" name="home_file" id="home_file" accept="image/*"
                            class="w-full p-2.5 text-sm rounded-lg border @error('home_file') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                            {{ $data->ktp_number ? '' : 'required' }}>
                        @error('home_file')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location Section -->
                <div class="p-4 bg-white rounded-lg border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Lokasi Pemasangan</h3>

                    <!-- Location Search -->
                    <div class="mb-4">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            Cari Lokasi (Kota/Kecamatan/Kelurahan)
                        </label>
                        <div class="flex gap-2">
                            <input type="text" id="search" placeholder="Kata Kunci"
                                class="w-full p-2.5 text-sm rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <button type="button" id="searchButton"
                                class="px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="space-y-2">
                        <p
                            class="text-sm font-medium text-indigo-800 bg-indigo-50 px-3 py-1 rounded-lg border border-indigo-200 text-center">
                            Tekan pada peta untuk memilih titik lokasi pemasangan
                        </p>
                        <div id="map"></div>
                    </div>

                    <!-- Address Field -->
                    <div class="mt-4 space-y-2">
                        <label for="address"
                            class="block text-sm font-medium @error('address') text-red-500 @else text-gray-700 @enderror">
                            Alamat Lengkap
                        </label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full p-2.5 text-sm rounded-lg border @error('address') border-red-300 @else border-gray-300 @enderror focus:ring-purple-500 focus:border-purple-500"
                            required>{{ old('address', $data->address) }}</textarea>
                        @error('address')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" value="{{ old('longitude', $data->longitude) }}" name="longitude"
                        id="longitude">
                    <input type="hidden" value="{{ old('latitude', $data->latitude) }}" name="latitude"
                        id="latitude">
                    <input type="hidden" value="{{ old('group', $data->group) }}" name="group" value="1">
                    <input type="hidden" name="subscription_price" value="{{ $data->service->service_price }}">
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 py-2.5 px-5 text-sm font-medium text-white bg-gradient-to-br from-purple-600 to-blue-500 rounded-lg hover:bg-gradient-to-bl focus:ring-4 focus:ring-blue-300">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="14" r="2" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                            <span>Simpan</span>
                        </div>
                    </button>

                    <a href="{{ route('registration.register') }}"
                        class="flex-1 py-2.5 px-5 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                            <span>Kembali</span>
                        </div>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/2.4.0/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const map = L.map('map').setView([-6.2088, 106.8456], 13);
                let marker = null;

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Fungsi untuk menangani marker dan update koordinat
                function handleMarkerPlacement(latlng) {
                    // Hapus marker lama jika ada
                    if (marker) {
                        map.removeLayer(marker);
                    }

                    // Buat marker baru
                    marker = L.marker(latlng).addTo(map);

                    // Center map pada marker
                    map.setView(latlng, map.getZoom());

                    // Update nilai input koordinat
                    document.getElementById('latitude').value = latlng.lat;
                    document.getElementById('longitude').value = latlng.lng;

                    // Reverse geocoding untuk mendapatkan alamat
                    fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng.lat}&lon=${latlng.lng}`
                        )
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('address').value = data.display_name;
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Set marker default dari nilai input
                const defaultLat = parseFloat(document.getElementById('latitude').value);
                const defaultLng = parseFloat(document.getElementById('longitude').value);
                if (!isNaN(defaultLat) && !isNaN(defaultLng)) {
                    handleMarkerPlacement({
                        lat: defaultLat,
                        lng: defaultLng
                    });
                }

                // Monitor perubahan input latitude dan longitude
                document.getElementById('latitude').addEventListener('input', function() {
                    const lat = parseFloat(this.value);
                    const lng = parseFloat(document.getElementById('longitude').value);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        handleMarkerPlacement({
                            lat,
                            lng
                        });
                    }
                });

                document.getElementById('longitude').addEventListener('input', function() {
                    const lat = parseFloat(document.getElementById('latitude').value);
                    const lng = parseFloat(this.value);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        handleMarkerPlacement({
                            lat,
                            lng
                        });
                    }
                });

                // Event handler untuk klik pada map
                map.on('click', function(e) {
                    handleMarkerPlacement(e.latlng);
                });

                // Fungsi pencarian
                function searchLocation(query) {
                    if (!query) return;

                    fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`
                        )
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                const location = data[0];
                                const latlng = {
                                    lat: parseFloat(location.lat),
                                    lng: parseFloat(location.lon)
                                };

                                // Pindahkan view map ke lokasi yang ditemukan
                                map.setView(latlng, 16);

                                // Tempatkan marker
                                handleMarkerPlacement(latlng);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Event handler untuk tombol pencarian
                const searchButton = document.getElementById('searchButton');
                const searchInput = document.getElementById('search');

                searchButton.addEventListener('click', function() {
                    searchLocation(searchInput.value);
                });

                // Event handler untuk tombol Enter pada input pencarian
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        searchLocation(this.value);
                    }
                });

                // Pastikan map ter-render dengan benar
                map.invalidateSize();
            }, 100);
        });
    </script>
@endpush
