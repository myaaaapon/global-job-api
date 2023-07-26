<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 国のEloquentモデル
 *
 * @property int $id 国ID
 * @property string $name 国名
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|Company[] $companies 国に関連する会社を含むHasManyリレーション
 */
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

    /**
     * 国に関連する会社を取得します。
     *
     * @return HasMany
     * 国に関連する会社を含むHasManyリレーションを返します。
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'country_id', 'id');
    }
}
