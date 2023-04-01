<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'name',
        'num_of_lessons',
    ];

    /**
     * Get the associated with the Topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function section(): HasOne
    {
        return $this->hasOne(Section::class);
    }

    /**
     * Get all of the comments for the Topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
