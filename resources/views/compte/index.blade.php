<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Espace Membre</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

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
        body { background-color: #0c0c0e; color: #f8fafc; }
        .glass-nav { background: rgba(12, 12, 14, 0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .text-gradient { background: linear-gradient(to right, #f97316, #ea580c, #c2410c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass-panel { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); }
        .ambient-mesh {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(at 0% 0%, rgba(249, 115, 22, 0.1) 0px, transparent 50%);
            z-index: -1; pointer-events: none;
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
                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg></div>
                    <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span class="text-gradient not-italic font-sans font-extrabold ml-1">Sports</span></span>
                </a>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Le Complexe</a>
                    <a href="/ballons" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Ballons</a>
                    <a href="/chaussures" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Chaussures</a>
                    <a href="/terrains" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Terrains</a>
                    <a href="/retours" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Retours</a>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="/admin" class="text-white hover:text-accent-400 text-sm font-medium transition-colors">Administration</a>
                    @endif
                    <a href="/compte" class="ml-4 px-5 py-2 rounded-full border border-white/10 bg-white/5 text-white text-sm font-semibold relative after:content-[''] after:absolute after:-bottom-3 after:left-1/2 after:-translate-x-1/2 after:w-1/2 after:h-0.5 after:bg-accent-500">Espace Membre</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative z-10 w-full max-w-7xl mx-auto">
        
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div class="flex items-center gap-6">
                <!-- User Avatar Fake -->
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-accent-400 to-accent-600 p-0.5 shadow-lg shadow-accent-500/20">
                        <div class="w-full h-full rounded-2xl bg-dark-900 border border-white/10 flex items-center justify-center text-2xl font-serif text-white overflow-hidden relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=121216&color=f8fafc&bold=true" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-4 mb-1">
                        <h1 class="text-3xl font-serif font-bold text-white">Espace <span class="text-gradient">{{ explode(' ', Auth::user()->name)[0] }}</span></h1>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 font-semibold tracking-wide uppercase px-3 py-1.5 rounded-lg border border-rose-500/20 bg-rose-500/10 hover:bg-rose-500/20 transition-all cursor-pointer">Déconnexion</button>
                        </form>
                    </div>
                    <p class="text-slate-400 text-sm font-light">Gérez vos équipements et consultez votre historique.</p>
                </div>
            </div>
            
            <div class="glass-panel px-6 py-4 rounded-2xl flex gap-8">
                <div>
                    <div class="text-xs text-slate-500 uppercase tracking-widest font-semibold mb-1">Emprunts en cours</div>
                    <div class="text-2xl font-bold text-white">{{ count($empruntsActifs) }}</div>
                </div>
                <div class="w-px bg-white/10"></div>
                <div>
                    <div class="text-xs text-slate-500 uppercase tracking-widest font-semibold mb-1">Activités</div>
                    <div class="text-2xl font-bold text-white">{{ count($historique) }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Active Borrows -->
            <div class="lg:col-span-2 space-y-8">
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-serif text-white font-semibold">Équipements Empruntés</h2>
                        <a href="/retours" class="text-sm text-accent-400 hover:text-accent-300 transition-colors">Gérer les retours &rarr;</a>
                    </div>

                    @if($empruntsActifs->isEmpty())
                        <div class="glass-panel rounded-2xl p-10 text-center">
                            <p class="text-slate-400 text-sm">Vous n'avez pas d'équipements en votre possession.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach ($empruntsActifs as $emprunt)
                                <div class="glass-panel rounded-2xl p-5 hover:border-white/20 transition-all flex gap-5 items-start cursor-pointer group">
                                    @if($emprunt->ballon)
                                        <div class="w-16 h-16 bg-gradient-to-br from-[#d97706] to-[#78350f] rounded-full border border-white/20 shadow-xl flex-shrink-0 relative overflow-hidden group-hover:scale-105 transition-transform flex items-center justify-center">
                                            <div class="absolute w-full h-0.5 bg-black/40 rotate-[15deg]"></div>
                                            <div class="absolute w-0.5 h-full bg-black/40 -rotate-[15deg]"></div>
                                        </div>
                                        <div class="flex-grow pt-1">
                                            <div class="text-[10px] text-accent-400 font-bold uppercase tracking-widest mb-1">{{ $emprunt->ballon->marque }}</div>
                                            <h3 class="text-lg font-serif font-bold text-white line-clamp-2 leading-tight mb-3">Taille {{ $emprunt->ballon->taille }}</h3>
                                    @elseif($emprunt->chaussure)
                                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl border border-indigo-400/20 shadow-xl flex-shrink-0 group-hover:scale-105 transition-transform flex items-center justify-center rotate-[-10deg]">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.25 9.141v-1.5a1.5 1.5 0 00-1.5-1.5h-1.5A3.75 3.75 0 007.5 9.89v10.61c0 1.036.84 1.875 1.875 1.875h7.5A3.75 3.75 0 0020.625 18v-.75a4.5 4.5 0 00-4.5-4.5h-1.875M14.25 9.141V11.25"></path></svg>
                                        </div>
                                        <div class="flex-grow pt-1">
                                            <div class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest mb-1">{{ $emprunt->chaussure->marque }}</div>
                                            <h3 class="text-lg font-serif font-bold text-white line-clamp-2 leading-tight mb-3">{{ $emprunt->chaussure->modele }} - P.{{ $emprunt->chaussure->pointure }}</h3>
                                    @endif

                                        <div class="flex items-center gap-2">
                                            <div class="w-full bg-white/5 rounded-full h-1.5 flex-grow">
                                                @php
                                                    $start = \Carbon\Carbon::parse($emprunt->date_debut);
                                                    $end = \Carbon\Carbon::parse($emprunt->date_expiration);
                                                    $total = $start->diffInDays($end);
                                                    $elapsed = $start->diffInDays(now());
                                                    $progress = min(100, max(0, ($elapsed / max(1, $total)) * 100));
                                                @endphp
                                                <div class="bg-gradient-to-r from-accent-400 to-accent-600 h-1.5 rounded-full" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <div class="text-xs text-slate-500 font-medium w-10 text-right">{{ round($progress) }}%</div>
                                        </div>
                                        <div class="flex items-center justify-between mt-3">
                                            <div class="text-[10px] text-slate-500">À retourner avant le : {{ \Carbon\Carbon::parse($emprunt->date_expiration)->format('d/m/Y') }}</div>
                                            <form action="{{ route('emprunts.retourner', $emprunt->id_emprunt) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-[10px] font-bold uppercase tracking-wider text-red-400 hover:text-red-300 transition-colors px-2 py-1 rounded bg-red-400/10 hover:bg-red-400/20 cursor-pointer">
                                                    Retourner
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-serif text-white font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                            Mes Terrains Réservés
                        </h2>
                        <a href="/terrains" class="text-xs font-bold uppercase tracking-wider text-accent-400 hover:text-white transition-colors">Réserver +</a>
                    </div>

                    @if($reservations->isEmpty())
                        <div class="glass-panel rounded-2xl p-10 text-center">
                            <p class="text-slate-400 text-sm">Vous n'avez aucune réservation de terrain à venir.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($reservations as $resa)
                                <div class="glass-panel rounded-xl p-5 border-l-4 border-accent-500 flex flex-col gap-3 relative overflow-hidden group">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-bold text-white uppercase tracking-wide">{{ $resa->terrain->nom ?? 'Terrain inconnu' }}</h3>
                                            <div class="text-xs text-slate-400 mt-1 flex items-center gap-2">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                {{ \Carbon\Carbon::parse($resa->date_debut)->translatedFormat('l d F \à H:i') }}
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end gap-2">
                                            <span class="px-2 py-1 rounded bg-accent-500/20 text-accent-400 text-[10px] font-bold uppercase">{{ $resa->statut }}</span>
                                            <form action="{{ route('planning.destroy', $resa->id_reservation) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="if(confirm('Annuler cette réservation ?')) this.closest('form').submit();" class="text-[10px] text-slate-400 hover:text-rose-400 transition-colors uppercase tracking-wider font-bold">
                                                    Annuler
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-white/5 pt-3 mt-1">
                                        <div class="text-xs text-slate-400">
                                            Fin prévue : <span class="text-white">{{ \Carbon\Carbon::parse($resa->date_fin)->format('H:i') }}</span>
                                        </div>
                                        <div class="text-xs text-slate-400">
                                            Plancher: <span class="text-white uppercase">{{ $resa->terrain->type_sol ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-serif text-white font-semibold">Performances & Shooting</h2>
                        <form action="{{ route('stats.simuler') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-white font-bold tracking-widest uppercase bg-accent-500 hover:bg-accent-400 px-4 py-2 rounded-lg transition-colors shadow-lg shadow-accent-500/20 cursor-pointer">Simuler Session</button>
                        </form>
                    </div>

                    @if($stats->isEmpty())
                        <div class="glass-panel rounded-2xl p-10 text-center">
                            <p class="text-slate-400 text-sm">Aucune donnée de tir enregistrée.</p>
                        </div>
                    @else
                        @php
                            $latest = $stats->first();
                            $pctTotal = $latest->tirs_tentes > 0 ? round(($latest->tirs_reussis / $latest->tirs_tentes) * 100) : 0;
                            $pctRaquette = $latest->raquette_tentes > 0 ? round(($latest->raquette_reussis / $latest->raquette_tentes) * 100) : 0;
                            $pctMid = $latest->mid_tentes > 0 ? round(($latest->mid_reussis / $latest->mid_tentes) * 100) : 0;
                            $pct3pt = $latest->trois_pts_tentes > 0 ? round(($latest->trois_pts_reussis / $latest->trois_pts_tentes) * 100) : 0;
                        @endphp
                        <div class="glass-panel rounded-2xl p-6 border border-accent-500/20 relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 w-40 h-40 bg-accent-500/10 blur-3xl rounded-full pointer-events-none"></div>

                            <div class="flex items-center gap-4 mb-6 relative z-10">
                                <div class="w-12 h-12 rounded-full bg-accent-500/20 text-accent-500 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-white font-bold tracking-wide text-lg">{{ $latest->terrain->nom ?? 'Terrain inconnu' }}</div>
                                    <div class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($latest->date_session)->diffForHumans() }}</div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="text-4xl font-black text-white">{{ $pctTotal }}<span class="text-lg text-slate-400">%</span></div>
                                    <div class="text-[10px] text-accent-500 font-bold uppercase tracking-widest">{{ $latest->tirs_reussis }} / {{ $latest->tirs_tentes }} FGM</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 relative z-10">
                                <!-- Raquette -->
                                <div class="bg-dark-900/50 rounded-xl p-4 border border-white/5">
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Raquette</div>
                                    <div class="flex items-end gap-2 mb-2">
                                        <div class="text-2xl font-bold text-white leading-none">{{ $pctRaquette }}%</div>
                                        <div class="text-xs text-slate-500 mb-0.5">{{ $latest->raquette_reussis }}/{{ $latest->raquette_tentes }}</div>
                                    </div>
                                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400" style="width: {{ $pctRaquette }}%"></div>
                                    </div>
                                </div>

                                <!-- Mid Range -->
                                <div class="bg-dark-900/50 rounded-xl p-4 border border-white/5">
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Mi-Distance</div>
                                    <div class="flex items-end gap-2 mb-2">
                                        <div class="text-2xl font-bold text-white leading-none">{{ $pctMid }}%</div>
                                        <div class="text-xs text-slate-500 mb-0.5">{{ $latest->mid_reussis }}/{{ $latest->mid_tentes }}</div>
                                    </div>
                                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-amber-500 to-amber-400" style="width: {{ $pctMid }}%"></div>
                                    </div>
                                </div>

                                <!-- 3 points -->
                                <div class="bg-dark-900/50 rounded-xl p-4 border border-white/5">
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">3 Points</div>
                                    <div class="flex items-end gap-2 mb-2">
                                        <div class="text-2xl font-bold text-white leading-none">{{ $pct3pt }}%</div>
                                        <div class="text-xs text-slate-500 mb-0.5">{{ $latest->trois_pts_reussis }}/{{ $latest->trois_pts_tentes }}</div>
                                    </div>
                                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-sky-500 to-sky-400" style="width: {{ $pct3pt }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </section>
            </div>

            <!-- Right Column: History -->
            <div class="lg:col-span-1">
                <section class="glass-panel rounded-[2rem] p-6 h-full border border-white/5">
                    <h2 class="text-lg font-serif text-white font-semibold mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Activité Récente
                    </h2>

                    @if($historique->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-slate-500 text-sm">Aucun historique disponible.</p>
                        </div>
                    @else
                        <div class="relative border-l border-white/10 ml-3 space-y-8 pb-4">
                            @foreach ($historique as $log)
                                <div class="relative pl-6">
                                    <span class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full {{ $log->action == 'EMPRUNT' ? 'bg-accent-500 shadow-[0_0_10px_rgba(249,115,22,0.5)]' : 'bg-slate-600 border border-white/20' }}"></span>
                                    <div class="text-sm font-medium text-white mb-0.5">{{ $log->action }}</div>
                                    @if($log->emprunt->ballon)
                                        <div class="text-xs text-slate-400 mb-2">Ballon {{ $log->emprunt->ballon->marque }}</div>
                                    @elseif($log->emprunt->chaussure)
                                        <div class="text-xs text-slate-400 mb-2">Chaussures {{ $log->emprunt->chaussure->marque }}</div>
                                    @else
                                        <div class="text-xs text-slate-400 mb-2">Équipement inconnu</div>
                                    @endif
                                    <div class="flex items-center gap-1.5 text-[10px] uppercase tracking-widest text-slate-500">
                                        <span>{{ \Carbon\Carbon::parse($log->date_action)->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </main>
</body>
</html>
