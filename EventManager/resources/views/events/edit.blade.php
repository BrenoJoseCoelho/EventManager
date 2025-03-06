@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6">Editar Evento</h1>
        <form id="editEventForm" action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Título:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descrição -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Descrição:</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">{{ old('description', $event->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Data e Hora de Início -->
            <div class="mb-4">
                <label for="start_datetime" class="block text-gray-700">Data e Hora de Início:</label>
                <input type="datetime-local" name="start_datetime" id="start_datetime"
                    value="{{ old('start_datetime', \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i')) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('start_datetime')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Data e Hora de Término -->
            <div class="mb-4">
                <label for="end_datetime" class="block text-gray-700">Data e Hora de Término:</label>
                <input type="datetime-local" name="end_datetime" id="end_datetime"
                    value="{{ old('end_datetime', \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i')) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('end_datetime')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mensagem de erro para datas -->
            <p id="dateError" class="text-red-500 text-xs mt-1 hidden">A data e hora de início deve ser anterior à data e hora de término.</p>

            <!-- Localização -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700">Localização:</label>
                <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('location')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Capacidade Máxima -->
            <div class="mb-4">
                <label for="capacity" class="block text-gray-700">Capacidade Máxima:</label>
                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $event->capacity) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('capacity')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status:</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
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
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Atualizar Evento
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script para validar as datas -->
<script>
    document.getElementById('editEventForm').addEventListener('submit', function(event) {
        let startDatetime = document.getElementById('start_datetime').value;
        let endDatetime = document.getElementById('end_datetime').value;
        let dateError = document.getElementById('dateError');

        let startTime = new Date(startDatetime).getTime();
        let endTime = new Date(endDatetime).getTime();

        if (startTime >= endTime) {
            event.preventDefault();
            dateError.classList.remove('hidden');
            dateError.textContent = 'A data e hora de início deve ser anterior à data e hora de término.';
        } else {
            dateError.classList.add('hidden');
        }
    });
</script>
@endsection