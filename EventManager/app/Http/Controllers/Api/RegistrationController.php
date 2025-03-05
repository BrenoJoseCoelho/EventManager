<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    // Lista as inscrições do usuário autenticado
    public function index()
    {
        $registrations = User::user()->registrations()->with('event')->get();
        return response()->json(['data' => $registrations], 200);
    }

    // Inscreve o usuário autenticado em um evento
    public function store(Request $request)
    {
        $event = Event::find($request->input('event_id'));

        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        // Verifica se o evento está aberto e se a capacidade não foi atingida
        if ($event->status !== 'aberto') {
            return response()->json(['message' => 'Inscrições não estão abertas para este evento'], 403);
        }

        if ($event->registrations()->count() >= $event->capacity) {
            return response()->json(['message' => 'A capacidade máxima deste evento foi atingida'], 403);
        }

        // Cria a inscrição
        $registration = Registration::create([
            'event_id' => $event->id,
            'user_id'  => Auth::id(),
        ]);

        return response()->json(['data' => $registration, 'message' => 'Inscrição realizada com sucesso'], 201);
    }

    // Cancela uma inscrição
    public function destroy($id)
    {
        $registration = Registration::find($id);
        if (!$registration) {
            return response()->json(['message' => 'Inscrição não encontrada'], 404);
        }

        // Garante que o usuário autenticado é o dono da inscrição
        if ($registration->user_id !== Auth::id()) {
            return response()->json(['message' => 'Você não tem permissão para cancelar esta inscrição'], 403);
        }

        // Atualiza para marcar o cancelamento
        $registration->update(['canceled_at' => now()]);

        return response()->json(['message' => 'Inscrição cancelada com sucesso'], 200);
    }
}
