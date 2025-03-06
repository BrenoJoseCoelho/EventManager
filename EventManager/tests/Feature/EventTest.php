<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_participant_can_view_events()
    {
        // Cria um evento
        $event = Event::factory()->create();

        // Cria um usuário participante
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('events.index'));
        $response->assertStatus(200);
        $response->assertSee($event->title);
    }

    public function test_admin_can_create_event()
    {
        // Cria um usuário admin
        $admin = User::factory()->admin()->create();

        $data = [
            'title'          => 'Evento de Teste',
            'description'    => 'Descrição do evento de teste.',
            'start_datetime' => Carbon::now()->addDay()->toDateTimeString(),
            'end_datetime'   => Carbon::now()->addDays(2)->toDateTimeString(),
            'location'       => 'Local de Teste',
            'capacity'       => 100,
            'status'         => 'aberto',
        ];

        $response = $this->actingAs($admin)->post(route('events.store'), $data);
        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', ['title' => 'Evento de Teste']);
    }
}
