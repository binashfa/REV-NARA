@php

$sidebarOperator = \App\Models\Operator::where(
    'user_id',
    auth()->id()
)->first();

@endphp

<div class="w-[270px] h-screen bg-white border-r border-slate-200 flex flex-col justify-between px-5 py-6 shadow-sm">

    <!-- TOP -->
    <div>

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-10">

            <div class="w-11 h-11 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-bold text-lg">
                O
            </div>

            <div>

                <h1 class="text-lg font-bold text-slate-800">
                    SIOPERATOR
                </h1>

                <p class="text-xs text-slate-400">
                    Sistem Akademik
                </p>

            </div>

        </div>

        <!-- MENU -->
        <ul class="space-y-2">

            <li>
                <a
                    href="/operator"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-indigo-50 text-indigo-600 font-medium hover:bg-indigo-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 11V9m0 0L5 14m7-5l7 5" />
                    </svg>

                    Dashboard

                </a>
            </li>

            <li>
                <a
                    href="/operator/kelola-akun"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.364 4.56a9 9 0 01-13.243 13.243z" />
                    </svg>

                    Kelola Akun

                </a>
            </li>

            <li>
                <a
                    href="/operator/kelola-siswa"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-3-3H10a3 3 0 00-3 3v4m10 0H7" />
                    </svg>

                    Kelola Siswa

                </a>
            </li>

            <li>
                <a
                    href="/operator/kelola-mapel"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5S4.168 5.483 3 6.253v13C4.168 18.483 5.754 18 7.5 18s3.332.483 4.5 1.253m0-13C13.168 5.483 14.754 5 16.5 5s3.332.483 4.5 1.253v13C19.832 18.483 18.246 18 16.5 18s-3.332.483-4.5 1.253" />
                    </svg>

                    Kelola Mapel

                </a>
            </li>

            <li>
                <a
                    href="/operator/kelola-nilai"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>

                    Kelola Nilai

                </a>
            </li>

            <li>
                <a
                    href="/operator/kelola-minat-bakat"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6V7m4 10V4" />
                    </svg>

                    Kelola Minat Bakat

                </a>
            </li>

            <li>
                <a
                    href="/operator/kelola-kepribadian"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m8 0A9 9 0 1112 3a9 9 0 019 9z" />
                    </svg>

                    Kelola Kepribadian

                </a>
            </li>

            <li>
                <a
                    href="/operator/setting"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-1.14 1.603-1.14 1.902 0l.7 2.662a1 1 0 00.95.69h2.8c1.2 0 1.698 1.54.73 2.31l-2.267 1.8a1 1 0 00-.364 1.118l.87 2.632c.35 1.06-.85 1.94-1.76 1.28l-2.37-1.72a1 1 0 00-1.176 0l-2.37 1.72c-.91.66-2.11-.22-1.76-1.28l.87-2.632a1 1 0 00-.364-1.118l-2.267-1.8c-.968-.77-.47-2.31.73-2.31h2.8a1 1 0 00.95-.69l.7-2.662z" />
                    </svg>

                    Setting

                </a>
            </li>

        </ul>

    </div>

    <!-- BOTTOM -->
    <div>

        <a
            href="/logout"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition mb-5">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>

            Logout

        </a>

        <!-- PROFILE -->
        <div class="border border-slate-200 rounded-2xl p-3 flex items-center gap-3">

            <div class="w-11 h-11 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold uppercase">
                {{ substr($sidebarOperator->nama, 0, 1) }}
            </div>

            <h3 class="text-sm font-semibold text-slate-700">
                {{ $sidebarOperator->nama }}
            </h3>

            <p class="text-xs text-slate-400">
                {{ auth()->user()->username }}
            </p>

        </div>

    </div>

</div>