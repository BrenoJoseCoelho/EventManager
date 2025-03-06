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
    <table class="table-auto w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left border-b border-gray-200">Título</th>
                <th class="px-4 py-2 text-left border-b border-gray-200">Início</th>
                <th class="px-4 py-2 text-left border-b border-gray-200">Término</th>
                <th class="px-4 py-2 text-left border-b border-gray-200">Status</th>
                <th class="px-4 py-2 text-left border-b border-gray-200">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td class="px-4 py-2 border-b border-gray-200">{{ $event->title }}</td>
                <td class="px-4 py-2 border-b border-gray-200">
                    {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}
                </td>
                <td class="px-4 py-2 border-b border-gray-200">
                    {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}
                </td>
                <td class="px-4 py-2 border-b border-gray-200">
                    {{ ucfirst($event->status) }}
                </td>
                <td class="px-4 py-2 border-b border-gray-200">
                    <a href="{{ route('events.edit', $event->id) }}"
                        class="text-blue-500 hover:text-blue-700">
                        Editar
                    </a>
                    <a href="{{ route('events.details', $event->id) }}"
                        class="text-green-500 hover:text-green-700 ml-2">
                        Detalhes
                    </a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-500 hover:text-red-700 ml-2">
                            Excluir
                        </button>
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