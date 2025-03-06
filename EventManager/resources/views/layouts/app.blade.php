<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventManager</title>
    <!-- Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                EventManager
            </a>
            <div>
                @auth
                <span class="mr-4 text-gray-700">Olá, {{ Auth::user()->name }}</span>
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="mr-4 text-gray-700 hover:text-gray-900">Painel Admin</a>
                <!-- Link para o cadastro de usuário (para admin) -->
                <a href="{{ route('users.index') }}" class="mr-4 text-gray-700 hover:text-gray-900">
                    Cadastro de Usuário
                </a>
                @elseif(Auth::user()->role === 'participant')
                <!-- Link para a view de inscrições, disponível apenas para participantes -->
                <a href="{{ route('registrations.index') }}" class="mr-4 text-gray-700 hover:text-gray-900">
                    Minhas Inscrições
                </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-gray-900">Sair</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="mr-4 text-gray-700 hover:text-gray-900">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>
</body>

</html>