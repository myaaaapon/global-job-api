<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * サイトのEloquentモデル
 *
 * @property int $id サイトID
 * @property string $name サイト名
 * @property string $home_url ホームURL
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read HasOne|Job $job JobへのHasOneリレーション
 */
class Site extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name', 'home_url'];

    /**
     * Jobへのリレーション
     *
     * @return HasOne
     * JobへのHasOneリレーションを返します。
     */
    public function job(): HasOne
    {
        return $this->hasOne(Job::class);
    }
}
