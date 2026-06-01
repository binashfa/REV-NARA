<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Minat Bakat</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased">

<!-- SIDEBAR -->
<div class="fixed top-0 left-0 z-50">
    @include('operator.sidebar')
</div>

<!-- MAIN -->
<main class="ml-[270px] min-h-screen px-6 pt-10 pb-10">

    <!-- HERO -->
    <div class="mb-10">
        <div class="relative overflow-hidden rounded-[32px] p-8 md:p-10 flex items-center justify-between
            shadow-sm hover:shadow-lg transition-all duration-300
            bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

            <div class="relative z-10 space-y-3">

                <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-xs font-bold border">
                    <i class="fa-solid fa-star text-[#839958]"></i>
                    Minat & Bakat
                </span>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                    Kelola Minat Bakat
                </h1>

                <p class="text-[#105666]/70 text-sm">
                    Input nilai kuisioner siswa ⭐
                </p>

            </div>

            <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl 
                shadow-inner items-center justify-center border 
                transform rotate-6 hover:rotate-0 transition duration-300">

                <i class="fa-solid fa-star text-[#105666] text-3xl"></i>
            </div>

        </div>
    </div>

    <!-- ACTION -->
    <div class="flex gap-3 mb-6">

        <a href="/operator/template-minat-bakat"
            class="bg-[#839958] hover:bg-[#6f8248] text-white px-5 py-3 rounded-2xl transition shadow-md">
            Download Template
        </a>

        <form method="POST" action="/operator/import-minat-bakat" enctype="multipart/form-data">
            @csrf

            <input type="file" name="file" required
                class="border border-gray-200 rounded-xl px-3 py-2 mb-2">

            <button type="submit"
                class="bg-[#105666] hover:bg-[#0c4a56] text-white px-5 py-3 rounded-2xl transition shadow-md">
                Import CSV
            </button>
        </form>

    </div>

    <!-- FORM -->
    <form method="POST" action="/operator/simpan-minat-bakat">
        @csrf

        <div class="bg-white rounded-[32px] shadow-sm p-6 border border-gray-100 relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <!-- HEADER -->
                    <thead>
                        <tr class="text-left text-gray-400 border-b-2 border-gray-100 uppercase text-xs">
                            <th class="py-4">No</th>
                            <th class="py-4">Nama</th>
                            <th class="py-4">NISN</th>

                            @foreach($pertanyaans as $pertanyaan)
                            <th class="py-4 text-center">
                                {{ $loop->iteration }}
                            </th>
                            @endforeach

                            <th class="py-4 text-center">Hasil</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>

                        @foreach($siswas as $siswa)

                        <tr class="border-b hover:bg-[#F7F4D5]/30 transition-all">

                            <td class="py-3 text-center font-semibold text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-3 font-semibold text-[#105666]">
                                {{ $siswa->nama }}
                            </td>

                            <td class="py-3 text-gray-600">
                                {{ $siswa->nisn }}
                            </td>

                            @foreach($pertanyaans as $pertanyaan)

                            <td class="py-2 text-center">

                                <input
                                    type="number"
                                    min="1"
                                    max="4"
                                    required
                                    value="{{ $jawabans[$siswa->id . '-' . $pertanyaan->id]->nilai ?? '' }}"
                                    name="jawaban[{{ $siswa->id }}][{{ $pertanyaan->id }}]"
                                    class="w-14 border border-gray-200 rounded-xl px-2 py-1 text-center 
                                    focus:ring-2 focus:ring-[#839958] outline-none">

                            </td>

                            @endforeach

                            <!-- HASIL -->
                            <td class="py-3 text-center font-bold text-[#105666]">
                                {{ $siswa->hasilMinat->hasil ?? 'Belum Ada' }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-8 flex justify-end">

            <button
                type="submit"
                class="bg-[#105666] hover:bg-[#0c4a56] text-white px-8 py-4 rounded-2xl 
                transition shadow-md hover:shadow-lg hover:-translate-y-[1px]">
                Simpan Hasil
            </button>

        </div>

    </form>

</main>

</body>
</html>