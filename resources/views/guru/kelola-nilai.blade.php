<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Nilai</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen">

@include('guru.sidebar')

<main class="max-w-7xl mx-auto px-4 md:px-6 pt-8 pb-16">

    <!-- HEADER -->
    <header class="mb-8 md:mb-12">
        <div class="w-full bg-gradient-to-br from-[#105666] to-[#0d4b59] 
                    rounded-[24px] md:rounded-[32px] 
                    p-6 md:p-12 
                    flex items-center justify-between 
                    shadow-xl relative overflow-hidden">

            <!-- GLOW -->
            <div class="absolute top-0 right-0 w-60 h-60 md:w-80 md:h-80 bg-[#839958]/20 rounded-full blur-3xl -mr-10 -mt-10 md:-mr-20 md:-mt-20"></div>
            <div class="absolute bottom-0 left-1/4 md:left-1/3 w-40 h-40 md:w-60 md:h-60 bg-[#D3968C]/20 rounded-full blur-3xl"></div>

            <!-- TEXT -->
            <div class="relative z-10 space-y-3 md:space-y-4">

                <!-- BADGE -->
                <span class="inline-flex items-center gap-1.5 md:gap-2 
                            bg-white/10 text-[#F7F4D5] 
                            text-[10px] md:text-xs font-semibold 
                            px-3 py-1.5 rounded-full 
                            backdrop-blur-sm tracking-wider uppercase shadow-sm">
                    <i class="fa-solid fa-pen text-[10px] md:text-xs text-[#839958] animate-pulse"></i>
                    Input Nilai
                </span>

                <!-- TITLE -->
                <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    Kelola Nilai
                </h1>

                <!-- DESC -->
                <p class="text-gray-200 text-xs md:text-sm lg:text-base font-medium max-w-md leading-relaxed">
                    Input, import, dan kelola nilai siswa dengan mudah dalam satu dashboard.
                </p>

            </div>

            <!-- ICON KANAN -->
            <div class="hidden md:flex relative z-10 items-center justify-center pr-4 lg:pr-6">
                <div class="w-20 h-20 lg:w-24 lg:h-24 
                            bg-white/10 backdrop-blur-md 
                            rounded-2xl lg:rounded-3xl 
                            shadow-inner flex items-center justify-center 
                            border border-white/20 
                            transform rotate-6 hover:rotate-0 
                            transition duration-300">
                    <i class="fa-solid fa-file-pen text-[#F7F4D5] text-3xl lg:text-4xl"></i>
                </div>
            </div>

        </div>
    </header>

    <!-- CARD -->
    <section class="bg-white rounded-[32px] shadow-sm border p-6 md:p-8">

        <!-- FILTER -->
        <form method="GET" class="mb-8">
            <select
                name="mapel_id"
                onchange="this.form.submit()"
                class="border border-gray-200 rounded-xl px-4 py-3 w-64 outline-none
                       focus:ring-2 focus:ring-[#105666]/30">

                <option value="">Pilih Mapel</option>

                @foreach($mapels as $mapel)
                <option value="{{ $mapel->id }}" {{ $mapelId == $mapel->id ? 'selected' : '' }}>
                    {{ $mapel->nama_mapel }}
                </option>
                @endforeach

            </select>
        </form>

        @if($mapelId)

        <!-- ACTION -->
        <div class="flex flex-wrap gap-3 mb-8">

            <a href="/guru/template-nilai?mapel_id={{ $mapelId }}"
               class="px-5 py-3 rounded-xl bg-[#839958] text-white font-semibold
                      hover:bg-[#6f874a] transition shadow-sm">
                Download Template
            </a>

            <form method="POST" action="/guru/import-nilai" enctype="multipart/form-data"
                  class="flex items-center gap-3">
                @csrf

                <input type="hidden" name="mapel_id" value="{{ $mapelId }}">

                <input type="file" name="file" required
                       class="border border-gray-200 rounded-xl px-3 py-2 bg-white text-sm">

                <button type="submit"
                        class="px-5 py-3 rounded-xl bg-[#105666] text-white font-semibold
                               hover:bg-[#0d4b59] transition">
                    Import CSV
                </button>
            </form>

        </div>

        <!-- TABLE -->
        <form method="POST" action="/guru/simpan-nilai">
            @csrf

            <input type="hidden" name="mapel_id" value="{{ $mapelId }}">

            <div class="overflow-x-auto rounded-2xl border border-gray-100">

                <table class="w-full text-sm">

                    <!-- HEAD -->
                    <thead>
                        <tr class="bg-[#105666] text-white">
                            <th class="py-4 text-center font-semibold">No</th>
                            <th class="py-4 text-center font-semibold">NISN</th>
                            <th class="py-4 text-left font-semibold">Nama Siswa</th>
                            <th class="py-4 text-center font-semibold">UTS</th>
                            <th class="py-4 text-center font-semibold">UAS</th>
                            <th class="py-4 text-center font-semibold">UAM</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="text-gray-700 bg-white">

                        @foreach($siswas as $siswa)

                        @php
                        $nilai = $siswa->nilais->where('mapel_id', $mapelId)->first();
                        @endphp

                        <tr class="border-b border-gray-50 transition-all duration-300
                                hover:bg-[#F7F4D5]/40 group">

                            <!-- NO -->
                            <td class="py-4 text-center font-medium text-[#105666]">
                                {{ $loop->iteration }}
                            </td>

                            <!-- NISN -->
                            <td class="py-4 text-center text-gray-500">
                                {{ $siswa->nisn }}
                            </td>

                            <!-- NAMA -->
                            <td class="py-4 font-semibold text-gray-800 group-hover:text-[#105666] transition">
                                {{ $siswa->nama }}
                            </td>

                            <!-- UTS -->
                            <td class="py-4 text-center">
                                <input type="number" min="0" max="100"
                                    name="nilai[{{ $siswa->id }}][uts]"
                                    value="{{ $nilai->uts ?? '' }}"
                                    class="w-20 text-center border border-gray-200 rounded-lg py-2
                                        focus:ring-2 focus:ring-[#839958]/40
                                        focus:border-[#839958]
                                        transition">
                            </td>

                            <!-- UAS -->
                            <td class="py-4 text-center">
                                <input type="number" min="0" max="100"
                                    name="nilai[{{ $siswa->id }}][uas]"
                                    value="{{ $nilai->uas ?? '' }}"
                                    class="w-20 text-center border border-gray-200 rounded-lg py-2
                                        focus:ring-2 focus:ring-[#D3968C]/40
                                        focus:border-[#D3968C]
                                        transition">
                            </td>

                            <!-- UAM -->
                            <td class="py-4 text-center">
                                <input type="number" min="0" max="100"
                                    name="nilai[{{ $siswa->id }}][uam]"
                                    value="{{ $nilai->uam ?? '' }}"
                                    class="w-20 text-center border border-gray-200 rounded-lg py-2
                                        focus:ring-2 focus:ring-[#105666]/30
                                        focus:border-[#105666]
                                        transition">
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 flex justify-end">

                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-[#D3968C] text-white font-semibold
                        hover:bg-[#c07f75] transition shadow-sm hover:shadow-md hover:-translate-y-[1px]">
                    Simpan Nilai
                </button>

            </div>

            </form>

        @else

        <!-- EMPTY -->
        <div class="text-center py-16">
            <div class="w-16 h-16 rounded-full bg-[#F7F4D5] flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-filter text-[#105666] text-xl"></i>
            </div>
            <p class="text-gray-500 text-sm font-medium">
                Pilih mapel terlebih dahulu
            </p>
        </div>

        @endif

    </section>

</main>

</body>
</html>