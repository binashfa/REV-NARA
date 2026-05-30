<!DOCTYPE html>
<html>

<head>

    <title>Raport Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100">

    @include('guru.sidebar')

    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <!-- KIRI -->
            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Raport Siswa
                </h1>

                <p class="text-slate-500 mt-2">
                    Lihat raport siswa dan rekomendasi jurusan
                </p>

            </div>

            <!-- KANAN -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4">

                <form method="GET">

                    <label class="block text-sm font-medium text-slate-600 mb-2">

                        Pilih Siswa

                    </label>

                    <select
                        name="siswa_id"
                        onchange="this.form.submit()"
                        class="w-72 border border-slate-300 rounded-2xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-400">

                        <option value="">
                            Pilih Nama Siswa
                        </option>

                        @foreach($siswas as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ $siswaId == $item->id ? 'selected' : '' }}>

                            {{ $item->nama }}

                        </option>

                        @endforeach

                    </select>

                </form>

            </div>

        </div>

        @if($siswa)

        <!-- RAPORT -->
        <div class="bg-white rounded-3xl shadow-sm p-8">

            <!-- IDENTITAS -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <!-- IDENTITAS -->
                <div>

                    <h2 class="text-2xl font-bold text-indigo-600">
                        {{ $siswa->nama }}
                    </h2>

                    <div class="mt-2 space-y-1 text-slate-500 text-sm">

                        <p>
                            NISN :
                            {{ $siswa->nisn }}
                        </p>

                        <p>
                            Jenis Kelamin :
                            {{ $siswa->jenis_kelamin }}
                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <div>

                    <a
                        href="/guru/raport-pdf/{{ $siswa->id }}"
                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-2xl shadow-sm transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                        Export PDF

                    </a>

                </div>

            </div>

            <!-- TABLE NILAI -->
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-indigo-600 text-white">

                            <th class="px-4 py-4 text-left rounded-tl-2xl">
                                No
                            </th>

                            <th class="px-4 py-4 text-left">
                                Mata Pelajaran
                            </th>

                            <th class="px-4 py-4 text-center">
                                UTS
                            </th>

                            <th class="px-4 py-4 text-center">
                                UAS
                            </th>

                            <th class="px-4 py-4 text-center">
                                UAM
                            </th>

                            <th class="px-4 py-4 text-center rounded-tr-2xl">
                                Rata-rata
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php
                        $totalRata = 0;
                        $jumlahMapel = count($siswa->nilais);
                        @endphp

                        @forelse($siswa->nilais as $nilai)

                        @php

                        $rata = (
                        ($nilai->uts ?? 0) +
                        ($nilai->uas ?? 0) +
                        ($nilai->uam ?? 0)
                        ) / 3;

                        $totalRata += $rata;

                        @endphp

                        <tr class="border-b hover:bg-slate-50">

                            <td class="px-4 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4">
                                {{ $nilai->mapel->nama_mapel }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                {{ $nilai->uts }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                {{ $nilai->uas }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                {{ $nilai->uam }}
                            </td>

                            <td class="px-4 py-4 text-center font-bold text-indigo-600">
                                {{ number_format($rata,1) }}
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-8 text-slate-400">

                                Belum ada nilai

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>



            <!-- HASIL SPK -->
            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- AKADEMIK -->
                <div class="bg-indigo-50 rounded-2xl p-6">

                    <h3 class="text-lg font-bold text-indigo-700 mb-4">
                        Akademik
                    </h3>

                    <div class="text-4xl font-bold text-indigo-600">

                        {{ number_format($totalRata / max($jumlahMapel,1),1) }}

                    </div>

                    <p class="text-slate-500 mt-2">
                        Rata-rata nilai raport
                    </p>

                </div>

                <!-- MINAT -->
                <div class="bg-green-50 rounded-2xl p-6">

                    <h3 class="text-lg font-bold text-green-700 mb-4">
                        Minat Dominan
                    </h3>

                    <div class="text-3xl font-bold text-green-600">

                        {{ $siswa->hasilMinat->hasil ?? '-' }}

                    </div>

                    <p class="text-slate-500 mt-2">
                        Hasil tes minat bakat
                    </p>

                </div>

                <!-- KEPRIBADIAN -->
                <div class="bg-orange-50 rounded-2xl p-6">

                    <h3 class="text-lg font-bold text-orange-700 mb-4">
                        Kepribadian Dominan
                    </h3>

                    <div class="text-3xl font-bold text-orange-600">

                        {{ $siswa->hasilKepribadian->hasil ?? '-' }}

                    </div>

                    <p class="text-slate-500 mt-2">
                        Hasil tes kepribadian
                    </p>

                </div>

            </div>

            <!-- TABEL PROMETHEE -->
            <div class="mt-10 bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-2xl font-bold text-slate-800 mb-6">
                    Hasil Perhitungan PROMETHEE
                </h2>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="bg-indigo-600 text-white">

                                <th class="px-4 py-4 text-left rounded-tl-2xl">
                                    Ranking
                                </th>

                                <th class="px-4 py-4 text-left">
                                    Jurusan
                                </th>

                                <th class="px-4 py-4 text-center">
                                    Leaving Flow
                                </th>

                                <th class="px-4 py-4 text-center">
                                    Entering Flow
                                </th>

                                <th class="px-4 py-4 text-center rounded-tr-2xl">
                                    Net Flow
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($ranking as $jurusan => $nilai)

                            <tr class="border-b hover:bg-slate-50">

                                <td class="px-4 py-4">

                                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">

                                        {{ $loop->iteration }}

                                    </div>

                                </td>

                                <td class="px-4 py-4 font-semibold text-slate-700">

                                    {{ $jurusan }}

                                    @if($loop->first)

                                    <span class="ml-2 text-sm text-green-600">
                                        (Rekomendasi Utama)
                                    </span>

                                    @endif

                                </td>

                                <td class="px-4 py-4 text-center">

                                    {{ number_format($leavingFlows[$jurusan],2) }}

                                </td>

                                <td class="px-4 py-4 text-center">

                                    {{ number_format($enteringFlows[$jurusan],2) }}

                                </td>

                                <td class="px-4 py-4 text-center font-bold text-indigo-600">

                                    {{ number_format($netFlows[$jurusan],2) }}

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- KESIMPULAN -->
            <div class="mt-10 bg-indigo-50 border border-indigo-100 rounded-3xl p-8">

                <h2 class="text-2xl font-bold text-indigo-700 mb-4">
                    Kesimpulan Rekomendasi Jurusan
                </h2>

                <p class="text-slate-600 leading-8 text-lg">

                    Berdasarkan hasil perhitungan metode
                    <span class="font-semibold text-indigo-600">
                        PROMETHEE
                    </span>,
                    siswa bernama

                    <span class="font-bold text-slate-800">
                        {{ $siswa->nama }}
                    </span>

                    memiliki rekomendasi jurusan utama yaitu

                    <span class="font-bold text-green-600">
                        {{ array_key_first($ranking) }}
                    </span>.

                    Hasil ini diperoleh dari proses penilaian beberapa kriteria seperti
                    nilai akademik, hasil minat bakat, dan hasil kepribadian siswa.

                    Jurusan tersebut memiliki nilai rekomendasi tertinggi dibandingkan
                    jurusan lainnya sehingga dinilai paling sesuai dengan kemampuan
                    dan karakter siswa.

                </p>

            </div>

        </div>

        @endif

    </div>

</body>

</html>