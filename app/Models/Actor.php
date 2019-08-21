<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [ 'name' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'created_at', 'updated_at', 'pivot' ];

    // Relations
    public function movies()
    {
        return $this->belongsToMany(Movie::class)->withTimestamps();
    }
}
