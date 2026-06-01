<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
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

<body class="h-screen w-screen flex items-center justify-center bg-gradient-to-br from-[#839958] to-[#105666] relative overflow-hidden p-4 sm:p-6">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="hidden lg:block absolute w-[520px] h-[520px] rounded-full bg-[#F7F4D5]/10 -top-[230px] right-[150px] bubble-animation"></div>
        <div class="hidden lg:block absolute w-[460px] h-[460px] rounded-full bg-[#F7F4D5]/10 -bottom-[230px] left-[140px] bubble-animation" style="animation-delay: 1s;"></div>
        <div class="hidden lg:block absolute w-[190px] h-[190px] rounded-full bg-[#F7F4D5]/15 bottom-[35px] right-[25px] bubble-animation" style="animation-delay: 2s;"></div>
    </div>

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-[900px] h-full max-h-[750px] lg:h-[560px] rounded-[42px] shadow-2xl bg-[#F7F4D5] card-animation flex flex-col lg:flex-row overflow-hidden">

        <!-- IMAGE -->
        <div class="w-full lg:w-[54%] flex items-center justify-center p-4 lg:p-8 relative">

            <div class="hidden lg:block absolute w-[300px] h-[300px] bg-[#839958]/20 rounded-full blur-3xl -top-10 -left-10"></div>
            <div class="hidden lg:block absolute w-[250px] h-[250px] bg-[#D3968C]/15 rounded-full blur-3xl bottom-10 right-10"></div>

            <img src="/images/login.png"
                class="relative z-20 max-w-[280px] lg:max-w-[420px] object-contain image-animation">

        </div>

        <!-- FORM -->
        <div class="w-full lg:w-[48%] bg-[#105666] flex flex-col justify-center px-6 sm:px-10 lg:px-16 py-6 sm:py-8 rounded-[36px] lg:rounded-[42px] shadow-[-20px_0_40px_rgba(16,86,102,0.4)] z-30">

            <div class="w-full max-w-[340px] mx-auto text-[#F7F4D5] form-animation">

                <h1 class="text-[34px] font-extrabold mb-5">Login</h1>

                <form method="POST" action="/login">
                    @csrf

                    <!-- USERNAME -->
                    <div class="mb-4">
                        <label class="text-sm mb-2 block">Username</label>
                        <input
                            type="text"
                            name="username"
                            placeholder="Masukkan username"
                            class="w-full h-[42px] rounded-full bg-[#F7F4D5]/10 px-5 text-sm text-white
                            placeholder-white/50 border border-white/20 outline-none
                            focus:border-[#D3968C] focus:ring-4 focus:ring-[#D3968C]/20 transition">
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">
                        <label class="text-sm mb-2 block">Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            class="w-full h-[42px] rounded-full bg-[#F7F4D5]/10 px-5 text-sm text-white
                            placeholder-white/50 border border-white/20 outline-none
                            focus:border-[#D3968C] focus:ring-4 focus:ring-[#D3968C]/20 transition">
                    </div>

                    <div class="text-right mb-5">
                        <a href="#" class="text-xs text-white/60 underline hover:text-[#D3968C]">
                            Forgot Password?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full h-[44px] rounded-full bg-[#D3968C] font-bold text-white hover:bg-[#c48479] transition">
                        Masuk
                    </button>
                </form>

                <!-- ERROR -->
                @if ($errors->any())
                <div class="bg-[#D3968C]/20 border border-[#D3968C]/50 rounded-xl p-3 mt-4 text-[#D3968C] text-sm text-center">
                    {{ $errors->first() }}
                </div>
                @endif

            </div>

        </div>

    </div>

</body>
</html>