<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['title', 'body', 'company_id', 'price', 'category_id', 'contract_type_id', 'remote_id', 'published_at', 'image_url', 'score'];
}
