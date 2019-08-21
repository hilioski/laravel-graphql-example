<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [ 'name', 'year', 'description' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'created_at', 'updated_at', 'pivot' ];

    // Relations
    public function actors()
    {
        return $this->belongsToMany(Actor::class)->withTimestamps();
    }
}
