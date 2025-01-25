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
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.min.css" rel="stylesheet" type="text/css" /> --}}
    <title>Maxnet | Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    @stack('styles')
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
            z-index: 49;
        }

        .logo-maxnet {
            position: fixed;
            z-index: 9;
        }

        .card-section {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 90%;
            margin: 0 auto;
        }

        .bg-custom-background {
            background-image: url('/images/wave-one.svg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 200vh;
        }

        @media (min-width: 768px) {
            .card-section {
                max-width: 500px;
            }
        }

        /* Modern Minimalist Stepper */
        .stepper-wrapper {
            margin: 2rem auto;
            width: 100%;
            padding: 0 1.5rem;
        }

        .steps {
            display: flex;
            position: relative;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .step-line {
            position: absolute;
            height: 2px;
            background: linear-gradient(90deg, #603bf6 var(--progress, 0%), #e5e7eb var(--progress, 0%));
            width: calc(100% - 5rem);
            z-index: 1;
            left: 50%;
            transform: translateX(-50%);
            top: calc(2.5rem / 2);
            transition: --progress 0.4s ease;
        }

        .step {
            width: auto;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            gap: 0.75rem;
        }

        .step-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: white;
            border: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            color: #6b7280;
            transition: all 0.4s ease;
            position: relative;
        }

        .step.active .step-circle {
            border-color: #603bf6;
            background: linear-gradient(135deg, #603bf6, #833bf6);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(96, 59, 246, 0.3);
            animation: pulse-gradient 2s infinite;
        }

        .step-text {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .step.active .step-text {
            color: #6a3bf6;
            transform: scale(1.05);
        }

        @keyframes pulse-gradient {
            0% {
                box-shadow: 0 0 15px rgba(96, 59, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 25px rgba(96, 59, 246, 0.5);
            }

            100% {
                box-shadow: 0 0 15px rgba(96, 59, 246, 0.3);
            }
        }

        /* Update progress bar based on current step */
        .steps:has(.step:nth-child(1).active) .step-line {
            --progress: 0%;
        }

        .steps:has(.step:nth-child(2).active) .step-line {
            --progress: 33%;
        }

        .steps:has(.step:nth-child(3).active) .step-line {
            --progress: 66%;
        }

        .steps:has(.step:nth-child(4).active) .step-line {
            --progress: 100%;
        }

        @media (max-width: 768px) {
            .stepper-wrapper {
                padding: 0 1rem;
            }

            .step-line {
                width: calc(100% - 4rem);
                /* Adjust for smaller circles on mobile */
                top: calc(2rem / 2);
            }

            .step-circle {
                width: 2rem;
                height: 2rem;
                font-size: 0.875rem;
            }

            .step-text {
                font-size: 0.75rem;
                position: absolute;
                width: max-content;
                top: 100%;
                margin-top: 0.5rem;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Modal Styles */
        .modal-content {
            max-height: 70vh;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .read-more-button {
            position: sticky;
            bottom: 0;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to top, white 50%, transparent);
            text-align: center;
            display: none;
        }

        .read-more-button.visible {
            display: block;
        }

        /* Updated Modal Styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            display: none;
        }

        .modal-dialog {
            position: relative;
            margin: 1.5rem auto;
            max-width: 42rem;
            height: calc(100vh - 3rem);
            display: flex;
            align-items: center;
        }

        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
            scroll-behavior: smooth;
            position: relative;
            background: white;
            width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .read-more-button {
            position: sticky;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 0));
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .read-more-button.visible {
            opacity: 1;
            pointer-events: auto;
        }

        .scroll-guide {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            padding: 0.75rem;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 60%, rgba(255, 255, 255, 0));
            text-align: center;
            z-index: 10;
            font-size: 0.875rem;
            color: #2426b3;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .scroll-guide i {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-custom-background bg-white">
    <div class="absolute top-3 left-4 mb-6 text-xl font-semibold text-gray-900">
        <img class="h-[4rem] mr-2 logo-maxnet" src="{{ asset('images/icon.png') }}" alt="logo">
    </div>
    <section class="relative flex flex-col items-center justify-center min-h-screen w-full py-8">
        <div class="flex flex-col items-center justify-center w-full px-4">
            @php
                $currentRoute = Route::currentRouteName();
            @endphp
            {{-- @dump($currentRoute) --}}
            {{-- @dump($register_id ? $register_id : '') --}}
            <div class="w-full bg-white rounded-lg shadow-2xl p-6 card-section">
                <div class="text-center">
                    <div class="text-2xl text-black font-bold mt-7" style="color: black">
                        <h1>{{ $title ? $title : '' }}</h1>
                    </div>
                    <div class="stepper-wrapper">
                        <div class="steps">
                            <div class="step-line"></div>
                            <div
                                class="step {{ $currentRoute == 'confirmation' || $currentRoute == 'service' || $currentRoute == 'index' || $currentRoute == 'registration.register' || $currentRoute == 'user_data' || $currentRoute == 'profile' ? 'active' : '' }}">
                                <div class="step-circle">1</div>
                                <div class="step-text">Pilih Paket</div>
                            </div>
                            <div
                                class="step {{ $currentRoute == 'confirmation' || $currentRoute == 'registration.register' || $currentRoute == 'user_data' || $currentRoute == 'profile' ? 'active' : '' }}">
                                <div class="step-circle">2</div>
                                <div class="step-text">Buat Akun</div>
                            </div>
                            <div
                                class="step {{ $currentRoute == 'confirmation' || $currentRoute == 'profile' ? 'active' : '' }}">
                                <div class="step-circle">3</div>
                                <div class="step-text">Input Data</div>
                            </div>
                            <div class="step {{ $currentRoute == 'confirmation' ? 'active' : '' }}">
                                <div class="step-circle">4</div>
                                <div class="step-text">Selesai</div>
                            </div>
                        </div>
                    </div>
                </div>


                @yield('content')
            </div>
        </div>
    </section>


    <!-- Ikon WhatsApp Mengambang -->
    <a href="https://wa.me/628991306262" target="_blank" class="whatsapp-icon">
        <img src="https://img.icons8.com/ios-glyphs/30/ffffff/whatsapp.png" alt="WhatsApp">
    </a>


    <div class="modal-backdrop" id="modalBackdrop"></div>
    <div id="termsModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 bottom-0 z-50 hidden">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="flex items-start justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Syarat dan Ketentuan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5"
                        data-modal-hide="termsModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 01-1.414-1.414L8.586 10 4.293 5.707a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="scroll-content p-6 space-y-6">
                    <!-- Add this at the top of modal content -->
                    <div class="scroll-guide">
                        <span>Silahkan scroll ke bawah</span>
                        <i class="bx bx-chevron-down text-xl"></i>
                    </div>

                    <h3 class="">Syarat dan Ketentuan MaxNet+</h3>
                    <p>Selamat datang di MaxNet+, penyedia layanan internet. Dengan menggunakan layanan kami, Anda
                        setuju untuk mematuhi Syarat dan Ketentuan berikut. Harap baca dengan saksama.</p>

                    <h3 class="">1. Definisi</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Layanan : Layanan internet yang disediakan oleh MaxNet+ termasuk akses internet, layanan
                            pelanggan, dan
                            fitur tambahan lainnya.</li>
                        <li>Pelanggal : Individu atau entitas yang menggunakan layanan MaxNet+.</li>
                        <li>Perangkat : Perangkat keras dan lunak yang digunakan untuk mengakses layanan MaxNet+</li>

                    </ul>

                    <h3 class="">2. Lingkup Layanan</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Layanan diberikan sesuai dengan paket yang dipilih oleh pelanggan.
                            fitur tambahan lainnya.</li>
                        <li>MaxNet+ berhak untuk memperbarui, memodifikasi, atau menghentikan sebagian atau seluruh
                            layanan
                            sesuai kebijakan perusahaan.</li>
                        <li>Ketersediaan layanan dapat dipengaruhi oleh faktor teknis, seperti lokasi geografis, kondisi
                            cuaca, atau pemeliharaan jaringan.</li>

                    </ul>

                    <h3 class="">3. Kewajiban Pelanggan</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Pelanggan wajib memberikan informasi yang akurat dan terkini saat pendaftaran.</li>
                        <li>Pelanggan bertanggung jawab atas penggunaan layanan, termasuk memastikan bahwa layanan
                            digunakan
                            sesuai dengan hukum yang berlaku.</li>
                        <li>Dilarang menggunakan layanan untuk aktivitas ilegal, seperti penyebaran konten berbahaya,
                            peretasan, atau pelanggaran hak cipta.</li>
                        <li>Dilarang menjual-belikan kembali bandwidth yang diperoleh dari MaxNet+ tanpa izin tertulis
                            dari
                            pihak MaxNet+.</li>
                    </ul>

                    <h3 class="">4. Biaya dan Pembayaran</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Pelanggan wajib membayar biaya berlangganan sesuai dengan paket yang dipilih.</li>
                        <li>Pembayaran harus dilakukan tepat waktu sesuai jadwal yang ditentukan atau sebelum jatuh
                            tempo.
                        </li>
                        <li>MaxNet+ berhak menangguhkan layanan jika pembayaran tidak dilakukan sesuai ketentuan.</li>
                    </ul>

                    <h3 class="">5. Batasan Tanggung Jawab</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>MaxNet+ tidak bertanggung jawab atas gangguan layanan yang disebabkan oleh faktor di luar
                            kendali, termasuk tetapi tidak terbatas pada bencana alam, gangguan jaringan global, atau
                            tindakan pihak ketiga.</li>
                        <li>MaxNet+ tidak bertanggung jawab atas kehilangan data atau kerusakan perangkat akibat
                            penggunaan
                            layanan.
                        </li>
                    </ul>

                    <h3 class="">6. Privasi dan Keamanan</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>MaxNet+ berkomitmen untuk menjaga kerahasiaan data pelanggan sesuai dengan kebijakan privasi
                            perusahaan.</li>
                        <li>Pelanggan bertanggung jawab untuk menjaga kerahasiaan kredensial akses mereka.
                        </li>
                    </ul>

                    <h3 class="">7. Pengakhiran Layanan</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Pelanggan dapat mengakhiri layanan kapan saja dengan pemberitahuan tertulis kepada MaxNet+.
                        </li>
                        <li>MaxNet+ berhak mengakhiri layanan jika pelanggan melanggar Syarat dan Ketentuan ini.</li>
                    </ul>

                    <h3 class="">8. Perubahan Syarat dan Ketentuan</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>MaxNet+ berhak untuk mengubah Syarat dan Ketentuan ini sewaktu-waktu.</li>
                        <li>Perubahan akan diinformasikan kepada pelanggan melalui email atau pemberitahuan di situs
                            resmi
                            MaxNet+.</li>
                    </ul>

                    <h3 class="">9. Hukum yang Berlaku</h3>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Syarat dan Ketentuan ini diatur oleh hukum yang berlaku di wilayah operasional MaxNet+.</li>
                        <li>Segala perselisihan akan diselesaikan melalui mediasi terlebih dahulu sebelum mengajukan ke
                            pengadilan.</li>
                    </ul>

                    <h3 class="">10. Kontak</h3>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Untuk pertanyaan lebih lanjut, Anda dapat menghubungi kami melalui:
                    </p>
                    <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Email: info@maxnetplus.id</li>
                        <li>Telepon: 0899-106-6262</li>
                        <li>Situs web: www.maxnetplus.id</li>
                    </ul>


                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Dengan ini saya menyetujui:
                    </p>
                    <ol class="list-decimal pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <li>Data yang saya berikan adalah benar dan dapat dipertanggung jawabkan</li>
                        <li>Setiap pelanggan wajib mengizinkan petugas untuk melakukan pemasangan di lokasi yang telah
                            ditentukan</li>
                        <li>Saya bersedia mengikuti semua prosedur pemasangan internet</li>
                        <li>Saya bersedia membayar biaya pemasangan dan berlangganan sesuai paket yang dipilih</li>
                        <li>Saya mengijinkan petugas untuk melakukan pemasangan di lokasi yang telah ditentukan</li>
                    </ol>
                </div>

                <!-- Read More Button -->
                <div id="readMoreButton" class="read-more-button">
                    <button
                        class="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 rounded-full bg-white shadow-md hover:shadow-lg transition-all">
                        Baca Selanjutnya ↓
                    </button>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end gap-3 p-4 border-t">
                    <form id="registrationForm"
                        action="{{ route('confirmation.store', ['register_id' => $register_id]) }}" method="GET">
                        @csrf
                        <button type="submit" disabled id="agreeButton"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Setuju
                        </button>
                    </form>
                    <button data-modal-hide="termsModal" type="button"
                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Tidak Setuju
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>



</html>
@stack('scripts')
<script src="{{ asset('js/flowbite.js') }}"></script>
<script>
    document.querySelector('[data-modal-hide="termsModal"]').addEventListener('click', () => {
        document.getElementById('termsModal').classList.add('hidden');
        document.querySelector('.modal-backdrop').classList.add('hidden');
    });

    document.querySelector('[data-modal-toggle="termsModal"]').addEventListener('click', () => {
        document.getElementById('termsModal').classList.remove('hidden');
        document.querySelector('.modal-backdrop').classList.remove('hidden');
    });

    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        document.querySelector('[data-modal-hide="termsModal"]').click();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('termsModal');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalContent = modal.querySelector('.scroll-content');
        const readMoreButton = document.getElementById('readMoreButton');
        const agreeButton = document.getElementById('agreeButton');
        let hasReachedBottom = false;

        // Toggle modal
        function toggleModal(show) {
            modal.classList.toggle('hidden', !show);
            modalBackdrop.style.display = show ? 'block' : 'none';
            if (show) {
                document.body.style.overflow = 'hidden';
                checkScroll();
            } else {
                document.body.style.overflow = '';
            }
        }

        // Check scroll position
        function checkScroll() {
            const scrollPosition = modalContent.scrollTop + modalContent.clientHeight;
            const isAtBottom = scrollPosition >= modalContent.scrollHeight - 50;

            readMoreButton.classList.toggle('visible', !isAtBottom);

            if (isAtBottom && !hasReachedBottom) {
                hasReachedBottom = true;
                agreeButton.disabled = false;
                agreeButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        // Event Listeners
        document.querySelectorAll('[data-modal-hide="termsModal"]').forEach(button => {
            button.addEventListener('click', () => toggleModal(false));
        });

        document.querySelectorAll('[data-modal-toggle="termsModal"]').forEach(button => {
            button.addEventListener('click', () => toggleModal(true));
        });

        modalContent.addEventListener('scroll', checkScroll);

        readMoreButton.addEventListener('click', () => {
            modalContent.scrollBy({
                top: modalContent.clientHeight / 2,
                behavior: 'smooth'
            });
        });

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                toggleModal(false);
            }
        });

        // Initialize
        agreeButton.disabled = true;
        agreeButton.classList.add('opacity-50', 'cursor-not-allowed');
    });
</script>
