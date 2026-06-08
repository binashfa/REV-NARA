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

                <!-- ACTION BUTTONS -->
                <div class="flex flex-col sm:flex-row items-center gap-3 md:gap-4 w-full md:w-auto z-10 mt-2 md:mt-0">

                    <button
                        onclick="openImportModal()"
                        class="flex w-full sm:w-auto justify-center items-center gap-2 bg-[#839958] hover:bg-[#6f8248]
        text-white px-5 py-3 rounded-xl md:rounded-2xl transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98] text-sm md:text-base">

                        <i class="fa-solid fa-upload"></i>
                        Import CSV

                    </button>

                    <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
        shadow-inner items-center justify-center border
        transform rotate-6 hover:rotate-0 transition duration-300">

                        <i class="fa-solid fa-star text-[#105666] text-3xl"></i>

                    </div>

                </div>

            </div>
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

                                    <button
                                        type="button"
                                        onclick="openModal(
                                            '{{ $pertanyaan->id }}',
                                            `{{ addslashes($pertanyaan->pertanyaan) }}`
                                        )"
                                        class="w-10 h-10 rounded-full bg-[#105666] text-white hover:bg-[#0c4a56] transition">

                                        {{ $loop->iteration }}

                                    </button>

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

    <!-- MODAL EDIT PERTANYAAN -->
    <div
        id="modalPertanyaan"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-[999] p-4">

        <div class="bg-white rounded-3xl w-full max-w-xl p-6 shadow-xl">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-bold text-[#105666]">
                    Edit Pertanyaan
                </h2>

                <button
                    onclick="closeModal()"
                    class="text-gray-400 hover:text-red-500">

                    <i class="fa-solid fa-xmark text-xl"></i>

                </button>

            </div>

            <form method="POST" action="/operator/update-pertanyaan-minat-bakat">
                @csrf

                <input
                    type="hidden"
                    name="id"
                    id="modal_id">

                <label class="block text-sm font-semibold mb-2">
                    Isi Pertanyaan
                </label>

                <textarea
                    id="modal_pertanyaan"
                    name="pertanyaan"
                    rows="5"
                    required
                    class="w-full border rounded-2xl p-3 focus:ring-2 focus:ring-[#839958] outline-none"></textarea>

                <div class="flex justify-end gap-3 mt-5">

                    <button
                        type="button"
                        onclick="closeModal()"
                        class="px-5 py-2 rounded-xl bg-gray-200 hover:bg-gray-300">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-[#105666] text-white hover:bg-[#0c4a56]">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div
        id="modalImport"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">

        <div class="bg-white w-full max-w-md rounded-[24px] md:rounded-[32px] shadow-2xl overflow-hidden">

            <div class="relative px-6 py-5 border-b border-gray-100">

                <div class="absolute top-0 left-0 w-full h-[4px]
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <div class="flex justify-between items-center">

                    <h1 class="text-xl font-black text-[#105666]">
                        Import Minat Bakat
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
                action="/operator/import-minat-bakat"
                enctype="multipart/form-data">

                @csrf

                <div class="p-6 space-y-4">

                    <a
                        href="/operator/template-minat-bakat"
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
                        class="px-5 py-2 rounded-xl bg-gray-200">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-[#105666] text-white">

                        Import

                    </button>

                </div>

            </form>

        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }
    </style>

    <script>
        function openImportModal() {
            document.getElementById('modalImport').classList.remove('hidden');
            document.getElementById('modalImport').classList.add('flex');
        }

        function closeImportModal() {
            document.getElementById('modalImport').classList.remove('flex');
            document.getElementById('modalImport').classList.add('hidden');
        }

        function openModal(id, pertanyaan) {
            document.getElementById('modal_id').value = id;
            document.getElementById('modal_pertanyaan').value = pertanyaan;

            let modal = document.getElementById('modalPertanyaan');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            let modal = document.getElementById('modalPertanyaan');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</body>

</html>