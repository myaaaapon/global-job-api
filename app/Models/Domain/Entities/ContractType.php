<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'contract_types';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];
}
