<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
    ];
    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
    ];
    
    // Relationship: A booking belongs to a book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relationship: A booking belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
