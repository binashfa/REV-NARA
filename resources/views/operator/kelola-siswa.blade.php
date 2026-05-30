<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    <!-- SIDEBAR -->
    @include('operator.sidebar')

    <!-- CONTENT -->
    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <!-- LEFT -->
            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Kelola Siswa
                </h1>

                <p class="text-slate-500 mt-1">
                    Data seluruh siswa
                </p>

            </div>

            <!-- RIGHT BUTTON -->
            <div class="flex items-center gap-3">

                <!-- IMPORT -->
                <button
                    onclick="openImportModal()"
                    class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl transition shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>

                    Import CSV

                </button>

                <!-- TAMBAH -->
                <button
                    onclick="openModal()"
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl transition shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>

                    Tambah Siswa

                </button>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-slate-500">

                            <th class="text-left py-4">
                                No
                            </th>

                            <th class="text-left py-4">
                                NISN
                            </th>

                            <th class="text-left py-4">
                                Nama
                            </th>

                            <th class="text-left py-4">
                                Jenis Kelamin
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($siswas as $siswa)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="py-4">
                                {{ $loop->iteration }}
                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-siswa/{{ $siswa->id }}"
                                id="siswaForm-{{ $siswa->id }}">

                                @csrf
                                @method('PUT')

                                <!-- NISN -->
                                <td class="py-4">

                                    <span id="nisnText-{{ $siswa->id }}">
                                        {{ $siswa->nisn }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nisn"
                                        value="{{ $siswa->nisn }}"
                                        id="nisnInput-{{ $siswa->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2">

                                </td>

                                <!-- NAMA -->
                                <td class="py-4">

                                    <span id="namaText-{{ $siswa->id }}">
                                        {{ $siswa->nama }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $siswa->nama }}"
                                        id="namaInput-{{ $siswa->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2">

                                </td>

                                <!-- JK -->
                                <td class="py-4">

                                    <span
                                        id="jkText-{{ $siswa->id }}"
                                        class="px-4 py-2 rounded-full text-sm
                {{ $siswa->jenis_kelamin == 'Laki-laki'
                    ? 'bg-blue-100 text-blue-700'
                    : 'bg-pink-100 text-pink-700'
                }}">
                                        {{ $siswa->jenis_kelamin }}
                                    </span>

                                    <select
                                        name="jenis_kelamin"
                                        id="jkInput-{{ $siswa->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2">

                                        <option
                                            value="Laki-laki"
                                            {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>

                                        <option
                                            value="Perempuan"
                                            {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>

                                    </select>

                                </td>


                            </form>

                            <!-- AKSI -->
                            <td class="py-4">

                                <div class="flex gap-2">

                                    <!-- EDIT -->
                                    <button
                                        type="button"
                                        id="editBtn-{{ $siswa->id }}"
                                        onclick="editSiswa('{{ $siswa->id }}')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm">
                                        Edit
                                    </button>

                                    <!-- SIMPAN -->
                                    <button
                                        type="submit"
                                        form="siswaForm-{{ $siswa->id }}"
                                        id="saveBtn-{{ $siswa->id }}"
                                        class="hidden bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                                        Simpan
                                    </button>

                                    <!-- DELETE -->
                                    <form
                                        method="POST"
                                        action="/operator/hapus-siswa/{{ $siswa->id }}"
                                        onsubmit="return confirm('Yakin hapus siswa?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-10 text-slate-400">

                                Belum ada data siswa

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    <div
        id="modalTambah"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white w-[500px] rounded-3xl p-8 shadow-2xl">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Tambah Siswa
                </h1>

                <button
                    onclick="closeModal()"
                    class="text-slate-400 hover:text-red-500 text-2xl">
                    ×
                </button>

            </div>

            <!-- FORM -->
            <form method="POST" action="/operator/tambah-siswa">

                @csrf

                <!-- NISN -->
                <div class="mb-5">

                    <label class="block mb-2 text-slate-600 font-medium">
                        NISN
                    </label>

                    <input
                        type="text"
                        name="nisn"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- NAMA -->
                <div class="mb-5">

                    <label class="block mb-2 text-slate-600 font-medium">
                        Nama Siswa
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- JK -->
                <div class="mb-5">

                    <label class="block mb-2 text-slate-600 font-medium">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-400">

                        <option value="">
                            Pilih Jenis Kelamin
                        </option>

                        <option value="Laki-laki">
                            Laki-laki
                        </option>

                        <option value="Perempuan">
                            Perempuan
                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeModal()"
                        class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 transition">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- MODAL IMPORT -->
    <div
        id="modalImport"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white w-[450px] rounded-3xl p-8 shadow-2xl">

            <div class="flex justify-between items-center mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Import Data Siswa
                </h1>

                <button
                    onclick="closeImportModal()"
                    class="text-2xl text-slate-400 hover:text-red-500">
                    ×
                </button>

            </div>

            <form
                method="POST"
                action="/operator/import-siswa"
                enctype="multipart/form-data">

                @csrf

                <!-- TEMPLATE -->
                <div class="mb-5">

                    <a
                        href="/operator/template-siswa"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl transition">
                        Download Template
                    </a>

                </div>

                <!-- FILE -->
                <div class="mb-6">

                    <label class="block mb-2 text-slate-600 font-medium">
                        Upload File CSV
                    </label>

                    <input
                        type="file"
                        name="file"
                        accept=".csv"
                        class="w-full border border-slate-300 rounded-xl p-3">

                    <p class="text-sm text-slate-400 mt-2">
                        Format file harus CSV sesuai template
                    </p>

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeImportModal()"
                        class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 transition">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white transition">
                        Import
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        function openModal() {
            document
                .getElementById('modalTambah')
                .classList
                .remove('hidden');

            document
                .getElementById('modalTambah')
                .classList
                .add('flex');
        }

        function closeModal() {
            document
                .getElementById('modalTambah')
                .classList
                .remove('flex');

            document
                .getElementById('modalTambah')
                .classList
                .add('hidden');
        }

        function openImportModal() {
            document
                .getElementById('modalImport')
                .classList
                .remove('hidden');

            document
                .getElementById('modalImport')
                .classList
                .add('flex');
        }

        function closeImportModal() {
            document
                .getElementById('modalImport')
                .classList
                .remove('flex');

            document
                .getElementById('modalImport')
                .classList
                .add('hidden');
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
</body>

</html>