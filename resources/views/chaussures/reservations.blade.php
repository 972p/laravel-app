@extends('layouts.app')

@section('title', 'H3 Sports | Mes Réservations')

@section('content')
<header class="mb-12">
    <h1 class="text-4xl lg:text-5xl font-serif font-bold text-white mb-4">Mon <span class="text-gradient">Planning</span></h1>
    <p class="text-slate-400 font-light text-lg">Retrouvez ici vos réservations de chaussures et de terrains.</p>
</header>

@if(session('success'))
    <div class="mb-8 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="space-y-12">
    <!-- Section Chaussures -->
    <section>
        <div class="flex items-center gap-4 mb-6">
            <h2 class="text-2xl font-serif font-bold text-white">Réservations Chaussures</h2>
            <div class="h-px flex-grow bg-white/10"></div>
        </div>
        
        <div class="glass-card rounded-[2rem] overflow-hidden border border-white/5">
            <div class="p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-500 text-xs uppercase tracking-widest border-b border-white/10">
                            <th class="pb-6 font-bold">Modèle</th>
                            <th class="pb-6 font-bold">Période</th>
                            <th class="pb-6 font-bold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($shoeReservations as $res)
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.25 9.141v-1.5a1.5 1.5 0 00-1.5-1.5h-1.5A3.75 3.75 0 007.5 9.89v10.61c0 1.036.84 1.875 1.875 1.875h7.5A3.75 3.75 0 0020.625 18v-.75a4.5 4.5 0 00-4.5-4.5h-1.875M14.25 9.141V11.25"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-white font-bold">{{ $res->shoe->name }}</div>
                                            <div class="text-slate-500 text-xs uppercase tracking-wider">{{ $res->shoe->brand }} - P.{{ $res->shoe->size }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <div class="text-slate-300 text-sm">{{ $res->start_date->format('d/m/Y') }}</div>
                                    <div class="text-slate-500 text-xs">Jusqu'au {{ $res->end_date->format('d/m/Y') }}</div>
                                </td>
                                <td class="py-6 text-right">
                                    <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Annuler cette réservation ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold uppercase tracking-widest text-rose-400 hover:text-rose-300 transition-colors px-4 py-2 rounded-lg border border-rose-500/20 bg-rose-500/5 hover:bg-rose-500/10 cursor-pointer">
                                            Annuler
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-slate-500 text-sm italic">Aucune réservation de chaussures.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Section Terrains -->
    <section>
        <div class="flex items-center gap-4 mb-6">
            <h2 class="text-2xl font-serif font-bold text-white">Réservations Terrains</h2>
            <div class="h-px flex-grow bg-white/10"></div>
        </div>
        
        <div class="glass-card rounded-[2rem] overflow-hidden border border-white/5">
            <div class="p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-500 text-xs uppercase tracking-widest border-b border-white/10">
                            <th class="pb-6 font-bold">Terrain</th>
                            <th class="pb-6 font-bold">Date & Heure</th>
                            <th class="pb-6 font-bold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($terrainReservations as $res)
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-accent-500/10 border border-accent-500/20 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-white font-bold">{{ $res->terrain->nom }}</div>
                                            <div class="text-slate-500 text-xs uppercase tracking-wider">{{ $res->terrain->type_sol }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <div class="text-slate-300 text-sm">{{ \Carbon\Carbon::parse($res->date_debut)->format('d/m/Y H:i') }}</div>
                                    <div class="text-slate-500 text-xs">Durée : {{ \Carbon\Carbon::parse($res->date_debut)->diffInMinutes($res->date_fin) }} min</div>
                                </td>
                                <td class="py-6 text-right">
                                    <form action="{{ route('reservations.destroy', $res->id_reservation) }}" method="POST" onsubmit="return confirm('Annuler cette réservation ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold uppercase tracking-widest text-rose-400 hover:text-rose-300 transition-colors px-4 py-2 rounded-lg border border-rose-500/20 bg-rose-500/5 hover:bg-rose-500/10 cursor-pointer">
                                            Annuler
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-slate-500 text-sm italic">Aucune réservation de terrain.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
