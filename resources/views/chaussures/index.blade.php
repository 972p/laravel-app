<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Chaussures</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { background-color: #0a0a0c; color: #f8fafc; }
        .glass-nav { background: rgba(10, 10, 12, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .text-gradient { background: linear-gradient(to right, #f97316, #ea580c, #c2410c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); transition: all 0.4s ease; }
        .glass-card:hover { border: 1px solid rgba(249, 115, 22, 0.3); transform: translateY(-8px); }
        .ambient-mesh { position: fixed; inset: 0; background-image: radial-gradient(at 10% 20%, rgba(249, 115, 22, 0.05) 0px, transparent 50%), radial-gradient(at 90% 80%, rgba(234, 88, 12, 0.05) 0px, transparent 50%); z-index: -1; pointer-events: none; }
        .flatpickr-input { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(255,255,255,0.1) !important; color: white !important; border-radius: 0.75rem !important; padding: 0.6rem 1rem !important; width: 100%; font-size: 0.75rem; transition: all 0.3s; }
        .flatpickr-input:hover { border-color: rgba(249, 115, 22, 0.5) !important; }
        select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.7rem center; background-size: 1rem; }
    </style>
</head>

<body class="antialiased font-sans flex flex-col min-h-screen">
    <div class="ambient-mesh"></div>

    <nav class="glass-nav fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>
                    </div>
                    <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span class="text-gradient not-italic font-sans font-extrabold ml-1">Sports</span></span>
                </a>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Le Complexe</a>
                    <a href="/ballons" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Ballons</a>
                    <a href="{{ route('chaussures.index') }}" class="text-white text-sm font-medium relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-accent-500">Chaussures</a>
                    <a href="/terrains" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Terrains</a>
                    <a href="/retours" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Retours</a>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="/admin" class="text-white hover:text-accent-400 text-sm font-medium transition-colors">Administration</a>
                    @endif
                    <a href="/compte" class="ml-4 px-5 py-2 rounded-full border border-white/10 hover:bg-white/10 text-white text-sm font-semibold transition-all">Espace Membre</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative z-10">
        <div class="max-w-7xl mx-auto">
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400 text-sm">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-8 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-400 text-sm">{{ $errors->first() }}</div>
            @endif

            <header class="mb-12 text-center md:text-left">
                <h1 class="text-4xl lg:text-5xl font-serif font-bold text-white mb-4">Sneakers <span class="text-gradient">Pro</span></h1>
                <p class="text-slate-400 font-light text-lg max-w-2xl">Filtrez par marque, pointure ou style et gérez vos emprunts en temps réel.</p>
            </header>

            <form action="{{ route('chaussures.index') }}" method="GET" class="mb-12 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 bg-white/5 p-6 rounded-2xl border border-white/10">
                
                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Marque</label>
                    <select name="brand" class="bg-dark-800 border-white/10 rounded-xl text-white text-xs p-2.5 outline-none focus:border-accent-500">
                        <option value="">Toutes</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Pointure</label>
                    <select name="size" class="bg-dark-800 border-white/10 rounded-xl text-white text-xs p-2.5 outline-none focus:border-accent-500">
                        <option value="">Toutes</option>
                        @foreach($sizes as $size)
                            <option value="{{ $size }}" {{ request('size') == $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Style</label>
                    <select name="tag" class="bg-dark-800 border-white/10 rounded-xl text-white text-xs p-2.5 outline-none focus:border-accent-500">
                        <option value="">Tous les styles</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Modèle</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ex: Air..." class="bg-dark-800 border-white/10 rounded-xl text-white text-xs p-2.5 outline-none focus:border-accent-500">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Disponibilité</label>
                    <input type="text" id="global-datepicker" placeholder="Dates..." class="bg-dark-800 border-white/10 rounded-xl text-white text-xs p-2.5 outline-none focus:border-accent-500 flatpickr-input" value="{{ request('start_date') ? request('start_date').' au '.request('end_date') : '' }}">
                    <input type="hidden" name="start_date" id="global_start" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" id="global_end" value="{{ request('end_date') }}">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full py-2.5 bg-accent-500 hover:bg-accent-600 text-white rounded-xl font-bold text-xs transition-all shadow-lg shadow-accent-500/20">Filtrer</button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($chaussures as $chauss)
                    <div class="glass-card rounded-[1.5rem] p-6 group flex flex-col h-full bg-dark-800/80">
                        <div class="flex-grow">
                            <div class="h-40 mb-6 flex items-center justify-center">
                                @if($chauss->image)
                                    <img src="{{ asset('storage/' . $chauss->image) }}" class="w-full h-full object-contain transition-transform group-hover:scale-110" alt="{{ $chauss->modele }}">
                                @else
                                    <div class="w-16 h-16 rounded-xl bg-white/5 flex items-center justify-center text-slate-600"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold bg-indigo-500/20 text-indigo-300">{{ $chauss->marque }}</span>
                                @foreach($chauss->tags as $t)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/5 text-slate-400">#{{ $t->name }}</span>
                                @endforeach
                            </div>
                            
                            <h3 class="text-lg font-serif text-white mb-1 uppercase tracking-widest truncate">{{ $chauss->modele }}</h3>
                            
                            <div class="flex justify-between items-center mb-4 text-xs">
                                <p class="text-slate-400 font-medium">Taille: <span class="text-white">{{ $chauss->pointure }}</span></p>
                                <span class="text-accent-400 font-bold uppercase">{{ $chauss->etat }}</span>
                            </div>
                        </div>

                        <form action="{{ route('chaussures.emprunter', $chauss->id_chaussure) }}" method="POST" class="mt-auto space-y-3">
                            @csrf
                            <input type="text" class="datepicker" placeholder="Choisir vos dates" 
                                   data-booked="{{ $chauss->getBookedDates()->toJson() }}" required>
                            
                            <input type="hidden" name="start_date" class="start_val">
                            <input type="hidden" name="end_date" class="end_val">

                            <button type="submit" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 text-white text-xs font-bold hover:bg-accent-500 hover:border-accent-500 transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Réserver
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white/5 rounded-3xl border border-white/5">
                        <p class="text-slate-500">Aucun résultat. Essayez d'autres critères.</p>
                        <a href="{{ route('chaussures.index') }}" class="text-accent-400 text-sm mt-2 inline-block">Réinitialiser</a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <footer class="border-t border-white/10 bg-dark-900/50 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex justify-between items-center">
            <div class="text-sm font-serif italic text-white">H3<span class="text-accent-400 ml-1">Sports</span></div>
            <div class="text-slate-500 text-[10px] tracking-wider uppercase">&copy; 2026 H3 Campus</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // On initialise un calendrier pour CHAQUE chaussure
            document.querySelectorAll('.datepicker').forEach(function(el) {
                // On récupère les dates bloquées depuis l'attribut data-booked
                const bookedDates = JSON.parse(el.dataset.booked || '[]');
                
                // On prépare le format pour Flatpickr
                const disableConfig = bookedDates.map(range => ({
                    from: range.from,
                    to: range.to
                }));

                flatpickr(el, {
                    mode: "range",
                    minDate: "today",
                    dateFormat: "Y-m-d",
                    locale: "fr",
                    disable: disableConfig, // Les dates grisées !
                    onClose: function(selectedDates, dateStr, instance) {
                        if (selectedDates.length === 2) {
                            const form = instance.element.closest('form');
                            // On remplit les inputs cachés start_date et end_date
                            form.querySelector('.start_val').value = selectedDates[0].toISOString().split('T')[0];
                            form.querySelector('.end_val').value = selectedDates[1].toISOString().split('T')[0];
                        }
                    }
                });
            });

            // Initialisation du calendrier global pour le filtrage
            flatpickr('#global-datepicker', {
                mode: "range",
                minDate: "today",
                dateFormat: "Y-m-d",
                locale: "fr",
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        document.getElementById('global_start').value = selectedDates[0].toISOString().split('T')[0];
                        document.getElementById('global_end').value = selectedDates[1].toISOString().split('T')[0];
                    } else {
                        document.getElementById('global_start').value = '';
                        document.getElementById('global_end').value = '';
                    }
                }
            });
        });
    </script>
</body>
</html>