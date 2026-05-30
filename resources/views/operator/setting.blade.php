<!DOCTYPE html>
<html>

<head>

    <title>Setting Operator</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 flex">

    @include('operator.sidebar')

    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Setting Operator
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola informasi akun operator
            </p>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 px-5 py-4 rounded-2xl mb-6">

            {{ session('success') }}

        </div>

        @endif

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm p-8 max-w-3xl">

            <form
                method="POST"
                action="/operator/update-setting">

                @csrf

                <!-- USERNAME -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-slate-600">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ auth()->user()->username }}"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- NAMA -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-slate-600">
                        Nama Operator
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ $operator->nama }}"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- PASSWORD -->
                <div class="mb-8">

                    <label class="block mb-2 font-medium text-slate-600">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Kosongkan jika tidak ingin mengganti password"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="mb-8">

                    <label class="block mb-2 font-medium text-slate-600">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-400">

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end">

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl transition shadow-sm">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>