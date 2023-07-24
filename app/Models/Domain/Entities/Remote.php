<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Remote extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'remotes';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];
}
