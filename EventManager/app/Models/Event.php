<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'location',
        'capacity',
        'status'
    ];

    // Relacionamento: um evento possui muitas inscrições
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}