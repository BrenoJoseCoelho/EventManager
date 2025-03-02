<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Exibe a lista de eventos
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Exibe o formulário para criar um novo evento
    public function create()
    {
        return view('events.create');
    }

    // Armazena o novo evento no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'required|date|after_or_equal:start_datetime',
            'location'       => 'required|string|max:255',
            'capacity'       => 'required|integer|min:1',
            'status'         => 'required|in:aberto,encerrado,cancelado'
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    // Exibe os detalhes de um evento
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // Exibe o formulário para editar um evento
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Atualiza o evento no banco de dados
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'required|date|after_or_equal:start_datetime',
            'location'       => 'required|string|max:255',
            'capacity'       => 'required|integer|min:1',
            'status'         => 'required|in:aberto,encerrado,cancelado'
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    // Exclui um evento do banco de dados
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
