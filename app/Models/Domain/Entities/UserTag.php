<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    protected $fillable = ['user_id', 'tag_id'];

    protected $table = 'user_tags';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
