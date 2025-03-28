<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'title',
        'author',
        'category',
        'description',
        'stock',
    ];

    
// Relationship: One book can have many bookings

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    
}
