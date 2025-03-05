@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Novo Usuário</h1>
    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <!-- Nome -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nome:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md">
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md">
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Senha -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Senha:</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full border-gray-300 rounded-md">
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmação de Senha -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirme a Senha:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="mt-1 block w-full border-gray-300 rounded-md">
        </div>

        <!-- Papel -->
        <div class="mb-4">
            <label for="role" class="block text-gray-700">Papel:</label>
            <select name="role" id="role" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Selecione</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="participant" {{ old('role') == 'participant' ? 'selected' : '' }}>Participante</option>
            </select>
            @error('role')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botão de Submissão -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Cadastrar Usuário
            </button>
        </div>
    </form>
</div>
@endsection