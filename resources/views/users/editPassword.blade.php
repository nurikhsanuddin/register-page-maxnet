@extends('layout.app')


@section('section')
<section class="bg-gray-50 h-[100vh] bg-custom-background bg-cover md:bg-center flex">
  <div class="flex flex-col mx-auto px-2 justify-center md:w-[700px] ">
    <div class="flex flex-col items-center justify-center w-full px-6 mx-auto md:h-screen md:w-[500px]">
      <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
        <img class="h-[4rem] mr-2" src="{{ asset('images/icon.png') }}" alt="logo">
      </div>
      <div class="w-full bg-white rounded-lg shadow-2xl md:mt-0 sm:max-w-md xl:p-0 ">
        <div class="p-6 md:space-y-6 sm:p-8 ">
          @if ($errors->any())
          @foreach ($errors->all() as $error)
          <div id="alert-3" class="flex p-4 w-full mb-4 text-red-800 border-2 border-red-300 rounded-lg bg-red-50"
            role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
              {{ $error }}
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
          @endforeach
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
          <div>
            <h2 class="text-center font-semibold">Change Password</h2>
          </div>
          <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <div class="relative">
              <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
              <div class="relative">
                <input type="password" id="new_password" name="new_password"
                  class="mt-1 p-2 w-full border rounded-md pr-10 focus:ring focus:ring-blue-300" required>
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <img src="https://img.icons8.com/ios-glyphs/30/000000/invisible.png" alt="toggle password"
                    class="cursor-pointer" onclick="togglePassword('new_password', this)" />
                </span>
              </div>
            </div>
            <div class="relative">
              <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                Password</label>
              <div class="relative">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                  class="mt-1 p-2 w-full border rounded-md pr-10 focus:ring focus:ring-blue-300" required>
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <img src="https://img.icons8.com/ios-glyphs/30/000000/invisible.png" alt="toggle password"
                    class="cursor-pointer" onclick="togglePassword('new_password_confirmation', this)" />
                </span>
              </div>
            </div>

            <div>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full hover:bg-blue-600">Change
                Password</button>
            </div>
          </form>
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
<script>
  function togglePassword(fieldId, iconElement) {
    const field = document.getElementById(fieldId);
    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
    field.setAttribute('type', type);

    // Toggle the icon
    iconElement.src = type === 'password'
      ? 'https://img.icons8.com/ios-glyphs/30/000000/invisible.png'
      : 'https://img.icons8.com/ios-glyphs/30/000000/visible.png';
  }
</script>
@endpush