<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ユーザータグのEloquentモデル
 *
 * @property int $id タグID
 * @property int $user_id ユーザーID
 * @property int $tag_id タグID
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read BelongsTo|User $user ユーザーへのリレーション
 * @property-read BelongsTo|Tag $tag タグへのリレーション
 */
class UserTag extends Model
{
    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'tag_id'];

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'user_tags';

    /**
     * ユーザーへのリレーション
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * タグへのリレーション
     *
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
