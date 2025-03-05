<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    // Exibe as inscrições do usuário autenticado
    public function index()
    {
        // $registrations = Auth::user()->registrations()->with('event')->get();
        return view('registrations.index', compact('registrations'));
    }

    // Realiza a inscrição em um evento
    public function store(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        // Verifica se o evento está aberto e se a capacidade não foi atingida
        if ($event->status !== 'aberto') {
            return redirect()->back()->with('error', 'Inscrições não estão abertas para este evento.');
        }

        if ($event->registrations()->count() >= $event->capacity) {
            return redirect()->back()->with('error', 'A capacidade máxima deste evento foi atingida.');
        }

        Registration::create([
            'event_id' => $event->id,
            'user_id'  => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }

    // Cancela uma inscrição
    public function destroy($registrationId)
    {
        $registration = Registration::findOrFail($registrationId);

        // Garante que o usuário autenticado seja o dono da inscrição
        if ($registration->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para cancelar esta inscrição.');
        }

        // Em vez de deletar, registra o cancelamento
        $registration->update(['canceled_at' => now()]);

        return redirect()->back()->with('success', 'Inscrição cancelada com sucesso!');
    }
}
