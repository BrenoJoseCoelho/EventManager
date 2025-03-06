<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role'     => ['required', 'in:admin,participant'],
        ]);

        $validatedData = $request->only('name', 'email', 'password');

        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['role'] = $request->role;

        $user = User::create($validatedData);

        event(new Registered($user));

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role'     => 'required|in:admin,participant'
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
