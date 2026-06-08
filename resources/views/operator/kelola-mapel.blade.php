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

                <!-- ICON BOX -->
                <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
                        shadow-inner items-center justify-center border 
                        transform rotate-6 hover:rotate-0 transition duration-300">

                    <i class="fa-solid fa-book text-[#105666] text-3xl"></i>
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

    <!-- SCRIPT -->
    <script>
        function editMapel(id) {
            document.getElementById('text-' + id).classList.add('hidden');
            document.getElementById('form-' + id).classList.remove('hidden');
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