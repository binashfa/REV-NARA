<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Nilai</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased">

<!-- SIDEBAR FIX -->
<div class="fixed top-0 left-0 z-50">
    @include('operator.sidebar')
</div>

<!-- MAIN -->
<main class="ml-[270px] min-h-screen px-6 pt-10 pb-10">

    <!-- HERO / HEADER -->
    <div class="mb-10">
        <div class="relative overflow-hidden rounded-[32px] p-8 md:p-10 flex items-center justify-between
            shadow-sm hover:shadow-lg transition-all duration-300
            bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

            <!-- TOP BORDER -->
            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <!-- GLOW -->
            <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

            <!-- TEXT -->
            <div class="relative z-10 space-y-3">

                <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-xs font-bold border backdrop-blur-sm shadow-sm">
                    <i class="fa-solid fa-chart-line text-[#839958]"></i>
                    Data Nilai
                </span>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                    Kelola Nilai
                </h1>

                <p class="text-[#105666]/70 text-sm md:text-base font-medium">
                    Kelola nilai siswa dengan mudah dan cepat 📊
                </p>

            </div>

            <!-- ICON -->
            <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl 
                shadow-inner items-center justify-center border 
                transform rotate-6 hover:rotate-0 transition duration-300">

                <i class="fa-solid fa-chart-line text-[#105666] text-3xl"></i>
            </div>

        </div>
    </div>

<!-- CARD -->
<div class="bg-white rounded-[32px] shadow-sm p-6 border border-gray-100 relative overflow-hidden">

    <!-- TOP LINE -->
    <div class="absolute top-0 left-0 w-full h-[4px] 
        bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead>
                <tr class="text-left text-gray-400 border-b-2 border-gray-100 uppercase text-xs tracking-widest">
                    <th class="py-4 pl-2 font-bold">No</th>
                    <th class="py-4 font-bold">Nama Siswa</th>
                    <th class="py-4 font-bold">Mapel</th>
                    <th class="py-4 text-center font-bold">UTS</th>
                    <th class="py-4 text-center font-bold">UAS</th>
                    <th class="py-4 text-center font-bold">UAM</th>
                    <th class="py-4 text-center font-bold">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

                @forelse($nilais as $nilai)

                <tr class="border-b border-gray-50 transition-all duration-300 hover:bg-[#F7F4D5]/30 group">

                    <!-- NO -->
                    <td class="py-4 pl-2 font-semibold text-gray-600">
                        {{ $loop->iteration }}
                    </td>

                    <!-- NAMA -->
                    <td class="py-4 font-semibold text-[#105666]">
                        {{ $nilai->siswa->nama }}
                    </td>

                    <!-- MAPEL -->
                    <td class="py-4">
                        <span class="inline-flex items-center gap-2 
                            bg-[#105666]/10 text-[#105666] 
                            px-3 py-1.5 rounded-full text-xs font-semibold">

                            <i class="fa-solid fa-book text-[10px]"></i>
                            {{ $nilai->guru->mapel->nama_mapel }}

                        </span>
                    </td>

                    <form
                        method="POST"
                        action="/operator/edit-nilai/{{ $nilai->id }}"
                        id="nilaiForm-{{ $nilai->id }}">

                        @csrf
                        @method('PUT')

                        <!-- UTS -->
                        <td class="py-4 text-center">

                            <span
                                id="utsText-{{ $nilai->id }}"
                                class="font-bold text-[#105666]">
                                {{ $nilai->uts }}
                            </span>

                            <input
                                type="number"
                                name="uts"
                                value="{{ $nilai->uts }}"
                                id="utsInput-{{ $nilai->id }}"
                                class="hidden w-20 border border-gray-200 rounded-xl px-3 py-2 text-center
                                focus:ring-2 focus:ring-[#839958] outline-none">
                        </td>

                        <!-- UAS -->
                        <td class="py-4 text-center">

                            <span
                                id="uasText-{{ $nilai->id }}"
                                class="font-bold text-[#105666]">
                                {{ $nilai->uas }}
                            </span>

                            <input
                                type="number"
                                name="uas"
                                value="{{ $nilai->uas }}"
                                id="uasInput-{{ $nilai->id }}"
                                class="hidden w-20 border border-gray-200 rounded-xl px-3 py-2 text-center
                                focus:ring-2 focus:ring-[#839958] outline-none">
                        </td>

                        <!-- UAM -->
                        <td class="py-4 text-center">

                            <span
                                id="uamText-{{ $nilai->id }}"
                                class="font-bold text-[#105666]">
                                {{ $nilai->uam }}
                            </span>

                            <input
                                type="number"
                                name="uam"
                                value="{{ $nilai->uam }}"
                                id="uamInput-{{ $nilai->id }}"
                                class="hidden w-20 border border-gray-200 rounded-xl px-3 py-2 text-center
                                focus:ring-2 focus:ring-[#839958] outline-none">
                        </td>

                    </form>

                    <!-- AKSI -->
                    <td class="py-4">
                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <button
                                type="button"
                                id="editBtn-{{ $nilai->id }}"
                                onclick="editNilai('{{ $nilai->id }}')"
                                class="px-4 py-2 rounded-xl text-xs font-medium
                                bg-[#839958] hover:bg-[#6f8248]
                                text-white transition-all duration-300
                                hover:shadow-md hover:-translate-y-[1px] active:scale-[0.97]">
                                Edit
                            </button>

                            <!-- SIMPAN -->
                            <button
                                type="submit"
                                form="nilaiForm-{{ $nilai->id }}"
                                id="saveBtn-{{ $nilai->id }}"
                                class="hidden px-4 py-2 rounded-xl text-xs font-medium
                                bg-[#105666] hover:bg-[#0c4a56]
                                text-white transition-all duration-300
                                hover:shadow-md hover:-translate-y-[1px] active:scale-[0.97]">
                                Simpan
                            </button>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-400">
                        Belum ada data nilai
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
    </div>

    <script>
        function editNilai(id) {
            // TEXT
            document.getElementById('utsText-' + id).classList.add('hidden');
            document.getElementById('uasText-' + id).classList.add('hidden');
            document.getElementById('uamText-' + id).classList.add('hidden');

            // INPUT
            document.getElementById('utsInput-' + id).classList.remove('hidden');
            document.getElementById('uasInput-' + id).classList.remove('hidden');
            document.getElementById('uamInput-' + id).classList.remove('hidden');

            // BUTTON
            document.getElementById('editBtn-' + id).classList.add('hidden');
            document.getElementById('saveBtn-' + id).classList.remove('hidden');
        }
    </script>

</body>

</html>