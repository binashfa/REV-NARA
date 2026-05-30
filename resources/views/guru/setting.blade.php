<!DOCTYPE html>
<html>

<head>

    <title>Setting Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100">

    @include('guru.sidebar')

    <div class="p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Setting Guru
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola akun dan profil guru
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm p-8 max-w-2xl">

            @if(session('success'))

            <div class="mb-6 bg-green-100 text-green-700 px-5 py-4 rounded-2xl">

                {{ session('success') }}

            </div>

            @endif

            <form
                method="POST"
                action="/guru/update-setting"
                class="space-y-6">

                @csrf

                <!-- NAMA -->
                <div>

                    <label class="block text-sm font-semibold text-slate-600 mb-2">

                        Nama Guru

                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ $guru->nama }}"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- USERNAME -->
                <div>

                    <label class="block text-sm font-semibold text-slate-600 mb-2">

                        Username

                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ Auth::user()->username }}"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- PASSWORD -->
                <div>

                    <label class="block text-sm font-semibold text-slate-600 mb-2">

                        Password Baru

                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Kosongkan jika tidak diubah"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- KONFIRMASI -->
                <div>

                    <label class="block text-sm font-semibold text-slate-600 mb-2">

                        Konfirmasi Password

                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- BUTTON -->
                <div class="pt-4">

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold transition">

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>