<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Réservations</title>

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
        body { background-color: #0a0a0c; color: #f8fafc; }
        .glass-nav { background: rgba(10, 10, 12, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .text-gradient { background: linear-gradient(to right, #f97316, #ea580c, #c2410c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .ambient-mesh { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-image: radial-gradient(at 80% 90%, rgba(249, 115, 22, 0.05) 0px, transparent 50%); z-index: -1; pointer-events: none; }
    </style>
</head>

<body class="antialiased font-sans flex flex-col min-h-screen">
    <div class="ambient-mesh"></div>

    <nav class="glass-nav fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg></div>
                    <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span class="text-gradient not-italic font-sans font-extrabold ml-1">Sports</span></span>
                </a>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Le Complexe</a>
                    <a href="/ballons" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Ballons</a>
                    <a href="/chaussures"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Chaussures</a>
                    <a href="/terrains" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Terrains</a>
                    <a href="/reservations" class="text-white text-sm font-medium relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-accent-500">Réservations</a>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="/admin" class="text-white hover:text-accent-400 text-sm font-medium transition-colors">Administration</a>
                    @endif
                    <a href="/compte" class="ml-4 px-5 py-2 rounded-full border border-white/10 hover:bg-white/10 text-white text-sm font-semibold transition-all">Espace Membre</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative z-10 w-full max-w-5xl mx-auto">
        <header class="mb-12 border-b border-white/10 pb-8">
            <h1 class="text-3xl lg:text-4xl font-serif font-bold text-white mb-2">Toutes les <span class="text-gradient">Réservations</span></h1>
            <p class="text-slate-400 font-light text-sm">Visualisez les réservations des gymnases H3 Campus.</p>
        </header>

        @if($reservations->isEmpty())
            <div class="glass-card rounded-2xl p-12 text-center border-dashed border-white/20">
                <h3 class="text-xl font-serif text-white mb-2">Aucune réservation</h3>
                <p class="text-slate-400 text-sm mb-6">Les terrains sont tous libres !</p>
                <a href="/terrains" class="inline-flex py-3 px-6 rounded-xl btn-outline text-white font-medium hover:bg-white/10 transition-all text-sm">Réserver un terrain</a>
            </div>
        @else
            <div class="glass-card rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/5">
                            <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase">Terrain</th>
                            <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase">Adhérent</th>
                            <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase">Début</th>
                            <th class="p-4 text-xs font-semibold text-slate-400 tracking-wider uppercase">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($reservations as $reservation)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="p-4 text-sm font-bold text-white">{{ $reservation->terrain->nom }}</td>
                                <td class="p-4 text-sm text-slate-400">{{ $reservation->adherent->nom }}</td>
                                <td class="p-4 text-sm text-slate-400">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d M Y H:i') }}</td>
                                <td class="p-4 text-sm"><span class="px-2 py-1 rounded bg-accent-500/20 text-accent-400 font-bold uppercase tracking-widest text-[10px]">{{ $reservation->statut }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
</body>
</html>
