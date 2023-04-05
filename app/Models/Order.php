<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'level',
        'type',
        'time',
        'max_scoure',
    ];

/**
 * Get the user associated with the Order
 * @return \Illuminate\Database*/
public function user(): belongsTo
{
    return $this->belongsTo(User::class);
}

public function topic(): belongsTo
{
    return $this->belongsTo(Topic::class);
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
