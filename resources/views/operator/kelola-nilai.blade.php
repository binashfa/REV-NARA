<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Nilai</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

    <div class="fixed top-0 left-0 z-50">
        @include('operator.sidebar')
    </div>

    <main class="ml-0 lg:ml-[270px] min-h-screen px-4 md:px-6 pt-4 lg:pt-10 pb-10 transition-all duration-300">

        <div class="mb-8 md:mb-10">
            <div class="relative overflow-hidden rounded-[24px] md:rounded-[32px] p-6 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-5 md:gap-0
                shadow-sm hover:shadow-lg transition-all duration-300
                bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

                <div class="relative z-10 space-y-3 w-full md:w-auto">

                    <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-[10px] md:text-xs font-bold border backdrop-blur-sm shadow-sm">
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

                <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
                    shadow-inner items-center justify-center border 
                    transform rotate-6 hover:rotate-0 transition duration-300 z-10">

                    <i class="fa-solid fa-chart-line text-[#105666] text-3xl"></i>
                </div>

            </div>
        </div>

        <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm p-5 md:p-6 border border-gray-100 relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="mb-5 flex flex-wrap items-center gap-3">

                <form method="GET" class="mb-5">

                    <select
                        name="mapel_id"
                        onchange="this.form.submit()"
                        class="px-4 py-2 rounded-xl border border-gray-200">

                        <option value="" selected disabled>
                            Pilih Mapel
                        </option>

                        @foreach($mapels as $mapel)

                        <option
                            value="{{ $mapel->id }}"
                            {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>

                            {{ $mapel->nama_mapel }}

                        </option>

                        @endforeach

                    </select>

                </form>

            </div>

            <div class="overflow-x-auto pb-2">
                @if(!request()->filled('mapel_id'))

                <div class="text-center py-16">

                    <i class="fa-solid fa-book text-5xl text-gray-300 mb-4"></i>

                    <p class="text-gray-400 font-medium">
                        Silakan pilih mapel terlebih dahulu
                    </p>

                </div>

                @else

                <table class="w-full text-sm min-w-[700px] whitespace-nowrap md:whitespace-normal">

                    <thead>
                        <tr class="text-left text-gray-400 border-b-2 border-gray-100 uppercase text-[10px] md:text-xs tracking-widest">
                            <th class="py-4 pl-2 font-bold w-12 md:w-16">No</th>
                            <th class="py-4 font-bold">Nama Siswa</th>
                            <th class="py-4 font-bold">Mapel</th>
                            <th class="py-4 text-center font-bold w-20 md:w-24">UTS</th>
                            <th class="py-4 text-center font-bold w-20 md:w-24">UAS</th>
                            <th class="py-4 text-center font-bold w-20 md:w-24">UAM</th>
                            <th class="py-4 text-center font-bold w-28 md:w-32">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($nilais as $nilai)

                        <tr class="border-b border-gray-50 transition-all duration-300 hover:bg-[#F7F4D5]/30 group text-xs md:text-sm">

                            <td class="py-3 md:py-4 pl-2 font-semibold text-gray-600 align-middle">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-3 md:py-4 font-semibold text-[#105666] align-middle">
                                {{ $nilai->siswa->nama }}
                            </td>

                            <td class="py-3 md:py-4 align-middle">
                                <span class="inline-flex items-center gap-1.5 md:gap-2 
                                    bg-[#105666]/10 text-[#105666] 
                                    px-2 md:px-3 py-1 md:py-1.5 rounded-full text-[10px] md:text-xs font-semibold">

                                    <i class="fa-solid fa-book text-[8px] md:text-[10px]"></i>
                                    {{ $nilai->mapel->nama_mapel }}

                                </span>
                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-nilai/{{ $nilai->id }}"
                                id="nilaiForm-{{ $nilai->id }}">

                                @csrf
                                @method('PUT')

                                <td class="py-3 md:py-4 text-center align-middle">

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
                                        class="hidden w-16 md:w-20 border border-gray-200 rounded-lg md:rounded-xl px-2 md:px-3 py-1.5 md:py-2 text-center text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#839958] outline-none mx-auto">
                                </td>

                                <td class="py-3 md:py-4 text-center align-middle">

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
                                        class="hidden w-16 md:w-20 border border-gray-200 rounded-lg md:rounded-xl px-2 md:px-3 py-1.5 md:py-2 text-center text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#839958] outline-none mx-auto">
                                </td>

                                <td class="py-3 md:py-4 text-center align-middle">

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
                                        class="hidden w-16 md:w-20 border border-gray-200 rounded-lg md:rounded-xl px-2 md:px-3 py-1.5 md:py-2 text-center text-xs md:text-sm
                                        focus:ring-2 focus:ring-[#839958] outline-none mx-auto">
                                </td>

                            </form>

                            <td class="py-3 md:py-4 align-middle">
                                <div class="flex justify-center gap-2">

                                    <button
                                        type="button"
                                        id="editBtn-{{ $nilai->id }}"
                                        onclick="editNilai('{{ $nilai->id }}')"
                                        class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs font-medium
                                        bg-[#839958] hover:bg-[#6f8248]
                                        text-white transition-all duration-300
                                        hover:shadow-md hover:-translate-y-[1px] active:scale-[0.97]">
                                        Edit
                                    </button>

                                    <button
                                        type="submit"
                                        form="nilaiForm-{{ $nilai->id }}"
                                        id="saveBtn-{{ $nilai->id }}"
                                        class="hidden px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs font-medium
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
                            <td colspan="7" class="text-center py-10 text-gray-400 text-xs md:text-sm">
                                Belum ada data nilai
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>


                @endif


            </div>

        </div>
    </main>

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