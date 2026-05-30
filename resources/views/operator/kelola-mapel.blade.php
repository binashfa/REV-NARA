<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Mata Pelajaran</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    <!-- SIDEBAR -->
    @include('operator.sidebar')

    <!-- CONTENT -->
    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Kelola Mata Pelajaran
                </h1>

                <p class="text-slate-500 mt-1">
                    Data seluruh mata pelajaran
                </p>

            </div>

            <button
                onclick="openModalMapel()"
                class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl transition shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Tambah Mapel

            </button>

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
                                Nama Mata Pelajaran
                            </th>

                            <th class="text-left py-4">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($mapels as $mapel)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="py-4">
                                {{ $loop->iteration }}
                            </td>

                            <!-- NAMA MAPEL -->
                            <td class="py-4">

                                <!-- TEXT -->
                                <span
                                    id="text-{{ $mapel->id }}"
                                    class="font-medium text-slate-700">
                                    {{ $mapel->nama_mapel }}
                                </span>

                                <!-- FORM EDIT -->
                                <form
                                    method="POST"
                                    action="/operator/edit-mapel/{{ $mapel->id }}"
                                    id="form-{{ $mapel->id }}"
                                    class="hidden">

                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="text"
                                        name="nama_mapel"
                                        value="{{ $mapel->nama_mapel }}"
                                        class="w-full border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-400">

                                </form>

                            </td>

                            <!-- AKSI -->
                            <td class="py-4">

                                <div class="flex items-center gap-2">

                                    <!-- EDIT -->
                                    <button
                                        type="button"
                                        id="editBtn-{{ $mapel->id }}"
                                        onclick="editMapel('{{ $mapel->id }}')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm transition">
                                        Edit
                                    </button>

                                    <!-- SIMPAN -->
                                    <button
                                        type="submit"
                                        form="form-{{ $mapel->id }}"
                                        id="saveBtn-{{ $mapel->id }}"
                                        class="hidden bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm transition">
                                        Simpan
                                    </button>

                                    <!-- DELETE -->
                                    <form
                                        method="POST"
                                        action="/operator/hapus-mapel/{{ $mapel->id }}"
                                        onsubmit="return confirm('Yakin hapus mapel?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center py-10 text-slate-400">

                                Belum ada data mapel

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- MODAL EDIT -->
    <div
        id="modalEditMapel"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-5">

        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="flex justify-between items-center px-8 py-6 border-b">

                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Mapel
                </h1>

                <button
                    onclick="closeEditModal()"
                    class="text-2xl text-slate-400 hover:text-red-500">
                    ×
                </button>

            </div>

            <!-- FORM -->
            <form
                method="POST"
                id="formEditMapel">

                @csrf
                @method('PUT')

                <div class="p-8">

                    <label class="block mb-2 text-sm font-semibold text-slate-600">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mapel"
                        id="editNamaMapel"
                        required
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- FOOTER -->
                <div class="flex justify-end gap-3 px-8 py-5 bg-slate-50 border-t">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="px-6 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 transition">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-7 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white transition">
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- MODAL -->
    <div
        id="modalMapel"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-5">

        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="flex justify-between items-center px-8 py-6 border-b">

                <h1 class="text-2xl font-bold text-slate-800">
                    Tambah Mapel
                </h1>

                <button
                    onclick="closeModalMapel()"
                    class="text-2xl text-slate-400 hover:text-red-500">
                    ×
                </button>

            </div>

            <!-- FORM -->
            <form method="POST" action="/operator/tambah-mapel">

                @csrf

                <div class="p-8">

                    <label class="block mb-2 text-sm font-semibold text-slate-600">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mapel"
                        required
                        placeholder="Masukkan nama mapel"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- FOOTER -->
                <div class="flex justify-end gap-3 px-8 py-5 bg-slate-50 border-t">

                    <button
                        type="button"
                        onclick="closeModalMapel()"
                        class="px-6 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 transition">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-7 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white transition">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- SCRIPT -->
    <script>
        function openModalMapel() {
            document
                .getElementById('modalMapel')
                .classList
                .remove('hidden');

            document
                .getElementById('modalMapel')
                .classList
                .add('flex');
        }

        function closeModalMapel() {
            document
                .getElementById('modalMapel')
                .classList
                .remove('flex');

            document
                .getElementById('modalMapel')
                .classList
                .add('hidden');
        }


        function editMapel(id) {
            // TEXT HILANG
            document
                .getElementById('text-' + id)
                .classList
                .add('hidden');

            // FORM MUNCUL
            document
                .getElementById('form-' + id)
                .classList
                .remove('hidden');

            // BUTTON EDIT HILANG
            document
                .getElementById('editBtn-' + id)
                .classList
                .add('hidden');

            // BUTTON SIMPAN MUNCUL
            document
                .getElementById('saveBtn-' + id)
                .classList
                .remove('hidden');
        }
    </script>

</body>

</html>