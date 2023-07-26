<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Domain\Entities\Job;

class GetJobRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストを行うことを許可するかどうかを判断します。
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに適用されるバリデーションルールを取得します。
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => ['integer', 'exists:categories,id'],
            'country_id' => ['integer', 'exists:countries,id'],
            'remote_id' => ['integer', 'exists:remotes,id'],
            'tag' => ['array'],
            'tag.*.id' => ['integer', Rule::exists('tags', 'id'), 'distinct'],
            'limit' => ['integer', 'in:' . implode(',', Job::getPaginationPatterns())],
        ];
    }
}
