<!DOCTYPE html>
<html>

<head>

    <title>Navbar Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between shadow-sm">

        <!-- LEFT -->
        <div class="flex items-center gap-10">

            <!-- LOGO -->
            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-bold">
                    S
                </div>

                <div>

                    <h1 class="text-lg font-bold text-slate-800">
                        SIGURU
                    </h1>

                    <p class="text-xs text-slate-400">
                        Sistem Guru
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <ul class="flex items-center gap-3">

                <li>
                    <a
                        href="/guru"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 font-medium hover:bg-emerald-100 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 11V9m0 0L5 14m7-5l7 5" />
                        </svg>

                        Dashboard

                    </a>
                </li>

                <li>
                    <a
                        href="/guru/kelola-nilai"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Kelola Nilai

                    </a>
                </li>

                <li>
                    <a
                        href="/guru/raport"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Raport

                    </a>
                </li>

                <li>
                    <a
                        href="/guru/setting"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-1.14 1.603-1.14 1.902 0l.7 2.662a1 1 0 00.95.69h2.8c1.2 0 1.698 1.54.73 2.31l-2.267 1.8a1 1 0 00-.364 1.118l.87 2.632c.35 1.06-.85 1.94-1.76 1.28l-2.37-1.72a1 1 0 00-1.176 0l-2.37 1.72c-.91.66-2.11-.22-1.76-1.28l.87-2.632a1 1 0 00-.364-1.118l-2.267-1.8c-.968-.77-.47-2.31.73-2.31h2.8a1 1 0 00.95-.69l.7-2.662z" />
                        </svg>

                        Setting

                    </a>
                </li>

            </ul>

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-4">

            <!-- PROFILE -->
            <div class="flex items-center gap-3 border border-slate-200 rounded-2xl px-4 py-2 bg-white">

                <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->guru->nama,0,1)) }}
                </div>

                <div>

                    <h3 class="text-sm font-semibold text-slate-700">
                        {{ Auth::user()->guru->nama }}
                    </h3>

                    <p class="text-xs text-slate-400">
                        Guru
                    </p>

                </div>

            </div>

            <!-- LOGOUT -->
            <a
                href="/logout"
                class="flex items-center gap-2 px-4 py-2 rounded-xl text-red-500 hover:bg-red-50 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V7m0 0V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2v-1" />
                </svg>

                Logout

            </a>

        </div>

    </nav>

</body>

</html>