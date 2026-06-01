<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Mata Pelajaran</title>

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
                        <i class="fa-solid fa-book text-[#839958]"></i>
                        Data Mapel
                    </span>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                        Kelola Mata Pelajaran
                    </h1>

                    <p class="text-[#105666]/70 text-sm md:text-base font-medium">
                        Kelola data mata pelajaran dengan mudah dan cepat 📚
                    </p>

                </div>

                <!-- ACTION + ICON -->
                <div class="flex items-center gap-4">

                    <!-- BUTTON TAMBAH -->
                    <button
                        onclick="openModalMapel()"
                        class="flex items-center gap-2 bg-[#105666] hover:bg-[#0c4a56]
                        text-white px-5 py-3 rounded-2xl transition shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">

                        <i class="fa-solid fa-plus"></i>
                        Tambah Mapel
                    </button>

                    <!-- ICON BOX -->
                    <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl 
                        shadow-inner items-center justify-center border 
                        transform rotate-6 hover:rotate-0 transition duration-300">

                        <i class="fa-solid fa-book text-[#105666] text-3xl"></i>
                    </div>

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
                            <th class="py-4 font-bold">Nama Mata Pelajaran</th>
                            <th class="py-4 text-center font-bold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($mapels as $mapel)

                        <tr class="border-b border-gray-50 transition-all duration-300 hover:bg-[#F7F4D5]/30 group">

                            <!-- NO -->
                            <td class="py-4 pl-2 font-semibold text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <!-- NAMA -->
                            <td class="py-4">

                                <!-- TEXT -->
                                <span
                                    id="text-{{ $mapel->id }}"
                                    class="font-bold text-gray-800">
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
                                        class="w-full border border-gray-200 rounded-2xl px-4 py-2 outline-none 
                                        focus:ring-2 focus:ring-[#839958] transition-all">
                                </form>

                            </td>

                            <!-- AKSI -->
                            <td class="py-4">
                                <div class="flex justify-center gap-2">

                                    <!-- EDIT -->
                                    <button
                                        type="button"
                                        id="editBtn-{{ $mapel->id }}"
                                        onclick="editMapel('{{ $mapel->id }}')"
                                        class="bg-[#839958] hover:bg-[#6f8248] text-white px-4 py-2 rounded-xl text-xs 
                                        transition-all duration-300 hover:shadow-md active:scale-[0.97]">
                                        Edit
                                    </button>

                                    <!-- SIMPAN -->
                                    <button
                                        type="submit"
                                        form="form-{{ $mapel->id }}"
                                        id="saveBtn-{{ $mapel->id }}"
                                        class="hidden bg-[#105666] hover:bg-[#0c4a56] text-white px-4 py-2 rounded-xl text-xs 
                                        transition-all duration-300 hover:shadow-md active:scale-[0.97]">
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
                                            class="bg-[#D3968C] hover:bg-[#c07f77] text-white px-4 py-2 rounded-xl text-xs 
                                            transition-all duration-300 hover:shadow-md active:scale-[0.97]">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-400">
                                Belum ada data mapel
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- MODAL EDIT -->
        <div
            id="modalEditMapel"
            class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-5 backdrop-blur-sm">

            <div class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden relative">

                <!-- HEADER -->
                <div class="relative px-8 pt-6 pb-5 border-b border-gray-100 bg-gradient-to-br from-[#F7F4D5]/60 via-white to-white">

                    <!-- TOP LINE -->
                    <div class="absolute top-0 left-0 w-full h-[4px] 
                        bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                    <div class="flex justify-between items-center">

                        <h1 class="text-2xl font-black text-[#105666]">
                            Edit Mapel
                        </h1>

                        <button
                            onclick="closeEditModal()"
                            class="w-10 h-10 rounded-full bg-white border border-gray-100 
                            hover:bg-[#F7F4D5] flex items-center justify-center 
                            text-gray-400 hover:text-[#D3968C] text-xl transition-all duration-300">
                            ×
                        </button>

                    </div>

                </div>

                <!-- FORM -->
                <form method="POST" id="formEditMapel">

                    @csrf
                    @method('PUT')

                    <div class="p-8">

                        <label class="block mb-2 text-sm font-semibold text-[#105666]">
                            Nama Mata Pelajaran
                        </label>

                        <input
                            type="text"
                            name="nama_mapel"
                            id="editNamaMapel"
                            required
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 
                            outline-none bg-white 
                            focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">

                    </div>

                    <!-- FOOTER -->
                    <div class="flex justify-end gap-3 px-8 py-6">

                        <button
                            type="button"
                            onclick="closeEditModal()"
                            class="px-6 py-3 rounded-2xl bg-gray-200 hover:bg-gray-300 
                            transition-all duration-300 font-medium text-gray-700">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-7 py-3 rounded-2xl bg-[#105666] hover:bg-[#0c4a56] 
                            text-white transition-all duration-300 font-medium 
                            shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- MODAL TAMBAH -->
        <div
            id="modalMapel"
            class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-5 backdrop-blur-sm">

            <div class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden relative">

                <!-- HEADER -->
                <div class="relative px-8 pt-6 pb-5 border-b border-gray-100 bg-gradient-to-br from-[#F7F4D5]/60 via-white to-white">

                    <!-- TOP LINE -->
                    <div class="absolute top-0 left-0 w-full h-[4px] 
                        bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                    <div class="flex justify-between items-center">

                        <h1 class="text-2xl font-black text-[#105666]">
                            Tambah Mapel
                        </h1>

                        <button
                            onclick="closeModalMapel()"
                            class="w-10 h-10 rounded-full bg-white border border-gray-100 
                            hover:bg-[#F7F4D5] flex items-center justify-center 
                            text-gray-400 hover:text-[#D3968C] text-xl transition-all duration-300">
                            ×
                        </button>

                    </div>

                </div>

                <!-- FORM -->
                <form method="POST" action="/operator/tambah-mapel">

                    @csrf

                    <div class="p-8">

                        <label class="block mb-2 text-sm font-semibold text-[#105666]">
                            Nama Mata Pelajaran
                        </label>

                        <input
                            type="text"
                            name="nama_mapel"
                            required
                            placeholder="Masukkan nama mapel"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 
                            outline-none bg-white 
                            focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">

                    </div>

                    <!-- FOOTER -->
                    <div class="flex justify-end gap-3 px-8 py-6">

                        <button
                            type="button"
                            onclick="closeModalMapel()"
                            class="px-6 py-3 rounded-2xl bg-gray-200 hover:bg-gray-300 
                            transition-all duration-300 font-medium text-gray-700">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-7 py-3 rounded-2xl bg-[#105666] hover:bg-[#0c4a56] 
                            text-white transition-all duration-300 font-medium 
                            shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">
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