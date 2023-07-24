<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];

}
