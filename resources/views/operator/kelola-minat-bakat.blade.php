<!DOCTYPE html>
<html>

<head>

    <title>Kelola Minat Bakat</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    @include('operator.sidebar')

    <div class="flex-1 p-8">

        <div class="bg-white rounded-3xl shadow-sm p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-slate-800">
                    Kelola Minat Bakat
                </h1>

                <p class="text-slate-500 mt-2">
                    Input nilai kuisioner siswa
                </p>

                <div class="flex gap-3 mb-6">

                    <a
                        href="/operator/template-minat-bakat"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-2xl">
                        Download Template
                    </a>

                    <form
                        method="POST"
                        action="/operator/import-minat-bakat"
                        enctype="multipart/form-data">

                        @csrf

                        <input
                            type="file"
                            name="file"
                            required
                            class="mb-3">

                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-2xl">
                            Import CSV
                        </button>

                    </form>

                </div>

            </div>

            <form
                method="POST"
                action="/operator/simpan-minat-bakat">

                @csrf

                <div class="overflow-x-auto">

                    <table class="w-full border border-slate-200">

                        <thead class="bg-slate-100">

                            <tr>

                                <th class="border px-4 py-3">
                                    No
                                </th>

                                <th class="border px-4 py-3 min-w-[250px]">
                                    Nama
                                </th>

                                <th class="border px-4 py-3">
                                    NISN
                                </th>

                                @foreach($pertanyaans as $pertanyaan)

                                <th class="border px-4 py-3 text-center">
                                    {{ $loop->iteration }}
                                </th>

                                @endforeach

                                <th class="border px-4 py-3 text-center">
                                    Hasil
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($siswas as $siswa)

                            <tr class="hover:bg-slate-50">

                                <td class="border px-4 py-3 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $siswa->nama }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $siswa->nisn }}
                                </td>

                                @foreach($pertanyaans as $pertanyaan)

                                <td class="border px-2 py-2">

                                    <input
                                        type="number"
                                        min="1"
                                        max="4"
                                        required
                                        value="{{ $jawabans[$siswa->id . '-' . $pertanyaan->id]->nilai ?? '' }}"
                                        name="jawaban[{{ $siswa->id }}][{{ $pertanyaan->id }}]"
                                        class="w-16 border border-slate-300 rounded-lg px-2 py-1 text-center outline-none focus:ring-2 focus:ring-indigo-400">

                                </td>

                                @endforeach

                                
                                <td class="border px-4 py-3 text-center font-bold text-indigo-600">

                                    {{ $siswa->hasilMinat->hasil ?? 'Belum Ada' }}

                                </td>


                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-8 flex justify-end">

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl">
                        Simpan Hasil
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>