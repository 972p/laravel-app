<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Retourner un Ballon</title>

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
                            dark: { 900: '#0a0a0c', 800: '#121216', 700: '#1a1a20', 600: '#272730' },
                            accent: { 400: '#f97316', 500: '#ea580c', 600: '#c2410c' }
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
            border-color: rgba(249, 115, 22, 0.6);
            color: #fdba74;
        }
    </style>
</head>

<body class="antialiased font-sans flex flex-col min-h-screen">
    <!-- Ambient Background -->
    <div
        class="fixed inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-accent-600/10 via-dark-900 to-dark-900 -z-10 pointer-events-none">
    </div>

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
                        </svg></div>
                    <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span
                            class="text-gradient not-italic font-sans font-extrabold ml-1">Sports</span></span>
                </a>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Le Complexe</a>
                    <a href="/ballons"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Ballons</a>
                    <a href="/chaussures"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Chaussures</a>
                    <a href="/terrains"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Terrains</a>
                    <a href="/retours"
                        class="text-white text-sm font-medium relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-accent-600">Retours</a>
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
    <main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative z-10 w-full max-w-5xl mx-auto">
        <header class="mb-12 border-b border-white/10 pb-8">
            <h1 class="text-3xl lg:text-4xl font-serif font-bold text-white mb-2">Gérer vos <span
                    class="text-gradient">Retours</span></h1>
            <p class="text-slate-400 font-light text-sm">Visualisez vos emprunts en cours et libérez les ballons pour
                les autres membres du complexe.</p>
        </header>

        @if($emprunts->isEmpty())
            <div class="glass-card rounded-2xl p-12 text-center border-dashed border-white/20">
                <div
                    class="w-16 h-16 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-500 mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-serif text-white mb-2">Aucun emprunt en cours</h3>
                <p class="text-slate-400 text-sm mb-6">Vous n'avez actuellement aucun ballon en votre possession.</p>
                <a href="/ballons"
                    class="inline-flex py-3 px-6 rounded-xl btn-outline text-white font-medium hover:bg-white/10 transition-all text-sm">Parcourir
                    les équipements</a>
            </div>
        @else
            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/5">
                                <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase">Équipement</th>
                                <th
                                    class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase hidden sm:table-cell">
                                    Emprunté le</th>
                                <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase">Échéance</th>
                                <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase text-right">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($emprunts as $emprunt)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            @if($emprunt->ballon)
                                                <div class="w-8 h-8 bg-gradient-to-br from-[#d97706] to-[#78350f] rounded-full border border-white/20 shadow-md relative overflow-hidden flex items-center justify-center">
                                                    <div class="absolute w-full h-[1px] bg-black/40 rotate-[15deg]"></div>
                                                    <div class="absolute w-[1px] h-full bg-black/40 -rotate-[15deg]"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-white mb-0.5 uppercase tracking-wide">{{ $emprunt->ballon->marque }}</div>
                                                    <div class="text-[11px] text-slate-500 font-medium tracking-wide uppercase">Taille {{ $emprunt->ballon->taille }} - {{ $emprunt->ballon->etat }}</div>
                                                </div>
                                            @elseif($emprunt->chaussure)
                                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg border border-indigo-400/20 shadow-md flex items-center justify-center text-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.25 9.141v-1.5a1.5 1.5 0 00-1.5-1.5h-1.5A3.75 3.75 0 007.5 9.89v10.61c0 1.036.84 1.875 1.875 1.875h7.5A3.75 3.75 0 0020.625 18v-.75a4.5 4.5 0 00-4.5-4.5h-1.875M14.25 9.141V11.25"></path></svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-white mb-0.5 uppercase tracking-wide">{{ $emprunt->chaussure->marque }}</div>
                                                    <div class="text-[11px] text-slate-500 font-medium tracking-wide uppercase">{{ $emprunt->chaussure->modele }} - P.{{ $emprunt->chaussure->pointure }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm text-slate-400 hidden sm:table-cell">
                                        {{ \Carbon\Carbon::parse($emprunt->date_debut)->format('d M Y') }}</td>
                                    <td class="p-4 text-sm">
                                        @php
                                            $isLate = \Carbon\Carbon::parse($emprunt->date_expiration)->isPast();
                                        @endphp
                                        <span
                                            class="inline-flex items-center gap-1.5 {{ $isLate ? 'text-rose-400 font-semibold' : 'text-slate-300' }}">
                                            @if($isLate)
                                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            @endif
                                            {{ \Carbon\Carbon::parse($emprunt->date_expiration)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <form action="{{ route('emprunts.retourner', $emprunt->id_emprunt) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex py-2 px-4 rounded-lg btn-outline text-white text-xs font-medium cursor-pointer">
                                                Retourner
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>
</body>

</html>