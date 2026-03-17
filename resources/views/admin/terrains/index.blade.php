@extends('layouts.admin')

@section('title', 'Gestion des Terrains')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <!-- Liste des Terrains -->
    <div class="xl:col-span-2 glass-panel border-white/5 bg-dark-900/40 rounded-[2rem] p-8">
        <div class="overflow-x-auto text-left">
            <table class="w-full text-slate-400 text-sm">
                <thead class="text-xs uppercase bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4 rounded-l-xl">ID</th>
                        <th class="px-6 py-4">Nom du Terrain</th>
                        <th class="px-6 py-4">Type de Sol</th>
                        <th class="px-6 py-4 text-right rounded-r-xl">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($terrains as $terrain)
                    <tr x-data="{ editing: false }" class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        
                        <!-- VIEW MODE -->
                        <td x-show="!editing" class="px-6 py-4 font-mono text-accent-400">#{{ $terrain->id_terrain }}</td>
                        <td x-show="!editing" class="px-6 py-4 text-white font-medium">{{ $terrain->nom }}</td>
                        <td x-show="!editing" class="px-6 py-4 uppercase text-xs">{{ $terrain->type_sol }}</td>
                        <td x-show="!editing" class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="editing = true" class="px-3 py-1 border border-indigo-500/30 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded text-xs font-medium transition-colors">
                                    Éditer
                                </button>
                                <form action="{{ route('admin.terrains.destroy', $terrain) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="if(confirm('Supprimer ce terrain supprimera toutes les réservations associées. Confirmer ?')) this.closest('form').submit();" class="px-3 py-1 border border-red-500/30 text-red-500 hover:bg-red-500 hover:text-white rounded text-xs font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <!-- EDIT MODE -->
                        <td x-show="editing" colspan="4" class="px-6 py-4 bg-white/5 rounded-xl">
                            <form action="{{ route('admin.terrains.update', $terrain) }}" method="POST" class="flex gap-4 items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nom" value="{{ $terrain->nom }}" required class="flex-1 bg-dark-900 border border-white/10 rounded px-3 py-2 text-white focus:outline-none focus:border-accent-500 text-sm">
                                <select name="type_sol" class="bg-dark-900 border border-white/10 rounded px-3 py-2 text-white focus:outline-none focus:border-accent-500 text-sm w-48">
                                    <option value="parquet" {{ $terrain->type_sol == 'parquet' ? 'selected' : '' }}>Parquet (Intérieur)</option>
                                    <option value="bitume" {{ $terrain->type_sol == 'bitume' ? 'selected' : '' }}>Bitume (Extérieur)</option>
                                    <option value="tartan" {{ $terrain->type_sol == 'tartan' ? 'selected' : '' }}>Tartan</option>
                                </select>
                                <div class="flex gap-2">
                                    <button type="submit" class="px-4 py-2 bg-accent-600 hover:bg-accent-500 text-white rounded text-sm font-bold transition-colors">Enregistrer</button>
                                    <button type="button" @click="editing = false" class="px-4 py-2 border border-slate-600 text-slate-400 hover:text-white rounded text-sm transition-colors">Annuler</button>
                                </div>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Créer un Terrain -->
    <div class="glass-panel border-white/5 bg-dark-900/40 rounded-[2rem] p-8 h-fit">
        <h2 class="text-xl font-serif text-white font-semibold mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouveau Terrain
        </h2>
        
        <form action="{{ route('admin.terrains.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">Nom du Terrain</label>
                <input type="text" name="nom" required class="w-full bg-dark-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 border-b-2 focus:ring-0 transition-colors" placeholder="Ex: Playground Sud">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">Type de sol</label>
                <select name="type_sol" class="w-full bg-dark-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 border-b-2 focus:ring-0 transition-colors">
                    <option value="parquet">Parquet (Intérieur)</option>
                    <option value="bitume">Bitume (Extérieur)</option>
                    <option value="tartan">Tartan</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-3 rounded-xl transition-colors shadow-[0_0_15px_rgba(99,102,241,0.3)] mt-2">
                Ajouter le Terrain
            </button>
        </form>
    </div>

</div>
@endsection
