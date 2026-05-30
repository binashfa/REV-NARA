<!DOCTYPE html>
<html>

<head>

    <title>Dashboard Operator</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    @include('operator.sidebar')

    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Dashboard Operator
            </h1>

            <p class="text-slate-500 mt-2">
                Sistem Akademik Sekolah
            </p>

        </div>

        <!-- WELCOME -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-3xl p-8 text-white shadow-lg mb-8">

            <h2 class="text-3xl font-bold mb-2">
                Selamat Datang Operator 👋
            </h2>

            <p class="text-indigo-100 text-lg">
                Kelola data akademik sekolah dengan mudah dan cepat
            </p>

        </div>

        <!-- CARD GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- SISWA -->
            <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center mb-5">

                    <div>

                        <p class="text-slate-500">
                            Total Siswa
                        </p>

                        <h1 class="text-4xl font-bold text-slate-800 mt-2">
                            {{ $totalSiswa }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-6 0v5m6 0H8"/>
                        </svg>

                    </div>

                </div>

            </div>

            <!-- GURU -->
            <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center mb-5">

                    <div>

                        <p class="text-slate-500">
                            Total Guru
                        </p>

                        <h1 class="text-4xl font-bold text-slate-800 mt-2">
                            {{ $totalGuru }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0120 17.944M12 14L5.84 10.578A12.083 12.083 0 004 17.944"/>
                        </svg>

                    </div>

                </div>

            </div>

            <!-- MAPEL -->
            <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center mb-5">

                    <div>

                        <p class="text-slate-500">
                            Mata Pelajaran
                        </p>

                        <h1 class="text-4xl font-bold text-slate-800 mt-2">
                            {{ $totalMapel }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5S4.168 5.483 3 6.253v13C4.168 18.483 5.754 18 7.5 18s3.332.483 4.5 1.253"/>
                        </svg>

                    </div>

                </div>

            </div>

            <!-- NILAI -->
            <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center mb-5">

                    <div>

                        <p class="text-slate-500">
                            Data Nilai
                        </p>

                        <h1 class="text-4xl font-bold text-slate-800 mt-2">
                            {{ $totalNilai }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6V7m4 10V4"/>
                        </svg>

                    </div>

                </div>

            </div>

            <!-- MINAT -->
            <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center mb-5">

                    <div>

                        <p class="text-slate-500">
                            Data Minat Bakat
                        </p>

                        <h1 class="text-4xl font-bold text-slate-800 mt-2">
                            {{ $totalMinat }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>

                    </div>

                </div>

            </div>

            <!-- KEPRIBADIAN -->
            <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center mb-5">

                    <div>

                        <p class="text-slate-500">
                            Data Kepribadian
                        </p>

                        <h1 class="text-4xl font-bold text-slate-800 mt-2">
                            {{ $totalKepribadian }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>