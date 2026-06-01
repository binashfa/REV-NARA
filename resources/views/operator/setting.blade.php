<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Operator</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-white via-[#fdfafa] to-[#faf6f6] min-h-screen font-sans antialiased overflow-x-hidden">

    <!-- SIDEBAR -->
    <div class="fixed top-0 left-0 z-50">
        @include('operator.sidebar')
    </div>

    <!-- MAIN -->
    <main class="ml-0 lg:ml-[270px] min-h-screen px-4 md:px-6 pt-4 lg:pt-10 pb-10 transition-all duration-300">

        <!-- HERO -->
        <div class="mb-8 md:mb-10">
            <div class="relative overflow-hidden rounded-[24px] md:rounded-[32px] p-6 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-5 md:gap-0
                shadow-sm hover:shadow-lg transition-all duration-300
                bg-gradient-to-br from-[#F7F4D5] via-[#f1f5d6] to-[#e9f0d0]">

                <!-- TOP BORDER -->
                <div class="absolute top-0 left-0 w-full h-[4px] 
                    bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

                <!-- GLOW -->
                <div class="absolute -top-16 -right-16 w-40 h-40 bg-[#105666]/10 blur-3xl rounded-full"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#839958]/10 blur-3xl rounded-full"></div>

                <!-- TEXT -->
                <div class="relative z-10 space-y-3 w-full md:w-auto">

                    <span class="inline-flex items-center gap-2 bg-white/60 text-[#105666] px-4 py-1.5 rounded-full text-[10px] md:text-xs font-bold border backdrop-blur-sm shadow-sm">
                        <i class="fa-solid fa-gear text-[#839958]"></i>
                        Pengaturan
                    </span>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#105666]">
                        Setting Operator
                    </h1>

                    <p class="text-[#105666]/70 text-sm md:text-base font-medium">
                        Kelola informasi akun operator ⚙️
                    </p>

                </div>

                <!-- ICON -->
                <div class="hidden md:flex w-20 h-20 bg-white/40 backdrop-blur-md rounded-3xl shrink-0
                    shadow-inner items-center justify-center border 
                    transform rotate-6 hover:rotate-0 transition duration-300 z-10">

                    <i class="fa-solid fa-gear text-[#105666] text-3xl"></i>
                </div>

            </div>
        </div>

        <!-- ALERT -->
        @if(session('success'))
        <div class="mb-6 bg-[#839958]/20 border border-[#839958]/40 text-[#5f713f] px-5 py-4 rounded-xl md:rounded-2xl text-sm md:text-base">
            {{ session('success') }}
        </div>
        @endif

        <!-- CARD FORM -->
        <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm p-5 md:p-8 w-full border border-gray-100 relative overflow-hidden">

            <!-- TOP LINE -->
            <div class="absolute top-0 left-0 w-full h-[4px] 
                bg-gradient-to-r from-[#105666] via-[#839958] to-[#D3968C]"></div>

            <form id="settingForm" method="POST" action="/operator/update-setting">
                @csrf

                <!-- USERNAME -->
                <div class="mb-4 md:mb-5">
                    <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ auth()->user()->username }}"
                        class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:px-5 md:py-4 
                        outline-none bg-white text-sm md:text-base
                        focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                </div>

                <!-- NAMA -->
                <div class="mb-4 md:mb-5">
                    <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                        Nama Operator
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ $operator->nama }}"
                        class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:px-5 md:py-4 
                        outline-none bg-white text-sm md:text-base
                        focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                </div>

                <!-- PASSWORD -->
                <div class="mb-4 md:mb-5">
                    <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Kosongkan jika tidak ingin mengganti password"
                        class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:px-5 md:py-4 
                        outline-none bg-white text-sm md:text-base
                        focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">
                </div>

                <!-- CONFIRM -->
                <div class="mb-6 md:mb-8">
                    <label class="block mb-1.5 md:mb-2 text-xs md:text-sm font-semibold text-[#105666]">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        class="w-full border border-gray-200 rounded-xl md:rounded-2xl px-4 py-3 md:px-5 md:py-4 
                        outline-none bg-white text-sm md:text-base
                        focus:ring-2 focus:ring-[#839958] focus:border-[#839958] transition-all duration-300">

                    <!-- PESAN ERROR VALIDASI -->
                    <p id="errorPasswordMsg" class="text-red-500 text-xs md:text-sm mt-2 hidden flex items-center gap-1.5 font-medium">
                        <i class="fa-solid fa-circle-exclamation"></i> Konfirmasi password tidak cocok!
                    </p>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="w-full md:w-auto flex justify-center items-center gap-2 bg-[#105666] hover:bg-[#0c4a56] text-white px-8 py-3.5 md:py-4 rounded-xl md:rounded-2xl 
                        transition-all duration-300 shadow-md font-bold text-sm md:text-base
                        hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98]">
                        <i class="fa-solid fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </main>

    <!-- SCRIPT VALIDASI -->
    <script>
        document.getElementById('settingForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const errorMsg = document.getElementById('errorPasswordMsg');

            if (password.length > 0 || confirmPassword.length > 0) {
                if (password !== confirmPassword) {
                    e.preventDefault(); // Menghentikan submit form ke backend
                    errorMsg.classList.remove('hidden'); // Memunculkan pesan teks merah
                    document.getElementById('password_confirmation').focus(); // Fokus otomatis ke kolom konfirmasi
                } else {
                    errorMsg.classList.add('hidden'); // Sembunyikan jika pas
                }
            }
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const errorMsg = document.getElementById('errorPasswordMsg');
            
            if (this.value === password) {
                errorMsg.classList.add('hidden');
            }
        });
    </script>

</body>

</html>