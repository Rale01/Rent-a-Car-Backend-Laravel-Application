<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function rentalAgent()
    {
        return $this->belongsTo(RentalAgent::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
