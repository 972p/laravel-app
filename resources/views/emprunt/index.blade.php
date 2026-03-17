<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Équipements</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Outfit', 'sans-serif'],
                            serif: ['Playfair Display', 'serif'],
                        },
                        colors: {
                            dark: {
                                900: '#0a0a0c',
                                800: '#121216',
                                700: '#1a1a20',
                                600: '#272730',
                            },
                            accent: {
                                400: '#f97316', // Orange basketball
                                500: '#ea580c',
                                600: '#c2410c',
                            }
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        body {
            background-color: #0a0a0c;
            color: #f8fafc;
        }

        .glass-nav {
            background: rgba(10, 10, 12, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .text-gradient {
            background: linear-gradient(to right, #f97316, #ea580c, #c2410c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(249, 115, 22, 0.3);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5), 0 0 20px rgba(249, 115, 22, 0.15);
        }

        .ambient-mesh {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(at 10% 20%, rgba(249, 115, 22, 0.05) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(234, 88, 12, 0.05) 0px, transparent 50%);
            z-index: -1;
            pointer-events: none;
        }

        .btn-outline {
            position: relative;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="antialiased font-sans flex flex-col min-h-screen">
    <div class="ambient-mesh"></div>

    <!-- Navigation -->
    <nav class="glass-nav fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064">
                            </path>
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span
                            class="text-gradient not-italic font-sans font-extrabold ml-1">Sports</span></span>
                </a>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Le Complexe</a>
                    <a href="/ballons"
                        class="text-white text-sm font-medium relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-accent-500">Ballons</a>
                    <a href="/chaussures"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Chaussures</a>
                    <a href="/terrains"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Terrains</a>
                    <a href="/retours"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Retours</a>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="/admin" class="text-white hover:text-accent-400 text-sm font-medium transition-colors">Administration</a>
                    @endif
                    <a href="/compte"
                        class="ml-4 px-5 py-2 rounded-full border border-white/10 hover:bg-white/10 text-white text-sm font-semibold transition-all">Espace
                        Membre</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative z-10 border-t-0">
        <div class="max-w-7xl mx-auto">
            <header class="mb-16 text-center md:text-left">
                <h1 class="text-4xl lg:text-5xl font-serif font-bold text-white mb-4">Équipements <span
                        class="text-gradient">Premium</span></h1>
                <p class="text-slate-400 font-light text-lg max-w-2xl mx-auto md:mx-0">Parcourez notre collection de ballons professionnels et empruntez ceux qui correspondent à votre style de jeu.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($ballons as $ballon)
                    <div
                        class="glass-card rounded-[1.5rem] p-6 group relative overflow-hidden flex flex-col justify-between h-full bg-dark-800/80">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-accent-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div class="relative z-10">
                            <!-- Graphical representation of basketball -->
                            <div class="h-48 mb-6 flex items-center justify-center relative">
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-[#d97706] to-[#78350f] shadow-[0_10px_30px_rgba(0,0,0,0.5)] border-2 border-white/10 relative overflow-hidden flex items-center justify-center p-4">
                                    <!-- Ball veins -->
                                    <div class="absolute w-full h-0.5 bg-black/40 rotate-[15deg]"></div>
                                    <div class="absolute w-0.5 h-full bg-black/40 -rotate-[15deg]"></div>
                                    <div class="absolute w-[150%] h-[150%] rounded-full border-2 border-black/40 -translate-x-[60%]"></div>
                                    <div class="absolute w-[150%] h-[150%] rounded-full border-2 border-black/40 translate-x-[60%]"></div>
                                </div>
                            </div>

                            <h3 class="text-xl font-serif text-white mb-1 group-hover:text-accent-400 transition-colors line-clamp-1 truncate uppercase tracking-widest"
                                title="{{ $ballon->marque }}">{{ $ballon->marque }}</h3>
                            <div class="flex justify-between items-center mb-6">
                                <p class="text-slate-400 text-sm font-light">Taille {{ $ballon->taille }}</p>
                                <span class="px-2 py-0.5 rounded text-[10px] uppercase tracking-wider font-bold bg-white/10 text-slate-300">
                                    {{ $ballon->etat }}
                                </span>
                            </div>
                        </div>

                        <!-- Emprunter Action -->
                        <form action="#" method="POST" class="relative z-10 mt-auto">
                            @csrf
                            <button type="submit"
                                class="w-full py-3 rounded-xl btn-outline flex items-center justify-center gap-2 text-white font-medium hover:border-accent-400/50 hover:bg-accent-400/10 transition-all cursor-pointer">
                                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Emprunter
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-white/10 bg-dark-900/50 backdrop-blur-md py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex justify-between items-center">
            <div class="text-sm font-serif italic text-white opacity-80">H3<span
                    class="not-italic font-sans font-bold ml-1 text-accent-400">Sports</span></div>
            <div class="text-slate-500 text-xs tracking-wider uppercase">&copy; 2026 H3 Campus</div>
        </div>
    </footer>
</body>
</html>