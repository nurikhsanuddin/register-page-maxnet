{{-- @dump($errors) --}}
@extends('registration.layout')
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
        <form class="space-y-2 md:space-y-4" action="{{ route('register.store') }}" method="POST">
            @csrf
            <div>
                {{-- <p>Paket Yang Dipilih : {{ $data->service->service_name }}</p> --}}
                <label for="name"
                    class="block mb-2 text-sm font-medium @if ($errors->has('email')) text-red-500 @else text-gray-900 @endif">Nama
                    Lengkap</label>
                <input type="text" name="name" value="{{ $data->name ? $data->name : '' }}" id="name"
                    class="bg-gray-50 border @if ($errors->has('name')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 d "
                    placeholder="John Doe" autofocus required>
                @error('name')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}
                    </p>
                @enderror
            </div>
            <div>

                <label for="email"
                    class="block mb-2 text-sm font-medium @if ($errors->has('email')) text-red-500 @else text-gray-900 @endif">E-mail
                </label>
                <input type="text" name="email" value="{{ $data->email ? $data->email : '' }}" id="email"
                    class="bg-gray-50 border @if ($errors->has('email')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 d "
                    placeholder="user@example.com" autofocus required>
                @error('email')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}
                    </p>
                @enderror
            </div>
            <div>
                <label for="password"
                    class="block mb-2 text-sm font-medium @if ($errors->has('password')) text-red-500 @else text-gray-900 @endif">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border @if ($errors->has('password')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 "
                    required>
                @error('password')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}
                    </p>
                @enderror
            </div>
            <div>
                <label for="repeat_password"
                    class="block mb-2 text-sm font-medium @if ($errors->has('repeat_password')) text-red-500 @else text-gray-900 @endif">Konfirmasi
                    Password</label>
                <input type="password" name="repeat_password" id="repeat_password" placeholder="••••••••"
                    class="bg-gray-50 border @if ($errors->has('repeat_password')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 "
                    required>
                @error('repeat_password')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                {{-- <a href="{{ route('login.forgot') }}" class="text-md text-blue-500">Forgot Password ?</a> --}}
            </div>
            <div>
                <button type="submit"
                    class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full  ">
                    <div class="flex space-x-2 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-lock">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12 2a5 5 0 0 1 5 5v3a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3v-3a5 5 0 0 1 5 -5m0 12a2 2 0 0 0 -1.995 1.85l-.005 .15a2 2 0 1 0 2 -2m0 -10a3 3 0 0 0 -3 3v3h6v-3a3 3 0 0 0 -3 -3" />
                        </svg>
                        <p>Buat Akun</p>
                    </div>

                </button>

            </div>
            <div class="flex space-x-2 align-center justify-center">

                <a href="{{ route('service') }}"
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
        </form>
    </div>
@endsection
