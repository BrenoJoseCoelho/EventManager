@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Minhas Inscrições</h1>

    @if(isset($registrations) && $registrations->count())
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Evento</th>
                    <th class="py-2 px-4 border-b">Data da Inscrição</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $registration->event->title }}</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="py-2 px-4 border-b">{{ $registration->canceled_at ? 'Cancelada' : 'Ativa' }}</td>
                        <td class="py-2 px-4 border-b">
                            @if(!$registration->canceled_at)
                                <form action="{{ route('registrations.destroy', $registration->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Cancelar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-700">Você ainda não realizou nenhuma inscrição.</p>
    @endif
@endsection
