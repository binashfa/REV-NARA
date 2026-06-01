<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen">

@include('guru.sidebar')

<main class="max-w-7xl mx-auto px-4 md:px-6 pt-4 md:pt-8 pb-16">

    <header class="mb-6 md:mb-12">
        <div class="w-full bg-gradient-to-br from-[#105666] to-[#0d4b59] 
                    rounded-[24px] md:rounded-[32px] 
                    p-6 md:p-12 
                    flex items-center justify-between 
                    shadow-xl relative overflow-hidden">

            <div class="absolute top-0 right-0 w-60 h-60 md:w-80 md:h-80 bg-[#839958]/20 rounded-full blur-3xl -mr-10 -mt-10 md:-mr-20 md:-mt-20"></div>
            <div class="absolute bottom-0 left-1/4 md:left-1/3 w-40 h-40 md:w-60 md:h-60 bg-[#D3968C]/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 space-y-3 md:space-y-4">

                <span class="inline-flex items-center gap-1.5 md:gap-2 
                            bg-white/10 text-[#F7F4D5] 
                            text-[10px] md:text-xs font-semibold 
                            px-3 py-1.5 rounded-full 
                            backdrop-blur-sm tracking-wider uppercase shadow-sm">
                    <i class="fa-solid fa-chart-line text-[10px] md:text-xs text-[#839958] animate-pulse"></i>
                    Raport Siswa
                </span>

                <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    Raport Siswa
                </h1>

                <p class="text-gray-200 text-xs md:text-sm lg:text-base font-medium max-w-md leading-relaxed">
                    Lihat raport siswa, analisis nilai, dan rekomendasi jurusan secara lengkap.
                </p>

            </div>

            <div class="hidden md:flex relative z-10 items-center justify-center pr-4 lg:pr-6">
                <div class="w-20 h-20 lg:w-24 lg:h-24 
                            bg-white/10 backdrop-blur-md 
                            rounded-2xl lg:rounded-3xl 
                            shadow-inner flex items-center justify-center 
                            border border-white/20 
                            transform rotate-6 hover:rotate-0 
                            transition duration-300">
                    <i class="fa-solid fa-file-lines text-[#F7F4D5] text-3xl lg:text-4xl"></i>
                </div>
            </div>

        </div>
    </header>

    <section class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm border p-4 sm:p-6 md:p-8 min-h-[500px] flex flex-col">

        <div class="mb-6 md:mb-8">
            <form method="GET">

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Pilih Siswa
                </label>

                <select
                    name="siswa_id"
                    onchange="this.form.submit()"
                    class="w-full md:w-72 border border-gray-200 rounded-xl px-4 py-3 outline-none text-sm md:text-base
                           focus:ring-2 focus:ring-[#105666]/30">

                    <option value="">Pilih Nama Siswa</option>

                    @foreach($siswas as $item)
                    <option value="{{ $item->id }}" {{ $siswaId == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                    @endforeach

                </select>

            </form>
        </div>

        @if($siswa)

            <div class="mb-8 md:mb-10 rounded-2xl p-5 md:p-6 shadow-md
                        bg-gradient-to-r from-[#eaf3f2] via-[#dbeceb] to-[#f7faf9]
                        border border-[#d6e4e3]
                        flex flex-col md:flex-row md:justify-between md:items-center gap-4 md:gap-6
                        relative overflow-hidden">

                <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#105666]/15 blur-3xl rounded-full"></div>

                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-[#D3968C]/10 blur-3xl rounded-full"></div>

                <div class="relative z-10">
                    <h2 class="text-xl md:text-2xl font-bold text-[#105666]">
                        {{ $siswa->nama }}
                    </h2>

                    <div class="mt-2 text-xs md:text-sm text-gray-600 space-y-1">
                        <p>NISN : {{ $siswa->nisn }}</p>
                        <p>Jenis Kelamin : {{ $siswa->jenis_kelamin }}</p>
                    </div>
                </div>

                <div class="relative z-10 w-full md:w-auto mt-2 md:mt-0">
                    <a href="/guru/raport-pdf/{{ $siswa->id }}"
                        class="inline-flex justify-center items-center gap-2 px-5 py-3 rounded-xl 
                            bg-[#D3968C] text-white font-semibold text-sm md:text-base w-full md:w-auto
                            hover:bg-[#c07f75] transition shadow-md hover:shadow-lg">

                        <i class="fa-solid fa-file-arrow-down"></i>
                        Export PDF
                    </a>
                </div>

            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-100 pb-2">

                <table class="w-full text-sm whitespace-nowrap md:whitespace-normal">

                    <thead>
                        <tr class="bg-[#105666] text-white text-xs md:text-sm">
                            <th class="py-3 md:py-4 px-3 md:px-4 text-center">No</th>
                            <th class="py-3 md:py-4 px-3 md:px-4 text-left">Mata Pelajaran</th>
                            <th class="py-3 md:py-4 px-3 md:px-4 text-center">UTS</th>
                            <th class="py-3 md:py-4 px-3 md:px-4 text-center">UAS</th>
                            <th class="py-3 md:py-4 px-3 md:px-4 text-center">UAM</th>
                            <th class="py-3 md:py-4 px-3 md:px-4 text-center">Rata-rata</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white text-gray-700">

                        @php
                        $totalRata = 0;
                        $jumlahMapel = count($siswa->nilais);
                        @endphp

                        @forelse($siswa->nilais as $nilai)

                        @php
                        $rata = (($nilai->uts ?? 0)+($nilai->uas ?? 0)+($nilai->uam ?? 0))/3;
                        $totalRata += $rata;
                        @endphp

                        <tr class="border-b hover:bg-[#F7F4D5]/40 text-xs md:text-sm">

                            <td class="py-3 md:py-4 px-3 md:px-4 text-center">{{ $loop->iteration }}</td>

                            <td class="py-3 md:py-4 px-3 md:px-4 font-semibold">
                                {{ $nilai->mapel->nama_mapel }}
                            </td>

                            <td class="py-3 md:py-4 px-3 md:px-4 text-center">{{ $nilai->uts }}</td>
                            <td class="py-3 md:py-4 px-3 md:px-4 text-center">{{ $nilai->uas }}</td>
                            <td class="py-3 md:py-4 px-3 md:px-4 text-center">{{ $nilai->uam }}</td>

                            <td class="py-3 md:py-4 px-3 md:px-4 text-center font-bold text-[#105666]">
                                {{ number_format($rata,1) }}
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 md:py-8 text-gray-400 text-xs md:text-sm">
                                Belum ada nilai
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-8 md:mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">

                <div class="group relative overflow-hidden rounded-2xl shadow-md
                            hover:shadow-xl hover:-translate-y-1 transition duration-300
                            bg-gradient-to-br from-[#e8f3f2] via-[#d9eceb] to-[#f8fcfc]
                            border border-[#cfe3e1]">

                    <div class="absolute top-0 left-0 w-full">
                        <svg viewBox="0 0 500 20" preserveAspectRatio="none" class="w-full h-[12px]">
                            <defs>
                                <linearGradient id="topGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#105666"/>
                                    <stop offset="50%" stop-color="#839958"/>
                                    <stop offset="100%" stop-color="#D3968C"/>
                                </linearGradient>
                            </defs>
                            <path d="M0,12 C200,-2 300,-2 500,12 L500,0 L0,0 Z" fill="url(#topGrad1)"></path>
                        </svg>
                    </div>

                    <div class="absolute top-0 left-0 w-full">
                        <svg viewBox="0 0 500 80" preserveAspectRatio="none" class="w-full h-[50px]">
                            <path d="M0,50 C200,100 300,0 500,60 L500,0 L0,0 Z" fill="#105666"></path>
                        </svg>
                    </div>

                    <div class="relative z-10 pt-16 md:pt-20 p-5 md:p-6">
                        <h3 class="inline-block text-[10px] md:text-xs font-semibold 
                                text-[#105666] bg-[#105666]/10 
                                px-3 py-1 rounded-full mb-2 md:mb-3">
                            Akademik
                        </h3>

                        <div class="text-3xl md:text-4xl font-bold text-[#105666]">
                            {{ number_format($totalRata / max($jumlahMapel,1),1) }}
                        </div>

                        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
                            Rata-rata nilai raport
                        </p>
                    </div>

                </div>

                <div class="group relative overflow-hidden rounded-2xl shadow-md
                            hover:shadow-xl hover:-translate-y-1 transition duration-300
                            bg-gradient-to-br from-[#f0f6ea] via-[#e6f1db] to-[#fbfdf7]
                            border border-[#dbe8c8]">

                    <div class="absolute top-0 left-0 w-full">
                        <svg viewBox="0 0 500 20" preserveAspectRatio="none" class="w-full h-[12px]">
                            <defs>
                                <linearGradient id="topGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#105666"/>
                                    <stop offset="50%" stop-color="#839958"/>
                                    <stop offset="100%" stop-color="#D3968C"/>
                                </linearGradient>
                            </defs>
                            <path d="M0,12 C200,-2 300,-2 500,12 L500,0 L0,0 Z" fill="url(#topGrad2)"></path>
                        </svg>
                    </div>

                    <div class="absolute top-0 left-0 w-full">
                        <svg viewBox="0 0 500 80" preserveAspectRatio="none" class="w-full h-[65px]">
                            <path d="M0,50 C200,100 300,0 500,60 L500,0 L0,0 Z" fill="#839958"></path>
                        </svg>
                    </div>

                    <div class="relative z-10 pt-16 md:pt-20 p-5 md:p-6">
                        <h3 class="inline-block text-[10px] md:text-xs font-semibold 
                                text-[#839958] bg-[#839958]/10 
                                px-3 py-1 rounded-full mb-2 md:mb-3">
                            Minat Dominan
                        </h3>

                        <div class="text-2xl md:text-3xl font-bold text-[#839958] truncate">
                            {{ $siswa->hasilMinat->hasil ?? '-' }}
                        </div>

                        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
                            Hasil tes minat bakat
                        </p>
                    </div>

                </div>

                <div class="group relative overflow-hidden rounded-2xl shadow-md
                            hover:shadow-xl hover:-translate-y-1 transition duration-300
                            bg-gradient-to-br from-[#fff2f1] via-[#fbe3e1] to-[#fff9f8]
                            border border-[#f3d6d3]">

                    <div class="absolute top-0 left-0 w-full">
                        <svg viewBox="0 0 500 20" preserveAspectRatio="none" class="w-full h-[12px]">
                            <defs>
                                <linearGradient id="topGrad3" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#105666"/>
                                    <stop offset="50%" stop-color="#839958"/>
                                    <stop offset="100%" stop-color="#D3968C"/>
                                </linearGradient>
                            </defs>
                            <path d="M0,12 C200,-2 300,-2 500,12 L500,0 L0,0 Z" fill="url(#topGrad3)"></path>
                        </svg>
                    </div>

                    <div class="absolute top-0 left-0 w-full">
                        <svg viewBox="0 0 500 80" preserveAspectRatio="none" class="w-full h-[65px]">
                            <path d="M0,50 C200,100 300,0 500,60 L500,0 L0,0 Z" fill="#D3968C"></path>
                        </svg>
                    </div>

                    <div class="relative z-10 pt-16 md:pt-20 p-5 md:p-6">
                        <h3 class="inline-block text-[10px] md:text-xs font-semibold 
                                text-[#D3968C] bg-[#D3968C]/10 
                                px-3 py-1 rounded-full mb-2 md:mb-3">
                            Kepribadian
                        </h3>

                        <div class="text-2xl md:text-3xl font-bold text-[#D3968C] truncate">
                            {{ $siswa->hasilKepribadian->hasil ?? '-' }}
                        </div>

                        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
                            Hasil tes kepribadian
                        </p>
                    </div>

                </div>

            </div>

            <div class="mt-8 md:mt-10">

                <h2 class="text-xl md:text-2xl font-bold text-[#105666] mb-4 md:mb-6">
                    Hasil PROMETHEE
                </h2>

                <div class="overflow-x-auto rounded-2xl border pb-2">

                    <table class="w-full text-sm whitespace-nowrap md:whitespace-normal">

                        <thead>
                            <tr class="bg-[#105666] text-white text-xs md:text-sm">
                                <th class="py-3 md:py-4 px-3 md:px-4">Rank</th>
                                <th class="py-3 md:py-4 px-3 md:px-4 text-left">Jurusan</th>
                                <th class="py-3 md:py-4 px-3 md:px-4">Leaving</th>
                                <th class="py-3 md:py-4 px-3 md:px-4">Entering</th>
                                <th class="py-3 md:py-4 px-3 md:px-4">Net</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($ranking as $jurusan => $nilai)
                            <tr class="border-b hover:bg-[#F7F4D5]/40 text-xs md:text-sm">

                                <td class="py-3 md:py-4 px-3 md:px-4 text-center">{{ $loop->iteration }}</td>

                                <td class="py-3 md:py-4 px-3 md:px-4 font-semibold">
                                    {{ $jurusan }}
                                    @if($loop->first)
                                    <span class="text-green-600 font-medium ml-1 text-[10px] md:text-xs">(Rekomendasi)</span>
                                    @endif
                                </td>

                                <td class="py-3 md:py-4 px-3 md:px-4 text-center">
                                    {{ number_format($leavingFlows[$jurusan],2) }}
                                </td>

                                <td class="py-3 md:py-4 px-3 md:px-4 text-center">
                                    {{ number_format($enteringFlows[$jurusan],2) }}
                                </td>

                                <td class="py-3 md:py-4 px-3 md:px-4 text-center font-bold text-[#105666]">
                                    {{ number_format($netFlows[$jurusan],2) }}
                                </td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="mt-8 md:mt-10 bg-[#F7F4D5] rounded-2xl p-5 md:p-6 shadow-sm border border-[#edeac7]">

                <h2 class="text-lg md:text-xl font-bold text-[#105666] mb-2 md:mb-3">
                    Kesimpulan
                </h2>

                <p class="text-gray-700 text-sm md:text-base leading-relaxed">
                    Berdasarkan metode <b>PROMETHEE</b>, siswa
                    <b>{{ $siswa->nama }}</b>
                    direkomendasikan ke jurusan
                    <b class="text-[#839958]">{{ array_key_first($ranking) }}</b>.
                </p>

            </div>

        </div>

        @else

        <div class="flex-1 flex flex-col items-center justify-center py-10 md:py-16">

            <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#F7F4D5] flex items-center justify-center mb-4 shadow-inner">
                <i class="fa-solid fa-filter text-[#105666] text-xl md:text-2xl"></i>
            </div>

            <p class="text-gray-500 text-xs md:text-sm font-medium">
                Pilih siswa terlebih dahulu
            </p>

        </div>

        @endif

    </section>

</main>

</body>
</html>