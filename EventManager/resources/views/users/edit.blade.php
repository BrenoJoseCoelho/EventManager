@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6">Editar Usuário</h1>
        <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                <p id="emailError" class="text-red-500 text-xs mt-1 hidden">Por favor, insira um e-mail válido.</p>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">
                    Senha (deixe em branco para manter a atual):
                </label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmação de Senha -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirme a Senha:</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                <p id="passwordEditError" class="text-red-500 text-xs mt-1 hidden">As senhas não coincidem.</p>
            </div>

            <!-- Papel -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Papel:</label>
                <select name="role" id="role" required
                    class="mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                    <option value="">Selecione</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="participant" {{ old('role', $user->role) == 'participant' ? 'selected' : '' }}>Participante</option>
                </select>
                @error('role')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botão de Submissão -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Atualizar Usuário
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script para validação front-end -->
<script>
    document.getElementById('editUserForm').addEventListener('submit', function(event) {
        let valid = true;

        // Validação do email
        let emailField = document.getElementById('email');
        let emailValue = emailField.value;
        let emailError = document.getElementById('emailError');
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailValue)) {
            valid = false;
            emailError.classList.remove('hidden');
            emailError.textContent = 'Por favor, insira um e-mail válido.';
        } else {
            emailError.classList.add('hidden');
        }

        // Validação da confirmação de senha (apenas se o campo senha for preenchido)
        let password = document.getElementById('password').value;
        let confirmPassword = document.getElementById('password_confirmation').value;
        let passwordError = document.getElementById('passwordEditError');
        if (password !== "" && password !== confirmPassword) {
            valid = false;
            passwordError.classList.remove('hidden');
            passwordError.textContent = 'As senhas não coincidem.';
        } else {
            passwordError.classList.add('hidden');
        }

        if (!valid) {
            event.preventDefault();
        }
    });
</script>
@endsection