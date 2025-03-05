@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Editar Evento</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PATCH')

        <!-- Título -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Título:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descrição -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descrição:</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $event->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Data e Hora de Início -->
        <div class="mb-4">
            <label for="start_datetime" class="block text-gray-700">Data e Hora de Início:</label>
            <input type="datetime-local" name="start_datetime" id="start_datetime" value="{{ old('start_datetime', \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i')) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('start_datetime')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Data e Hora de Término -->
        <div class="mb-4">
            <label for="end_datetime" class="block text-gray-700">Data e Hora de Término:</label>
            <input type="datetime-local" name="end_datetime" id="end_datetime" value="{{ old('end_datetime', \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i')) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('end_datetime')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Localização -->
        <div class="mb-4">
            <label for="location" class="block text-gray-700">Localização:</label>
            <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('location')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Capacidade Máxima -->
        <div class="mb-4">
            <label for="capacity" class="block text-gray-700">Capacidade Máxima:</label>
            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $event->capacity) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('capacity')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status:</label>
            <select name="status" id="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Selecione</option>
                <option value="aberto" {{ old('status', $event->status) == 'aberto' ? 'selected' : '' }}>Aberto</option>
                <option value="encerrado" {{ old('status', $event->status) == 'encerrado' ? 'selected' : '' }}>Encerrado</option>
                <option value="cancelado" {{ old('status', $event->status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botão de Submissão -->
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Atualizar Evento
            </button>
        </div>
    </form>
</div>
@endsection
