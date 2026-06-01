<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun</title>

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
                        <i class="fa-solid fa-user-gear text-[#839958]"></i>
                        Operator Aktif
                    </span>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                        Kelola Akun
                    </h1>

                    <p class="text-[#105666]/70 text-xs md:text-base font-medium">
                        Kelola akun guru dan operator dengan mudah dan cepat 🚀
                    </p>

                </div>

                <div class="flex items-center gap-4 w-full md:w-auto z-10 mt-2 md:mt-0">

                    <button
                        onclick="openModalAkun()"
                        class="flex items-center justify-center gap-2 bg-[#105666] hover:bg-[#0c4a56]
                        text-white px-5 py-3 rounded-xl md:rounded-2xl transition shadow-md w-full md:w-auto text-sm md:text-base">

                        <i class="fa-solid fa-plus"></i>
                        Tambah Akun
                    </button>

                    <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl 
                        shadow-inner items-center justify-center border shrink-0
                        transform rotate-6 hover:rotate-0 transition duration-300">

                        <i class="fa-solid fa-users text-[#105666] text-3xl"></i>
                    </div>

                </div>

            </div>
        </div>

        <div class="bg-white rounded-[24px] md:rounded-[32px] p-5 md:p-6 mb-8 md:mb-10 border border-gray-100 shadow-sm relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#839958]"></div>

            <div class="flex justify-between items-center mb-6">

                <div>
                    <div class="inline-block bg-[#F7F4D5] px-4 py-2 rounded-xl mb-1 md:mb-2">
                        <h2 class="text-base md:text-xl font-black text-[#105666]">
                            Data Guru
                        </h2>
                    </div>

                    <p class="text-xs md:text-sm text-gray-500">
                        Seluruh akun guru
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto pb-2">
                <table class="w-full text-sm min-w-[600px] whitespace-nowrap md:whitespace-normal">

                    <thead>
                        <tr class="text-left text-gray-400 border-b border-gray-100 uppercase text-[10px] md:text-xs tracking-wider">
                            <th class="py-4 pl-2 pr-4">No</th>
                            <th class="py-4 px-4">Username</th>
                            <th class="py-4 px-4">Nama</th>
                            <th class="py-4 px-4">Mapel</th>
                            <th class="py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($gurus as $guru)

                        <tr class="border-b border-gray-50 hover:bg-[#F7F4D5]/20 transition-all duration-300 text-xs md:text-sm">

                            <td class="py-3 md:py-4 pl-2 pr-4 font-semibold text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <form method="POST"
                                action="/operator/edit-guru/{{ $guru->id }}"
                                id="guruForm-{{ $guru->id }}">

                                @csrf
                                @method('PUT')

                                <td class="py-3 md:py-4 px-4">
                                    <span id="guruUsernameText-{{ $guru->id }}">
                                        {{ $guru->user->username }}
                                    </span>

                                    <input type="text"
                                        name="username"
                                        value="{{ $guru->user->username }}"
                                        id="guruUsernameInput-{{ $guru->id }}"
                                        class="hidden w-full min-w-[120px] border border-gray-200 rounded-xl px-3 py-1.5 md:py-2 focus:outline-none focus:ring-2 focus:ring-[#839958]">
                                </td>

                                <td class="py-3 md:py-4 px-4">
                                    <span id="guruNamaText-{{ $guru->id }}">
                                        {{ $guru->nama }}
                                    </span>

                                    <input type="text"
                                        name="nama"
                                        value="{{ $guru->nama }}"
                                        id="guruNamaInput-{{ $guru->id }}"
                                        class="hidden w-full min-w-[150px] border border-gray-200 rounded-xl px-3 py-1.5 md:py-2 focus:outline-none focus:ring-2 focus:ring-[#839958]">
                                </td>

                                <td class="py-3 md:py-4 px-4">
                                    <span id="guruMapelText-{{ $guru->id }}"
                                        class="inline-flex items-center gap-1 bg-[#eef6f6] text-[#105666] px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold">
                                        {{ $guru->mapel->nama_mapel }}
                                    </span>

                                    <select name="mapel_id"
                                        id="guruMapelInput-{{ $guru->id }}"
                                        class="hidden w-full min-w-[150px] border border-gray-200 rounded-xl px-3 py-1.5 md:py-2 focus:ring-2 focus:ring-[#839958]">

                                        @foreach($mapels as $mapel)
                                        <option value="{{ $mapel->id }}"
                                            {{ $guru->mapel_id == $mapel->id ? 'selected' : '' }}>
                                            {{ $mapel->nama_mapel }}
                                        </option>
                                        @endforeach

                                    </select>
                                </td>

                            </form>

                            <td class="py-3 md:py-4">
                                <div class="flex justify-center gap-2">

                                    <button type="button"
                                        onclick="editGuru('{{ $guru->id }}')"
                                        id="guruEditBtn-{{ $guru->id }}"
                                        class="bg-[#839958] hover:bg-[#6f8248] text-white px-3 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs transition">
                                        Edit
                                    </button>

                                    <button type="submit"
                                        form="guruForm-{{ $guru->id }}"
                                        id="guruSaveBtn-{{ $guru->id }}"
                                        class="hidden bg-[#105666] hover:bg-[#0c4a56] text-white px-3 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs transition">
                                        Simpan
                                    </button>

                                    <form method="POST"
                                        action="/operator/hapus-guru/{{ $guru->id }}"
                                        onsubmit="return confirm('Yakin hapus guru?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-[#D3968C] hover:bg-[#c07f77] text-white px-3 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs transition-all duration-300 hover:shadow-md active:scale-[0.98]">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400 text-xs md:text-sm">
                                Belum ada data guru
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm p-5 md:p-6 border border-gray-100 relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="flex justify-between items-center mb-6">

                <div>
                    <div class="inline-block bg-[#F7F4D5] px-4 py-2 rounded-xl mb-1 md:mb-2">
                        <h2 class="text-base md:text-xl font-black text-[#105666]">
                            Data Operator
                        </h2>
                    </div>

                    <p class="text-xs md:text-sm text-gray-500">
                        Seluruh akun operator
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto pb-2">

                <table class="w-full text-sm min-w-[600px] whitespace-nowrap md:whitespace-normal">

                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 uppercase text-[10px] md:text-xs tracking-wider">
                            <th class="text-left py-4 pl-2 pr-4">No</th>
                            <th class="text-left py-4 px-4">Username</th>
                            <th class="text-left py-4 px-4">Nama</th>
                            <th class="text-left py-4 px-4">Jabatan</th>
                            <th class="text-center py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($operators as $operator)

                        <tr class="border-b border-gray-50 hover:bg-[#F7F4D5]/20 transition-all duration-300 text-xs md:text-sm">

                            <td class="py-3 md:py-4 pl-2 pr-4 font-semibold text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-operator/{{ $operator->id }}"
                                id="operatorForm-{{ $operator->id }}">

                                @csrf
                                @method('PUT')

                                <td class="py-3 md:py-4 px-4">
                                    <span id="operatorUsernameText-{{ $operator->id }}">
                                        {{ $operator->user->username }}
                                    </span>

                                    <input
                                        type="text"
                                        name="username"
                                        value="{{ $operator->user->username }}"
                                        id="operatorUsernameInput-{{ $operator->id }}"
                                        class="hidden w-full min-w-[120px] border border-gray-200 rounded-xl px-3 py-1.5 md:py-2 outline-none focus:ring-2 focus:ring-[#839958]">
                                </td>

                                <td class="py-3 md:py-4 px-4">
                                    <span id="operatorNamaText-{{ $operator->id }}">
                                        {{ $operator->nama }}
                                    </span>

                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $operator->nama }}"
                                        id="operatorNamaInput-{{ $operator->id }}"
                                        class="hidden w-full min-w-[150px] border border-gray-200 rounded-xl px-3 py-1.5 md:py-2 outline-none focus:ring-2 focus:ring-[#839958]">
                                </td>

                                <td class="py-3 md:py-4 px-4">
                                    <span
                                        id="operatorJabatanText-{{ $operator->id }}"
                                        class="inline-flex items-center bg-[#eef6f6] text-[#105666] px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold">
                                        {{ ucfirst($operator->jabatan) }}
                                    </span>

                                    <select
                                        name="jabatan"
                                        id="operatorJabatanInput-{{ $operator->id }}"
                                        class="hidden w-full min-w-[120px] border border-gray-200 rounded-xl px-3 py-1.5 md:py-2 outline-none focus:ring-2 focus:ring-[#839958]">

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

                            <td class="py-3 md:py-4">

                                <div class="flex justify-center gap-2">

                                    <button
                                        type="button"
                                        id="operatorEditBtn-{{ $operator->id }}"
                                        onclick="editOperator('{{ $operator->id }}')"
                                        class="bg-[#839958] hover:bg-[#6f8248] text-white px-3 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs transition-all duration-300">
                                        Edit
                                    </button>

                                    <button
                                        type="submit"
                                        form="operatorForm-{{ $operator->id }}"
                                        id="operatorSaveBtn-{{ $operator->id }}"
                                        class="hidden bg-[#105666] hover:bg-[#0c4a56] text-white px-3 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs transition-all duration-300">
                                        Simpan
                                    </button>

                                    <form
                                        method="POST"
                                        action="/operator/hapus-operator/{{ $operator->id }}"
                                        onsubmit="return confirm('Yakin hapus operator?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-[#D3968C] hover:bg-[#c07f77] text-white px-3 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs transition-all duration-300 hover:shadow-md active:scale-[0.98]">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400 text-xs md:text-sm">
                                Belum ada data operator
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

    <div
        id="modalAkun"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 md:p-5 backdrop-blur-sm">

        <div class="bg-white w-full max-w-2xl rounded-[24px] md:rounded-[32px] shadow-2xl overflow-y-auto max-h-[90vh] relative custom-scrollbar">

            <div class="relative px-6 md:px-8 pt-6 md:pt-7 pb-4 md:pb-5 border-b border-gray-100 bg-gradient-to-br from-[#F7F4D5]/60 via-white to-white sticky top-0 z-20">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C] rounded-t-[24px] md:rounded-t-[32px]"></div>

                <div class="flex justify-between items-start">

                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-[#105666]">
                            Tambah Akun
                        </h1>
                        <p class="text-[#105666]/70 mt-1 text-xs md:text-sm">
                            Tambahkan akun guru atau operator
                        </p>
                    </div>

                    <button
                        onclick="closeModalAkun()"
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white border border-gray-100 
                        hover:bg-[#F7F4D5] flex items-center justify-center 
                        text-gray-400 hover:text-[#D3968C] text-lg md:text-xl 
                        transition-all duration-300 shadow-sm shrink-0">
                        ×
                    </button>

                </div>

            </div>

            <form method="POST" action="/operator/tambah-akun">

                @csrf

                <div class="p-5 md:p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <div class="col-span-1 md:col-span-2">
                            <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                                Username
                            </label>
                            <input
                                type="text"
                                name="username"
                                placeholder="Masukkan username"
                                class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                                outline-none bg-white text-sm md:text-base
                                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                        </div>

                        <div>
                            <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                                outline-none bg-white text-sm md:text-base
                                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                        </div>

                        <div>
                            <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                                Role
                            </label>
                            <select
                                name="role"
                                class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                                outline-none bg-white text-sm md:text-base
                                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                                <option value="">Pilih Role</option>
                                <option value="guru">Guru</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                                Nama
                            </label>
                            <input
                                type="text"
                                name="nama"
                                placeholder="Masukkan nama"
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

                        <div class="col-span-1 md:col-span-2">
                            <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                                Mata Pelajaran
                            </label>
                            <select
                                name="mapel_id"
                                class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                                outline-none bg-white text-sm md:text-base
                                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}">
                                    {{ $mapel->nama_mapel }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 px-5 sm:px-8 py-5 sm:py-6 border-t border-gray-100 bg-gray-50/50">

                    <button
                        type="button"
                        onclick="closeModalAkun()"
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

    <script>
        function openModalAkun() {
            document.getElementById('modalAkun').classList.remove('hidden');
            document.getElementById('modalAkun').classList.add('flex');
        }

        function closeModalAkun() {
            document.getElementById('modalAkun').classList.remove('flex');
            document.getElementById('modalAkun').classList.add('hidden');
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
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, 0.2); border-radius: 10px; }
    </style>
</body>

</html>