<?php

namespace App\Models\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['title', 'body', 'company_id', 'price', 'category_id', 'contract_type_id', 'remote_id', 'published_at', 'image_url', 'score', 'language_id', 'site_id'];

    /**
     * Companyへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * HtmlTagへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function htmlTag()
    {
        return $this->belongsTo(HtmlTag::class);
    }

    /**
     * Categoryへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ContractTypeへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }

    /**
     * Remoteへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function remote()
    {
        return $this->belongsTo(Remote::class);
    }

    /**
     * Languageへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Siteへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
