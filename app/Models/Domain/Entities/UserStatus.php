<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    public const ADMIN = 1;
    public const FREE_USER = 2;
    public const PAID_USER = 3;

    protected $table = 'user_statuses';
    protected $fillable = ['name'];

    // リレーションを設定
    public function users()
    {
        return $this->hasMany(User::class, 'status_id');
    }
}
