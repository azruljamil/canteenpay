<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'attendee_id',
        'items',
        'total'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }
}
