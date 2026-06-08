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
        <div class="hidden lg:block absolute w-[460px] h-[460px] rounded-full bg-[#F7F4D5]/10 -bottom-[230px] left-[140px] bubble-animation" style="animation-delay: 1s;"></div>
        <div class="hidden lg:block absolute w-[190px] h-[190px] rounded-full bg-[#F7F4D5]/15 bottom-[35px] right-[25px] bubble-animation" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 w-full max-w-[900px] h-[94%] max-h-[680px] lg:h-[560px] lg:max-h-[750px] rounded-[32px] md:rounded-[42px] shadow-2xl bg-[#F7F4D5] card-animation flex flex-col lg:flex-row overflow-hidden">

        <div class="w-full lg:w-[54%] flex items-center justify-center p-4 pb-8 lg:p-8 lg:pb-8 relative h-[36%] sm:h-[42%] lg:h-auto lg:min-h-full shrink-0">
            <div class="hidden lg:block absolute w-[300px] h-[300px] bg-[#839958]/20 rounded-full blur-3xl -top-10 -left-10"></div>
            <div class="hidden lg:block absolute w-[250px] h-[250px] bg-[#D3968C]/15 rounded-full blur-3xl bottom-10 right-10"></div>

            <img src="/images/login.png" class="relative z-20 w-auto h-full max-h-[160px] sm:max-h-[240px] lg:w-auto lg:h-auto lg:max-h-none lg:max-w-[420px] object-contain image-animation">
        </div>

        <div class="relative z-30 w-full flex-1 lg:flex-none lg:w-[48%] bg-[#105666] flex flex-col justify-center px-6 sm:px-10 lg:px-16 pt-8 pb-4 sm:py-6 lg:py-8 rounded-t-[36px] rounded-b-none lg:rounded-none lg:rounded-l-[42px] -mt-6 lg:mt-0 shadow-[0_-15px_35px_rgba(16,86,102,0.25)] lg:shadow-[-20px_0_40px_rgba(16,86,102,0.4)]">
            
            <div class="w-12 h-1.5 bg-white/20 rounded-full absolute top-3 left-1/2 -translate-x-1/2 lg:hidden"></div>

            <div class="w-full max-w-[340px] mx-auto text-[#F7F4D5] form-animation relative mt-2 lg:mt-0">
                <h1 class="text-[26px] sm:text-[34px] lg:text-[34px] font-extrabold mb-5 sm:mb-6 lg:mb-6 text-center lg:text-left">Login</h1>

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-4 sm:mb-5 lg:mb-5">
                        <label class="text-sm mb-1.5 sm:mb-2 lg:mb-2 block font-medium">Username</label>
                        <input type="text" name="username" placeholder="Masukkan username" class="w-full h-[44px] rounded-full bg-[#F7F4D5]/10 px-5 text-sm text-white placeholder-white/50 border border-white/20 outline-none focus:border-[#D3968C] focus:ring-4 focus:ring-[#D3968C]/20 transition">
                    </div>

                    <div class="mb-4 sm:mb-5 lg:mb-5">
                        <label class="text-sm mb-1.5 sm:mb-2 lg:mb-2 block font-medium">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="passwordInput" placeholder="Masukkan password" class="w-full h-[44px] rounded-full bg-[#F7F4D5]/10 px-5 pr-12 text-sm text-white placeholder-white/50 border border-white/20 outline-none focus:border-[#D3968C] focus:ring-4 focus:ring-[#D3968C]/20 transition">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#D3968C] cursor-pointer outline-none hover:text-[#e0a89f] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    <path id="eyeSlash" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="text-right mb-5 sm:mb-6 lg:mb-6">
                        <a href="/forgot-password" class="text-xs text-white/60 underline hover:text-[#D3968C] transition-colors">Forgot Password?</a>
                    </div>

                    <button type="submit" class="w-full h-[46px] rounded-full bg-[#D3968C] font-bold text-white hover:bg-[#c48479] hover:shadow-lg hover:-translate-y-[1px] active:scale-[0.98] transition-all duration-300 tracking-wide">
                        Masuk
                    </button>
                </form>

                @if ($errors->any())
                <div class="bg-[#D3968C]/20 border border-[#D3968C]/50 rounded-xl p-3 mt-4 lg:mt-5 text-[#D3968C] text-sm text-center font-medium animate-pulse">
                    {{ $errors->first() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("passwordInput");
            const slash = document.getElementById("eyeSlash");
            if (input.type === "password") {
                input.type = "text";
                slash.classList.add("hidden");
            } else {
                input.type = "password";
                slash.classList.remove("hidden");
            }
        }
        window.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("passwordInput");
            const slash = document.getElementById("eyeSlash");
            if (input.type === "password") {
                slash.classList.remove("hidden");
            } else {
                slash.classList.add("hidden");
            }
        });
    </script>
</body>
</html>