<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];
}
