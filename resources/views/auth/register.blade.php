<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H3 Sports | Inscription</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <style>
        body { background-color: #0c0c0e; color: #f8fafc; }
        .ambient-mesh {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(at 100% 100%, rgba(249, 115, 22, 0.15) 0px, transparent 60%);
            z-index: -1; pointer-events: none;
        }
        .glass-panel { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .text-gradient { background: linear-gradient(to right, #f97316, #ea580c, #c2410c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        
        .input-dark {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-dark:focus {
            outline: none;
            border-color: rgba(249, 115, 22, 0.5);
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
        }
    </style>
</head>
<body class="antialiased font-sans flex items-center justify-center min-h-screen relative p-6">
    <div class="ambient-mesh"></div>

    <a href="/" class="absolute top-8 left-8 flex items-center gap-3 group">
        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg></div>
        <span class="font-bold text-xl tracking-wide text-white font-serif italic">H3<span class="text-gradient not-italic font-sans font-extrabold ml-1">Sports</span></span>
    </a>

    <div class="w-full max-w-md">
        <div class="glass-panel p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-accent-400 to-accent-600"></div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-serif font-bold text-white mb-2">Devenir Membre</h1>
                <p class="text-slate-400 text-sm">Rejoignez l'élite sportive H3 Campus.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nom Complet</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus class="input-dark w-full px-4 py-3 rounded-xl text-sm placeholder-slate-500" placeholder="Michael Jordan">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Adresse email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="input-dark w-full px-4 py-3 rounded-xl text-sm placeholder-slate-500" placeholder="votre@email.com">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Mot de passe</label>
                    <input type="password" id="password" name="password" required class="input-dark w-full px-4 py-3 rounded-xl text-sm placeholder-slate-500" placeholder="••••••••">
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Confirmer le Mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="input-dark w-full px-4 py-3 rounded-xl text-sm placeholder-slate-500" placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-accent-500 to-accent-600 text-white font-bold tracking-wide shadow-lg shadow-accent-500/20 hover:shadow-accent-500/40 transition-all transform hover:-translate-y-0.5">
                        S'inscrire
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center border-t border-white/5 pt-6">
                <p class="text-slate-400 text-sm">Déjà membre ? <a href="/login" class="text-accent-400 font-semibold hover:text-accent-300 transition-colors">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>
