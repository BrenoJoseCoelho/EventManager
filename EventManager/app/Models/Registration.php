<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'canceled_at'
    ];

    // Relacionamento: cada inscrição pertence a um evento
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relacionamento: cada inscrição pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}