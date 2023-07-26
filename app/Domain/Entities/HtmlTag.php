<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * HTMLタグのEloquentモデル
 *
 * @property int $id HTMLタグID
 * @property int $job_id 求人情報ID
 * @property string $title タイトル
 * @property string $body ボディ
 * @property int $language_id 言語ID
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read BelongsTo|Job $job HTMLタグに関連する求人情報を含むBelongsToリレーション
 * @property-read HasOne|Item $item HTMLタグに関連するアイテムを含むHasOneリレーション
 * @property-read BelongsTo|Language $language HTMLタグの言語を含むBelongsToリレーション
 */
class HtmlTag extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'html_tags';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['job_id', 'title', 'body', 'language_id'];

    /**
     * HTMLタグに関連する求人情報を取得します。
     *
     * @return BelongsTo
     * HTMLタグに関連する求人情報を含むBelongsToリレーションを返します。
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    /**
     * HTMLタグに関連するアイテムを取得します。
     *
     * @return HasOne
     * HTMLタグに関連するアイテムを含むHasOneリレーションを返します。
     */
    public function item(): HasOne
    {
        return $this->hasOne(Item::class, 'html_tag_id');
    }

    /**
     * HTMLタグの言語を取得します。
     *
     * @return BelongsTo
     * HTMLタグの言語を含むBelongsToリレーションを返します。
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
}
