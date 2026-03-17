@extends('layouts.admin')

@section('title', 'Gestion des Chaussures')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <!-- Liste des Chaussures -->
    <div class="xl:col-span-2 glass-panel border-white/5 bg-dark-900/40 rounded-[2rem] p-8">
        <div class="overflow-x-auto text-left">
            <table class="w-full text-slate-400 text-sm">
                <thead class="text-xs uppercase bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-4 rounded-l-xl">Image</th>
                        <th class="px-4 py-4">Paire</th>
                        <th class="px-4 py-4">Pointure</th>
                        <th class="px-4 py-4">État</th>
                        <th class="px-4 py-4 text-right rounded-r-xl">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chaussures as $chaussure)
                    <tr x-data="{ editing: false }" class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        
                        <!-- VIEW MODE -->
                        <td x-show="!editing" class="px-4 py-4">
                            @if($chaussure->image)
                                <img src="{{ asset('storage/' . $chaussure->image) }}" class="w-12 h-12 object-cover rounded-xl bg-white/5 border border-white/10" alt="{{ $chaussure->modele }}">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td x-show="!editing" class="px-4 py-4">
                            <div class="font-bold text-white">{{ $chaussure->marque }}</div>
                            <div class="text-xs">{{ $chaussure->modele }}</div>
                        </td>
                        <td x-show="!editing" class="px-4 py-4 text-white">EU {{ $chaussure->pointure }}</td>
                        <td x-show="!editing" class="px-4 py-4">
                            <span class="bg-white/10 text-slate-300 px-3 py-1 rounded-full text-xs tracking-wider">{{ $chaussure->etat }}</span>
                        </td>
                        <td x-show="!editing" class="px-4 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="editing = true" class="px-3 py-1 border border-indigo-500/30 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded text-xs font-medium transition-colors">
                                    Éditer
                                </button>
                                <form action="{{ route('admin.chaussures.destroy', $chaussure) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" @click="if(confirm('Supprimer cette paire supprimera tous les emprunts associés. Confirmer ?')) $el.closest('form').submit();" class="px-3 py-1 border border-red-500/30 text-red-500 hover:bg-red-500 hover:text-white rounded text-xs font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <!-- EDIT MODE -->
                        <td x-show="editing" colspan="5" class="px-6 py-4 bg-white/5 rounded-xl">
                            <form action="{{ route('admin.chaussures.update', $chaussure) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="flex gap-4">
                                    <div class="flex-1">
                                        <label class="block text-xs uppercase tracking-wider text-slate-500 mb-1">Marque</label>
                                        <input type="text" name="marque" value="{{ $chaussure->marque }}" required class="w-full bg-dark-900 border border-white/10 rounded px-3 py-2 text-white text-sm">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-xs uppercase tracking-wider text-slate-500 mb-1">Modèle</label>
                                        <input type="text" name="modele" value="{{ $chaussure->modele }}" required class="w-full bg-dark-900 border border-white/10 rounded px-3 py-2 text-white text-sm">
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-1/3">
                                        <label class="block text-xs uppercase tracking-wider text-slate-500 mb-1">Pointure</label>
                                        <input type="number" name="pointure" value="{{ $chaussure->pointure }}" required min="30" max="55" class="w-full bg-dark-900 border border-white/10 rounded px-3 py-2 text-white text-sm">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-xs uppercase tracking-wider text-slate-500 mb-1">État</label>
                                        <select name="etat" class="w-full bg-dark-900 border border-white/10 rounded px-3 py-2 text-white text-sm">
                                            <option value="Neuf" {{ $chaussure->etat == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                                            <option value="Très bon état" {{ $chaussure->etat == 'Très bon état' ? 'selected' : '' }}>Très bon état</option>
                                            <option value="Bon état" {{ $chaussure->etat == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                                            <option value="Usé" {{ $chaussure->etat == 'Usé' ? 'selected' : '' }}>Usé</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-1">Remplacer l'Image (optionnel)</label>
                                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20">
                                </div>
                                <div class="flex justify-end gap-2 pt-2 border-t border-white/5 mt-4">
                                    <button type="button" @click="editing = false" class="px-4 py-2 border border-slate-600 text-slate-400 hover:text-white rounded text-sm transition-colors">Annuler</button>
                                    <button type="submit" class="px-4 py-2 bg-accent-600 hover:bg-accent-500 text-white font-bold rounded text-sm transition-colors">Sauvegarder</button>
                                </div>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Créer une Chaussure -->
    <div class="glass-panel border-white/5 bg-dark-900/40 rounded-[2rem] p-8 h-fit">
        <h2 class="text-xl font-serif text-white font-semibold mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvelle Paire
        </h2>
        
        <form action="{{ route('admin.chaussures.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">Marque</label>
                <input type="text" name="marque" required class="w-full bg-dark-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-accent-500 border-b-2 transition-colors">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">Modèle</label>
                <input type="text" name="modele" required class="w-full bg-dark-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-accent-500 border-b-2 transition-colors">
            </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">Pointure</label>
                    <input type="number" name="pointure" required min="30" max="55" class="w-full bg-dark-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-accent-500 border-b-2 transition-colors">
                </div>
                <div class="w-1/2">
                    <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">État</label>
                    <select name="etat" class="w-full bg-dark-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-accent-500 border-b-2 transition-colors">
                        <option value="Neuf">Neuf</option>
                        <option value="Très bon état">Très bon</option>
                        <option value="Bon état">Bon état</option>
                        <option value="Usé">Usé</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-500 font-bold mb-2">Photo de la Paire</label>
                <div class="relative w-full h-32 border-2 border-dashed border-white/10 rounded-xl bg-dark-900/50 flex flex-col items-center justify-center hover:border-accent-500/50 transition-colors group">
                    <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <svg class="w-8 h-8 text-slate-400 mb-2 group-hover:text-accent-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="text-sm font-medium text-slate-400 group-hover:text-accent-400">Cliquez ou glissez une image</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-accent-600 hover:bg-accent-500 text-white font-bold py-3 rounded-xl transition-colors shadow-[0_0_15px_rgba(249,115,22,0.3)] mt-6">
                Ajouter la Paire
            </button>
        </form>
    </div>

</div>
@endsection
