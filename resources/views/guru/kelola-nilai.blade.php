<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Nilai</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <!-- SIDEBAR -->
    @include('guru.sidebar')

    <!-- CONTENT -->
    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Kelola Nilai
            </h1>

            <p class="text-slate-500 mt-1">
                Input nilai siswa 
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow-lg p-6">

            <!-- FILTER MAPEL -->
            <form method="GET" class="mb-8">

                <select
                    name="mapel_id"
                    onchange="this.form.submit()"
                    class="border border-slate-300 rounded-xl px-4 py-3 w-64 outline-none focus:ring-2 focus:ring-indigo-400">

                    <option value="">
                        Pilih Mapel
                    </option>

                    @foreach($mapels as $mapel)

                    <option
                        value="{{ $mapel->id }}"
                        {{ $mapelId == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>

                    @endforeach

                </select>

            </form>

            @if($mapelId)

            <div class="flex gap-3 mb-6">

                <!-- DOWNLOAD TEMPLATE -->
                <a
                    href="/guru/template-nilai?mapel_id={{ $mapelId }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl transition">
                    Download Template
                </a>

                <!-- IMPORT -->
                <form
                    method="POST"
                    action="/guru/import-nilai"
                    enctype="multipart/form-data"
                    class="flex items-center gap-3">

                    @csrf

                    <input
                        type="hidden"
                        name="mapel_id"
                        value="{{ $mapelId }}">

                    <input
                        type="file"
                        name="file"
                        required
                        class="border border-slate-300 rounded-xl px-3 py-2 bg-white">

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl transition">
                        Import CSV
                    </button>

                </form>

            </div>

            @endif

            <!-- TABLE -->
            @if($mapelId)

            <form method="POST" action="/guru/simpan-nilai">

                @csrf

                <input
                    type="hidden"
                    name="mapel_id"
                    value="{{ $mapelId }}">

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>

                            <tr class="bg-indigo-600 text-white">

                                <th class="p-4 text-center">
                                    No
                                </th>

                                <th class="p-4 text-center">
                                    NISN
                                </th>

                                <th class="p-4 text-center">
                                    Nama Siswa
                                </th>

                                <th class="p-4 text-center">
                                    UTS
                                </th>

                                <th class="p-4 text-center">
                                    UAS
                                </th>

                                <th class="p-4 text-center">
                                    UAM
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($siswas as $siswa)

                            @php

                            $nilai = $siswa->nilais
                            ->where('mapel_id', $mapelId)
                            ->first();

                            @endphp

                            <tr class="border-b hover:bg-slate-50">

                                <td class="p-4 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-4 text-center">
                                    {{ $siswa->nisn }}
                                </td>

                                <td class="p-4">
                                    {{ $siswa->nama }}
                                </td>

                                <!-- UTS -->
                                <td class="p-4 text-center">

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        name="nilai[{{ $siswa->id }}][uts]"
                                        value="{{ $nilai->uts ?? '' }}"
                                        class="border border-slate-300 rounded-lg px-3 py-2 w-28 text-center">

                                </td>

                                <!-- UAS -->
                                <td class="p-4 text-center">

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        name="nilai[{{ $siswa->id }}][uas]"
                                        value="{{ $nilai->uas ?? '' }}"
                                        class="border border-slate-300 rounded-lg px-3 py-2 w-28 text-center">

                                </td>

                                <!-- UAM -->
                                <td class="p-4 text-center">

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        name="nilai[{{ $siswa->id }}][uam]"
                                        value="{{ $nilai->uam ?? '' }}"
                                        class="border border-slate-300 rounded-lg px-3 py-2 w-28 text-center">

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-8 flex justify-end">

                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl">
                        Simpan Nilai
                    </button>

                </div>

            </form>

            @else

            <div class="text-center py-16 text-slate-500">

                Pilih mapel terlebih dahulu

            </div>

            @endif

        </div>

    </div>

</body>

</html>