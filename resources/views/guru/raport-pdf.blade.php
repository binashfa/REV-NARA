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

        h1,h2,h3{
            margin:0;
        }

        .title{
            text-align:center;
            margin-bottom:30px;
        }

        .box{
            border:1px solid #cbd5e1;
            border-radius:10px;
            padding:15px;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        th{
            background:#4f46e5;
            color:white;
            padding:10px;
            border:1px solid #ddd;
        }

        td{
            border:1px solid #ddd;
            padding:8px;
        }

        .text-center{
            text-align:center;
        }

        .badge{
            display:inline-block;
            padding:4px 10px;
            border-radius:20px;
            background:#dcfce7;
            color:#166534;
            font-size:12px;
        }

        .ranking{
            width:30px;
            height:30px;
            border-radius:50%;
            background:#4f46e5;
            color:white;
            text-align:center;
            line-height:30px;
            font-weight:bold;
            display:inline-block;
        }

    </style>

</head>

<body>

    <!-- JUDUL -->
    <div class="title">

        <h1>
            RAPORT SISWA
        </h1>

        <p>
            Sistem Pendukung Keputusan Jurusan Metode PROMETHEE
        </p>

    </div>

    <!-- IDENTITAS -->
    <div class="box">

        <h2>
            Identitas Siswa
        </h2>

        <p>
            Nama :
            {{ $siswa->nama }}
        </p>

        <p>
            NISN :
            {{ $siswa->nisn }}
        </p>

        <p>
            Jenis Kelamin :
            {{ $siswa->jenis_kelamin }}
        </p>

    </div>

    <!-- NILAI -->
    <div class="box">

        <h2>
            Data Nilai
        </h2>

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

                $rata = (
                    ($nilai->uts ?? 0) +
                    ($nilai->uas ?? 0) +
                    ($nilai->uam ?? 0)
                ) / 3;

                $total += $rata;

                @endphp

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $nilai->mapel->nama_mapel }}
                    </td>

                    <td class="text-center">
                        {{ $nilai->uts }}
                    </td>

                    <td class="text-center">
                        {{ $nilai->uas }}
                    </td>

                    <td class="text-center">
                        {{ $nilai->uam }}
                    </td>

                    <td class="text-center">
                        {{ number_format($rata,1) }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <!-- HASIL -->
    <div class="box">

        <h2>
            Hasil Pendukung SPK
        </h2>

        <p>

            Akademik :
            <strong>
                {{ number_format($total / max($jumlah,1),1) }}
            </strong>

        </p>

        <p>

            Minat Dominan :
            <strong>
                {{ $siswa->hasilMinat->hasil ?? '-' }}
            </strong>

        </p>

        <p>

            Kepribadian Dominan :
            <strong>
                {{ $siswa->hasilKepribadian->hasil ?? '-' }}
            </strong>

        </p>

    </div>

    <!-- PROMETHEE -->
    <div class="box">

        <h2>
            Hasil Perhitungan PROMETHEE
        </h2>

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

                    <td class="text-center">

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        {{ $jurusan }}

                        @if($loop->first)

                        <span class="badge">
                            Rekomendasi Utama
                        </span>

                        @endif

                    </td>

                    <td class="text-center">

                        {{ number_format($leavingFlows[$jurusan],2) }}

                    </td>

                    <td class="text-center">

                        {{ number_format($enteringFlows[$jurusan],2) }}

                    </td>

                    <td class="text-center">

                        {{ number_format($netFlows[$jurusan],2) }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <!-- KESIMPULAN -->
    <div class="box">

        <h2>
            Kesimpulan
        </h2>

        <p>

            Berdasarkan hasil perhitungan metode PROMETHEE,
            siswa bernama

            <strong>
                {{ $siswa->nama }}
            </strong>

            direkomendasikan masuk jurusan

            <strong>
                {{ array_key_first($ranking) }}
            </strong>

            karena memiliki nilai Net Flow tertinggi dibanding jurusan lainnya.

        </p>

    </div>

</body>

</html>