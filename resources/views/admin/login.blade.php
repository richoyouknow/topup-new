<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ChampionStore.id</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css'])
</head>
<body class="bg-bg-dark text-white font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Decorative Glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-primary-purple/10 blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-card-dark border border-border-dark rounded-2xl p-8 shadow-glow relative z-10">
        <!-- Logo -->
        <div class="flex flex-col items-center gap-2 mb-8 text-center">
            <div class="w-12 h-12 rounded-xl bg-primary-purple/10 border border-primary-purple flex items-center justify-center shadow-glow">
                <svg class="w-6 h-6 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-xl font-extrabold tracking-tight mt-2">ChampionStore<span class="text-primary-purple">.id</span></h1>
            <span class="text-xs text-gray-400">Panel Admin</span>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-5">
            @csrf

            <!-- Username Field -->
            <div class="flex flex-col gap-2">
                <label for="username" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus placeholder="Masukkan username" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            </div>

            <!-- Password Field -->
            <div class="flex flex-col gap-2">
                <label for="password" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Password</label>
                <input type="password" name="password" id="password" required placeholder="Masukkan password" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="rounded border-border-dark text-primary-purple focus:ring-0">
                <label for="remember" class="text-xs text-gray-400 cursor-pointer">Ingat saya</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-glow mt-2">
                Masuk ke Dashboard
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-primary-purple transition-colors">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
