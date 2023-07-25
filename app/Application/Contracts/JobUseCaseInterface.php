<?php

namespace App\Application\Contracts;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

interface JobUseCaseInterface
{
    /**
     * 検索条件に基づいて求人情報を取得します。
     *
     * @param int|null $categoryId カテゴリID
     * @param int|null $countryId 国ID
     * @param int|null $remoteId リモートID
     * @param array|null $tagIds タグIDの配列
     * @param int|null $limit 表示件数
     * @return LengthAwarePaginator
     * @throws ModelNotFoundException 検索条件に合致する求人情報が見つからない場合に投げられます。
     */
    public function getAllJobsBySearch(?int $categoryId, ?int $countryId, ?int $remoteId, ?array $tagIds, ?int $limit): LengthAwarePaginator;

    /**
     * 指定されたIDの求人情報を取得します。
     *
     * @param int $id
     * @return array
     * @throws ModelNotFoundException 指定されたIDに対応する求人情報が見つからない場合に投げられます。
     */
    public function getJobById(int $id): array;
}
