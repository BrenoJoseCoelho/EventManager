<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibe a lista de usuários
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Exibe o formulário para criar um novo usuário
    public function create()
    {
        return view('users.create');
    }

    // Armazena um novo usuário no banco de dados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,participant'
        ]);

        // Criptografa a senha antes de salvar
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    // Exibe os detalhes de um usuário
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Exibe o formulário para editar um usuário
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Atualiza o usuário no banco de dados
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role'     => 'required|in:admin,participant'
        ]);

        // Atualiza a senha somente se for informada
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Remove um usuário do banco de dados
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
