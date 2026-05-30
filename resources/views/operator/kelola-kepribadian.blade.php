<!DOCTYPE html>
<html>

<head>

    <title>Kelola Kepribadian</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    @include('operator.sidebar')

    <div class="flex-1 p-8">

        <div class="bg-white rounded-3xl shadow-sm p-8">

            <!-- HEADER -->
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5 mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-slate-800">
                        Kelola Kepribadian
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Input nilai kuisioner kepribadian siswa
                    </p>

                </div>

                <div class="flex flex-col md:flex-row gap-3">

                    <!-- TEMPLATE -->
                    <a
                        href="/operator/template-kepribadian"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-2xl transition shadow-sm text-center"
                    >
                        Download Template
                    </a>

                    <!-- IMPORT -->
                    <form
                        method="POST"
                        action="/operator/import-kepribadian"
                        enctype="multipart/form-data"
                        class="flex flex-col md:flex-row items-start md:items-center gap-3"
                    >

                        @csrf

                        <input
                            type="file"
                            name="file"
                            required
                            class="border border-slate-300 rounded-xl px-3 py-2 bg-white text-sm"
                        >

                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-2xl transition shadow-sm"
                        >
                            Import CSV
                        </button>

                    </form>

                </div>

            </div>

            <!-- ALERT -->
            @if(session('success'))

            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">

                {{ session('success') }}

            </div>

            @endif

            <!-- TABLE -->
            <form
                method="POST"
                action="/operator/simpan-kepribadian"
            >

                @csrf

                <div class="overflow-x-auto rounded-2xl border border-slate-200">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-100 text-slate-700">

                            <tr>

                                <th class="border-b px-4 py-4 text-center">
                                    No
                                </th>

                                <th class="border-b px-4 py-4 text-left min-w-[250px]">
                                    Nama
                                </th>

                                <th class="border-b px-4 py-4 text-center">
                                    NISN
                                </th>

                                @foreach($pertanyaans as $pertanyaan)

                                <th class="border-b px-4 py-4 text-center min-w-[90px]">

                                    <div class="font-bold text-indigo-600">
                                        {{ $loop->iteration }}
                                    </div>

                                </th>

                                @endforeach

                                <th class="border-b px-4 py-4 text-center min-w-[180px]">
                                    Hasil
                                </th>

                            </tr>

                        </thead>

                        <tbody class="bg-white">

                            @foreach($siswas as $siswa)

                            <tr class="hover:bg-slate-50 transition">

                                <!-- NO -->
                                <td class="border-b px-4 py-4 text-center text-slate-500">

                                    {{ $loop->iteration }}

                                </td>

                                <!-- NAMA -->
                                <td class="border-b px-4 py-4">

                                    <div class="font-semibold text-slate-700">
                                        {{ $siswa->nama }}
                                    </div>

                                </td>

                                <!-- NISN -->
                                <td class="border-b px-4 py-4 text-center text-slate-600">

                                    {{ $siswa->nisn }}

                                </td>

                                <!-- INPUT -->
                                @foreach($pertanyaans as $pertanyaan)

                                <td class="border-b px-2 py-3 text-center">

                                    <input
                                        type="number"
                                        min="1"
                                        max="4"
                                        value="{{ $jawabans[$siswa->id . '-' . $pertanyaan->id]->nilai ?? '' }}"
                                        name="jawaban[{{ $siswa->id }}][{{ $pertanyaan->id }}]"
                                        class="w-16 border border-slate-300 rounded-xl px-2 py-2 text-center outline-none focus:ring-2 focus:ring-indigo-400"
                                    >

                                </td>

                                @endforeach

                                <!-- HASIL -->
                                <td class="border-b px-4 py-4 text-center">

                                    @if($siswa->hasilKepribadian)

                                    <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">

                                        {{ $siswa->hasilKepribadian->hasil }}

                                    </span>

                                    @else

                                    <span class="text-slate-400">
                                        Belum Ada
                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <!-- BUTTON -->
                <div class="mt-8 flex justify-end">

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl transition shadow-sm font-medium"
                    >
                        Simpan Hasil
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>