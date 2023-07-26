<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * ユーザーのEloquentモデル
 *
 * @property int $id ユーザーID
 * @property string $name ユーザー名
 * @property string $email ユーザーのメールアドレス
 * @property string $password ユーザーのパスワード
 * @property int $status_id ユーザーステータスID
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 * @property \Carbon\Carbon|null $deleted_at 削除日時
 *
 * @property-read Collection|UserToken[] $tokens ユーザートークンのコレクション
 * @property-read UserStatus $status ユーザーステータス
 * @property-read Collection|UserTag[] $userTags ユーザータグのコレクション
 * @property-read Collection|Tag[] $tags ユーザーに関連するタグのコレクション
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /**
     * シリアライズ時に非表示にする属性
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * キャストする属性
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * ソフトデリートの対象とするカラム
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * フィルアブル属性
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'email', 'password', 'status_id'];

    /**
     * ユーザーステータスのリレーション
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

    /**
     * ユーザータグのリレーション
     *
     * @return HasMany
     */
    public function userTags(): HasMany
    {
        return $this->hasMany(UserTag::class);
    }

    /**
     * ユーザーに関連するタグのリレーション
     *
     * @return HasManyThrough
     */
    public function tags(): HasManyThrough
    {
        return $this->hasManyThrough(Tag::class, UserTag::class, 'user_id', 'id', 'id', 'tag_id');
    }
}
