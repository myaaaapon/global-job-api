<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Entities\UserStatus;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'status_id' => ['required', 'integer', 'in:' . implode(',', UserStatus::getStatusIds())],
            'tag' => ['array'],
            'tag.*.id' => ['integer', Rule::exists('tags', 'id'), 'distinct'],
        ];
    }
}
