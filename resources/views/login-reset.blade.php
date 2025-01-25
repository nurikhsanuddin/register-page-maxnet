{{-- @dump($errors) --}}
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

                    <form class="space-y-4 md:space-y-6" action="{{ route('resetPassword') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tokentu" value="{{request()->get('token')}}">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium @if ($errors->has('email')) text-red-500 @else text-gray-900 @endif">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ request()->get('email') }}"
                                class="bg-gray-50 border @if ($errors->has('email')) border-red-300 @else border-gray-400 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 d "
                                autofocus>

                            @error('email')
                            <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                                    }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium @if ($errors->has('password')) text-red-500 @else text-gray-900 @endif">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border @if ($errors->has('password')) border-red-300 @else border-gray-300 @endif text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 "
                                required>
                            @error('password')
                            <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                                    }}
                            </p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-purple-900 hover:bg-purple-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Reset
                            Password</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/flowbite.js') }}"></script>
</body>

</html>