<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

    <!-- SIDEBAR -->
    <div class="fixed top-0 left-0 z-50">
        @include('operator.sidebar')
    </div>

    <!-- MAIN CONTENT -->
    <!-- PERBAIKAN: Mengubah pt-20 menjadi pt-6 agar tidak ada ruang kosong berlebih di atas (mobile) -->
    <main class="ml-0 lg:ml-[270px] min-h-screen px-4 md:px-6 pt-6 lg:pt-10 pb-10 transition-all duration-300">

        <!-- HERO -->
        <div class="mb-8 md:mb-10">
            <div class="relative overflow-hidden rounded-[24px] md:rounded-[32px] p-6 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between
                        shadow-sm hover:shadow-lg transition-all duration-300
                        bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0] gap-6">

                <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <!-- GLOW EFFECTS -->
                <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

                <div class="relative z-10 space-y-3">
                    <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-[10px] md:text-xs font-bold border backdrop-blur-sm shadow-sm uppercase tracking-wider">
                        <i class="fa-solid fa-user-gear text-[#839958]"></i>
                        Operator Aktif
                    </span>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666] leading-tight">
                        Dashboard Operator
                    </h1>

                    <p class="text-[#105666]/70 text-sm md:text-base font-medium">
                        Kelola data akademik sekolah dengan mudah dan cepat 🚀
                    </p>
                </div>

                <!-- ICON BOX -->
                <div class="hidden md:block relative z-10">
                    <div class="w-24 h-24 bg-white/40 backdrop-blur-md rounded-3xl shadow-inner flex items-center justify-center border transform rotate-6 hover:rotate-0 transition duration-300">
                        <i class="fa-solid fa-database text-[#105666] text-4xl"></i>
                    </div>
                </div>

            </div>
        </div>

        <!-- CARDS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">

            <!-- SISWA -->
            <div class="group relative bg-white rounded-[24px] md:rounded-[28px] overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-in-out
                hover:-translate-y-1 hover:shadow-lg
                shadow-sm border border-gray-100">

                <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                    <p class="text-xs md:text-sm text-gray-400 mb-1">Total Siswa</p>
                    <h2 class="text-2xl md:text-3xl font-black text-[#105666]">{{ $totalSiswa }}</h2>
                </div>

                <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-6 md:translate-x-8 bg-[#105666]/80
                    rounded-l-[40px] md:rounded-l-[60px] transition-all duration-300 ease-in-out
                    group-hover:translate-x-4 md:group-hover:translate-x-6 group-hover:brightness-105"></div>

                <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-in-out
                    group-hover:scale-105 border border-white/20">
                    <i class="fa-solid fa-users text-white text-lg md:text-xl"></i>
                </div>
            </div>

            <!-- GURU -->
            <div class="group relative bg-white rounded-[24px] md:rounded-[28px] overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-in-out
                hover:-translate-y-1 hover:shadow-lg
                shadow-sm border border-gray-100">

                <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                    <p class="text-xs md:text-sm text-gray-400">Total Guru</p>
                    <h2 class="text-2xl md:text-3xl font-black text-[#105666]">{{ $totalGuru }}</h2>
                </div>

                <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-6 md:translate-x-8 bg-[#839958]/80
                    rounded-l-[40px] md:rounded-l-[60px] transition-all duration-300 ease-in-out
                    group-hover:translate-x-4 md:group-hover:translate-x-6 group-hover:brightness-105"></div>

                <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-in-out
                    group-hover:scale-105 border border-white/20">
                    <i class="fa-solid fa-chalkboard-user text-white text-lg md:text-xl"></i>
                </div>
            </div>

            <!-- MAPEL -->
            <div class="group relative bg-white rounded-[24px] md:rounded-[28px] overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-in-out
                hover:-translate-y-1 hover:shadow-lg
                shadow-sm border border-gray-100">

                <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                    <p class="text-xs md:text-sm text-gray-400">Mata Pelajaran</p>
                    <h2 class="text-2xl md:text-3xl font-black text-[#105666]">{{ $totalMapel }}</h2>
                </div>

                <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-6 md:translate-x-8 bg-[#D3968C]/80
                    rounded-l-[40px] md:rounded-l-[60px] transition-all duration-300 ease-in-out
                    group-hover:translate-x-4 md:group-hover:translate-x-6 group-hover:brightness-105"></div>

                <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-in-out
                    group-hover:scale-105 border border-white/20">
                    <i class="fa-solid fa-book text-white text-lg md:text-xl"></i>
                </div>
            </div>

            <!-- NILAI -->
            <div class="group relative bg-white rounded-[24px] md:rounded-[28px] overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-in-out
                hover:-translate-y-1 hover:shadow-lg
                shadow-sm border border-gray-100">

                <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                    <p class="text-xs md:text-sm text-gray-400">Data Nilai</p>
                    <h2 class="text-2xl md:text-3xl font-black text-[#105666]">{{ $totalNilai }}</h2>
                </div>

                <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-6 md:translate-x-8 bg-[#105666]/80
                    rounded-l-[40px] md:rounded-l-[60px] transition-all duration-300 ease-in-out
                    group-hover:translate-x-4 md:group-hover:translate-x-6 group-hover:brightness-105"></div>

                <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-in-out
                    group-hover:scale-105 border border-white/20">
                    <i class="fa-solid fa-chart-line text-white text-lg md:text-xl"></i>
                </div>
            </div>

            <!-- MINAT -->
            <div class="group relative bg-white rounded-[24px] md:rounded-[28px] overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-in-out
                hover:-translate-y-1 hover:shadow-lg
                shadow-sm border border-gray-100">

                <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                    <p class="text-xs md:text-sm text-gray-400">Minat Bakat</p>
                    <h2 class="text-2xl md:text-3xl font-black text-[#105666]">{{ $totalMinat }}</h2>
                </div>

                <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-6 md:translate-x-8 bg-[#839958]/80
                    rounded-l-[40px] md:rounded-l-[60px] transition-all duration-300 ease-in-out
                    group-hover:translate-x-4 md:group-hover:translate-x-6 group-hover:brightness-105"></div>

                <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-in-out
                    group-hover:scale-105 border border-white/20">
                    <i class="fa-solid fa-star text-white text-lg md:text-xl"></i>
                </div>
            </div>

            <!-- KEPRIBADIAN -->
            <div class="group relative bg-white rounded-[24px] md:rounded-[28px] overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-in-out
                hover:-translate-y-1 hover:shadow-lg
                shadow-sm border border-gray-100">

                <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                    <p class="text-xs md:text-sm text-gray-400">Kepribadian</p>
                    <h2 class="text-2xl md:text-3xl font-black text-[#105666]">{{ $totalKepribadian }}</h2>
                </div>

                <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-6 md:translate-x-8 bg-[#D3968C]/80
                    rounded-l-[40px] md:rounded-l-[60px] transition-all duration-300 ease-in-out
                    group-hover:translate-x-4 md:group-hover:translate-x-6 group-hover:brightness-105"></div>

                <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-in-out
                    group-hover:scale-105 border border-white/20">
                    <i class="fa-solid fa-user text-white text-lg md:text-xl"></i>
                </div>
            </div>

        </div>
    </main>

</body>

</html>