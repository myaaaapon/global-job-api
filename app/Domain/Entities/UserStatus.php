<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * ユーザーステータスのEloquentモデル
 *
 * @property int $id ステータスID
 * @property string $name ステータス名
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasMany|User[] $users ユーザーのコレクション
 */
class UserStatus extends Model
{
    public const ADMIN = 1;
    public const FREE_USER = 2;
    public const PAID_USER = 3;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'user_statuses';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * ユーザーのリレーション
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'status_id');
    }

    /**
     * ステータスIDの配列を取得します。
     *
     * @return array
     */
    public static function getStatusIds(): array
    {
        return [
            self::ADMIN,
            self::FREE_USER,
            self::PAID_USER,
        ];
    }
}
