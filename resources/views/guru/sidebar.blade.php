<!DOCTYPE html>
<html>

<head>

    <title>Navbar Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-[#fdfafa]">

    <!-- NAVBAR -->
    <nav class="w-full border-b sticky top-0 z-50 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-[70px] lg:h-[80px] flex items-center justify-between">

            <!-- LEFT -->
            <div class="flex items-center gap-4 lg:gap-10">

                <!-- HAMBURGER -->
                <button id="menuBtn" class="lg:hidden text-[#105666] text-xl">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- LOGO -->
                <div class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-[#105666]/20 blur-xl rounded-xl 
                                    opacity-0 group-hover:opacity-100 transition"></div>

                        <img src="{{ asset('images/logoNara.png') }}"
                            class="relative z-10 w-12 h-12 lg:w-14 lg:h-14 object-contain 
                                   transition group-hover:scale-105">
                    </div>
                </div>

                <!-- MENU DESKTOP -->
                <ul class="hidden lg:flex items-center gap-2 text-sm font-medium">

                    <li>
                        <a href="/guru"
                            class="flex items-center gap-2 px-5 py-2 rounded-full transition
                            {{ request()->is('guru') ? 'bg-[#105666] text-white' : 'text-[#105666] hover:bg-[#f3f7f6]' }}">
                            <i class="fa-solid fa-house"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="/guru/kelola-nilai"
                            class="flex items-center gap-2 px-5 py-2 rounded-full transition
                            {{ request()->is('guru/kelola-nilai*') ? 'bg-[#105666] text-white' : 'text-[#105666] hover:bg-[#f3f7f6]' }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Kelola Nilai
                        </a>
                    </li>

                    <li>
                        <a href="/guru/raport"
                            class="flex items-center gap-2 px-5 py-2 rounded-full transition
                            {{ request()->is('guru/raport*') ? 'bg-[#105666] text-white' : 'text-[#105666] hover:bg-[#f3f7f6]' }}">
                            <i class="fa-solid fa-file-lines"></i>
                            Raport
                        </a>
                    </li>

                    <li>
                        <a href="/guru/setting"
                            class="flex items-center gap-2 px-5 py-2 rounded-full transition
                            {{ request()->is('guru/setting*') ? 'bg-[#105666] text-white' : 'text-[#105666] hover:bg-[#f3f7f6]' }}">
                            <i class="fa-solid fa-gear"></i>
                            Setting
                        </a>
                    </li>

                </ul>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                <!-- PROFILE -->
                <div class="flex items-center gap-2 px-3 py-2 rounded-full"
                    style="background-color: rgba(16, 86, 102, 0.1);">

                    <div class="w-8 h-8 rounded-full flex items-center justify-center bg-[#105666] text-white text-sm font-bold">
                        {{ strtoupper(substr(Auth::user()->guru->nama,0,1)) }}
                    </div>

                    <div class="hidden lg:block">
                        <p class="text-sm font-semibold text-[#105666]">
                            {{ Auth::user()->guru->nama }}
                        </p>
                    </div>

                    <a href="/logout" class="ml-2 text-red-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>

                </div>

            </div>

        </div>

    </nav>

    <!-- SIDEBAR MOBILE -->
    <div id="sidebar"
        class="fixed top-0 left-0 w-[260px] h-full bg-white shadow-xl transform -translate-x-full transition-transform duration-300 z-50 lg:hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between p-4 border-b">
            <h2 class="font-bold text-[#105666]">Menu</h2>
            <button id="closeBtn">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- MENU -->
        <div class="flex flex-col p-4 gap-2 text-sm font-medium">

            <a href="/guru"
                class="flex items-center gap-2 px-4 py-2 rounded-lg transition
                {{ request()->is('guru') ? 'bg-[#105666] text-white' : 'text-[#105666]' }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="/guru/kelola-nilai"
                class="flex items-center gap-2 px-4 py-2 rounded-lg transition
                {{ request()->is('guru/kelola-nilai*') ? 'bg-[#105666] text-white' : 'text-[#105666]' }}">
                <i class="fa-solid fa-pen-to-square"></i>
                Kelola Nilai
            </a>

            <a href="/guru/raport"
                class="flex items-center gap-2 px-4 py-2 rounded-lg transition
                {{ request()->is('guru/raport*') ? 'bg-[#105666] text-white' : 'text-[#105666]' }}">
                <i class="fa-solid fa-file-lines"></i>
                Raport
            </a>

            <a href="/guru/setting"
                class="flex items-center gap-2 px-4 py-2 rounded-lg transition
                {{ request()->is('guru/setting*') ? 'bg-[#105666] text-white' : 'text-[#105666]' }}">
                <i class="fa-solid fa-gear"></i>
                Setting
            </a>

        </div>

    </div>

    <!-- OVERLAY -->
    <div id="overlay"
        class="fixed inset-0 bg-black/40 hidden z-40 lg:hidden"></div>

    <!-- SCRIPT -->
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('closeBtn');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    </script>

</body>

</html>