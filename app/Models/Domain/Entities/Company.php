<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'country_id'];

    /**
     * Countryへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
