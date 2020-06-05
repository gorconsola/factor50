<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function address ()
    {
        return $this->belongsTo(Address::class);
    }


    public function tasks ()
    {
        return $this->hasMany(Task::class);
    }
}
