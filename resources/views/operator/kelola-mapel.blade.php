<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Pelajaran</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

    <!-- SIDEBAR FIX -->
    <div class="fixed top-0 left-0 z-50">
        @include('operator.sidebar')
    </div>

    <!-- MAIN -->
    <!-- PERBAIKAN: pt-4 agar seluruh konten benar-benar bergeser naik ke atas di mobile -->
    <main class="ml-0 lg:ml-[270px] min-h-screen px-4 md:px-6 pt-4 lg:pt-10 pb-10 transition-all duration-300">

        <!-- HERO / HEADER -->
        <div class="mb-8 md:mb-10">
            <div class="relative overflow-hidden rounded-[24px] md:rounded-[32px] p-6 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-5 md:gap-0
                shadow-sm hover:shadow-lg transition-all duration-300
                bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

                <!-- TOP BORDER -->
                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <!-- GLOW -->
                <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

                <!-- TEXT -->
                <div class="relative z-10 space-y-3 w-full md:w-auto">

                    <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-[10px] md:text-xs font-bold border backdrop-blur-sm shadow-sm">
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
                <div class="flex items-center gap-4 w-full md:w-auto z-10 mt-2 md:mt-0">

                    <!-- BUTTON TAMBAH -->
                    <button
                        onclick="openModalMapel()"
                        class="flex w-full md:w-auto items-center justify-center gap-2 bg-[#105666] hover:bg-[#0c4a56]
                        text-white px-5 py-3 rounded-xl md:rounded-2xl transition shadow-md hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98] text-sm md:text-base">

                        <i class="fa-solid fa-plus"></i>
                        Tambah Mapel
                    </button>

                    <!-- ICON BOX -->
                    <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
                        shadow-inner items-center justify-center border 
                        transform rotate-6 hover:rotate-0 transition duration-300">

                        <i class="fa-solid fa-book text-[#105666] text-3xl"></i>
                    </div>

                </div>

            </div>
        </div>

        <!-- CARD TABEL -->
        <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm p-5 md:p-6 border border-gray-100 relative overflow-hidden">

            <!-- TOP LINE -->
            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="overflow-x-auto pb-2">

                <table class="w-full text-sm min-w-[500px] whitespace-nowrap md:whitespace-normal">

                    <!-- HEADER -->
                    <thead>
                        <tr class="text-left text-gray-400 border-b-2 border-gray-100 uppercase text-[10px] md:text-xs tracking-widest">
                            <th class="py-4 pl-2 font-bold w-12 md:w-16">No</th>
                            <th class="py-4 font-bold">Nama Mata Pelajaran</th>
                            <th class="py-4 text-center font-bold w-32 md:w-48">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($mapels as $mapel)

                        <tr class="border-b border-gray-50 transition-all duration-300 hover:bg-[#F7F4D5]/30 group text-xs md:text-sm">

                            <!-- NO -->
                            <td class="py-3 md:py-4 pl-2 font-semibold text-gray-600 align-middle">
                                {{ $loop->iteration }}
                            </td>

                            <!-- NAMA -->
                            <td class="py-3 md:py-4 align-middle">

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
                                    class="hidden w-full max-w-sm">

                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="text"
                                        name="nama_mapel"
                                        value="{{ $mapel->nama_mapel }}"
                                        required
                                        class="w-full border border-gray-200 rounded-lg md:rounded-xl px-3 md:px-4 py-1.5 md:py-2 outline-none 
                                        focus:ring-2 focus:ring-[#839958] transition-all font-normal">
                                </form>

                            </td>

                            <!-- AKSI -->
                            <td class="py-3 md:py-4 align-middle">
                                <div class="flex justify-center gap-2">

                                    <!-- EDIT -->
                                    <button
                                        type="button"
                                        id="editBtn-{{ $mapel->id }}"
                                        onclick="editMapel('{{ $mapel->id }}')"
                                        class="bg-[#839958] hover:bg-[#6f8248] text-white px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs 
                                        transition-all duration-300 hover:shadow-md active:scale-[0.97]">
                                        Edit
                                    </button>

                                    <!-- SIMPAN -->
                                    <button
                                        type="submit"
                                        form="form-{{ $mapel->id }}"
                                        id="saveBtn-{{ $mapel->id }}"
                                        class="hidden bg-[#105666] hover:bg-[#0c4a56] text-white px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs 
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
                                            class="bg-[#D3968C] hover:bg-[#c07f77] text-white px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs 
                                            transition-all duration-300 hover:shadow-md active:scale-[0.97]">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-400 text-xs md:text-sm">
                                Belum ada data mapel
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

    <!-- MODAL TAMBAH MAPEL -->
    <div
        id="modalMapel"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 md:p-5 backdrop-blur-sm">

        <div class="bg-white w-full max-w-lg rounded-[24px] md:rounded-[32px] shadow-2xl overflow-y-auto max-h-[90vh] custom-scrollbar relative">

            <!-- HEADER MODAL -->
            <div class="relative px-6 md:px-8 pt-6 pb-4 md:pb-5 border-b border-gray-100 bg-gradient-to-br from-[#F7F4D5]/60 via-white to-white sticky top-0 z-20">

                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C] rounded-t-[24px] md:rounded-t-[32px]"></div>

                <div class="flex justify-between items-center">

                    <h1 class="text-xl md:text-2xl font-black text-[#105666]">
                        Tambah Mapel
                    </h1>

                    <button
                        onclick="closeModalMapel()"
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white border border-gray-100 
                        hover:bg-[#F7F4D5] flex items-center justify-center 
                        text-gray-400 hover:text-[#D3968C] text-lg md:text-xl transition-all duration-300 shrink-0">
                        ×
                    </button>

                </div>

            </div>

            <!-- FORM -->
            <form method="POST" action="/operator/tambah-mapel">

                @csrf

                <div class="p-5 md:p-8">

                    <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mapel"
                        required
                        placeholder="Masukkan nama mapel"
                        class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:py-4 
                        outline-none bg-white text-sm md:text-base
                        focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">

                </div>

                <!-- FOOTER -->
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 px-5 sm:px-8 py-5 sm:py-6 border-t border-gray-50 bg-gray-50/50">

                    <button
                        type="button"
                        onclick="closeModalMapel()"
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

    <!-- SCRIPT -->
    <script>
        function openModalMapel() {
            document.getElementById('modalMapel').classList.remove('hidden');
            document.getElementById('modalMapel').classList.add('flex');
        }

        function closeModalMapel() {
            document.getElementById('modalMapel').classList.remove('flex');
            document.getElementById('modalMapel').classList.add('hidden');
        }

        function editMapel(id) {
            document.getElementById('text-' + id).classList.add('hidden');
            document.getElementById('form-' + id).classList.remove('hidden');
            document.getElementById('editBtn-' + id).classList.add('hidden');
            document.getElementById('saveBtn-' + id).classList.remove('hidden');
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, 0.2); border-radius: 10px; }
    </style>

</body>

</html>