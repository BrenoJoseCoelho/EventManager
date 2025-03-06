@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Lista de Usuários</h1>
    <!-- Botão para cadastrar um novo usuário -->
    <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
        Novo Usuário
    </a>
</div>

@if(isset($users) && $users->count())
<table class="table-auto w-full bg-white border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 text-left border-b border-gray-200">Nome</th>
            <th class="px-4 py-2 text-left border-b border-gray-200">Email</th>
            <th class="px-4 py-2 text-left border-b border-gray-200">Papel</th>
            <th class="px-4 py-2 text-left border-b border-gray-200">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="px-4 py-2 border-b border-gray-200">{{ $user->name }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ $user->email }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ ucfirst($user->role) }}</td>
            <td class="px-4 py-2 border-b border-gray-200">
                <a href="{{ route('users.edit', $user->id) }}"
                    class="text-blue-500 hover:text-blue-700">
                    Editar
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
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
<p class="text-gray-700">Nenhum usuário cadastrado.</p>
@endif
@endsection