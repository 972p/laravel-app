@extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<div class="glass-panel border-white/5 bg-dark-900/40 rounded-[2rem] p-8 hidden md:block">
    <div class="overflow-x-auto text-left">
        <table class="w-full text-slate-400 text-sm">
            <thead class="text-xs uppercase bg-white/5 text-slate-300">
                <tr>
                    <th class="px-6 py-4 rounded-l-xl">ID</th>
                    <th class="px-6 py-4">Nom</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Date d'inscription</th>
                    <th class="px-6 py-4">Rôle</th>
                    <th class="px-6 py-4 text-right rounded-r-xl">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-mono text-accent-400">#{{ $user->id }}</td>
                    <td class="px-6 py-4 text-white font-medium">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        @if($user->is_admin)
                            <span class="bg-accent-500/20 text-accent-400 px-3 py-1 rounded-full text-xs font-bold tracking-wider">ADMIN</span>
                        @else
                            <span class="bg-white/10 text-slate-300 px-3 py-1 rounded-full text-xs font-bold tracking-wider">MEMBRE</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2" x-data="{ editing: false, confirming: false }">
                            
                            <!-- Toggle Admin Form -->
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 0 : 1 }}">
                                    <button type="submit" class="px-3 py-1 border border-indigo-500/30 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded text-xs font-medium transition-colors">
                                        {{ $user->is_admin ? 'Retirer Admin' : 'Rendre Admin' }}
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" @click="if(confirm('Attention ! Supprimer cet utilisateur supprimera tout son historique. Confirmer ?')) $el.closest('form').submit();" class="px-3 py-1 border border-red-500/30 text-red-500 hover:bg-red-500 hover:text-white rounded text-xs font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-slate-500 italic block">Vous en ce moment</span>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
