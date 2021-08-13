<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'birthdate', 'user_id'
    ];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
