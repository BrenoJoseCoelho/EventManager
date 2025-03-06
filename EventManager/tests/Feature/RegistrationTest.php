<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_participant_can_register_to_event()
    {
        // Cria um usuário participante
        $participant = User::factory()->create();

        // Cria um evento aberto
        $event = Event::factory()->create(['status' => 'aberto']);

        // Verifica que o participante não está inscrito
        $this->assertFalse($participant->registrations()->where('event_id', $event->id)->exists());

        // Realiza a inscrição
        $response = $this->actingAs($participant)->post(route('registrations.store', $event->id));
        $response->assertRedirect();

        // Verifica que o participante agora está inscrito
        $this->assertTrue($participant->registrations()->where('event_id', $event->id)->exists());
    }

    public function test_participant_can_cancel_registration()
    {
        // Cria um usuário participante
        $participant = User::factory()->create();

        // Cria um evento aberto
        $event = Event::factory()->create(['status' => 'aberto']);

        // Cria uma inscrição para o participante
        $registration = Registration::factory()->create([
            'event_id' => $event->id,
            'user_id'  => $participant->id,
            'canceled_at' => null,
        ]);

        // Verifica que a inscrição existe e está ativa
        $this->assertNull($registration->canceled_at);

        // Realiza o cancelamento da inscrição
        $response = $this->actingAs($participant)->delete(route('registrations.destroy', $registration->id));
        $response->assertRedirect();

        // Atualiza a instância e verifica que a inscrição foi cancelada
        $registration->refresh();
        $this->assertNotNull($registration->canceled_at);
    }

    public function test_cannot_register_when_event_is_full()
    {
        // Cria um evento com capacidade para 1 inscrição e status aberto
        $event = Event::factory()->create([
            'status' => 'aberto',
            'capacity' => 1,
        ]);

        // Cria um usuário e registra-o para preencher a capacidade
        $participant1 = User::factory()->create();
        Registration::factory()->create([
            'event_id' => $event->id,
            'user_id'  => $participant1->id,
        ]);

        // Cria um segundo usuário
        $participant2 = User::factory()->create();

        // Tenta realizar a inscrição para o segundo usuário
        $response = $this->actingAs($participant2)->post(route('registrations.store', $event->id));

        // Verifica se a sessão contém a mensagem de erro informando que o evento está cheio
        $response->assertSessionHas('error');

        // Verifica que o participante2 não foi inscrito
        $this->assertFalse($participant2->registrations()->where('event_id', $event->id)->exists());
    }
}
