<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto&display=swap"
        rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flowbite.css') }}" rel="stylesheet">

    <title>Maxnet | Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">

    <style>
        .whatsapp-icon {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            background-color: #25D366;
            color: white;
            padding: 1rem;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .bg-gradient-blue {
            background: rgb(49, 51, 130);
            background: linear-gradient(90deg, rgba(49, 51, 130, 1) 0%, rgba(74, 105, 189, 1) 46%, rgba(74, 105, 189, 1) 100%);
        }

        .bg-gradient-blue:hover {
            background: rgb(49, 51, 130);
            background: linear-gradient(90deg, rgba(49, 51, 130, 1) 0%, rgba(74, 105, 189, 1) 46%, rgba(74, 105, 189, 1) 100%);

        }
    </style>
</head>

<body>
    <section class="bg-gray-50 h-[100vh] bg-custom-background bg-cover md:bg-center flex">
        <div class="flex flex-col items-center justify-center w-full px-6 mx-auto md:h-screen md:w-[500px]">
            <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="h-[4rem] mr-2" src="{{ asset('images/icon.png') }}" alt="logo">
            </div>
            <div class="w-full bg-white rounded-lg shadow-2xl md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 md:space-y-6 sm:p-8 ">
                    @if (session('error'))
                        <div id="alert-3"
                            class="flex p-4 mb-4 text-red-800 border-2 border-red-300 rounded-lg bg-red-50 "
                            role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                    <form class="space-y-4 md:space-y-6" action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium @if ($errors->has('email')) text-red-500 @else text-gray-900 @endif">E-mail
                                / No Hp</label>
                            <input type="text" name="email" id="email"
                                class="bg-gray-50 border @if ($errors->has('email')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 d "
                                placeholder="user@example.com" autofocus required>
                            @error('email')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}
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
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <a href="{{ route('login.forgot') }}" class="text-md text-blue-500">Forgot Password ?</a>
                        </div>
                        <div>
                            <button type="submit"
                                class="text-white w-full bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                    <span class=" ml-2 text-sm">Sign in</span>
                                </div>
                            </button>

                        </div>
                        <div class="text-center mt-0 text-xs text-gray-900">

                            <span>ATAU</span>
                        </div>
                        <div class="flex space-x-2 align-center justify-center">

                            <a class="text-white w-full bg-gradient-to-r from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                href="{{ route('service') }}">
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-hand-click">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5" />
                                        <path d="M11 11.5v-2a1.5 1.5 0 0 1 3 0v2.5" />
                                        <path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5" />
                                        <path
                                            d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7l-.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47" />
                                        <path d="M5 3l-1 -1" />
                                        <path d="M4 7h-1" />
                                        <path d="M14 3l1 -1" />
                                        <path d="M15 6h1" />
                                    </svg>
                                    <span class="ml-2">Mulai Berlangganan</span>

                                </div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Ikon WhatsApp Mengambang -->
    <a href="https://wa.me/628991306262" target="_blank" class="whatsapp-icon">
        <img src="https://img.icons8.com/ios-glyphs/30/ffffff/whatsapp.png" alt="WhatsApp">
    </a>
    <script src="{{ asset('js/flowbite.js') }}"></script>
</body>

</html>
