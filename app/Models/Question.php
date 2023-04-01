<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'question',
        'value',
        'time',
        'level',
        'topic_id',
        'lecture',
    ];

    public function Orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_question');
    }

}
