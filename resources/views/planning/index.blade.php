@extends('layouts.app')

@section('title', 'Mon Planning | H3 Sports')

@section('content')
    <main class="flex-grow pt-10 pb-20 relative z-10">
        <div class="max-w-7xl mx-auto">
            <header class="mb-12">
                <h1 class="text-4xl font-serif font-bold text-white mb-2 uppercase tracking-tighter">
                    Mon <span class="text-gradient">Planning</span>
                </h1>
                <p class="text-slate-400 font-light italic">Retrouvez ici vos réservations de matériel et vos créneaux de
                    terrains.</p>
            </header>

            {{-- SECTION 1 : ÉQUIPEMENTS (Chaussures / Ballons) --}}
            <div class="mb-16">
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="text-xl font-serif text-white border-b border-white/10 pb-2">Matériel Emprunté</h2>
                    <span
                        class="bg-indigo-500/10 text-indigo-400 text-[10px] px-2 py-1 rounded-md font-bold uppercase tracking-widest">Équipements</span>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden bg-dark-800/50">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-white/5 text-[10px] uppercase tracking-widest text-slate-500">
                            <tr>
                                <th class="px-6 py-4">Article</th>
                                <th class="px-6 py-4">Période d'emprunt</th>
                                <th class="px-6 py-4 text-right">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($emprunts as $emprunt)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white uppercase italic">
                                                @if($emprunt->chaussure)
                                                    {{ $emprunt->chaussure->marque }} {{ $emprunt->chaussure->modele }}
                                                @elseif($emprunt->ballon)
                                                    Ballon {{ $emprunt->ballon->marque }}
                                                @else
                                                    <span class="text-slate-500">Équipement non défini</span>
                                                @endif
                                            </span>
                                            <span class="text-[10px] text-slate-500 uppercase tracking-tighter">Réf:
                                                #{{ $emprunt->id_emprunt }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-medium">
                                        <span class="text-slate-400">Du</span>
                                        {{ optional($emprunt->date_debut)->format('d/m/Y') ?? 'N/A' }}
                                        <span class="text-slate-400 mx-1">au</span>
                                        {{ optional($emprunt->date_expiration)->format('d/m/Y') ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span
                                            class="px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-[10px] font-bold uppercase tracking-widest">
                                            {{ $emprunt->statut ?? 'En cours' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-500 italic text-xs">Aucun
                                        équipement en cours d'emprunt.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- SECTION 2 : TERRAINS --}}
            <div>
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="text-xl font-serif text-white border-b border-white/10 pb-2">Mes Réservations</h2>
                    <span
                        class="bg-accent-500/10 text-accent-400 text-[10px] px-2 py-1 rounded-md font-bold uppercase tracking-widest">Terrains</span>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden bg-dark-800/50">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-white/5 text-[10px] uppercase tracking-widest text-slate-500">
                            <tr>
                                <th class="px-6 py-4">Lieu / Terrain</th>
                                <th class="px-6 py-4">Date & Horaires</th>
                                <th class="px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($reservations as $res)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-6 py-4 font-bold text-white uppercase tracking-tight">
                                        {{ $res->terrain->nom ?? 'Terrain inconnu' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs font-medium">
                                        <div class="flex flex-col">
                                            <span class="text-white">Le
                                                {{ \Carbon\Carbon::parse($res->date_debut)->translatedFormat('d F Y') }}</span>
                                            <span class="text-slate-500">
                                                {{ \Carbon\Carbon::parse($res->date_debut)->format('H:i') }}
                                                - {{ \Carbon\Carbon::parse($res->date_fin)->format('H:i') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center gap-6">
                                            <span class="text-accent-400 text-[10px] font-bold uppercase tracking-widest">
                                                {{ $res->statut ?? 'Confirmé' }}
                                            </span>

                                            {{-- FORMULAIRE DE SUPPRESSION MIS À JOUR --}}
                                            <form action="{{ route('planning.destroy', $res->id_reservation) }}" method="POST"
                                                onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-slate-500 hover:text-red-500 transition-colors p-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-500 italic text-xs">Aucune
                                        réservation de terrain prévue.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection