<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Akun</title>

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
                    Kelola Akun
                </h1>

                <p class="text-slate-500 mt-1">
                    Data akun guru dan operator
                </p>

            </div>

            <button
                onclick="openModalAkun()"
                class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl transition shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Tambah Akun

            </button>

        </div>

        <!-- CARD -->
        <!-- DATA GURU -->
        <div class="bg-white rounded-3xl shadow-sm p-6 mb-8">

            <div class="flex justify-between items-center mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Data Guru
                    </h2>

                    <p class="text-slate-500">
                        Seluruh akun guru
                    </p>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-slate-500">

                            <th class="text-left py-4">
                                No
                            </th>

                            <th class="text-left py-4">
                                Username
                            </th>

                            <th class="text-left py-4">
                                Nama
                            </th>

                            <th class="text-left py-4">
                                Mapel
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($gurus as $guru)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="py-4">
                                {{ $loop->iteration }}
                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-guru/{{ $guru->id }}"
                                id="guruForm-{{ $guru->id }}">

                                @csrf
                                @method('PUT')

                                <!-- USERNAME -->
                                <td class="py-4">

                                    <span id="guruUsernameText-{{ $guru->id }}">
                                        {{ $guru->user->username }}
                                    </span>

                                    <input
                                        type="text"
                                        name="username"
                                        value="{{ $guru->user->username }}"
                                        id="guruUsernameInput-{{ $guru->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2">

                                </td>

                                <!-- NAMA -->
                                <td class="py-4">

                                    <span id="guruNamaText-{{ $guru->id }}">
                                        {{ $guru->nama }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $guru->nama }}"
                                        id="guruNamaInput-{{ $guru->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2">

                                </td>

                                <!-- MAPEL -->
                                <td class="py-4">

                                    <span id="guruMapelText-{{ $guru->id }}">
                                        {{ $guru->mapel->nama_mapel }}
                                    </span>

                                    <select
                                        name="mapel_id"
                                        id="guruMapelInput-{{ $guru->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2">

                                        @foreach($mapels as $mapel)

                                        <option
                                            value="{{ $mapel->id }}"
                                            {{ $guru->mapel_id == $mapel->id ? 'selected' : '' }}>
                                            {{ $mapel->nama_mapel }}
                                        </option>

                                        @endforeach

                                    </select>

                                </td>

                            </form>

                            <!-- AKSI -->
                            <td class="py-4">

                                <div class="flex gap-2">

                                    <button
                                        type="button"
                                        id="guruEditBtn-{{ $guru->id }}"
                                        onclick="editGuru('{{ $guru->id }}')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm">
                                        Edit
                                    </button>

                                    <button
                                        type="submit"
                                        form="guruForm-{{ $guru->id }}"
                                        id="guruSaveBtn-{{ $guru->id }}"
                                        class="hidden bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                                        Simpan
                                    </button>

                                    <form
                                        method="POST"
                                        action="/operator/hapus-guru/{{ $guru->id }}"
                                        onsubmit="return confirm('Yakin hapus guru?')">

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

                            <td colspan="4" class="text-center py-10 text-slate-400">

                                Belum ada data guru

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- DATA OPERATOR -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex justify-between items-center mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Data Operator
                    </h2>

                    <p class="text-slate-500">
                        Seluruh akun operator
                    </p>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-slate-500">

                            <th class="text-left py-4">
                                No
                            </th>

                            <th class="text-left py-4">
                                Username
                            </th>

                            <th class="text-left py-4">
                                Nama
                            </th>

                            <th class="text-left py-4">
                                jabatan
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($operators as $operator)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="py-4">
                                {{ $loop->iteration }}
                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-operator/{{ $operator->id }}"
                                id="operatorForm-{{ $operator->id }}">

                                @csrf
                                @method('PUT')

                                <!-- USERNAME -->
                                <td class="py-4">

                                    <span id="operatorUsernameText-{{ $operator->id }}">
                                        {{ $operator->user->username }}
                                    </span>

                                    <input
                                        type="text"
                                        name="username"
                                        value="{{ $operator->user->username }}"
                                        id="operatorUsernameInput-{{ $operator->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-400">

                                </td>

                                <!-- NAMA -->
                                <td class="py-4">

                                    <span id="operatorNamaText-{{ $operator->id }}">
                                        {{ $operator->nama }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $operator->nama }}"
                                        id="operatorNamaInput-{{ $operator->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-400">

                                </td>

                                <!-- LEVEL -->
                                <td class="py-4">

                                    <span
                                        id="operatorJabatanText-{{ $operator->id }}"
                                        class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm">
                                        {{ ucfirst($operator->jabatan) }}
                                    </span>

                                    <select
                                        name="jabatan"
                                        id="operatorJabatanInput-{{ $operator->id }}"
                                        class="hidden w-full border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-400">

                                        <option
                                            value="admin"
                                            {{ $operator->jabatan == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>

                                        <option
                                            value="bk"
                                            {{ $operator->jabatan == 'bk' ? 'selected' : '' }}>
                                            BK
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
                                        id="operatorEditBtn-{{ $operator->id }}"
                                        onclick="editOperator('{{ $operator->id }}')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm">
                                        Edit
                                    </button>

                                    <!-- SIMPAN -->
                                    <button
                                        type="submit"
                                        form="operatorForm-{{ $operator->id }}"
                                        id="operatorSaveBtn-{{ $operator->id }}"
                                        class="hidden bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                                        Simpan
                                    </button>

                                    <!-- DELETE -->
                                    <form
                                        method="POST"
                                        action="/operator/hapus-operator/{{ $operator->id }}"
                                        onsubmit="return confirm('Yakin hapus operator?')">

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

                            <td colspan="5" class="text-center py-10 text-slate-400">

                                Belum ada data operator

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @if ($errors->any())

    <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5">

        <ul>

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif
    <!-- MODAL TAMBAH AKUN -->
    <div
        id="modalAkun"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-5">

        <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="flex justify-between items-center px-8 py-6 border-b border-slate-200">

                <div>

                    <h1 class="text-3xl font-bold text-slate-800">
                        Tambah Akun
                    </h1>

                    <p class="text-slate-500 mt-1">
                        Tambahkan akun guru atau operator
                    </p>

                </div>

                <button
                    onclick="closeModalAkun()"
                    class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-red-500 text-2xl transition">
                    ×
                </button>

            </div>

            <!-- FORM -->
            <form method="POST" action="/operator/tambah-akun">

                @csrf

                <div class="p-8">

                    <!-- GRID -->
                    <div class="grid grid-cols-2 gap-6">

                        <!-- USERNAME -->
                        <div class="col-span-2">

                            <label class="block mb-2 text-sm font-semibold text-slate-600">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                placeholder="Masukkan username"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                        </div>

                        <!-- PASSWORD -->
                        <div>

                            <label class="block mb-2 text-sm font-semibold text-slate-600">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                        </div>

                        <!-- ROLE -->
                        <div>

                            <label class="block mb-2 text-sm font-semibold text-slate-600">
                                Role
                            </label>

                            <select
                                name="role"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                                <option value="">
                                    Pilih Role
                                </option>

                                <option value="guru">
                                    Guru
                                </option>

                                <option value="operator">
                                    Operator
                                </option>

                            </select>

                        </div>

                        <!-- NAMA -->
                        <div>

                            <label class="block mb-2 text-sm font-semibold text-slate-600">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="nama"
                                placeholder="Masukkan nama"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                        </div>

                        <!-- JK -->
                        <div>

                            <label class="block mb-2 text-sm font-semibold text-slate-600">
                                Jenis Kelamin
                            </label>

                            <select
                                name="jenis_kelamin"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

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

                        <!-- MAPEL -->
                        <div class="col-span-2">

                            <label class="block mb-2 text-sm font-semibold text-slate-600">
                                Mata Pelajaran
                            </label>

                            <select
                                name="mapel_id"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                                <option value="">
                                    Pilih Mata Pelajaran
                                </option>

                                @foreach($mapels as $mapel)

                                <option value="{{ $mapel->id }}">
                                    {{ $mapel->nama_mapel }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="flex justify-end gap-3 px-8 py-5 bg-slate-50 border-t border-slate-200">

                    <button
                        type="button"
                        onclick="closeModalAkun()"
                        class="px-6 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 transition font-medium">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-7 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white transition font-medium shadow-sm">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- SCRIPT -->
    <script>
        function openModalAkun() {
            document
                .getElementById('modalAkun')
                .classList
                .remove('hidden');

            document
                .getElementById('modalAkun')
                .classList
                .add('flex');
        }

        function closeModalAkun() {
            document
                .getElementById('modalAkun')
                .classList
                .remove('flex');

            document
                .getElementById('modalAkun')
                .classList
                .add('hidden');
        }

        function editGuru(id) {
            // TEXT
            document.getElementById('guruUsernameText-' + id).classList.add('hidden');
            document.getElementById('guruNamaText-' + id).classList.add('hidden');
            document.getElementById('guruMapelText-' + id).classList.add('hidden');

            // INPUT
            document.getElementById('guruUsernameInput-' + id).classList.remove('hidden');
            document.getElementById('guruNamaInput-' + id).classList.remove('hidden');
            document.getElementById('guruMapelInput-' + id).classList.remove('hidden');

            // BUTTON
            document.getElementById('guruEditBtn-' + id).classList.add('hidden');
            document.getElementById('guruSaveBtn-' + id).classList.remove('hidden');
        }

        function editOperator(id) {
            // TEXT
            document.getElementById('operatorUsernameText-' + id).classList.add('hidden');
            document.getElementById('operatorNamaText-' + id).classList.add('hidden');
            document.getElementById('operatorJabatanText-' + id).classList.add('hidden');

            // INPUT
            document.getElementById('operatorUsernameInput-' + id).classList.remove('hidden');
            document.getElementById('operatorNamaInput-' + id).classList.remove('hidden');
            document.getElementById('operatorJabatanInput-' + id).classList.remove('hidden');

            // BUTTON
            document.getElementById('operatorEditBtn-' + id).classList.add('hidden');
            document.getElementById('operatorSaveBtn-' + id).classList.remove('hidden');
        }
    </script>
</body>

</html>