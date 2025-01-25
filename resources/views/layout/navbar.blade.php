<nav class="bg-white fixed top-0 left-0 right-0 shadow-md p-1 mx-auto w-full">
  <div class="container mx-auto px-6 py-3 flex justify-between items-center">
    <div class="flex items-center">
      <a href="{{ route('home') }}" class="flex items-center">
        <img src="{{ asset('images/icon.png') }}" class="h-[3rem] mr-3 md:h-9" alt="Maxnet" />
      </a>
    </div>
    <div class="flex items-center lg:order-2 relative">
      <span class="text-gray-600 font-semibold mx-5">Hi,{{ Str::limit(Auth::user()->customer_name, 5) }}</span>
      <div class="w-7 cursor-pointer relative" id="profileDropdown">
        <img id="profile" class="rounded-full" src="{{ asset('images/user_default.jpg') }}" alt="Profile Image" />
        <div
          class="absolute w-[300px] bg-white shadow-md right-0 opacity-0 invisible -translate-y-[20px] transition-all ease-in-out duration-300 p-2 text-wrap"
          id="dropdown-user">
          <a class="flex items-center hover:bg-gray-100 px-4 rounded-sm mt-2 " href="{{route('editPassword')}}">
            <i class='bx bx-xs bx-rename'></i>
            <span class="block px-4 py-2 text-sm text-gray-700 hover:text-gray-900 whitespace-nowrap">Reset
              Password</span>
          </a>
          <a class="flex items-center hover:bg-gray-100 px-4 rounded-sm mt-2" href="{{ route('logout.action') }}"
            onclick="event.preventDefault(); document.getElementById('logout').submit();">
            <i class="bx bx-xs bx-power-off"></i>
            <p class="block px-4 py-2 text-sm text-gray-700 hover:text-gray-900">Logout</p>
          </a>
          <form id="logout" action="{{ route('logout.action') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>