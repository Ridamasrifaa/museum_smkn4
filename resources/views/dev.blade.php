@extends('layouts.app')

@section('title', 'Tim Pengembang — Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-[#FFFDF5] dark:bg-zinc-950 text-slate-900 dark:text-zinc-100 transition-colors duration-300 antialiased min-h-screen flex flex-col justify-between')

@push('styles')
    <style>
        /* Background kotak-kotak ala Neo-Brutalism */
        .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.06) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.06) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /* Styling kartu tim */
        #team-grid > * {
            background: #ffffff;
            color: #000000;
            border: 3px solid #000000;
            border-radius: 1rem;
            box-shadow: 5px 5px 0px 0px #000000;
            transition: all 0.1s ease;
        }
        #team-grid > *:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px 0px #000000;
        }
        .dark #team-grid > * {
            background: #18181b;
            color: #f4f4f5;
            border-color: #ffffff;
            box-shadow: 5px 5px 0px 0px #ffffff;
        }
        .dark #team-grid > *:hover {
            box-shadow: 7px 7px 0px 0px #ffffff;
        }

        .neop-btn-box {
            border: 2px solid #000;
            box-shadow: 2px 2px 0px 0px #000;
            transition: all 0.1s ease;
        }
        .neop-btn-box:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }
        .dark .neop-btn-box {
            border: 2px solid #fff;
            box-shadow: 2px 2px 0px 0px #fff;
        }
        .dark .neop-btn-box:active {
            box-shadow: 0px 0px 0px 0px #fff;
        }
    </style>
@endpush

@section('content')
    <div class="flex-grow bg-grid-pattern">
        <!-- ===== MAIN CONTENT CONTAINER ===== -->
        <main class="py-12 sm:py-16">
            <!-- ===== TIM KAMI ===== -->
            <section id="tim-kami" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center max-w-2xl mx-auto">
                    <span class="inline-block px-4 py-1.5 mb-3 text-xs font-black uppercase tracking-wider text-black bg-cyan-300 rounded-full border-2 border-black shadow-[2px_2px_0px_#000]"> Developer Profile </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white mb-3 tracking-tight uppercase">Tim Pengembang</h2>
                    <p class="text-slate-700 dark:text-gray-300 text-xs sm:text-base font-medium">Siswa di balik perancangan dan pembangunan platform Museum Karya. <br> (Klik foto untuk memperbesar)</p>
                </div>

                <!-- Kontainer grid yang akan dirender secara dinamis lewat JS -->
                <div id="team-grid"></div>
            </section>
        </main>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-gray-900 dark:bg-black text-white text-center py-12 mt-16 border-t-4 border-black dark:border-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="pt-4">
                <p class="text-gray-300 font-bold text-sm">&copy; {{ date('Y') }} Museum Karya SMKN 4 Tasikmalaya</p>
                <p class="text-gray-400 text-xs mt-1">
                    Design &amp; Development By 
                    <a href="{{ route('dev') }}" class="text-blue-500 dark:text-blue-400 font-bold underline decoration-2 underline-offset-4 hover:text-blue-600 transition-colors">
                        Team Developer PPLG
                    </a>
                </p>
            </div>
        </div>
    </footer>

    <!-- ===== MODAL PREVIEW FOTO PROFIL (AVATAR) ===== -->
    <div id="avatarModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div id="modalContent" class="relative max-w-md w-full mx-4 bg-white dark:bg-zinc-900 rounded-3xl p-8 border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transform scale-95 transition-all duration-300 text-center">
            <button onclick="closeAvatarModal()" aria-label="Tutup" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center bg-[#FF6B6B] text-black font-black border-3 border-black rounded-xl shadow-[3px_3px_0px_#000] hover:bg-white cursor-pointer">
                ✕
            </button>
            
            <div class="w-64 h-64 sm:w-72 sm:h-72 mx-auto mb-6 mt-4 rounded-full overflow-hidden bg-[#FFD23F] border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] relative select-none">
                <img id="modalImage" src="" alt="" class="w-full h-full object-cover object-center" />
            </div>

            <h4 id="modalName" class="text-xl font-black uppercase text-black dark:text-white"></h4>
            <span class="inline-block mt-2 px-3 py-1 text-[11px] font-black uppercase tracking-wider text-black bg-[#74B9FF] border-2 border-black rounded-lg shadow-[2px_2px_0px_#000]">Foto Profil</span>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Memanggil file JavaScript Eksternal -->
    <script src="{{ asset('assets/js/dev.js') }}"></script>
@endpush