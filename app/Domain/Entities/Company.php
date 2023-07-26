<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 企業のEloquentモデル
 *
 * @property int $id 企業ID
 * @property string $name 企業名
 * @property string $address 企業の所在地
 * @property int $country_id 所在国のID
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|Item[] $items この企業に関連するアイテムを含むHasManyリレーション
 * @property-read BelongsTo|Country $country この企業の所在国に対するBelongsToリレーション
 */
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
     * 企業に関連するアイテムを取得します。
     *
     * @return HasMany
     * この企業に関連するアイテムを含むHasManyリレーションを返します。
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'company_id', 'id');
    }

    /**
     * 企業の所在国に対するリレーションを取得します。
     *
     * @return BelongsTo
     * この企業の所在国に対するBelongsToリレーションを返します。
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
