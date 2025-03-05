@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ $event->title }}</h1>

    <div class="bg-white p-6 rounded shadow">
        <!-- Descrição -->
        @if($event->description)
            <p class="mb-4 text-gray-700">{{ $event->description }}</p>
        @else
            <p class="mb-4 text-gray-700">Sem descrição</p>
        @endif

        <!-- Datas -->
        <div class="mb-4">
            <strong>Início:</strong>
            {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}<br>
            <strong>Término:</strong>
            {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}
        </div>

        <!-- Localização -->
        <div class="mb-4">
            <strong>Local:</strong> {{ $event->location }}
        </div>

        <!-- Capacidade e Status -->
        <div class="mb-4">
            <strong>Capacidade Máxima:</strong> {{ $event->capacity }}<br>
            <strong>Status:</strong> {{ ucfirst($event->status) }}
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Botão para Inscrever-se (se estiver disponível) -->
        @auth
            @if($event->status === 'aberto')
                <form action="{{ route('registrations.store', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Inscrever-se
                    </button>
                </form>
            @else
                <p class="text-red-500 font-semibold mt-4">As inscrições não estão abertas para este evento.</p>
            @endif
        @else
            <p class="text-gray-700 mt-4">
                Faça login para se inscrever neste evento.
            </p>
        @endauth
    </div>
</div>
@endsection
