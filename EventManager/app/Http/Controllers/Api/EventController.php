<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    // Retorna a lista de eventos
    public function index()
    {
        $events = Event::all();
        return response()->json(['data' => $events], 200);
    }

    // Cria um novo evento
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'required|date|after_or_equal:start_datetime',
            'location'       => 'required|string|max:255',
            'capacity'       => 'required|integer|min:1',
            'status'         => 'required|in:aberto,encerrado,cancelado',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $event = Event::create($request->all());
        return response()->json(['data' => $event, 'message' => 'Evento criado com sucesso'], 201);
    }

    // Retorna um evento específico
    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }
        return response()->json(['data' => $event], 200);
    }

    // Atualiza um evento existente
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'required|date|after_or_equal:start_datetime',
            'location'       => 'required|string|max:255',
            'capacity'       => 'required|integer|min:1',
            'status'         => 'required|in:aberto,encerrado,cancelado',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $event->update($request->all());
        return response()->json(['data' => $event, 'message' => 'Evento atualizado com sucesso'], 200);
    }

    // Exclui um evento
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Evento excluído com sucesso'], 200);
    }
}
