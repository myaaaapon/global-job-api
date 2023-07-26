<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * リモートのEloquentモデル
 *
 * @property int $id リモートID
 * @property string $name リモート名
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|Item[] $items ItemへのHasManyリレーション
 */
class Remote extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'remotes';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Itemへのリレーション
     *
     * @return HasMany
     * ItemへのHasManyリレーションを返します。
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'remote_id', 'id');
    }
}
