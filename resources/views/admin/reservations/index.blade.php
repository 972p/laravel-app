@extends('layouts.admin')

@section('title', 'Gestion des Réservations')

@section('content')
    <div class="glass-panel border-white/5 bg-dark-900/40 rounded-[2rem] p-8 hidden md:block">
        <div class="overflow-x-auto text-left">
            <table class="w-full text-slate-400 text-sm">
                <thead class="text-xs uppercase bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4 rounded-l-xl">ID</th>
                        <th class="px-6 py-4">Utilisateur</th>
                        <th class="px-6 py-4">Terrain</th>
                        <th class="px-6 py-4">Créneau</th>
                        <th class="px-6 py-4">Statut</th>
                        <th class="px-6 py-4 text-right rounded-r-xl">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                        <tr x-data="{ editing: false }" class="border-b border-white/5 hover:bg-white/5 transition-colors">

                            <td x-show="!editing" class="px-6 py-4 font-mono text-accent-400">#{{ $res->id_reservation }}</td>
                            <td x-show="!editing" class="px-6 py-4 text-white font-medium">
                                {{ $res->user->name ?? 'Utilisateur inconnu' }}</td>
                            <td x-show="!editing" class="px-6 py-4">{{ $res->terrain->nom ?? 'N/A' }}</td>
                            <td x-show="!editing" class="px-6 py-4 font-mono text-slate-300">
                                {{ \Carbon\Carbon::parse($res->date_debut)->format('d/m/Y H:i') }} -
                                {{ \Carbon\Carbon::parse($res->date_fin)->format('H:i') }}
                            </td>
                            <td x-show="!editing" class="px-6 py-4">
                                @if($res->statut === 'confirmée')
                                    <span
                                        class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs tracking-wider">Confirmée</span>
                                @elseif($res->statut === 'annulée')
                                    <span
                                        class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-xs tracking-wider">Annulée</span>
                                @else
                                    <span
                                        class="bg-slate-500/20 text-slate-400 px-3 py-1 rounded-full text-xs tracking-wider">{{ ucfirst($res->statut) }}</span>
                                @endif
                            </td>
                            <td x-show="!editing" class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button @click="editing = true"
                                        class="px-3 py-1 border border-indigo-500/30 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded text-xs font-medium transition-colors">
                                        Statut
                                    </button>

                                    {{-- FIX : Passage explicite de id_reservation pour la suppression --}}
                                    <form
                                        action="{{ route('admin.reservations.destroy', ['reservation' => $res->id_reservation]) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="if(confirm('Attention ! Confirmer la suppression de cette réservation ?')) this.closest('form').submit();"
                                            class="px-3 py-1 border border-red-500/30 text-red-500 hover:bg-red-500 hover:text-white rounded text-xs font-medium transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <td x-show="editing" colspan="6" class="px-6 py-4 bg-white/5 rounded-xl">
                                {{-- FIX : Passage explicite de id_reservation pour l'update --}}
                                <form action="{{ route('admin.reservations.update', ['reservation' => $res->id_reservation]) }}"
                                    method="POST" class="flex items-center gap-4 justify-end">
                                    @csrf
                                    @method('PUT')
                                    <span class="text-sm text-slate-400">Modifier le statut de la réservation
                                        #{{ $res->id_reservation }}:</span>
                                    <select name="statut"
                                        class="bg-dark-900 border border-white/10 rounded px-3 py-1.5 text-white focus:outline-none focus:border-accent-500 text-sm">
                                        <option value="confirmée" {{ $res->statut == 'confirmée' ? 'selected' : '' }}>Confirmée
                                        </option>
                                        <option value="terminée" {{ $res->statut == 'terminée' ? 'selected' : '' }}>Terminée
                                        </option>
                                        <option value="annulée" {{ $res->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                    <div class="flex gap-2">
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-accent-600 hover:bg-accent-500 text-white rounded text-sm transition-colors font-medium">Valider</button>
                                        <button type="button" @click="editing = false"
                                            class="px-3 py-1.5 border border-slate-600 text-slate-400 hover:text-white rounded text-sm transition-colors">Annuler</button>
                                    </div>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection