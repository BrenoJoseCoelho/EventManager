@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Eventos Disponíveis</h1>

@if(isset($events) && $events->count())
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($events as $event)
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
        <p class="text-gray-600">{{ Str::limit($event->description, 100) }}</p>
        <p class="text-sm text-gray-500 mt-2">
            <strong>Início:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}<br>
            <strong>Término:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}
        </p>
        <!-- Condições para exibir a inscrição -->
        @if($event->status !== 'aberto' || \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($event->end_datetime)))
        <p class="mt-2 text-red-500 font-semibold">
            Inscrições não estão mais disponíveis.
        </p>
        @elseif(Auth::check() && Auth::user()->registrations()->where('event_id', $event->id)->exists())
        <p class="mt-2 text-green-500 font-semibold">
            Você já está inscrito neste evento.
        </p>
        @else
        <a href="{{ route('events.show', $event->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
            Ver Detalhes
        </a>
        @endif
    </div>
    @endforeach
</div>
@else
<p class="text-gray-700">Nenhum evento disponível no momento.</p>
@endif
@endsection