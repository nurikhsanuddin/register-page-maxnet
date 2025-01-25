<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  @include('layouts.partials.link')
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <!-- Navbar -->
  @include('layout.navbar')
  <!-- Main Content -->
  <main
    class="flex flex-col flex-grow items-center justify-center bg-gray-100 bg-custom-background bg-cover bg-fixed md:bg-center">
    @yield('section')
  </main>
  <!-- Ikon WhatsApp Mengambang -->
  <a href="https://wa.me/628991306262" target="_blank"
    class="fixed bottom-4 right-4 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg z-50">
    <img src="https://img.icons8.com/ios-glyphs/30/ffffff/whatsapp.png" alt="WhatsApp">
  </a>
  <!-- Ikon Back Mengambang -->
  <a href="javascript:void(0)" onclick="handleBack()"
    class="fixed bottom-4 left-4 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg z-50 flex items-center justify-center w-12 h-12">
    <i class='bx bx-arrow-back text-2xl'></i>
  </a>
  <!-- Footer -->
  {{-- @include('layout.footer') --}}
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script>
  // Simpan URL halaman sebelumnya di localStorage saat pengguna mengunjungi halaman login
  window.onload = function() {
    if (document.referrer !== "" && !document.referrer.includes('/login')) {
      localStorage.setItem('lastVisitedPage', document.referrer);
    }
    // Reset status navigasi ketika halaman login dimuat
    localStorage.setItem('backButtonClicked', 'false');
  };

  function handleBack() {
    const lastVisitedPage = localStorage.getItem('lastVisitedPage');
    const backButtonClicked = localStorage.getItem('backButtonClicked');

    if (backButtonClicked === 'true') {
      // Jika tombol kembali telah diklik sebelumnya, redirect ke halaman default
      window.location.href = '/'; // ganti '/' dengan URL halaman default Anda
    } else {
      // Tandai bahwa tombol kembali telah diklik
      localStorage.setItem('backButtonClicked', 'true');

      if (lastVisitedPage) {
        window.location.href = lastVisitedPage;
      } else {
        window.location.href = '/'; // ganti '/' dengan URL halaman default Anda
      }
    }
  }
</script>
<script>
  $('#profileDropdown').click(function() {
    $('#dropdown-user').toggleClass('invisible').toggleClass('opacity-0').toggleClass('translate-y-[10px]').toggleClass('translate-y-0');
  });

  $(document).ready(function () {
    $('button[data-tab-target]').click(function () {
      var target = $(this).data('tab-target');
      $('button[data-tab-target]').removeClass('border-blue-500 text-blue-500');
      $(this).addClass('border-blue-500 text-blue-500');
      $('.tab-content').removeClass('active');
      $(target).addClass('active');
    });

    // Activate the first tab and content by default
    $('#tabMenu button:first').addClass('border-blue-500 text-blue-500');
    $('#tabContent > div:first').addClass('active');
  });
</script>
@stack('scripts')
@include('layouts.partials.script')

</html>