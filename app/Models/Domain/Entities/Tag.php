<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * タグのEloquentモデル
 *
 * @property int $id タグID
 * @property string $name タグ名
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|UserTag[] $userTags ユーザータグへのリレーション
 */
class Tag extends Model
{
    /**
     * ユーザータグへのリレーション
     *
     * @return HasMany
     */
    public function userTags(): HasMany
    {
        return $this->hasMany(UserTag::class);
    }
}
