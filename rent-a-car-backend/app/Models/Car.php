<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'rentTimeInMonths'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }
}
