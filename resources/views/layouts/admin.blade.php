<!DOCTYPE html>
<html lang="fr" class="bg-dark-900 overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H3 Sports | Administration</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-dark-900 text-slate-300 font-sans antialiased min-h-screen flex selection:bg-accent-500/30">
    
    <!-- Background Effects -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-accent-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=')] opacity-50 z-0"></div>
    </div>

    <!-- Sidebar Navigation -->
    <aside class="w-64 fixed inset-y-0 left-0 z-50 bg-dark-900/90 backdrop-blur-xl border-r border-white/5 flex flex-col transition-transform duration-300">
        <div class="h-20 flex items-center px-6 border-b border-white/5">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white">
                    <svg class="w-5 h-5 group-hover:text-accent-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>
                </div>
                <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span class="text-gradient not-italic text-accent-500 font-sans font-extrabold ml-1">Admin</span></span>
            </a>
        </div>

        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
            <div class="text-[10px] font-bold tracking-[0.2em] uppercase text-slate-500 mb-4 px-2">Tableaux de Bord</div>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-accent-500/10 text-accent-400 border border-accent-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="font-medium text-sm">Utilisateurs</span>
            </a>

            <a href="{{ route('admin.terrains.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.terrains.*') ? 'bg-accent-500/10 text-accent-400 border border-accent-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="font-medium text-sm">Terrains</span>
            </a>

            <a href="{{ route('admin.chaussures.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.chaussures.*') ? 'bg-accent-500/10 text-accent-400 border border-accent-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span class="font-medium text-sm">Chaussures</span>
            </a>

            <a href="{{ route('admin.reservations.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.reservations.*') ? 'bg-accent-500/10 text-accent-400 border border-accent-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="font-medium text-sm">Réservations</span>
            </a>
            
            <div class="mt-8 pt-6 border-t border-white/5">
                <a href="{{ route('compte.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-medium text-sm">Retour au Site</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 ml-64 relative z-10 flex flex-col min-h-screen">
        
        <!-- Header -->
        <header class="h-20 bg-dark-900/50 backdrop-blur-md border-b border-white/5 flex items-center justify-between px-8 sticky top-0 z-40">
            <div>
                <h1 class="text-2xl font-serif font-bold text-white">@yield('title')</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-slate-400">
                    Connecté en tant que <span class="text-white font-medium">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Main Workspace -->
        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="glass-panel border-green-500/30 bg-green-500/10 text-green-400 p-4 rounded-xl mb-8 flex items-center gap-3" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="glass-panel border-red-500/30 bg-red-500/10 text-red-400 p-4 rounded-xl mb-8">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
