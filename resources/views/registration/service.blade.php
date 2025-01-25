@extends('registration.layout')
@section('content')
    <div class="w-full rounded-lg md:mt-0 sm:max-w-md xl:p-0 ">
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
                <div id="alert-3"
                    class="flex p-4 mb-4 text-emerald-800 border-2 border-emerald-300 rounded-lg bg-emerald-50 "
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
            <form class="space-y-2 md:space-y-4" action="{{ route('service.store') }}" method="POST">
                @csrf
                {{-- <div class="text-center">
                    <h1>PILIH LAYANAN</h1>
                </div> --}}
                {{-- <input type="text" name="service" id="service"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 d "
                    placeholder="user@example.com" autofocus required> --}}
                <label for="service" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                    Layanan</label>
                <input type="hidden" name="register_id" value="{{ $register_id }}" id="">
                <select name="service" id="service"
                    class="bg-gray-50 border @if ($errors->has('service')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 d "
                    required>
                    @foreach ($data as $service)
                        <option value="{{ $service->serv_id }}"
                            {{ $data_available && optional($data_available->service)->serv_id == $service->serv_id ? 'selected' : '' }}>
                            {{ $service->service_name . ' - Rp ' . number_format($service->service_price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('service')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}
                    </p>
                @enderror
                <button type="submit"
                    class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full ">LANJUT</button>
            </form>
        </div>
    </div>
@endsection
