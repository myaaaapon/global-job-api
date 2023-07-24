<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name', 'home_url'];
}
