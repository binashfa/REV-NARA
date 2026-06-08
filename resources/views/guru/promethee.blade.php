<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROMETHEE</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-slate-100 min-h-screen">

    @include('guru.sidebar')

    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div
            class="bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]
               rounded-[32px] p-8 mb-8 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <span
                        class="inline-flex items-center gap-2
                           bg-white/40 text-[#105666]
                           px-4 py-2 rounded-full
                           text-xs font-bold">

                        <i class="fa-solid fa-ranking-star"></i>

                        Sistem Pendukung Keputusan

                    </span>

                    <h1 class="text-4xl font-black text-[#105666] mt-4">

                        Metode PROMETHEE

                    </h1>

                    <p class="text-[#105666]/70 mt-2">

                        Perhitungan rekomendasi jurusan siswa

                    </p>

                </div>

                <form method="GET">

                    <select
                        name="siswa_id"
                        onchange="this.form.submit()"
                        class="w-72 border rounded-2xl px-4 py-3">

                        <option value="">
                            Pilih Siswa
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

        <!-- IDENTITAS -->
        <div class="bg-white rounded-3xl shadow-sm p-6 mb-8">

            <div class="flex items-center gap-3">

                <h2 class="text-2xl font-bold text-[#105666]">

                    {{ $siswa->nama }}

                </h2>

            </div>

            <p class="text-gray-500 mt-2">

                NISN : {{ $siswa->nisn }}

            </p>

            <p class="text-gray-500">

                Jenis Kelamin : {{ $siswa->jenis_kelamin }}

            </p>

        </div>

        <!-- INFORMASI PROMETHEE -->
        <div class="bg-white rounded-3xl shadow-sm mb-8">

            <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl">

                <h2 class="text-white text-xl font-black">
                    Informasi Metode PROMETHEE
                </h2>

            </div>

            <div class="p-8 space-y-8">

                <!-- ALTERNATIF -->
                <div class="grid md:grid-cols-2 gap-6">

                    <!-- ALTERNATIF -->
                    <div class="bg-slate-50 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-[#105666] mb-4">
                            4.2.1 Alternatif
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                            <div class="bg-white rounded-xl p-3 text-center font-semibold text-[#105666]">
                                A1 = IPA
                            </div>

                            <div class="bg-white rounded-xl p-3 text-center font-semibold text-[#105666]">
                                A2 = IPS
                            </div>

                            <div class="bg-white rounded-xl p-3 text-center font-semibold text-[#105666]">
                                A3 = TKJ
                            </div>

                            <div class="bg-white rounded-xl p-3 text-center font-semibold text-[#105666]">
                                A4 = DKV
                            </div>

                            <div class="bg-white rounded-xl p-3 text-center font-semibold text-[#105666]">
                                A5 = Akuntansi
                            </div>

                            <div class="bg-white rounded-xl p-3 text-center font-semibold text-[#105666]">
                                A6 = Ponpes
                            </div>

                        </div>

                    </div>

                    <!-- KRITERIA -->
                    <div class="bg-slate-50 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-[#105666] mb-4">
                            4.2.2 Kriteria
                        </h3>

                        <div class="space-y-3">

                            <div>C1 = Akademik (G1)</div>
                            <div>C2 = Minat (G2)</div>
                            <div>C3 = Kepribadian (G3)</div>

                        </div>

                    </div>

                </div>

                <!-- BOBOT KRITERIA -->
                <div>

                    <h3 class="text-lg font-bold text-[#105666] mb-5">
                        4.2.3 Bobot Kriteria
                    </h3>

                    <div class="grid md:grid-cols-3 gap-6">

                        <!-- C1 -->
                        <div class="bg-slate-50 rounded-2xl overflow-hidden">

                            <div class="bg-[#105666] text-white px-4 py-3 font-bold text-center">
                                C1 - Akademik
                            </div>

                            <table class="w-full text-sm">

                                <tr class="border-b">
                                    <td class="p-3">≥ 90</td>
                                    <td class="p-3 text-center">5</td>
                                </tr>

                                <tr class="border-b">
                                    <td class="p-3">85 - 89</td>
                                    <td class="p-3 text-center">4</td>
                                </tr>

                                <tr class="border-b">
                                    <td class="p-3">80 - 84</td>
                                    <td class="p-3 text-center">3</td>
                                </tr>

                                <tr class="border-b">
                                    <td class="p-3">75 - 79</td>
                                    <td class="p-3 text-center">2</td>
                                </tr>

                                <tr>
                                    <td class="p-3">&lt; 75</td>
                                    <td class="p-3 text-center">1</td>
                                </tr>

                            </table>

                        </div>

                        <!-- C2 -->
                        <div class="bg-slate-50 rounded-2xl overflow-hidden">

                            <div class="bg-[#839958] text-white px-4 py-3 font-bold text-center">C2 - Minat</div>

                            <table class="w-full text-sm">
                                <tr class="border-b">
                                    <td class="p-3">≥ 3.5</td>
                                    <td class="p-3 text-center">5</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3">3.0 - 3.49</td>
                                    <td class="p-3 text-center">4</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3">2.5 - 2.99</td>
                                    <td class="p-3 text-center">3</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3">2.0 - 2.49</td>
                                    <td class="p-3 text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="p-3">&lt; 2</td>
                                    <td class="p-3 text-center">1</td>
                                </tr>
                            </table>
                        </div>

                        <!-- C3 -->
                        <div class="bg-slate-50 rounded-2xl overflow-hidden">
                            <div class="bg-[#D3968C] text-white px-4 py-3 font-bold text-center">C3 - Kepribadian</div>

                            <table class="w-full text-sm">
                                <tr class="border-b">
                                    <td class="p-3">≥ 3.5</td>
                                    <td class="p-3 text-center">5</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3">3.0 - 3.49</td>
                                    <td class="p-3 text-center">4</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3">2.5 - 2.99</td>
                                    <td class="p-3 text-center">3</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3">2.0 - 2.49</td>
                                    <td class="p-3 text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="p-3">&lt; 2</td>
                                    <td class="p-3 text-center">1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm mb-8">

            <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl">
                <h2 class="text-white text-xl font-black">Perhitungan Nilai Akademik Per Mapel</h2>
            </div>

            <div class="p-8">

                <h3 class="font-bold text-[#105666] mb-4">Rumus</h3>

                <div class="text-center text-2xl font-bold mb-8">
                    (UTS + UAS + UAM)
                    <hr class="w-48 mx-auto border-black">3
                </div>

                <h3 class="font-bold text-[#105666] mb-4">Hasil Per Mapel</h3>

                <div class="overflow-x-auto">

                    <table class="w-full border">
                        <thead>
                            <tr class="bg-slate-100">
                                <th class="border px-4 py-3">Mapel</th>
                                <th class="border px-4 py-3">UTS</th>
                                <th class="border px-4 py-3">UAS</th>
                                <th class="border px-4 py-3">UAM</th>
                                <th class="border px-4 py-3">Nilai</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($nilaiPerMapel as $item)
                            <tr>
                                <td class="border px-4 py-3">{{ $item['mapel'] }}</td>
                                <td class="border px-4 py-3 text-center">{{ $item['uts'] }}</td>
                                <td class="border px-4 py-3 text-center">{{ $item['uas'] }}</td>
                                <td class="border px-4 py-3 text-center">{{ $item['uam'] }}</td>
                                <td class="border px-4 py-3 text-center font-semibold text-[#105666]">{{ number_format($item['nilai'],2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm mb-8">
            <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl">
                <h2 class="text-white text-xl font-black">Nilai Akademik Per Jurusan</h2>
            </div>

            <div class="p-6 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-3">Jurusan</th>
                            <th class="text-center py-3">Sumber Nilai Rata - rata</th>
                            <th class="text-center py-3">Nilai Akademik</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($nilaiAkademikJurusan as $jurusan => $nilai)

                        <tr class="border-b">
                            <td class="py-3 font-semibold">{{ $jurusan }}</td>
                            <td class="text-center text-slate-500">
                                @switch($jurusan)
                                @case('IPA')
                                Matematika + IPA + Bahasa Indonesia
                                @break
                                @case('IPS')
                                IPS + PPKN + Bahasa Inggris
                                @break
                                @case('TKJ')
                                TIK + Matematika + Bahasa Inggris
                                @break
                                @case('DKV')
                                Seni Budaya + Matematika + Bahasa Indonesia
                                @break
                                @case('AKUNTANSI')
                                Matematika + Bahasa Indonesia + Bahasa Inggris
                                @break
                                @case('PONPES')
                                Bahasa Arab + BTQ + Bahasa Indonesia
                                @break
                                @endswitch
                            </td>
                            <td class="text-center font-bold text-[#105666]">{{ number_format($nilai,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-3xl shadow-sm mb-8">
                <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl">
                    <h2 class="text-white text-xl font-black">Perhitungan Minat (G2)</h2>
                </div>

                <div class="p-6 overflow-x-auto">

                    <table class="w-full border">

                        <thead>
                            <tr class="bg-slate-100">
                                <th class="border px-4 py-3">Jurusan</th>
                                <th class="border px-4 py-3">Nilai Awal</th>
                                <th class="border px-4 py-3">Bobot</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                            $minats = [
                            'IPA' => $siswa->hasilMinat->ipa ?? 0,
                            'IPS' => $siswa->hasilMinat->ips ?? 0,
                            'TKJ' => $siswa->hasilMinat->tkj ?? 0,
                            'DKV' => $siswa->hasilMinat->dkv ?? 0,
                            'Akuntansi' => $siswa->hasilMinat->akuntansi ?? 0,
                            'Ponpes' => $siswa->hasilMinat->pondok_pesantren ?? 0,
                            ];
                            @endphp

                            @foreach($minats as $jurusan => $nilai)

                            @php

                            if($nilai >= 7){
                            $bobot = 5;
                            }elseif($nilai == 6){
                            $bobot = 4;
                            }elseif($nilai == 5){
                            $bobot = 3;
                            }elseif($nilai == 4){
                            $bobot = 2;
                            }else{
                            $bobot = 1;
                            }

                            @endphp

                            <tr>
                                <td class="border px-4 py-3">{{ $jurusan }}</td>
                                <td class="border px-4 py-3 text-center">{{ $nilai }}</td>
                                <td class="border px-4 py-3 text-center font-bold text-[#839958]">{{ $bobot }}</td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-sm mb-8">

                <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl">
                    <h2 class="text-white text-xl font-black">Perhitungan Kepribadian (G3)</h2>
                </div>

                <div class="p-6 overflow-x-auto">

                    <table class="w-full border">

                        <thead>
                            <tr class="bg-slate-100">
                                <th class="border px-4 py-3">Jurusan</th>
                                <th class="border px-4 py-3">Nilai Awal</th>
                                <th class="border px-4 py-3">Bobot</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                            $kepribadian = [
                            'IPA' => $siswa->hasilKepribadian->ipa ?? 0,
                            'IPS' => $siswa->hasilKepribadian->ips ?? 0,
                            'TKJ' => $siswa->hasilKepribadian->tkj ?? 0,
                            'DKV' => $siswa->hasilKepribadian->dkv ?? 0,
                            'Akuntansi' => $siswa->hasilKepribadian->akuntansi ?? 0,
                            'Ponpes' => $siswa->hasilKepribadian->pondok_pesantren ?? 0,
                            ];
                            @endphp

                            @foreach($kepribadian as $jurusan => $nilai)

                            @php

                            if($nilai >= 3.5){
                            $bobot = 5;
                            }elseif($nilai >= 3.0){
                            $bobot = 4;
                            }elseif($nilai >= 2.5){
                            $bobot = 3;
                            }elseif($nilai >= 2.0){
                            $bobot = 2;
                            }else{
                            $bobot = 1;
                            }

                            @endphp

                            <tr>
                                <td class="border px-4 py-3">{{ $jurusan }}</td>
                                <td class="border px-4 py-3 text-center">{{ number_format($nilai, 2) }}</td>
                                <td class="border px-4 py-3 text-center font-bold text-[#D3968C]">{{ $bobot }}</td>
                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

        <!-- KONVERSI BOBOT -->
        <div class="bg-white rounded-3xl shadow-sm mb-8">
            <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl">
                <h2 class="text-white text-xl font-black">
                    Konversi Bobot Alternatif
                </h2>
            </div>

            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-slate-100">
                                <th class="border px-4 py-3">Alternatif</th>
                                <th class="border px-4 py-3">C1 (Akademik)</th>
                                <th class="border px-4 py-3">C2 (Minat)</th>
                                <th class="border px-4 py-3">C3 (Kepribadian)</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($alternatif as $jurusan => $nilai)
                            <tr>
                                <td class="border px-4 py-3 font-semibold">{{ $jurusan }}</td>
                                <td class="border px-4 py-3 text-center">{{ $akademikJurusan[$jurusan] }}</td>
                                <td class="border px-4 py-3 text-center">{{ $nilai['minat'] }}</td>
                                <td class="border px-4 py-3 text-center">{{ $nilai['kepribadian'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- NILAI PREFERENSI KRITERIA -->
        <div class="bg-white rounded-3xl shadow-sm mb-8">

            <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl flex justify-between items-center">

                <h2 class="text-white text-xl font-black">
                    Perhitungan Nilai Preferensi Kriteria
                </h2>

                <button
                    onclick="openInfoPreferensi()"
                    class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center">
                    <i class="fa-solid fa-circle-info"></i>
                </button>

            </div>

            <div class="p-6 overflow-x-auto">

                <table class="w-full border">

                    <thead>

                        <tr class="bg-slate-100">

                            <th class="border px-4 py-3">
                                Alternatif
                            </th>

                            @foreach($alternatif as $jurusan => $v)
                            <th class="border px-4 py-3">
                                {{ $jurusan }}
                            </th>
                            @endforeach

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($preferensi as $a => $row)

                        <tr>

                            <td class="border px-4 py-3 font-bold">
                                {{ $a }}
                            </td>

                            @foreach($row as $b => $nilai)

                            <td class="border px-4 py-3 text-center">

                                {{ $a == $b ? '-' : number_format($nilai, 2) }}

                            </td>

                            @endforeach

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <!-- HASIL PROMETHEE -->
        <div class="bg-white rounded-3xl shadow-sm mb-8">

            <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-8 py-5 rounded-t-3xl flex justify-between items-center">

                <h2 class="text-white text-xl font-black">
                    Hasil Perhitungan PROMETHEE
                </h2>

                <button
                    onclick="openInfoPromethee()"
                    class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 text-white transition flex items-center justify-center">
                    <i class="fa-solid fa-circle-info"></i>
                </button>

            </div>

            <div class="p-6 overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th>Jurusan</th>

                            <th class="text-center">
                                Leaving Flow
                            </th>

                            <th class="text-center">
                                Entering Flow
                            </th>

                            <th class="text-center">
                                Net Flow
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($ranking as $jurusan => $nilai)

                        <tr class="border-b">

                            <td class="py-3">
                                {{ $jurusan }}
                            </td>

                            <td class="text-center">
                                {{ number_format($leavingFlows[$jurusan],2) }}
                            </td>

                            <td class="text-center">
                                {{ number_format($enteringFlows[$jurusan],2) }}
                            </td>

                            <td class="text-center font-bold text-[#105666]">
                                {{ number_format($netFlows[$jurusan],2) }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <!-- RANKING -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">

            @foreach($ranking as $jurusan => $nilai)

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between">

                    <h3 class="font-bold">
                        {{ $jurusan }}
                    </h3>

                    <span>
                        #{{ $loop->iteration }}
                    </span>

                </div>

                <h1 class="text-4xl font-black text-[#105666] mt-4">
                    {{ number_format($nilai,2) }}
                </h1>

                @if($loop->first)
                <p class="text-green-600 text-sm mt-2">
                    Rekomendasi Utama
                </p>
                @endif
            </div>
            @endforeach

        </div>

        <!-- KESIMPULAN -->
        <div class="bg-gradient-to-r from-[#F7F4D5] to-[#e9f0d0] rounded-3xl p-8 shadow-sm">

            <h2 class="text-2xl font-black text-[#105666] mb-4">
                Kesimpulan
            </h2>

            <p class="text-gray-700 leading-8">

                Berdasarkan hasil perhitungan metode <strong>PROMETHEE</strong> menggunakan kriteria <strong>Akademik</strong>, <strong>Minat</strong>, dan <strong>Kepribadian</strong>, siswa
                <strong>{{ $siswa->nama }}</strong> memperoleh nilai Net Flow tertinggi pada jurusan

                <strong class="text-green-600">
                    {{ array_key_first($ranking) }}
                </strong>

                sehingga jurusan tersebut menjadi rekomendasi utama yang paling sesuai dengan kemampuan akademik, minat, dan karakter siswa.
            </p>

        </div>
        @endif

    </main>

    @include('guru.promethee-panduan')

    <script>
        function openInfoPromethee() {

            document
                .getElementById('modalInfoPromethee')
                .classList.remove('hidden');

            document
                .getElementById('modalInfoPromethee')
                .classList.add('flex');
        }

        function closeInfoPromethee() {

            document
                .getElementById('modalInfoPromethee')
                .classList.remove('flex');

            document
                .getElementById('modalInfoPromethee')
                .classList.add('hidden');
        }

        function openInfoPreferensi() {

            document
                .getElementById('modalInfoPreferensi')
                .classList.remove('hidden');

            document
                .getElementById('modalInfoPreferensi')
                .classList.add('flex');
        }

        function closeInfoPreferensi() {

            document
                .getElementById('modalInfoPreferensi')
                .classList.remove('flex');

            document
                .getElementById('modalInfoPreferensi')
                .classList.add('hidden');
        }
    </script>
</body>

</html>