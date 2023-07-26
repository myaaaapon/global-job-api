<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * アイテムのEloquentモデル
 *
 * @property int $id アイテムID
 * @property int|null $html_tag_id HTMLタグID
 * @property string $title タイトル
 * @property string|null $body ボディ
 * @property int $company_id 企業ID
 * @property float|null $price 価格
 * @property int $category_id カテゴリID
 * @property int $contract_type_id 契約タイプID
 * @property int $remote_id リモートID
 * @property \Carbon\Carbon|null $published_at 公開日時
 * @property string|null $image_url 画像URL
 * @property float|null $score スコア
 * @property \Carbon\Carbon|null $created_at 作成日時
 * @property \Carbon\Carbon|null $updated_at 更新日時
 *
 * @property-read BelongsTo|HtmlTag $htmlTag HtmlTagへのBelongsToリレーション
 * @property-read HasMany|ItemTag[] $itemTags ItemTagへのHasManyリレーション
 * @property-read BelongsTo|Company $company CompanyへのBelongsToリレーション
 * @property-read BelongsTo|Category $category CategoryへのBelongsToリレーション
 * @property-read BelongsTo|ContractType $contractType ContractTypeへのBelongsToリレーション
 * @property-read BelongsTo|Remote $remote RemoteへのBelongsToリレーション
 */
class Item extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['html_tag_id', 'title', 'body', 'company_id', 'price', 'category_id', 'contract_type_id', 'remote_id', 'published_at', 'image_url', 'score'];

    /**
     * HtmlTagへのリレーション
     *
     * @return BelongsTo
     * HtmlTagへのBelongsToリレーションを返します。
     */
    public function htmlTag(): BelongsTo
    {
        return $this->belongsTo(HtmlTag::class);
    }

    /**
     * ItemTagへのリレーション
     *
     * @return HasMany
     * ItemTagへのHasManyリレーションを返します。
     */
    public function itemTags(): HasMany
    {
        return $this->hasMany(ItemTag::class, 'item_id');
    }

    /**
     * Companyへのリレーション
     *
     * @return BelongsTo
     * CompanyへのBelongsToリレーションを返します。
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Categoryへのリレーション
     *
     * @return BelongsTo
     * CategoryへのBelongsToリレーションを返します。
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ContractTypeへのリレーション
     *
     * @return BelongsTo
     * ContractTypeへのBelongsToリレーションを返します。
     */
    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class);
    }

    /**
     * Remoteへのリレーション
     *
     * @return BelongsTo
     * RemoteへのBelongsToリレーションを返します。
     */
    public function remote(): BelongsTo
    {
        return $this->belongsTo(Remote::class);
    }
}
