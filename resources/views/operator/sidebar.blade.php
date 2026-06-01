@php
$sidebarOperator = \App\Models\Operator::where(
    'user_id',
    auth()->id()
)->first();

$path = request()->path();
@endphp

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="w-[270px] h-screen 
    bg-gradient-to-b from-[#0f4f5c] to-[#083944] 
    text-white flex flex-col justify-between px-5 py-6 
    shadow-2xl relative overflow-hidden">

    <!-- EFFECT -->
    <div class="absolute top-0 right-0 w-52 h-52 bg-[#839958]/20 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-52 h-52 bg-[#D3968C]/10 blur-3xl rounded-full"></div>

    <div class="relative z-10 flex flex-col h-full">

        <!-- LOGO -->
        <div class="flex flex-col items-center mb-10">
            <img src="/images/logoNara.png"
                class="h-20 object-contain transition duration-300
                hover:scale-110 hover:-translate-y-1
                hover:drop-shadow-[0_8px_25px_rgba(255,255,255,0.35)]">
        </div>

        <!-- MENU -->
        <ul class="space-y-2 text-sm">

            <!-- DASHBOARD (FIX UTAMA) -->
            <li>
                <a href="{{ url('/operator/dashboard') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator') || request()->is('operator/dashboard') 
                        ? 'bg-[#F7F4D5] text-[#105666] font-semibold' 
                        : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/kelola-akun') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/kelola-akun') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-users"></i>
                    Kelola Akun
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/kelola-siswa') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/kelola-siswa') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-user-graduate"></i>
                    Kelola Siswa
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/kelola-mapel') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/kelola-mapel') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-book-open"></i>
                    Kelola Mapel
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/kelola-nilai') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/kelola-nilai') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-file-lines"></i>
                    Kelola Nilai
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/kelola-minat-bakat') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/kelola-minat-bakat') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    Kelola Minat Bakat
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/kelola-kepribadian') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/kelola-kepribadian') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-brain"></i>
                    Kelola Kepribadian
                </a>
            </li>

            <li>
                <a href="{{ url('/operator/setting') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('operator/setting') ? 'bg-[#F7F4D5] text-[#105666]' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-gear"></i>
                    Setting
                </a>
            </li>

        </ul>

        <div class="flex-1"></div>

        <!-- PROFILE -->
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 flex items-center gap-3 mb-4">

            <div class="w-10 h-10 rounded-full 
                bg-[#F7F4D5] text-[#105666] 
                flex items-center justify-center font-bold uppercase shadow-inner">
                {{ substr($sidebarOperator->nama, 0, 1) }}
            </div>

            <div>
                <h3 class="text-sm font-semibold">
                    {{ $sidebarOperator->nama }}
                </h3>
                <p class="text-xs text-white/70">
                    {{ auth()->user()->username }}
                </p>
            </div>

        </div>

        <!-- LOGOUT -->
        <a href="/logout"
            class="flex items-center gap-3 px-4 py-3 rounded-xl 
            bg-[#D3968C] hover:bg-[#c07f77] text-white 
            transition-all duration-300 hover:shadow-md active:scale-[0.98]">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</div>