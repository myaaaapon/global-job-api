<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];
}
