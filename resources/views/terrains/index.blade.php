<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Les Terrains</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s ease;
        }

        .glass-card:hover {
            border: 1px solid rgba(249, 115, 22, 0.3);
            transform: translateY(-8px);
        }

        .ambient-mesh {
            position: fixed;
            inset: 0;
            background-image: radial-gradient(at 10% 20%, rgba(249, 115, 22, 0.05) 0px, transparent 50%), radial-gradient(at 90% 80%, rgba(234, 88, 12, 0.05) 0px, transparent 50%);
            z-index: -1;
            pointer-events: none;
        }

        /* Style Flatpickr */
        .flatpickr-input {
            background: rgba(18, 18, 22, 1) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem !important;
            font-size: 0.875rem;
            width: 100%;
        }
    </style>
</head>

<body class="antialiased font-sans flex flex-col min-h-screen">
    <div class="ambient-mesh"></div>

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
                    <a href="/" class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Le
                        Complexe</a>
                    <a href="/ballons"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Ballons</a>
                    <a href="/chaussures"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Chaussures</a>
                    <a href="/terrains"
                        class="text-white text-sm font-medium relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-accent-500">Terrains</a>
                    <a href="/retours"
                        class="text-slate-400 text-sm font-medium hover:text-white transition-colors">Retours</a>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="/admin"
                            class="text-white hover:text-accent-400 text-sm font-medium transition-colors">Administration</a>
                    @endif
                    <a href="/compte"
                        class="ml-4 px-5 py-2 rounded-full border border-white/10 hover:bg-white/10 text-white text-sm font-semibold transition-all">Espace
                        Membre</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative z-10">
        <div class="max-w-7xl mx-auto">

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <header class="mb-16 text-center md:text-left">
                <h1 class="text-4xl lg:text-5xl font-serif font-bold text-white mb-4">Terrains <span
                        class="text-gradient">Disponibles</span></h1>
                <p class="text-slate-400 font-light text-lg">Sélectionnez votre terrain et votre créneau horaire.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($terrains as $terrain)
                    <div class="glass-card rounded-[1.5rem] p-6 group flex flex-col h-full bg-dark-800/80">

                        <div class="relative z-10 mb-6">
                            <div
                                class="h-40 flex items-center justify-center relative rounded-xl bg-dark-900 border border-white/5 overflow-hidden">
                                <div class="absolute inset-0 border-4 border-accent-600/30 m-4 rounded"></div>
                                <div
                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-16 h-16 border-4 border-accent-600/30 rounded-full">
                                </div>
                                <div class="absolute w-full h-1 bg-accent-600/30 top-1/2 -translate-y-1/2"></div>
                            </div>

                            <h3 class="text-2xl font-serif text-white mt-4 uppercase tracking-wide">{{ $terrain->nom }}</h3>
                            <p class="text-slate-500 text-xs mt-1 uppercase tracking-widest">{{ $terrain->type_sol }}</p>
                        </div>

                        <form action="{{ route('terrains.reserver', $terrain->id_terrain) }}" method="POST"
                            class="mt-auto space-y-4">
                            @csrf

                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Date & Heure
                                    de début</label>
                                <input type="text" name="date_debut" class="timepicker" placeholder="Choisir le créneau"
                                    data-booked="{{ $terrain->getBookedSlotsJson() }}" required>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label
                                        class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Durée</label>
                                    <select name="duree_heures" required
                                        class="bg-dark-900 border border-white/10 rounded-lg px-3 py-2 text-white text-sm outline-none focus:border-accent-500">
                                        <option value="1">1h</option>
                                        <option value="2">2h</option>
                                        <option value="3">3h</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label
                                        class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Joueurs</label>
                                    <select name="nombres_joueurs" required
                                        class="bg-dark-900 border border-white/10 rounded-lg px-3 py-2 text-white text-sm outline-none focus:border-accent-500">
                                        <option value="2">1v1</option>
                                        <option value="4">2v2</option>
                                        <option value="6">3v3</option>
                                        <option value="10">5v5</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-3 rounded-xl bg-accent-500 text-white font-bold hover:bg-accent-600 transition-all shadow-lg shadow-accent-500/20">
                                Confirmer la réservation
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.timepicker').forEach(function (el) {
                // On récupère les créneaux déjà réservés
                const booked = JSON.parse(el.dataset.booked || '[]');

                flatpickr(el, {
                    enableTime: true,
                    noCalendar: false,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    time_24hr: true,
                    locale: "fr",
                    minuteIncrement: 60, // On réserve par heure pile
                    disable: booked.map(slot => ({
                        from: slot.from,
                        to: slot.to
                    }))
                });
            });
        });
    </script>
</body>

</html>