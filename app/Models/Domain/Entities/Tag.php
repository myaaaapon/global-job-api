<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * ユーザータグへのリレーション
     *
     * @return HasMany
     */
    public function userTags(): HasMany
    {
        return $this->hasMany(UserTag::class);
    }

    /**
     * アイテムタグへのリレーション
     *
     * @return HasMany
     */
    public function itemTags(): HasMany
    {
        return $this->hasMany(ItemTag::class);
    }
}
