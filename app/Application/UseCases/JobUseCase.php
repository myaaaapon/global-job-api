<?php

namespace App\Application\UseCases;

use App\Application\Contracts\JobUseCaseInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Domain\Repositories\JobRepositoryInterface;

class JobUseCase implements JobUseCaseInterface
{
    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;

    /**
     * JobUseCaseのコンストラクタ
     *
     * @param JobRepositoryInterface $jobRepository 求人情報リポジトリのインスタンス
     */
    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * 検索条件に基づいて求人情報を取得します。
     *
     * @param int|null $categoryId カテゴリID
     * @param int|null $countryId 国ID
     * @param int|null $remoteId リモートID
     * @param array|null $tagIds タグIDの配列
     * @param int|null $limit 表示件数
     * @return LengthAwarePaginator
     * @throws ModelNotFoundException 指定されたIDに対応する求人情報が見つからない場合は例外を投げます。
     */
    public function getAllJobsBySearch(?int $categoryId, ?int $countryId, ?int $remoteId, ?array $tagIds, ?int $limit): LengthAwarePaginator
    {
        return $this->jobRepository->getAllJobsBySearch($categoryId, $countryId, $remoteId, $tagIds, $limit);
    }

    /**
     * 指定されたIDの求人情報を取得します。
     *
     * @param int $id 求人情報のID
     * @return array
     * @throws ModelNotFoundException 指定されたIDに対応する求人情報が見つからない場合は例外を投げます。
     */
    public function getJobById(int $id): array
    {
        return $this->jobRepository->getJobById($id);
    }
}
