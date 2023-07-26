<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 言語のEloquentモデル
 *
 * @property int $id 言語ID
 * @property string $name 言語名
 *
 * @property-read HasMany|HtmlTag[] $htmlTags HtmlTagへのHasManyリレーション
 */
class Language extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * フィルアブル属性
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * HtmlTagへのリレーション
     *
     * @return HasMany
     * HtmlTagへのHasManyリレーションを返します。
     */
    public function htmlTags(): HasMany
    {
        return $this->hasMany(HtmlTag::class, 'language_id', 'id');
    }
}
