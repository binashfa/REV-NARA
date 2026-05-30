<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100">

    <!-- SIDEBAR -->
    @include('guru.sidebar')

    <!-- CONTENT -->
    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Dashboard Guru
                </h1>

                <p class="text-slate-500 mt-1">
                    Selamat datang kembali,
                    {{ $guru->nama }}
                </p>

            </div>

            <div class="bg-white px-5 py-3 rounded-2xl shadow-sm">

                <h3 class="text-sm text-slate-500">
                    Mata Pelajaran
                </h3>

                <p class="font-bold text-indigo-600">
                    {{ $guru->mapel->nama_mapel }}
                </p>

            </div>

        </div>

        <!-- CARD -->
        <div class="grid grid-cols-2 gap-6 mb-8">

            <!-- SISWA -->
            <div class="bg-white p-6 rounded-3xl shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-slate-500">
                            Total Siswa
                        </p>

                        <h1 class="text-4xl font-bold mt-2 text-slate-800">
                            {{ $jumlahSiswa }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-3-3H10a3 3 0 00-3 3v4m10 0H7m5-12a3 3 0 110 6 3 3 0 010-6z"/>
                        </svg>

                    </div>

                </div>

            </div>

            <!-- NILAI -->
            <div class="bg-white p-6 rounded-3xl shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-slate-500">
                            Total Nilai
                        </p>

                        <h1 class="text-4xl font-bold mt-2 text-slate-800">
                            {{ $jumlahNilai }}
                        </h1>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>

                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-xl font-bold text-slate-800">
                    Nilai Terbaru
                </h2>

                <a 
                    href="/guru/kelola-nilai"
                    class="text-indigo-600 font-medium"
                >
                    Lihat Semua
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="text-left py-4 text-slate-500">
                                Nama Siswa
                            </th>

                            <th class="text-left py-4 text-slate-500">
                                Mapel
                            </th>

                            <th class="text-left py-4 text-slate-500">
                                Nilai
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($nilaiTerbaru as $nilai)

                        <tr class="border-b hover:bg-slate-50">

                            <td class="py-4">
                                {{ $nilai->siswa->nama }}
                            </td>

                            <td class="py-4">
                                {{ $nilai->mapel->nama_mapel }}
                            </td>

                            <td class="py-4">

                                <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                                    {{ $nilai->nilai }}

                                </span>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>