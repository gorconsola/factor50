<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Filterable;

    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

     function scopeComplete($query)
    {
        return $query->with(['user.userRole', 'address', 'tasks']);
    }

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
