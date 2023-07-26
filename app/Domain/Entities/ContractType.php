<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 契約タイプのEloquentモデル
 *
 * @property int $id 契約タイプID
 * @property string $name 契約タイプ名
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|Item[] $items 契約タイプに関連するアイテムを含むHasManyリレーション
 */
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

    /**
     * 契約タイプに関連するアイテムを取得します。
     *
     * @return HasMany
     * 契約タイプに関連するアイテムを含むHasManyリレーションを返します。
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'contract_type_id', 'id');
    }
}
