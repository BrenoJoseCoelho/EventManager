@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Painel de Controle - Administrador</h1>
        <a href="{{ route('events.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Criar Evento
        </a>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-4">Lista de Eventos</h2>
        @if(isset($events) && $events->count())
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Título</th>
                        <th class="py-2 px-4 border-b">Início</th>
                        <th class="py-2 px-4 border-b">Término</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $event->title }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($event->status) }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('events.edit', $event->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-700">Nenhum evento cadastrado.</p>
        @endif
    </div>
@endsection
