<header class="fixed w-full z-10 top-0 shadow-md">
    <nav class="bg-white border-gray-200 py-4">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/icon.png') }}" class="h-[3rem] mr-3 md:h-9" alt="Maxnet" />
            </a>
            <div class="flex items-center lg:order-2">
                <form id="logout" action="{{ route('logout.action') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 focus:outline-none">Log
                        Out</button>
                </form>
            </div>
        </div>
    </nav>
</header>