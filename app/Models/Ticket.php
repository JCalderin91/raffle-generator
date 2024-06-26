<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'raffle_id', 'participant_id', 'numbers'
    ];
/*
    protected $casts = [
        'numbers' => 'object',
    ];
    */

    public function owner()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class, 'raffle_id');
    }
    

    
}
