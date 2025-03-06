<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function adminIndex()
    {
        $events = Event::all();
        return view('admin.dashboard', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

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

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

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

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }

    public function details(Event $event)
    {
        $event->load('registrations.user');
        return view('admin.event_details', compact('event'));
    }
}
