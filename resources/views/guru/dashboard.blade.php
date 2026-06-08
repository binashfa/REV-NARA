<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

@include('guru.sidebar')

<main class="max-w-7xl mx-auto px-4 sm:px-6 pt-6 md:pt-10 pb-10">

<header class="mb-8 md:mb-12">
    <div class="w-full 
                bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]
                rounded-[24px] md:rounded-[32px] 
                p-6 md:p-12 
                flex items-center justify-between 
                shadow-sm relative overflow-hidden
                transition-all duration-300
                hover:shadow-xl hover:-translate-y-[2px]">

        <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

        <div class="absolute top-0 right-0 w-60 h-60 md:w-80 md:h-80 bg-[#105666]/10 rounded-full blur-3xl -mr-10 -mt-10 md:-mr-20 md:-mt-20"></div>
        <div class="absolute bottom-0 left-1/4 md:left-1/3 w-40 h-40 md:w-60 md:h-60 bg-[#839958]/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 space-y-3 md:space-y-4">

            <span class="inline-flex items-center gap-1.5 md:gap-2 
                        bg-white/30 text-[#105666] 
                        text-[10px] md:text-xs font-semibold 
                        px-3 py-1.5 rounded-full 
                        backdrop-blur-sm tracking-wider uppercase shadow-sm">

                <i class="fa-solid fa-user-tie text-[10px] md:text-xs text-[#839958] animate-pulse"></i>
                Dashboard

            </span>

            <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-[#105666] tracking-tight leading-tight">
                Dashboard Guru
            </h1>

            <p class="text-[#105666]/70 text-xs md:text-sm lg:text-base font-medium max-w-md leading-relaxed">
                Selamat datang kembali, {{ $guru->nama }}
            </p>

        </div>

        <div class="hidden md:flex relative z-10 items-center justify-center pr-4 lg:pr-6">
            <div class="w-20 h-20 lg:w-24 lg:h-24 
                        bg-white/40 backdrop-blur-md 
                        rounded-2xl lg:rounded-3xl 
                        shadow-inner flex items-center justify-center 
                        border 
                        transform rotate-6 hover:rotate-0 
                        transition duration-300">

                <i class="fa-solid fa-user-tie text-[#105666] text-3xl lg:text-4xl"></i>

            </div>
        </div>

    </div>
</header>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-8 md:mb-10">

        <div class="group relative bg-white rounded-[24px] md:rounded-3xl overflow-hidden flex items-center h-28 md:h-32
                    transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-1
                    shadow-sm hover:shadow-[0_12px_30px_rgba(131,153,88,0.15),0_4px_12px_rgba(131,153,88,0.05)] border">

            <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
                <p class="text-xs md:text-sm text-gray-400">Total Siswa</p>
                <h2 class="text-2xl md:text-3xl font-black text-[#105666]">
                    {{ $jumlahSiswa }}
                </h2>
            </div>

            <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-4 md:translate-x-6 bg-[#839958] rounded-l-[40px] md:rounded-l-[60px]
                        transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]
                        group-hover:translate-x-3 group-hover:brightness-110"></div>

            <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 h-14 bg-white/10 backdrop-blur-sm
                        rounded-full flex items-center justify-center
                        transition-all duration-300 ease-out
                        group-hover:scale-110 group-hover:-translate-x-0.5 border border-white/20">
                <i class="fa-solid fa-users text-white text-lg md:text-xl"></i>
            </div>

        </div>

    <div class="group relative bg-white rounded-[24px] md:rounded-3xl overflow-hidden flex items-center h-28 md:h-32
                transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-1
                shadow-sm hover:shadow-[0_12px_30px_rgba(211,150,140,0.20),0_4px_12px_rgba(211,150,140,0.10)] border">

        <div class="p-5 md:p-6 pr-20 md:pr-24 w-full z-10">
            <p class="text-xs md:text-sm text-gray-400">Total Nilai</p>
            <h2 class="text-2xl md:text-3xl font-black text-[#105666]">
                {{ $jumlahNilai }}
            </h2>
        </div>

        <div class="absolute right-0 top-0 h-full w-24 md:w-32 translate-x-4 md:translate-x-6 bg-[#D3968C] rounded-l-[40px] md:rounded-l-[60px]
                    transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]
                    group-hover:translate-x-3 group-hover:brightness-110"></div>

        <div class="absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-12 h-12 md:w-14 h-14 bg-white/10 backdrop-blur-sm
                    rounded-full flex items-center justify-center
                    transition-all duration-300 ease-out
                    group-hover:scale-110 group-hover:-translate-x-0.5 border border-white/20">
            <i class="fa-solid fa-chart-column text-white text-lg md:text-xl"></i>
        </div>

    </div>

</div>

<div class="bg-white rounded-[24px] md:rounded-[32px] border shadow-sm relative overflow-hidden
            transition-all duration-300 hover:shadow-lg">

    <div class="bg-gradient-to-r from-[#105666] to-[#839958]
                px-5 md:px-8 py-5 md:py-6">

        <div class="flex justify-between items-center">

            <h2 class="text-lg md:text-2xl font-black text-white flex items-center gap-2 md:gap-3">
                <span class="w-9 h-9 md:w-11 md:h-11 rounded-lg md:rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-file-signature text-white text-sm md:text-base"></i>
                </span>
                Nilai Terbaru
            </h2>

            <a href="/guru/kelola-nilai"
               class="text-xs md:text-sm font-semibold text-white/80 hover:text-white transition flex items-center gap-1 whitespace-nowrap">
                Lihat Semua →
            </a>

        </div>

    </div>

    <div class="p-4 md:p-8">

        <div class="overflow-x-auto">
            <table class="w-full text-sm whitespace-nowrap md:whitespace-normal">

                <thead>
                    <tr class="text-left text-gray-400 border-b border-gray-100 uppercase text-[10px] md:text-xs tracking-widest">
                        <th class="py-3 pr-4 md:pr-0 font-bold">Nama Siswa</th>
                        <th class="py-3 px-4 md:px-0 font-bold">Mapel</th>
                        <th class="py-3 pl-4 md:pl-0 font-bold text-center">Nilai</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">

                    @foreach($nilaiTerbaru as $nilai)
                    <tr class="border-b border-gray-50 transition-all duration-300
                               hover:bg-gradient-to-r hover:from-[#F7F4D5]/40 hover:to-transparent group">

                        <td class="py-3 md:py-4 pr-4 md:pr-0">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="w-7 h-7 md:w-8 md:h-8 rounded-lg bg-[#e9f0d0] text-[#839958] flex items-center justify-center
                                            transition-transform duration-300 group-hover:scale-105 min-w-[28px]">
                                    <i class="fa-solid fa-user text-[10px] md:text-xs"></i>
                                </div>
                                <p class="font-bold text-gray-800 text-xs md:text-sm">
                                    {{ $nilai->siswa->nama }}
                                </p>
                            </div>
                        </td>

                        <td class="py-3 md:py-4 px-4 md:px-0 text-gray-500 font-medium text-xs md:text-sm">
                            {{ $nilai->mapel->nama_mapel }}
                        </td>

                        <td class="py-3 md:py-4 pl-4 md:pl-0 text-center">
                            <span class="inline-block px-3 py-1 md:px-4 md:py-1.5 rounded-full text-[10px] md:text-xs font-bold
                                         bg-[#eef6f6] text-[#105666]
                                         shadow-sm transition-all duration-300
                                         group-hover:scale-105 group-hover:shadow-md">
                                {{ round((($nilai->uts ?? 0) + ($nilai->uas ?? 0) + ($nilai->uam ?? 0)) / 3, 2) }}
                            </span>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

</div>

</main>

</body>
</html>