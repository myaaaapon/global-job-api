<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function userTags()
    {
        return $this->hasMany(UserTag::class);
    }
}
