<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 求人情報のEloquentモデル
 *
 * @property int $id 求人情報ID
 * @property int $site_id サイトID
 * @property string $url URL
 * @property string $content コンテンツ
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read BelongsTo|Site $site SiteへのBelongsToリレーション
 * @property-read HasOne|HtmlTag $htmlTag HtmlTagへのHasOneリレーション
 */
class Job extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['site_id', 'url', 'content'];

    /**
     * ページネーションの1ページあたりの件数を定義
     *
     * @var int
     */
    public const PAGINATION_LIMIT_10 = 10;
    public const PAGINATION_LIMIT_30 = 30;

    /**
     * 関連アイテムの表示件数を定義
     *
     * @var int
     */
    public const RELATE_DISPLAY_LIMIT = 4;

    /**
     * Siteへのリレーション
     *
     * @return BelongsTo
     * SiteへのBelongsToリレーションを返します。
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * HtmlTagへのリレーション
     *
     * @return HasOne
     * HtmlTagへのHasOneリレーションを返します。
     */
    public function htmlTag(): HasOne
    {
        return $this->hasOne(HtmlTag::class, 'job_id');
    }

    /**
     * ページネーションのパターンを配列で返します。
     *
     * @return array
     * ページネーションのパターンを連想配列として返します。
     * キーには定数値、値には表示する件数を指定します。
     */
    public static function getPaginationPatterns(): array
    {
        return [
            self::PAGINATION_LIMIT_10 => 10,
            self::PAGINATION_LIMIT_30 => 30,
        ];
    }
}
