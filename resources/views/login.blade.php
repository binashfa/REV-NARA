<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
    </style>

</head>

<body class="h-screen flex items-center justify-center">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-purple-900/40 backdrop-blur-[2px]"></div>

    <!-- LOGIN BOX -->
    <div class="relative z-10 w-[310px] rounded-2xl border border-white/60 bg-white/10 backdrop-blur-md px-10 py-14 shadow-2xl">

        <h1 class="text-white text-5xl font-light text-center mb-14">
            log in
        </h1>

        <form method="POST" action="/login">

            @csrf

            <!-- USERNAME -->
            <input 
                type="text"
                name="username"
                placeholder="User"
                class="w-full mb-4 rounded-full border border-white/70 bg-transparent px-5 py-3 text-white placeholder-white/80 outline-none"
            >

            <!-- PASSWORD -->
            <input 
                type="password"
                name="password"
                placeholder="password"
                class="w-full rounded-full border border-white/70 bg-transparent px-5 py-3 text-white placeholder-white/80 outline-none"
            >

            <!-- FORGOT -->
            <div class="mt-2 mb-10">
                <a href="#" class="text-white text-xs font-semibold">
                    forgot password?
                </a>
            </div>

            <!-- BUTTON -->
            <button 
                type="submit"
                class="w-full rounded-full border border-pink-300 bg-white/10 py-3 text-xl text-white shadow-lg transition hover:bg-white/20"
            >
                Login
            </button>

            <!-- REGISTER -->
            <p class="mt-6 text-center text-sm text-white">
                Don't have any account?
                <a href="#" class="font-bold">
                    Register
                </a>
            </p>

        </form>

    </div>

</body>
</html>