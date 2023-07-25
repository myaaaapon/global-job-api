<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemTag extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'item_tags';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['item_id', 'tag_id'];

    /**
     * Itemへのリレーション
     *
     * @return BelongsTo
     * ItemへのBelongsToリレーションを返します。
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Tagへのリレーション
     *
     * @return BelongsTo
     * TagへのBelongsToリレーションを返します。
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
