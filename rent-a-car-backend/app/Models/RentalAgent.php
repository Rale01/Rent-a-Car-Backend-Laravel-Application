<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAgent extends Model
{
    use HasFactory;

    protected $table = 'rental_agents';

    protected $fillable = [
        'name',
        'city',
        'address',
        'email',
        'telephone',
    ];

    public function putsForRent()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
