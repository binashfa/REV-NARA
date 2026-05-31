<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">

<style>

body{
    font-family: sans-serif;
    font-size: 13px;
    color:#1e293b;
}

h1,h2{
    margin:0;
}

/* HEADER */
.title{
    text-align:center;
    margin-bottom:25px;
    padding-bottom:10px;
    border-bottom:3px solid #839958;
}

.title h1{
    color:#105666;
}

/* BOX */
.box{
    border-radius:10px;
    padding:14px;
    margin-bottom:18px;
    border:1px solid #e2e8f0;
}

/* VARIAN WARNA */
.box-teal{
    background:#eef7f6;
    border-left:6px solid #105666;
}

.box-green{
    background:#f4f8ed;
    border-left:6px solid #839958;
}

.box-pink{
    background:#fff2f1;
    border-left:6px solid #D3968C;
}

.box-white{
    background:#ffffff;
}

/* TITLE */
.section-title{
    margin-bottom:8px;
    font-weight:bold;
    color:#105666;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th{
    background:#105666;
    color:white;
    padding:8px;
    font-size:12px;
    border:1px solid #e5e7eb;
}

td{
    border:1px solid #e5e7eb;
    padding:7px;
    color:#1e293b;
}

.text-center{
    text-align:center;
}

/* BADGE */
.badge{
    display:inline-block;
    padding:3px 8px;
    border-radius:12px;
    background:#fde8e6;
    color:#D3968C;
    font-size:10px;
    margin-left:5px;
}

/* TEXT COLOR */
.teal{ color:#105666; font-weight:bold; }
.green{ color:#839958; font-weight:bold; }
.pink{ color:#D3968C; font-weight:bold; }

/* 🔥 PAGE BREAK FIX */
.page-break{
    page-break-before: always;
}

.no-break{
    page-break-inside: avoid;
}

</style>

</head>

<body>

<!-- HEADER -->
<div class="title">
    <h1>RAPORT SISWA</h1>
    <p>Sistem Pendukung Keputusan Jurusan Metode PROMETHEE</p>
</div>

<!-- IDENTITAS -->
<div class="box box-teal">
    <h2 class="section-title">Identitas Siswa</h2>

    <p>Nama : <span class="teal">{{ $siswa->nama }}</span></p>
    <p>NISN : {{ $siswa->nisn }}</p>
    <p>Jenis Kelamin : {{ $siswa->jenis_kelamin }}</p>
</div>

<!-- NILAI -->
<div class="box box-white">
    <h2 class="section-title">Data Nilai</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>UAM</th>
                <th>Rata-rata</th>
            </tr>
        </thead>

        <tbody>

            @php
            $total = 0;
            $jumlah = count($siswa->nilais);
            @endphp

            @foreach($siswa->nilais as $nilai)

            @php
            $rata = (($nilai->uts ?? 0)+($nilai->uas ?? 0)+($nilai->uam ?? 0))/3;
            $total += $rata;
            @endphp

            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $nilai->mapel->nama_mapel }}</td>
                <td class="text-center">{{ $nilai->uts }}</td>
                <td class="text-center">{{ $nilai->uas }}</td>
                <td class="text-center">{{ $nilai->uam }}</td>
                <td class="text-center teal">{{ number_format($rata,1) }}</td>
            </tr>

            @endforeach

        </tbody>
    </table>

</div>

<!-- HASIL -->
<div class="box box-green">
    <h2 class="section-title">Hasil Pendukung SPK</h2>

    <p>
        Akademik :
        <span class="teal">
            {{ number_format($total / max($jumlah,1),1) }}
        </span>
    </p>

    <p>
        Minat Dominan :
        <span class="green">
            {{ $siswa->hasilMinat->hasil ?? '-' }}
        </span>
    </p>

    <p>
        Kepribadian Dominan :
        <span class="pink">
            {{ $siswa->hasilKepribadian->hasil ?? '-' }}
        </span>
    </p>

</div>

<!-- 🔥 PROMETHEE PINDAH HALAMAN -->
<div class="box box-white page-break no-break">

    <h2 class="section-title">Hasil Perhitungan PROMETHEE</h2>

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Jurusan</th>
                <th>Leaving Flow</th>
                <th>Entering Flow</th>
                <th>Net Flow</th>
            </tr>
        </thead>

        <tbody>

            @foreach($ranking as $jurusan => $nilai)

            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>

                <td>
                    {{ $jurusan }}

                    @if($loop->first)
                    <span class="badge">Rekomendasi</span>
                    @endif
                </td>

                <td class="text-center">{{ number_format($leavingFlows[$jurusan],2) }}</td>
                <td class="text-center">{{ number_format($enteringFlows[$jurusan],2) }}</td>
                <td class="text-center teal">{{ number_format($netFlows[$jurusan],2) }}</td>
            </tr>

            @endforeach

        </tbody>
    </table>

</div>

<!-- KESIMPULAN -->
<div class="box box-pink no-break">
    <h2 class="section-title">Kesimpulan</h2>

    <p>
        Berdasarkan metode PROMETHEE, siswa
        <span class="teal">{{ $siswa->nama }}</span>
        direkomendasikan ke jurusan
        <span class="green">{{ array_key_first($ranking) }}</span>.
    </p>

</div>

</body>

</html>