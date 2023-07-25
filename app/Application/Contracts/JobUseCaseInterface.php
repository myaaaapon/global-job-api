<?php

namespace App\Application\Contracts;

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
     * @return \Illuminate\Pagination\LengthAwarePaginator
     * 全ての求人情報を含むLengthAwarePaginatorインスタンスを返します。
     * 指定されたIDに対応する求人情報が見つからない場合は例外を投げます。
     * @throws ModelNotFoundException
     */
    public function getAllJobsBySearch(?int $categoryId, ?int $countryId, ?int $remoteId, ?array $tagIds, ?int $limit): \Illuminate\Pagination\LengthAwarePaginator;

    /**
     * 指定されたIDの求人情報を取得します。
     *
     * @param int $id
     * @return array
     * 指定されたIDに対応する求人情報を連想配列として返します。
     * 指定されたIDに対応する求人情報が見つからない場合は例外を投げます。
     * @throws ModelNotFoundException
     */
    public function getJobById(int $id): array;
}
