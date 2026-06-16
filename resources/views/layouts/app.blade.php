<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ChampionStore.id - Toko Top Up 8 Ball Pool Terpercaya')</title>
    <meta name="description" content="@yield('meta_description', 'Beli Coins, Cash, Legendary Cues, dan item premium 8 Ball Pool aman, legal, murah, dan proses super cepat di ChampionStore.id.')">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css'])
</head>
<body class="bg-bg-dark text-white font-sans antialiased selection:bg-primary-purple selection:text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-bg-dark/70 backdrop-blur-md border-b border-border-dark h-20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                @php
                    $websiteLogo = \App\Models\Setting::getValue('website_logo');
                @endphp
                @if($websiteLogo)
                    <img src="{{ $websiteLogo }}" alt="ChampionStore Logo" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform duration-200">
                @else
                    <div class="w-16 h-16 rounded-xl bg-primary-purple/10 border border-primary-purple flex items-center justify-center shadow-glow group-hover:scale-105 transition-transform duration-200">
                        <!-- Custom SVG Crown/Champion Icon -->
                        <svg class="w-5 h-5 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                @endif
                <span class="text-xl font-extrabold tracking-tight">ChampionStore<span class="text-primary-purple">.id</span></span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="relative text-sm font-medium text-gray-300 hover:text-primary-purple transition-colors duration-200 group {{ request()->routeIs('home') ? 'text-primary-purple' : '' }}">
                    <span class="relative">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-purple to-transparent group-hover:w-full transition-all duration-300 {{ request()->routeIs('home') ? 'w-full' : '' }}"></span>
                    </span>
                </a>
                <a href="{{ route('products.index') }}" class="relative text-sm font-medium text-gray-300 hover:text-primary-purple transition-colors duration-200 group {{ request()->routeIs('products.*') ? 'text-primary-purple' : '' }}">
                    <span class="relative">
                        Katalog
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-purple to-transparent group-hover:w-full transition-all duration-300 {{ request()->routeIs('products.*') ? 'w-full' : '' }}"></span>
                    </span>
                </a>
                <a href="{{ route('home') }}#faqs" class="relative text-sm font-medium text-gray-300 hover:text-primary-purple transition-colors duration-200 group">
                    <span class="relative">
                        FAQ
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-purple to-transparent group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>
                <a href="{{ route('home') }}#testimonials" class="relative text-sm font-medium text-gray-300 hover:text-primary-purple transition-colors duration-200 group">
                    <span class="relative">
                        Testimoni
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-purple to-transparent group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>
            </div>

            <!-- CTA Desktop -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.95] text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-glow hover:shadow-glow-hover hover:shadow-lg hover:-translate-y-0.5 relative overflow-hidden group">
                    <span class="relative z-10">Mulai Belanja</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-violet-600 to-primary-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" type="button" class="md:hidden p-2 rounded-xl text-gray-400 hover:text-white hover:bg-card-dark border border-transparent hover:border-border-dark active:scale-90 transition-all duration-200 group relative" aria-label="Toggle Menu">
                <div class="w-6 h-6 flex flex-col items-center justify-center gap-1.5 transition-transform duration-300 group-hover:scale-105">
                    <span id="hamburger-top" class="block w-5 h-0.5 bg-current rounded-full transition-all duration-300 origin-center"></span>
                    <span id="hamburger-mid" class="block w-5 h-0.5 bg-current rounded-full transition-all duration-300"></span>
                    <span id="hamburger-bot" class="block w-5 h-0.5 bg-current rounded-full transition-all duration-300 origin-center"></span>
                </div>
            </button>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 right-0 bg-bg-dark/95 border-b border-border-dark backdrop-blur-lg shadow-xl shadow-black/20 px-4 pt-4 pb-6 flex flex-col gap-4 animate-slideDown">
            <a href="{{ route('home') }}" class="text-base font-medium py-2.5 px-3 rounded-lg hover:bg-card-dark hover:text-primary-purple hover:translate-x-1 transition-all duration-200 flex items-center gap-3 {{ request()->routeIs('home') ? 'text-primary-purple bg-card-dark' : 'text-gray-300' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('home') ? 'text-primary-purple' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Home
            </a>
            <a href="{{ route('products.index') }}" class="text-base font-medium py-2.5 px-3 rounded-lg hover:bg-card-dark hover:text-primary-purple hover:translate-x-1 transition-all duration-200 flex items-center gap-3 {{ request()->routeIs('products.*') ? 'text-primary-purple bg-card-dark' : 'text-gray-300' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('products.*') ? 'text-primary-purple' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Katalog
            </a>
            <a href="{{ route('home') }}#faqs" class="text-base font-medium py-2.5 px-3 rounded-lg hover:bg-card-dark hover:text-primary-purple hover:translate-x-1 transition-all duration-200 flex items-center gap-3 text-gray-300">
                <svg class="w-4 h-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                FAQ
            </a>
            <a href="{{ route('home') }}#testimonials" class="text-base font-medium py-2.5 px-3 rounded-lg hover:bg-card-dark hover:text-primary-purple hover:translate-x-1 transition-all duration-200 flex items-center gap-3 text-gray-300">
                <svg class="w-4 h-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Testimoni
            </a>
            <div class="border-t border-border-dark/60 pt-4 mt-2">
                <a href="{{ route('products.index') }}" class="w-full text-center py-3.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.97] text-white font-bold rounded-xl transition-all duration-200 shadow-glow flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-card-dark/40 border-t border-border-dark pt-16 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Brand -->
                <div class="md:col-span-2 flex flex-col gap-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        @php
                            $websiteLogo = \App\Models\Setting::getValue('website_logo');
                        @endphp
                        @if($websiteLogo)
                            <img src="{{ $websiteLogo }}" alt="ChampionStore Logo" class="h-8 w-auto object-contain">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-primary-purple/10 border border-primary-purple flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                        @endif
                        <span class="text-lg font-extrabold tracking-tight">ChampionStore<span class="text-primary-purple">.id</span></span>
                    </a>
                    <p class="text-sm text-gray-400 max-w-sm leading-relaxed">
                        Penyedia layanan top up game 8 Ball Pool premium tercepat, teraman, dan termurah. Kami selalu menjaga keamanan akun Anda.
                    </p>
                </div>

                <!-- Navigation Links -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-sm font-bold text-gray-200 tracking-wider uppercase">Menu Utama</h3>
                    <ul class="flex flex-col gap-2.5">
                        <li><a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-primary-purple transition-colors">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-sm text-gray-400 hover:text-primary-purple transition-colors">Katalog Koin</a></li>
                        <li><a href="{{ route('home') }}#faqs" class="text-sm text-gray-400 hover:text-primary-purple transition-colors">Pertanyaan Umum</a></li>
                    </ul>
                </div>

                <!-- Socials & Contacts -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-sm font-bold text-gray-200 tracking-wider uppercase">Hubungi Kami</h3>
                    <ul class="flex flex-col gap-2.5">
                        @if(isset($settings['whatsapp_number']))
                        <li>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}" target="_blank" class="text-sm text-gray-400 hover:text-primary-purple flex items-center gap-2 group transition-colors">
                                <svg class="w-4 h-4 text-green-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.37 5.022L2 22l5.13-1.346a9.923 9.923 0 004.882 1.28h.005c5.507 0 9.99-4.478 9.99-9.986 0-2.67-1.037-5.178-2.92-7.062C17.199 3.003 14.697 2 12.012 2zm6.09 13.985c-.25.707-1.447 1.3-1.997 1.38-.475.07-1.096.126-3.21-.75-2.705-1.12-4.432-3.88-4.568-4.062-.132-.182-1.077-1.432-1.077-2.73 0-1.3.682-1.938.924-2.2.242-.263.533-.328.71-.328.176 0 .352.002.506.01.16.007.373-.06.583.45.216.524.737 1.797.8 1.928.062.13.104.282.018.451-.086.17-.13.277-.258.428-.128.152-.27.34-.385.456-.127.13-.26.27-.112.52.148.25.658 1.085 1.412 1.758.97.865 1.783 1.134 2.036 1.26.25.127.397.107.545-.06.148-.17.633-.736.804-.988.17-.25.343-.21.579-.123.237.086 1.503.708 1.762.838.258.128.43.19.492.3.063.11.063.633-.187 1.34z"/>
                                </svg>
                                <span>WhatsApp Admin</span>
                            </a>
                        </li>
                        @endif
                        @if(isset($settings['instagram_link']))
                        <li>
                            <a href="{{ $settings['instagram_link'] }}" target="_blank" class="text-sm text-gray-400 hover:text-primary-purple flex items-center gap-2 group transition-colors">
                                <svg class="w-4 h-4 text-pink-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                                </svg>
                                <span>Instagram Kami</span>
                            </a>
                        </li>
                        @endif
                        @if(isset($settings['tiktok_link']))
                        <li>
                            <a href="{{ $settings['tiktok_link'] }}" target="_blank" class="text-sm text-gray-400 hover:text-primary-purple flex items-center gap-2 group transition-colors">
                                <svg class="w-4 h-4 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                </svg>
                                <span>TikTok Kami</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="mt-16 pt-8 border-t border-border-dark flex flex-col md:flex-row items-center justify-between gap-4">
                <span class="text-xs text-gray-500">&copy; {{ date('Y') }} ChampionStore.id. Hak Cipta Dilindungi.</span>
                <div class="flex items-center gap-6">
                    <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-primary-purple transition-colors">Admin Area</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toggle Script for Mobile Menu -->
    <script>
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const topLine = document.getElementById('hamburger-top');
        const midLine = document.getElementById('hamburger-mid');
        const botLine = document.getElementById('hamburger-bot');

        toggleBtn.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            
            // Toggle menu
            if (isOpen) {
                mobileMenu.classList.add('hidden');
                // Reset hamburger
                topLine.style.transform = '';
                topLine.style.width = '1.25rem';
                midLine.style.opacity = '1';
                botLine.style.transform = '';
                botLine.style.width = '1.25rem';
            } else {
                mobileMenu.classList.remove('hidden');
                // Animate to X
                topLine.style.transform = 'translateY(6px) rotate(45deg)';
                topLine.style.width = '1.25rem';
                midLine.style.opacity = '0';
                midLine.style.transform = 'scaleX(0)';
                botLine.style.transform = 'translateY(-6px) rotate(-45deg)';
                botLine.style.width = '1.25rem';
            }
        });

        // Close menu on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                topLine.style.transform = '';
                topLine.style.width = '1.25rem';
                midLine.style.opacity = '1';
                midLine.style.transform = '';
                botLine.style.transform = '';
                botLine.style.width = '1.25rem';
            });
        });
    </script>

    <style>
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-slideDown {
            animation: slideDown 0.2s ease-out;
        }
    </style>
</body>
</html>
