<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Campus | Complexe Sportif</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Outfit', 'sans-serif'],
                            serif: ['Playfair Display', 'serif'],
                        },
                        colors: {
                            brand: {
                                dark: '#050505',
                                soot: '#111111',
                                sootLight: '#222222',
                                gray: '#888888',
                                orange: '#ea580c', // Bright basketball orange
                                orangeLight: '#f97316',
                                orangeDark: '#9a3412',
                            }
                        },
                        transitionTimingFunction: {
                            'expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        body {
            background-color: #050505;
            color: #ffffff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Subtle mesh for dark theme */
        .noise-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.02'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 50;
        }

        .ambient-glow {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(234, 88, 12, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
            top: -200px;
            right: -200px;
            z-index: 0;
            border-radius: 50%;
            pointer-events: none;
        }

        .nav-link {
            position: relative;
            display: inline-block;
            color: #888;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: -6px;
            left: 0;
            background-color: #ea580c;
            transform-origin: bottom right;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .nav-link:hover {
            color: #fff;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .image-reveal-wrapper {
            overflow: hidden;
        }

        .image-reveal {
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .image-reveal-wrapper:hover .image-reveal {
            transform: scale(1.05);
        }

        .text-outline {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px -10px rgba(234, 88, 12, 0.5);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px -10px rgba(234, 88, 12, 0.7);
        }

        .grid-bg {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
    </style>
</head>

<body class="selection:bg-brand-orange selection:text-white relative grid-bg">

    <div class="noise-overlay"></div>
    <div class="ambient-glow"></div>

    <!-- Navigation -->
    <nav class="w-full fixed top-0 z-40 bg-brand-dark/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-[90rem] mx-auto px-6 lg:px-12 py-5 flex justify-between items-center relative">

            <!-- Logo (Center Absolute or Flex start) -->
            <a href="/" class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-brand-orange flex items-center justify-center text-white shadow-[0_0_15px_rgba(234,88,12,0.4)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-sans font-black text-xl tracking-wider text-white uppercase leading-none">H3 <span
                            class="text-brand-orange">Sports</span></span>
                    <span
                        class="text-[9px] tracking-[0.2em] font-sans font-medium uppercase text-brand-gray mt-1">Complexe
                        Sportif</span>
                </div>
            </a>

            <!-- Links -->
            <div class="hidden md:flex flex-1 justify-end items-center gap-10">
                <a href="/ballons"
                    class="text-xs font-bold tracking-[0.1em] uppercase text-white hover:text-brand-orange transition-colors">Équipements</a>
                <a href="/terrains"
                    class="text-xs font-bold tracking-[0.1em] uppercase text-brand-gray hover:text-white transition-colors">Terrains</a>
                <a href="/planning"
                    class="text-xs font-bold tracking-[0.1em] uppercase text-brand-gray hover:text-white transition-colors">Planning</a>
                @if(auth()->check() && auth()->user()->is_admin)
                    <a href="/admin"
                        class="text-xs font-bold tracking-[0.1em] uppercase text-brand-orange hover:text-white transition-colors">Administration</a>
                @endif
                <a href="/compte"
                    class="ml-4 px-6 py-2.5 rounded-full btn-primary text-xs font-bold tracking-[0.1em] uppercase text-white">Espace
                    Athlète</a>
            </div>

            <!-- Mobile Menu -->
            <button class="md:hidden ml-auto text-white">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="stroke-current">
                    <path d="M4 6H20M4 12H20M4 18H20" stroke-width="1.5" stroke-linecap="square" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="pt-32 lg:pt-48 px-6 lg:px-12 max-w-[90rem] mx-auto relative z-10 pb-20">

        <div class="flex flex-col lg:flex-row justify-between items-center gap-16">

            <!-- Left Text Content -->
            <div class="lg:w-1/2 relative z-10">
                <div
                    class="inline-block px-4 py-1.5 rounded-full border border-brand-orange/30 bg-brand-orange/10 text-brand-orange text-[10px] font-bold tracking-[0.2em] uppercase mb-8">
                    Nouveau Complexe 2026
                </div>

                <h1
                    class="font-sans font-black leading-[0.9] text-[4rem] sm:text-[6rem] lg:text-[7.5rem] tracking-tighter text-white mb-6 uppercase">
                    ÉLEVEZ <br>
                    <span class="text-outline">VOTRE</span> <br>
                    <span class="text-brand-orange">NIVEAU</span>
                </h1>

                <p
                    class="font-sans font-light text-base lg:text-lg text-brand-gray max-w-md leading-relaxed mb-10 border-l-2 border-brand-orange pl-6">
                    Des infrastructures premiums pour des athlètes exigeants. Réservez vos terrains de basket et
                    empruntez des équipements professionnels directement depuis l'application H3 Campus.
                </p>

                <div class="flex flex-wrap items-center gap-6">
                    <a href="/terrains"
                        class="px-8 py-4 rounded-full btn-primary text-xs font-bold tracking-[0.15em] uppercase flex items-center gap-3">
                        Réserver un terrain
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="/ballons"
                        class="px-8 py-4 rounded-full border border-white/20 hover:border-white hover:bg-white/5 transition-all text-xs font-bold tracking-[0.15em] uppercase text-white">
                        Voir les équipements
                    </a>
                </div>
            </div>

            <!-- Right Visual -->
            <div class="lg:w-1/2 w-full relative h-[600px]">
                <div
                    class="absolute inset-0 image-reveal-wrapper rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(234,88,12,0.3)] border border-white/10 overflow-hidden transform rotate-3 hover:rotate-0 transition-transform duration-700">
                    <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=2690&auto=format&fit=crop"
                        class="w-full h-full object-cover image-reveal blur-[2px] brightness-50"
                        alt="Terrain de basketball">

                    <!-- Overlay graphic -->
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-transparent to-transparent"></div>

                    <!-- Floating Stat Cards -->
                    <div
                        class="absolute bottom-12 left-12 bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform -rotate-3">
                        <div class="text-brand-orange font-black text-4xl mb-1">03</div>
                        <div class="text-[10px] font-bold tracking-[0.2em] uppercase text-brand-gray">Terrains Premium
                        </div>
                    </div>

                    <div
                        class="absolute top-12 right-12 bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform rotate-6">
                        <div class="text-white font-black text-4xl mb-1">50+</div>
                        <div class="text-[10px] font-bold tracking-[0.2em] uppercase text-brand-gray">Ballons Pros</div>
                    </div>

                    <!-- Centered abstract hoop -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <div
                            class="w-48 h-48 rounded-full border border-brand-orange/50 relative shadow-[0_0_50px_rgba(234,88,12,0.4)]">
                            <div class="absolute inset-x-0 top-1/2 w-full h-[1px] bg-brand-orange/50"></div>
                            <div class="absolute inset-y-0 left-1/2 h-full w-[1px] bg-brand-orange/50"></div>
                            <div
                                class="absolute -right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-brand-orange shadow-[0_0_20px_rgba(234,88,12,1)] animate-pulse">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Services Section -->
    <section class="py-24 border-t border-white/5 relative bg-brand-soot">
        <div class="max-w-[90rem] mx-auto px-6 lg:px-12">

            <div class="text-center mb-20">
                <h2 class="font-sans font-black text-3xl lg:text-5xl text-white uppercase tracking-tighter mb-4">
                    L'Avantage <span class="text-brand-orange">H3</span></h2>
                <div class="h-1 w-24 bg-brand-orange mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10 text-center">
                <!-- Feature 1 -->
                <div
                    class="bg-brand-dark p-10 rounded-3xl border border-white/5 hover:border-brand-orange/30 transition-colors group">
                    <div
                        class="w-16 h-16 rounded-2xl bg-brand-orange/10 border border-brand-orange/20 mx-auto flex items-center justify-center mb-6 text-brand-orange group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white uppercase tracking-wide mb-3">Réservation Simplifiée</h3>
                    <p class="text-brand-gray text-sm font-light leading-relaxed">Vérifiez la disponibilité en temps
                        réel et réservez votre créneau sur l'un de nos parquets intérieurs.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-brand-dark p-10 rounded-3xl border border-brand-orange/20 shadow-[0_0_30px_rgba(234,88,12,0.1)] transform -translate-y-4 group">
                    <div
                        class="w-16 h-16 rounded-2xl bg-brand-orange text-white mx-auto flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-[0_10px_20px_rgba(234,88,12,0.4)]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white uppercase tracking-wide mb-3">Équipement Pro</h3>
                    <p class="text-brand-gray text-sm font-light leading-relaxed">Empruntez des ballons de qualité
                        professionnelle (Spalding, Wilson) entretenus quotidiennement.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-brand-dark p-10 rounded-3xl border border-white/5 hover:border-brand-orange/30 transition-colors group">
                    <div
                        class="w-16 h-16 rounded-2xl bg-brand-orange/10 border border-brand-orange/20 mx-auto flex items-center justify-center mb-6 text-brand-orange group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white uppercase tracking-wide mb-3">Suivi de Performance</h3>
                    <p class="text-brand-gray text-sm font-light leading-relaxed">Retrouvez l'historique de vos sessions
                        et de vos emprunts depuis votre espace adhérent unifié.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/10 bg-brand-dark pt-20 pb-10 px-6 lg:px-12">
        <div class="max-w-[90rem] mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start gap-16 mb-16">
                <div class="max-w-xs">
                    <span
                        class="font-sans font-black text-2xl tracking-wider text-white uppercase leading-none block mb-2">H3
                        <span class="text-brand-orange">Sports</span></span>
                    <p class="text-brand-gray text-sm font-light leading-relaxed mb-6">Complexe d'excellence destiné aux
                        passionnés de basketball du campus.</p>
                    <div class="flex gap-4">
                        <div
                            class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-brand-orange transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-brand-orange transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex gap-16 lg:gap-32 flex-wrap">
                    <div>
                        <h4 class="text-[10px] font-bold tracking-[0.2em] uppercase text-white mb-6">Installations</h4>
                        <ul class="space-y-4">
                            <li><a href="/terrains"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Les
                                    Terrains</a></li>
                            <li><a href="/ballons"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Les
                                    Ballons</a></li>
                            <li><a href="/chaussures"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Les
                                    Chaussures</a></li>
                            <li><a href="/reservations"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Réservations</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-bold tracking-[0.2em] uppercase text-white mb-6">Informations</h4>
                        <ul class="space-y-4">
                            <li><a href="#"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Le
                                    Campus H3</a></li>
                            <li><a href="#"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Règlement
                                    Intérieur</a></li>
                            <li><a href="#"
                                    class="text-sm font-light text-brand-gray hover:text-white transition-colors">Nous
                                    Contacter</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[10px] font-bold tracking-[0.2em] uppercase text-brand-gray">
                    &copy; 2026 H3 Sports. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="#"
                        class="text-[10px] font-bold tracking-[0.2em] uppercase text-brand-gray hover:text-white transition-colors">Mentions
                        Légales</a>
                    <a href="#"
                        class="text-[10px] font-bold tracking-[0.2em] uppercase text-brand-gray hover:text-white transition-colors">Confidentialité</a>
                </div>
            </div>

        </div>
    </footer>
</body>

</html>