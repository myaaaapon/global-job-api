<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function tokens()
    {
        return $this->user->tokens();
    }

    public function status()
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

    public function userTags()
    {
        return $this->hasMany(UserTag::class);
    }

}
