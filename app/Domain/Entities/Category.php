<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * カテゴリのEloquentモデル
 *
 * @property int $id カテゴリID
 * @property string $name カテゴリ名
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|Item[] $items カテゴリに関連するアイテムを含むHasManyリレーション
 */
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

    /**
     * カテゴリに関連するアイテムを取得します。
     *
     * @return HasMany
     * カテゴリに関連するアイテムを含むHasManyリレーションを返します。
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'category_id', 'id');
    }
}
