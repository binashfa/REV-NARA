<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen">

@include('guru.sidebar')

<main class="max-w-7xl mx-auto px-4 md:px-6 pt-8 pb-16">

    <!-- HEADER -->
    <header class="mb-8 md:mb-12">
        <div class="w-full bg-gradient-to-br from-[#105666] to-[#0d4b59] 
                    rounded-[24px] md:rounded-[32px] 
                    p-6 md:p-12 
                    flex items-center justify-between 
                    shadow-xl relative overflow-hidden
                    transition-all duration-300
                    hover:shadow-2xl hover:-translate-y-[2px]">

            <!-- GLOW -->
            <div class="absolute top-0 right-0 w-60 h-60 md:w-80 md:h-80 bg-[#839958]/20 rounded-full blur-3xl -mr-10 -mt-10 md:-mr-20 md:-mt-20"></div>
            <div class="absolute bottom-0 left-1/4 md:left-1/3 w-40 h-40 md:w-60 md:h-60 bg-[#D3968C]/20 rounded-full blur-3xl"></div>

            <!-- TEXT -->
            <div class="relative z-10 space-y-3 md:space-y-4">

                <!-- BADGE -->
                <span class="inline-flex items-center gap-2 
                            bg-white/10 text-[#F7F4D5] 
                            text-[10px] md:text-xs font-semibold 
                            px-3 py-1.5 rounded-full 
                            backdrop-blur-sm tracking-wider uppercase shadow-sm">

                    <i class="fa-solid fa-gear text-[#839958] animate-spin"></i>
                    Pengaturan

                </span>

                <!-- TITLE -->
                <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    Setting Guru
                </h1>

                <!-- DESC -->
                <p class="text-gray-200 text-xs md:text-sm lg:text-base font-medium max-w-md leading-relaxed">
                    Kelola akun dan profil guru dengan mudah dalam satu dashboard.
                </p>

            </div>

            <!-- ICON -->
            <div class="hidden md:flex relative z-10 items-center justify-center pr-4 lg:pr-6">
                <div class="w-20 h-20 lg:w-24 lg:h-24 
                            bg-white/10 backdrop-blur-md 
                            rounded-2xl lg:rounded-3xl 
                            shadow-inner flex items-center justify-center 
                            border border-white/20 
                            transform rotate-6 hover:rotate-0 
                            transition duration-300">

                    <i class="fa-solid fa-user-gear text-[#F7F4D5] text-3xl lg:text-4xl"></i>

                </div>
            </div>

        </div>
    </header>

    <!-- CARD FULL -->
    <section class="w-full">

        <div class="relative overflow-hidden rounded-[32px] p-8 md:p-10
                    bg-white border border-gray-200
                    shadow-sm hover:shadow-lg transition">

            <!-- GARIS ATAS -->
            <div class="absolute top-0 left-0 w-full h-[4px] 
                        bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <div class="relative z-10 w-full">

                @if(session('success'))
                <div class="mb-6 bg-[#eaf3d6] text-[#839958] px-5 py-4 rounded-2xl font-medium">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="/guru/update-setting" class="space-y-8">
                    @csrf

                    <!-- GRID -->
                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- NAMA -->
                        <div>
                            <label class="block text-sm font-semibold text-[#105666] mb-2">
                                Nama Guru
                            </label>

                            <input type="text" name="nama"
                                value="{{ $guru->nama }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none
                                       focus:ring-2 focus:ring-[#105666]/30 focus:border-[#105666]
                                       transition">
                        </div>

                        <!-- USERNAME -->
                        <div>
                            <label class="block text-sm font-semibold text-[#105666] mb-2">
                                Username
                            </label>

                            <input type="text" name="username"
                                value="{{ Auth::user()->username }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none
                                       focus:ring-2 focus:ring-[#839958]/30 focus:border-[#839958]
                                       transition">
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block text-sm font-semibold text-[#105666] mb-2">
                                Password Baru
                            </label>

                            <input type="password" name="password"
                                placeholder="Kosongkan jika tidak diubah"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none
                                       focus:ring-2 focus:ring-[#D3968C]/30 focus:border-[#D3968C]
                                       transition">
                        </div>

                        <!-- KONFIRMASI -->
                        <div>
                            <label class="block text-sm font-semibold text-[#105666] mb-2">
                                Konfirmasi Password
                            </label>

                            <input type="password" name="password_confirmation"
                                placeholder="Ulangi password baru"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none
                                       focus:ring-2 focus:ring-[#D3968C]/30 focus:border-[#D3968C]
                                       transition">
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end pt-4">

                        <button type="submit"
                            class="px-8 py-3 rounded-xl bg-[#D3968C] text-white font-semibold
                                   hover:bg-[#c07f75] transition shadow-sm
                                   hover:shadow-md hover:-translate-y-[1px]">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</main>

</body>
</html>