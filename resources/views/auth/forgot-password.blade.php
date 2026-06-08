<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            overflow: hidden !important;
            height: 100vh;
            height: 100dvh;
            width: 100vw;
            margin: 0;
            padding: 0;
        }

        @keyframes cardIn {
            0% { opacity: 0; transform: translateY(35px) scale(.96); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes imageIn {
            0% { opacity: 0; transform: translateX(-35px) translateY(20px) scale(.9); }
            100% { opacity: 1; transform: translateX(0) translateY(0) scale(1); }
        }
        @keyframes formIn {
            0% { opacity: 0; transform: translateX(35px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        @keyframes bubble {
            0%, 100% { transform: scale(1); opacity: .25; }
            50% { transform: scale(1.15); opacity: .5; }
        }
        .card-animation { animation: cardIn .8s ease-out forwards; }
        .image-animation { animation: imageIn .9s ease-out forwards, float 4s ease-in-out infinite 1s; }
        .form-animation { animation: formIn .9s ease-out forwards; }
        .bubble-animation { animation: bubble 5s ease-in-out infinite; }
    </style>
</head>
<body class="flex items-center justify-center bg-gradient-to-br from-[#839958] to-[#105666] relative p-4 sm:p-6 md:p-8">

    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="hidden lg:block absolute w-[520px] h-[520px] rounded-full bg-[#F7F4D5]/10 -top-[230px] right-[150px] bubble-animation"></div>
        <div class="hidden lg:block absolute w-[460px] h-[460px] rounded-full bg-[#F7F4D5]/10 -bottom-[230px] left-[140px] bubble-animation"></div>
    </div>

    <div class="relative z-10 w-full max-w-[900px] h-[560px] rounded-[42px] shadow-2xl bg-[#F7F4D5] card-animation flex overflow-hidden">

        <!-- KIRI -->
        <div class="w-[54%] flex items-center justify-center relative">

            <img
                src="/images/login.png"
                class="max-w-[420px] object-contain image-animation">

        </div>

        <!-- KANAN -->
        <div class="w-[46%] bg-[#105666] flex items-center justify-center px-14">

            <div class="w-full max-w-[340px] text-[#F7F4D5] form-animation">

                <h1 class="text-[34px] font-extrabold mb-3">
                    Lupa Password
                </h1>

                <p class="text-sm text-white/70 mb-6">
                    Masukkan username dan nama lengkap yang terdaftar.
                </p>

                <form method="POST" action="/forgot-password/check">
                    @csrf

                    <div class="mb-5">

                        <label class="text-sm block mb-2">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            required
                            placeholder="Masukkan username"
                            class="w-full h-[44px] rounded-full bg-[#F7F4D5]/10 px-5 text-white border border-white/20 outline-none focus:border-[#D3968C]">

                    </div>

                    <div class="mb-6">

                        <label class="text-sm block mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama"
                            required
                            placeholder="Masukkan nama lengkap"
                            class="w-full h-[44px] rounded-full bg-[#F7F4D5]/10 px-5 text-white border border-white/20 outline-none focus:border-[#D3968C]">

                    </div>

                    <button
                        type="submit"
                        class="w-full h-[46px] rounded-full bg-[#D3968C] font-bold text-white hover:bg-[#c48479] transition">

                        Verifikasi

                    </button>

                </form>

                @if ($errors->any())
                <div class="bg-red-500/20 border border-red-400 rounded-xl p-3 mt-4 text-sm text-center">
                    {{ $errors->first() }}
                </div>
                @endif

                <div class="text-center mt-5">

                    <a
                        href="/"
                        class="text-xs text-white/60 underline hover:text-[#D3968C]">

                        Kembali ke Login

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>
</html>