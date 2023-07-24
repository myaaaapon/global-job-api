<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Tagへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
