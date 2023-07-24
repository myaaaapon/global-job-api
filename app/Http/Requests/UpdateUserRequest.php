<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Domain\Entities\UserStatus;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->user()->id;

        return [
            'name' => ['required', 'unique:users,name,' . $userId],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'password' => ['required'],
            'status_id' => ['required', 'integer', 'in:' . implode(',', UserStatus::getStatusIds())],
            'tag' => ['array'],
            'tag.*.id' => ['integer', Rule::exists('tags', 'id'), 'distinct'],
        ];
    }
}
