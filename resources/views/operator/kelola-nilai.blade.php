<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Nilai</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    @include('operator.sidebar')

    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Kelola Nilai
            </h1>

            <p class="text-slate-500 mt-1">
                Data seluruh nilai siswa
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-slate-500">

                            <th class="text-left py-4">
                                No
                            </th>

                            <th class="text-left py-4">
                                Nama Siswa
                            </th>

                            <th class="text-left py-4">
                                Mapel
                            </th>

                            <th class="text-center py-4">
                                UTS
                            </th>

                            <th class="text-center py-4">
                                UAS
                            </th>

                            <th class="text-center py-4">
                                UAM
                            </th>

                            <th class="text-left py-4">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($nilais as $nilai)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-4">
                                {{ $nilai->siswa->nama }}
                            </td>

                            <td class="py-4">

                                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm">

                                    {{ $nilai->guru->mapel->nama_mapel }}

                                </span>

                            </td>

                            <form
                                method="POST"
                                action="/operator/edit-nilai/{{ $nilai->id }}"
                                id="nilaiForm-{{ $nilai->id }}">

                                @csrf
                                @method('PUT')

                                <!-- NILAI -->
                                <!-- UTS -->
                                <td class="py-4 text-center">

                                    <span
                                        id="utsText-{{ $nilai->id }}"
                                        class="font-bold text-indigo-600">
                                        {{ $nilai->uts }}
                                    </span>

                                    <input
                                        type="number"
                                        name="uts"
                                        value="{{ $nilai->uts }}"
                                        id="utsInput-{{ $nilai->id }}"
                                        class="hidden w-20 border border-slate-300 rounded-xl px-3 py-2 text-center">

                                </td>

                                <!-- UAS -->
                                <td class="py-4 text-center">

                                    <span
                                        id="uasText-{{ $nilai->id }}"
                                        class="font-bold text-green-600">
                                        {{ $nilai->uas }}
                                    </span>

                                    <input
                                        type="number"
                                        name="uas"
                                        value="{{ $nilai->uas }}"
                                        id="uasInput-{{ $nilai->id }}"
                                        class="hidden w-20 border border-slate-300 rounded-xl px-3 py-2 text-center">

                                </td>

                                <!-- UAM -->
                                <td class="py-4 text-center">

                                    <span
                                        id="uamText-{{ $nilai->id }}"
                                        class="font-bold text-orange-600">
                                        {{ $nilai->uam }}
                                    </span>

                                    <input
                                        type="number"
                                        name="uam"
                                        value="{{ $nilai->uam }}"
                                        id="uamInput-{{ $nilai->id }}"
                                        class="hidden w-20 border border-slate-300 rounded-xl px-3 py-2 text-center">

                                </td>

                            </form>

                            <!-- AKSI -->
                            <td class="py-4">

                                <div class="flex gap-2">

                                    <!-- EDIT -->
                                    <button
                                        type="button"
                                        id="editBtn-{{ $nilai->id }}"
                                        onclick="editNilai('{{ $nilai->id }}')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm">
                                        Edit
                                    </button>

                                    <!-- SIMPAN -->
                                    <button
                                        type="submit"
                                        form="nilaiForm-{{ $nilai->id }}"
                                        id="saveBtn-{{ $nilai->id }}"
                                        class="hidden bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                                        Simpan
                                    </button>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-10 text-slate-400">

                                Belum ada data nilai

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script>
        function editNilai(id) {
            // TEXT
            document.getElementById('utsText-' + id).classList.add('hidden');
            document.getElementById('uasText-' + id).classList.add('hidden');
            document.getElementById('uamText-' + id).classList.add('hidden');

            // INPUT
            document.getElementById('utsInput-' + id).classList.remove('hidden');
            document.getElementById('uasInput-' + id).classList.remove('hidden');
            document.getElementById('uamInput-' + id).classList.remove('hidden');

            // BUTTON
            document.getElementById('editBtn-' + id).classList.add('hidden');
            document.getElementById('saveBtn-' + id).classList.remove('hidden');
        }
    </script>

</body>

</html>