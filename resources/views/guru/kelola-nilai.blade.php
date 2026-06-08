<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Nilai</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

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
                        <i class="fa-solid fa-pen text-[10px] md:text-xs text-[#839958] animate-pulse"></i>
                        Input Nilai
                    </span>

                    <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                        Kelola Nilai
                    </h1>

                    <p class="text-gray-200 text-xs md:text-sm lg:text-base font-medium max-w-md leading-relaxed">
                        Input, import, dan kelola nilai siswa dengan mudah dalam satu dashboard.
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
                        <i class="fa-solid fa-file-pen text-[#F7F4D5] text-3xl lg:text-4xl"></i>
                    </div>
                </div>

            </div>
        </header>

        <section class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm border p-4 sm:p-6 md:p-8">

            @if($mapelId)
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">

                <form method="GET">
                    <select
                        name="mapel_id"
                        onchange="this.form.submit()"
                        class="border border-gray-200 rounded-xl px-4 py-3 w-full md:w-64 outline-none text-sm md:text-base
                   focus:ring-2 focus:ring-[#105666]/30 transition-all">

                        <option value="">Pilih Mapel</option>

                        @foreach($mapels as $mapel)
                        <option value="{{ $mapel->id }}" {{ $mapelId == $mapel->id ? 'selected' : '' }}>
                            {{ $mapel->nama_mapel }}
                        </option>
                        @endforeach

                    </select>
                </form>

                @if($mapelId)

                <button
                    type="button"
                    onclick="openImportModal()"
                    class="px-5 py-3 rounded-xl bg-[#105666] text-white font-semibold
               hover:bg-[#0d4b59] transition shadow-sm">

                    <i class="fa-solid fa-file-import mr-2"></i>
                    Import Nilai

                </button>

                @endif

            </div>

            <form method="POST" action="/guru/simpan-nilai">
                @csrf

                <input type="hidden" name="mapel_id" value="{{ $mapelId }}">

                <div class="overflow-x-auto rounded-2xl border border-gray-100 pb-2">

                    <table class="w-full text-sm whitespace-nowrap md:whitespace-normal">

                        <thead>
                            <tr class="bg-[#105666] text-white text-xs md:text-sm tracking-wide">
                                <th class="py-3 md:py-4 px-3 text-center font-semibold">No</th>
                                <th class="py-3 md:py-4 px-4 text-center font-semibold">NISN</th>
                                <th class="py-3 md:py-4 px-4 text-left font-semibold">Nama Siswa</th>
                                <th class="py-3 md:py-4 px-3 text-center font-semibold">UTS</th>
                                <th class="py-3 md:py-4 px-3 text-center font-semibold">UAS</th>
                                <th class="py-3 md:py-4 px-3 text-center font-semibold">UAM</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-700 bg-white">

                            @foreach($siswas as $siswa)

                            @php
                            $nilai = $siswa->nilais->where('mapel_id', $mapelId)->first();
                            @endphp

                            <tr class="border-b border-gray-50 transition-all duration-300
                                hover:bg-[#F7F4D5]/40 group">

                                <td class="py-3 md:py-4 px-3 text-center font-medium text-[#105666]">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="py-3 md:py-4 px-4 text-center text-gray-500 text-xs md:text-sm">
                                    {{ $siswa->nisn }}
                                </td>

                                <td class="py-3 md:py-4 px-4 font-semibold text-gray-800 group-hover:text-[#105666] transition text-xs md:text-sm">
                                    {{ $siswa->nama }}
                                </td>

                                <td class="py-3 md:py-4 px-2 text-center">
                                    <input type="number" min="0" max="100"
                                        name="nilai[{{ $siswa->id }}][uts]"
                                        value="{{ $nilai->uts ?? '' }}"
                                        class="w-16 md:w-20 min-w-[70px] text-center border border-gray-200 rounded-lg py-1.5 md:py-2 text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#839958]/40
                                        focus:border-[#839958] outline-none
                                        transition">
                                </td>

                                <td class="py-3 md:py-4 px-2 text-center">
                                    <input type="number" min="0" max="100"
                                        name="nilai[{{ $siswa->id }}][uas]"
                                        value="{{ $nilai->uas ?? '' }}"
                                        class="w-16 md:w-20 min-w-[70px] text-center border border-gray-200 rounded-lg py-1.5 md:py-2 text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#D3968C]/40
                                        focus:border-[#D3968C] outline-none
                                        transition">
                                </td>

                                <td class="py-3 md:py-4 px-2 text-center">
                                    <input type="number" min="0" max="100"
                                        name="nilai[{{ $siswa->id }}][uam]"
                                        value="{{ $nilai->uam ?? '' }}"
                                        class="w-16 md:w-20 min-w-[70px] text-center border border-gray-200 rounded-lg py-1.5 md:py-2 text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#105666]/30
                                        focus:border-[#105666] outline-none
                                        transition">
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="w-full md:w-auto px-8 py-3 rounded-xl bg-[#D3968C] text-white font-semibold text-sm md:text-base
                           hover:bg-[#c07f75] transition shadow-sm hover:shadow-md hover:-translate-y-[1px]">
                        <i class="fa-solid fa-save mr-1"></i> Simpan Nilai
                    </button>
                </div>

            </form>

            @else

            <div class="text-center py-12 md:py-16">
                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-[#F7F4D5] flex items-center justify-center mx-auto mb-3 md:mb-4">
                    <i class="fa-solid fa-filter text-[#105666] text-lg md:text-xl"></i>
                </div>
                <p class="text-gray-500 text-xs md:text-sm font-medium">
                    Pilih mapel terlebih dahulu untuk mengelola nilai.
                </p>
            </div>

            @endif

        </section>

    </main>

    <!-- Modal Import -->
    <!-- Modal Import Nilai -->
    <div
        id="modalImport"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">

        <div class="bg-white w-full max-w-md rounded-[24px] md:rounded-[32px] shadow-2xl overflow-hidden">

            <div class="relative px-6 py-5 border-b border-gray-100">

                <div class="absolute top-0 left-0 w-full h-[4px]
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]">
                </div>

                <div class="flex justify-between items-center">

                    <h1 class="text-xl font-black text-[#105666]">
                        Import Nilai Siswa
                    </h1>

                    <button
                        type="button"
                        onclick="closeImportModal()"
                        class="text-gray-400 hover:text-red-500">

                        <i class="fa-solid fa-xmark text-xl"></i>

                    </button>

                </div>

            </div>

            <form
                method="POST"
                action="/guru/import-nilai"
                enctype="multipart/form-data">

                @csrf

                <input type="hidden"
                    name="mapel_id"
                    value="{{ $mapelId }}">

                <div class="p-6 space-y-4">

                    <a
                        href="/guru/template-nilai?mapel_id={{ $mapelId }}"
                        class="flex w-full justify-center items-center gap-2
                    bg-[#839958] hover:bg-[#6f8248]
                    text-white px-5 py-3 rounded-xl transition">

                        <i class="fa-solid fa-download"></i>
                        Download Template

                    </a>

                    <div>

                        <label class="block mb-2 text-sm font-semibold text-[#105666]">
                            Upload File CSV
                        </label>

                        <input
                            type="file"
                            name="file"
                            required
                            accept=".csv"
                            class="w-full border border-gray-200 rounded-xl p-3">

                        <p class="text-xs text-gray-400 mt-2">
                            Format file harus CSV sesuai template
                        </p>

                    </div>

                </div>

                <div class="flex justify-end gap-3 p-6 border-t">

                    <button
                        type="button"
                        onclick="closeImportModal()"
                        class="px-5 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 transition">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-[#105666] text-white hover:bg-[#0d4b59] transition">

                        Import

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        function openImportModal() {
            document
                .getElementById('modalImport')
                .classList.remove('hidden');

            document
                .getElementById('modalImport')
                .classList.add('flex');
        }

        function closeImportModal() {
            document
                .getElementById('modalImport')
                .classList.add('hidden');

            document
                .getElementById('modalImport')
                .classList.remove('flex');
        }
    </script>

</body>

</html>