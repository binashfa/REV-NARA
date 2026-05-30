<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswa([

            'nisn' => $row['nisn'],

            'nama' => $row['nama'],

            'jenis_kelamin' => $row['jenis_kelamin']

        ]);
    }
}