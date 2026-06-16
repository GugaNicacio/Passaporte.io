<!DOCTYPE html>
<html lang="pt-BR" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io - Sistema de Ingressos</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-r from-[#425E83] via-[#6999c9] to-[#5D3A93]"> 
    
    <!-- navbar  -->
    <nav class="w-full h-15 bg-gray-200 flex p-3 justify-between items-center shadow-sm">
        <div class="justify-start content-center flex gap-3 items-center">
            <img src="{{ asset('images/logo.png') }}" alt="TwirperPassaporte" class="h-9 w-auto object-contain"> <!-- o asset seta basicamente, a imagem como uma var no local, pedi ajuda pro gpt com isso denovo porque tava dando um problema parecido com o do twirper-->
            <a href="/" class="text-xl text-gray-500 hover:text-black"><b>Passaporte<span class="text-[#5D3A93]">.io</span></b></a>
            
            @auth
                <div class="hidden md:flex gap-2 ml-4">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-black px-2 py-1">Vitrine</a>
                    @if(auth()->user()->role === 'participant')
                        <a href="{{ route('subscriptions.index') }}" class="text-sm text-gray-600 hover:text-black px-2 py-1 bg-white/50 rounded">Meus Ingressos</a>
                    @endif
                    @if(auth()->user()->role === 'organizer')
                        <a href="{{ route('events.index') }}" class="text-sm text-gray-600 hover:text-black px-2 py-1 bg-white/50 rounded font-semibold">Painel do Organizador</a>
                        <a href="{{ route('events.create') }}" class="text-sm text-gray-600 hover:text-black px-2 py-1 bg-white/80 rounded border border-gray-300">+ Criar Evento</a>
                    @endif
                </div>
            @endauth
        </div>

        <div class="flex items-center gap-3">
        @auth
            <span class="text-sm font-medium text-gray-700 bg-white/40 px-2 py-1 rounded">{{ auth()->user()->name }}</span>
            <form method="POST" action="/logout" class="inline">
                @csrf
                <button type="submit" class="p-2 text-sm text-red-700 hover:text-red-900 font-semibold">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="p-2 border border-gray-400 rounded-lg bg-white shadow-2xs hover:bg-gray-100 text-sm">Log In</a>
            <a href="{{ route('register') }}" class="p-2 rounded-lg bg-[#425E83] shadow-2xs text-white hover:bg-[#6382aa] text-sm font-medium">Sign Up</a>
        @endauth
        </div>
    </nav>

    @if (session('success'))
        <div class="toast toast-top toast-center z-50">
            <div class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast toast-top toast-center z-50">
            <div class="alert alert-error shadow-lg text-white bg-red-600 border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <!-- rodapé da resenha -->
    <footer class="w-full bg-gray-200 flex p-3 justify-center items-center shadow-inner mt-auto">
        <div>
            <p>© 2026 Passaporte.io <u>Built with Laravel by Gustavo Nicácio</u></p>
        </div>
    </footer>

</body>
</html>