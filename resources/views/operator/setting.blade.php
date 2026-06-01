<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Operator</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased">

<!-- SIDEBAR -->
<div class="fixed top-0 left-0 z-50">
    @include('operator.sidebar')
</div>

<!-- MAIN -->
<main class="ml-[270px] min-h-screen px-6 pt-10 pb-10">

    <!-- HERO -->
    <div class="mb-10">
        <div class="relative overflow-hidden rounded-[32px] p-8 md:p-10 flex items-center justify-between
            shadow-sm hover:shadow-lg transition-all duration-300
            bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

            <!-- TOP BORDER -->
            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <!-- GLOW -->
            <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

            <!-- TEXT -->
            <div class="relative z-10 space-y-3">

                <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-xs font-bold border">
                    <i class="fa-solid fa-gear text-[#839958]"></i>
                    Pengaturan
                </span>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                    Setting Operator
                </h1>

                <p class="text-[#105666]/70 text-sm">
                    Kelola informasi akun operator ⚙️
                </p>

            </div>

            <!-- ICON -->
            <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl 
                shadow-inner items-center justify-center border 
                transform rotate-6 hover:rotate-0 transition duration-300">

                <i class="fa-solid fa-gear text-[#105666] text-3xl"></i>
            </div>

        </div>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-6 bg-[#839958]/20 border border-[#839958]/40 text-[#5f713f] px-5 py-4 rounded-2xl">
        {{ session('success') }}
    </div>
    @endif

<!-- CARD -->
<div class="bg-white rounded-[32px] shadow-sm p-8 w-full border border-gray-100 relative overflow-hidden">

    <!-- TOP LINE -->
    <div class="absolute top-0 left-0 w-full h-[4px] 
        bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

    <form method="POST" action="/operator/update-setting">
        @csrf

        <!-- USERNAME -->
        <div class="mb-5">
            <label class="block mb-2 text-sm font-semibold text-[#105666]">
                Username
            </label>

            <input
                type="text"
                name="username"
                value="{{ auth()->user()->username }}"
                class="w-full border border-gray-200 rounded-2xl px-5 py-4 
                outline-none bg-white
                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
        </div>

        <!-- NAMA -->
        <div class="mb-5">
            <label class="block mb-2 text-sm font-semibold text-[#105666]">
                Nama Operator
            </label>

            <input
                type="text"
                name="nama"
                value="{{ $operator->nama }}"
                class="w-full border border-gray-200 rounded-2xl px-5 py-4 
                outline-none bg-white
                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
        </div>

        <!-- PASSWORD -->
        <div class="mb-5">
            <label class="block mb-2 text-sm font-semibold text-[#105666]">
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                placeholder="Kosongkan jika tidak ingin mengganti password"
                class="w-full border border-gray-200 rounded-2xl px-5 py-4 
                outline-none bg-white
                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
        </div>

        <!-- CONFIRM -->
        <div class="mb-6">
            <label class="block mb-2 text-sm font-semibold text-[#105666]">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                placeholder="Ulangi password baru"
                class="w-full border border-gray-200 rounded-2xl px-5 py-4 
                outline-none bg-white
                focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="bg-[#105666] hover:bg-[#0c4a56] text-white px-8 py-4 rounded-2xl 
                transition-all duration-300 shadow-md 
                hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

</main>

</body>
</html>