@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Detalhes do Evento: {{ $event->title }}</h1>

    <div class="bg-white p-6 rounded shadow mb-6">
        <p><strong>Descrição:</strong> {{ $event->description ?? 'Sem descrição' }}</p>
        <p><strong>Início:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}</p>
        <p><strong>Término:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}</p>
        <p><strong>Local:</strong> {{ $event->location }}</p>
        <p><strong>Capacidade:</strong> {{ $event->capacity }}</p>
        <p><strong>Status:</strong> {{ ucfirst($event->status) }}
    </div>

    <h2 class="text-2xl font-bold mb-4">Participantes</h2>

    @if($event->registrations->count())
    <table class="table-auto w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left border-b border-gray-200">Nome</th>
                <th class="px-4 py-2 text-left border-b border-gray-200">Email</th>
                <th class="px-4 py-2 text-left border-b border-gray-200">Inscrito em</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->registrations as $registration)
            <tr>
                <td class="px-4 py-2 border-b border-gray-200">
                    {{ $registration->user->name }}
                </td>
                <td class="px-4 py-2 border-b border-gray-200">
                    {{ $registration->user->email }}
                </td>
                <td class="px-4 py-2 border-b border-gray-200">
                    {{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y H:i') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-gray-700">Nenhum participante inscrito.</p>
    @endif

    <a href="{{ route('admin.dashboard') }}"
        class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Voltar ao Painel
    </a>
</div>
@endsection