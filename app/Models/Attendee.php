<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $table = 'attendee';

    protected $fillable = [
        'title',
        'name',
        'email',
        'phone',
        'company',
        'designation',
        'category',
        'token',
        'redeem',
        'redeem_on',
        'type',
        'balance',
        'status',
        'guest_of',
        'attendee_decision'
    ];
}
