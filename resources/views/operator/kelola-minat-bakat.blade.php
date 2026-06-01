<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Minat Bakat</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

    <!-- SIDEBAR -->
    <div class="fixed top-0 left-0 z-50">
        @include('operator.sidebar')
    </div>

    <!-- MAIN -->
    <main class="ml-0 lg:ml-[270px] min-h-screen px-4 md:px-6 pt-4 lg:pt-10 pb-10 transition-all duration-300">

        <!-- HERO -->
        <div class="mb-8 md:mb-10">
            <div class="relative overflow-hidden rounded-[24px] md:rounded-[32px] p-6 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-5 md:gap-0
                shadow-sm hover:shadow-lg transition-all duration-300
                bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

                <div class="relative z-10 space-y-3 w-full md:w-auto">

                    <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-[10px] md:text-xs font-bold border">
                        <i class="fa-solid fa-star text-[#839958]"></i>
                        Minat & Bakat
                    </span>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                        Kelola Minat Bakat
                    </h1>

                    <p class="text-[#105666]/70 text-sm md:text-base">
                        Input nilai kuisioner siswa ⭐
                    </p>

                </div>

                <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
                    shadow-inner items-center justify-center border 
                    transform rotate-6 hover:rotate-0 transition duration-300">

                    <i class="fa-solid fa-star text-[#105666] text-3xl"></i>
                </div>

            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6 items-start sm:items-center justify-between w-full">

            <a href="/operator/template-minat-bakat"
                class="flex w-full sm:w-auto justify-center items-center gap-2 bg-[#839958] hover:bg-[#6f8248] text-white px-5 py-3 rounded-xl md:rounded-2xl transition shadow-md hover:shadow-lg hover:-translate-y-[1px] text-sm md:text-base">
                <i class="fa-solid fa-download"></i>
                Download Template
            </a>

            <form method="POST" action="/operator/import-minat-bakat" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto items-center">
                @csrf

                <input type="file" name="file" required accept=".csv"
                    class="w-full sm:w-60 border border-gray-200 rounded-xl md:rounded-2xl px-3 py-2 bg-white text-xs md:text-sm">

                <button type="submit"
                    class="flex w-full sm:w-auto justify-center items-center gap-2 bg-[#105666] hover:bg-[#0c4a56] text-white px-5 py-3 rounded-xl md:rounded-2xl transition shadow-md hover:shadow-lg hover:-translate-y-[1px] text-sm md:text-base">
                    <i class="fa-solid fa-upload"></i>
                    Import CSV
                </button>
            </form>

        </div>

        <!-- FORM TABEL -->
        <form method="POST" action="/operator/simpan-minat-bakat">
            @csrf

            <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm p-5 md:p-6 border border-gray-100 relative overflow-hidden">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <!-- PERBAIKAN: Scroll tabel agar aman dari meluber -->
                <div class="overflow-x-auto pb-2 custom-scrollbar">

                    <table class="w-full text-sm min-w-max whitespace-nowrap">

                        <!-- HEADER -->
                        <thead>
                            <tr class="text-left text-gray-400 border-b-2 border-gray-100 uppercase text-[10px] md:text-xs">
                                <th class="py-4 pl-2 pr-4 font-bold">No</th>
                                <th class="py-4 px-4 font-bold">Nama</th>
                                <th class="py-4 px-4 font-bold">NISN</th>

                                @foreach($pertanyaans as $pertanyaan)
                                <th class="py-4 px-2 text-center font-bold w-16">
                                    {{ $loop->iteration }}
                                </th>
                                @endforeach

                                <th class="py-4 px-4 text-center font-bold">Hasil</th>
                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody>

                            @foreach($siswas as $siswa)

                            <tr class="border-b border-gray-50 hover:bg-[#F7F4D5]/30 transition-all text-xs md:text-sm">

                                <td class="py-3 md:py-4 pl-2 pr-4 text-center font-semibold text-gray-600 align-middle">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="py-3 md:py-4 px-4 font-semibold text-[#105666] align-middle">
                                    {{ $siswa->nama }}
                                </td>

                                <td class="py-3 md:py-4 px-4 text-gray-600 align-middle">
                                    {{ $siswa->nisn }}
                                </td>

                                @foreach($pertanyaans as $pertanyaan)

                                <td class="py-2 px-2 text-center align-middle">

                                    <input
                                        type="number"
                                        min="1"
                                        max="4"
                                        required
                                        value="{{ $jawabans[$siswa->id . '-' . $pertanyaan->id]->nilai ?? '' }}"
                                        name="jawaban[{{ $siswa->id }}][{{ $pertanyaan->id }}]"
                                        class="w-12 md:w-14 border border-gray-200 rounded-lg md:rounded-xl px-2 py-1.5 text-center text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#839958] outline-none mx-auto block">

                                </td>

                                @endforeach

                                <!-- HASIL -->
                                <td class="py-3 md:py-4 px-4 text-center font-bold text-[#105666] align-middle">
                                    <span class="inline-block px-3 py-1 bg-[#105666]/10 rounded-full">
                                        {{ $siswa->hasilMinat->hasil ?? 'Belum Ada' }}
                                    </span>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- BUTTON SIMPAN -->
            <div class="mt-6 md:mt-8 flex justify-end">

                <button
                    type="submit"
                    class="w-full md:w-auto flex justify-center items-center gap-2 bg-[#105666] hover:bg-[#0c4a56] text-white px-8 py-3.5 md:py-4 rounded-xl md:rounded-2xl 
                    transition shadow-md hover:shadow-lg hover:-translate-y-[1px] font-bold text-sm md:text-base active:scale-[0.98]">
                    <i class="fa-solid fa-save"></i>
                    Simpan Hasil
                </button>

            </div>

        </form>

    </main>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px;}
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, 0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(0, 0, 0, 0.2); }
    </style>

</body>

</html>