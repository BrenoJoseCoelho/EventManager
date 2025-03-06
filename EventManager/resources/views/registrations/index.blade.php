@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Minhas Inscrições</h1>

@if(isset($registrations) && $registrations->count())
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($registrations as $registration)
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-xl font-semibold">{{ $registration->event->title }}</h2>
        <p class="text-gray-600">
            Inscrito em: {{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y H:i') }}
        </p>
        <!-- Opcional: botão para cancelar inscrição -->
        @if(!$registration->canceled_at)
        <form action="{{ route('registrations.destroy', $registration->id) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">
                Cancelar Inscrição
            </button>
        </form>
        @else
        <p class="text-red-500 mt-2">Inscrição cancelada</p>
        @endif
    </div>
    @endforeach
</div>
@else
<p class="text-gray-700">Você ainda não se inscreveu em nenhum evento.</p>
@endif
@endsection