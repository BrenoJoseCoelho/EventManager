<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


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


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
