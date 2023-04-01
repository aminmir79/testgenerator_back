<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'level',
        'type',
        'max_scoure',
    ];

/**
 * Get the user associated with the Order
 *
 * @return \Illuminate\Database*/
public function user(): HasOne
{
    return $this->hasOne(User::class);
}

public function topic(): HasOne
{
    return $this->hasOne(Topic::class);
}

/**
 * The questions that belong to the Order
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function questions(): BelongsToMany
{
    return $this->belongsToMany(Question::class, 'order_question');
}

}
