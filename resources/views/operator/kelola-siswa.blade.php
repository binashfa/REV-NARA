<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa</title>

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
                        <i class="fa-solid fa-user-graduate text-[#839958]"></i>
                        Data Siswa
                    </span>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                        Kelola Siswa
                    </h1>

                    <p class="text-[#105666]/70 text-sm md:text-base font-medium">
                        Kelola data siswa dengan mudah dan cepat 🎓
                    </p>

                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 md:gap-4 w-full md:w-auto z-10 mt-2 md:mt-0">

                    <button
                        onclick="openImportModal()"
                        class="flex w-full sm:w-auto justify-center items-center gap-2 bg-[#839958] hover:bg-[#6f8248]
                        text-white px-5 py-3 rounded-xl md:rounded-2xl transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98] text-sm md:text-base">

                        <i class="fa-solid fa-upload"></i>
                        Import CSV
                    </button>

                    <button
                        onclick="openModal()"
                        class="flex w-full sm:w-auto justify-center items-center gap-2 bg-[#105666] hover:bg-[#0c4a56]
                        text-white px-5 py-3 rounded-xl md:rounded-2xl transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98] text-sm md:text-base">

                        <i class="fa-solid fa-plus"></i>
                        Tambah Siswa
                    </button>

                    <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
                        shadow-inner items-center justify-center border 
                        transform rotate-6 hover:rotate-0 transition duration-300">

                        <i class="fa-solid fa-user-graduate text-[#105666] text-3xl"></i>
                    </div>

                </div>

            </div>
        </div>

        <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm p-5 md:p-6 border border-gray-100 relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="overflow-x-auto pb-2">

                <table class="w-full text-sm min-w-[600px] whitespace-nowrap md:whitespace-normal">

                    <thead>
                        <tr class="text-left text-gray-400 border-b-2 border-gray-100 uppercase text-[10px] md:text-xs tracking-widest">
                            <th class="py-4 pl-2 font-bold w-12">No</th>
                            <th class="py-4 font-bold">NISN</th>
                            <th class="py-4 font-bold">Nama</th>
                            <th class="py-4 font-bold">Jenis Kelamin</th>
                            <th class="py-4 text-center font-bold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($siswas as $siswa)

                        <tr class="border-b border-gray-50 transition-all duration-300 hover:bg-[#F7F4D5]/30 group text-xs md:text-sm">

                        <tr class="border-b border-gray-50 transition-all duration-300 hover:bg-[#F7F4D5]/30 group text-xs md:text-sm">

                            <td class="py-3 md:py-4 pl-2 font-semibold text-gray-600 align-middle">
                                {{ $loop->iteration }}
                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-siswa/{{ $siswa->id }}"
                                id="siswaForm-{{ $siswa->id }}">

                                @csrf
                                @method('PUT')

                                <!-- NISN -->
                                <td class="py-3 md:py-4 align-middle">
                                    <span id="nisnText-{{ $siswa->id }}">
                                        {{ $siswa->nisn }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nisn"
                                        value="{{ $siswa->nisn }}"
                                        id="nisnInput-{{ $siswa->id }}"
                                        class="hidden w-full border border-gray-200 rounded-xl px-3 py-2
            focus:ring-2 focus:ring-[#839958] outline-none">
                                </td>

                                <!-- NAMA -->
                                <td class="py-3 md:py-4 font-bold text-gray-800 align-middle">
                                    <span id="namaText-{{ $siswa->id }}">
                                        {{ $siswa->nama }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $siswa->nama }}"
                                        id="namaInput-{{ $siswa->id }}"
                                        class="hidden w-full border border-gray-200 rounded-xl px-3 py-2
            focus:ring-2 focus:ring-[#839958] outline-none">
                                </td>

                                <!-- JK -->
                                <td class="py-3 md:py-4 align-middle">

                                    <span
                                        id="jkText-{{ $siswa->id }}"
                                        class="inline-block px-3 py-1.5 rounded-full text-xs font-semibold
            {{ $siswa->jenis_kelamin == 'Laki-laki'
                ? 'bg-[#839958]/20 text-[#5f713f]'
                : 'bg-[#D3968C]/20 text-[#a8645c]' }}">
                                        {{ $siswa->jenis_kelamin }}
                                    </span>

                                    <select
                                        name="jenis_kelamin"
                                        id="jkInput-{{ $siswa->id }}"
                                        class="hidden w-full border border-gray-200 rounded-xl px-3 py-2
            focus:ring-2 focus:ring-[#839958] outline-none">

                                        <option value="Laki-laki"
                                            {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>

                                        <option value="Perempuan"
                                            {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>

                                    </select>

                                </td>

                            </form>

                            <!-- AKSI -->
                            <td class="py-3 md:py-4 align-middle">
                                <div class="flex justify-center gap-2">

                                    <button
                                        type="button"
                                        id="editBtn-{{ $siswa->id }}"
                                        onclick="editSiswa('{{ $siswa->id }}')"
                                        class="bg-[#839958] hover:bg-[#6f8248] text-white px-4 py-2 rounded-xl text-xs">
                                        Edit
                                    </button>

                                    <button
                                        type="submit"
                                        form="siswaForm-{{ $siswa->id }}"
                                        id="saveBtn-{{ $siswa->id }}"
                                        class="hidden bg-[#105666] hover:bg-[#0c4a56] text-white px-4 py-2 rounded-xl text-xs">
                                        Simpan
                                    </button>

                                    <form
                                        method="POST"
                                        action="/operator/hapus-siswa/{{ $siswa->id }}"
                                        onsubmit="return confirm('Yakin hapus siswa?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-[#D3968C] hover:bg-[#c07f77] text-white px-4 py-2 rounded-xl text-xs">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>


                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400 text-xs md:text-sm">
                                Belum ada data siswa
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

    <div
        id="modalTambah"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 md:p-5 backdrop-blur-sm">

        <div class="bg-white w-full max-w-lg rounded-[24px] md:rounded-[32px] shadow-2xl overflow-y-auto max-h-[90vh] custom-scrollbar relative">

            <div class="relative px-6 md:px-8 pt-6 pb-4 md:pb-5 border-b border-gray-100 bg-gradient-to-br from-[#F7F4D5]/60 via-white to-white sticky top-0 z-20">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <div class="flex justify-between items-center">

                    <h1 class="text-xl md:text-2xl font-black text-[#105666]">
                        Tambah Siswa
                    </h1>

                    <button
                        onclick="closeModal()"
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white border border-gray-100 
                        hover:bg-[#F7F4D5] flex items-center justify-center 
                        text-gray-400 hover:text-[#D3968C] text-lg md:text-xl transition-all duration-300 shrink-0">
                        ×
                    </button>

                </div>

            </div>

            <form method="POST" action="/operator/tambah-siswa">

                @csrf

                <div class="p-5 md:p-8 space-y-4 md:space-y-5">

                    <div>
                        <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                            NISN
                        </label>

                        <input
                            type="text"
                            name="nisn"
                            placeholder="Masukkan NISN"
                            class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                            outline-none bg-white text-sm md:text-base
                            focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                    </div>

                    <div>
                        <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                            Nama Siswa
                        </label>

                        <input
                            type="text"
                            name="nama"
                            placeholder="Masukkan nama siswa"
                            class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                            outline-none bg-white text-sm md:text-base
                            focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                    </div>

                    <div>
                        <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                            Jenis Kelamin
                        </label>

                        <select
                            name="jenis_kelamin"
                            class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                            outline-none bg-white text-sm md:text-base
                            focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">

                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>

                        </select>
                    </div>

                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 px-5 sm:px-8 py-5 sm:py-6 border-t border-gray-50 bg-gray-50/50">

                    <button
                        type="button"
                        onclick="closeModal()"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl md:rounded-2xl bg-gray-200 hover:bg-gray-300 
                        transition-all duration-300 font-medium text-gray-700 text-sm md:text-base">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-7 py-3 rounded-xl md:rounded-2xl bg-[#105666] hover:bg-[#0c4a56] 
                        text-white transition-all duration-300 font-medium text-sm md:text-base
                        shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

    <div
        id="modalImport"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 md:p-5 backdrop-blur-sm">

        <div class="bg-white w-full max-w-md rounded-[24px] md:rounded-[32px] shadow-2xl overflow-y-auto max-h-[90vh] custom-scrollbar relative">

            <div class="relative px-6 md:px-8 pt-6 pb-4 md:pb-5 border-b border-gray-100 bg-gradient-to-br from-[#F7F4D5]/60 via-white to-white sticky top-0 z-20">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <div class="flex justify-between items-center">

                    <h1 class="text-xl md:text-2xl font-black text-[#105666]">
                        Import Data Siswa
                    </h1>

                    <button
                        onclick="closeImportModal()"
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white border border-gray-100 
                        hover:bg-[#F7F4D5] flex items-center justify-center 
                        text-gray-400 hover:text-[#D3968C] text-lg md:text-xl transition-all duration-300 shrink-0">
                        ×
                    </button>

                </div>

            </div>

            <form
                method="POST"
                action="/operator/import-siswa"
                enctype="multipart/form-data">

                @csrf

                <div class="p-5 md:p-8 space-y-4 md:space-y-5">

                    <a
                        href="/operator/template-siswa"
                        class="flex w-full justify-center items-center gap-2 bg-[#839958] hover:bg-[#6f8248] 
                        text-white px-5 py-3 rounded-xl md:rounded-2xl transition-all duration-300 shadow-md text-sm md:text-base">

                        <i class="fa-solid fa-download"></i>
                        Download Template
                    </a>

                    <div>
                        <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                            Upload File CSV
                        </label>

                        <input
                            type="file"
                            name="file"
                            accept=".csv"
                            class="w-full border border-gray-200 rounded-xl md:rounded-2xl p-2.5 md:p-3 text-sm md:text-base bg-white">

                        <p class="text-[10px] md:text-xs text-gray-400 mt-2">
                            Format file harus CSV sesuai template
                        </p>
                    </div>

                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 px-5 sm:px-8 py-5 sm:py-6 border-t border-gray-50 bg-gray-50/50">

                    <button
                        type="button"
                        onclick="closeImportModal()"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl md:rounded-2xl bg-gray-200 hover:bg-gray-300 
                        transition-all duration-300 font-medium text-gray-700 text-sm md:text-base">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-7 py-3 rounded-xl md:rounded-2xl bg-[#839958] hover:bg-[#6f8248] 
                        text-white transition-all duration-300 font-medium text-sm md:text-base
                        shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">
                        Import
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        function openModal() {
            document.getElementById('modalTambah').classList.remove('hidden');
            document.getElementById('modalTambah').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalTambah').classList.remove('flex');
            document.getElementById('modalTambah').classList.add('hidden');
        }

        function openImportModal() {
            document.getElementById('modalImport').classList.remove('hidden');
            document.getElementById('modalImport').classList.add('flex');
        }

        function closeImportModal() {
            document.getElementById('modalImport').classList.remove('flex');
            document.getElementById('modalImport').classList.add('hidden');
        }

        function editSiswa(id) {
            // TEXT
            document.getElementById('nisnText-' + id).classList.add('hidden');
            document.getElementById('namaText-' + id).classList.add('hidden');
            document.getElementById('jkText-' + id).classList.add('hidden');

            // INPUT
            document.getElementById('nisnInput-' + id).classList.remove('hidden');
            document.getElementById('namaInput-' + id).classList.remove('hidden');
            document.getElementById('jkInput-' + id).classList.remove('hidden');

            // BUTTON
            document.getElementById('editBtn-' + id).classList.add('hidden');
            document.getElementById('saveBtn-' + id).classList.remove('hidden');
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
    </style>
</body>

</html>