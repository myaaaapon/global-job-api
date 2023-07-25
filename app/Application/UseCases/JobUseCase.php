<?php

namespace App\Application\UseCases;

use App\Application\Contracts\JobUseCaseInterface;
use App\Models\Domain\Entities\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Domain\Entities\Job;

class JobUseCase implements JobUseCaseInterface
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
     * 全ての求人情報を含むLengthAwarePaginatorインスタンスを返します。
     * 指定されたIDに対応する求人情報が見つからない場合は例外を投げます。
     * @throws ModelNotFoundException
     */
    public function getAllJobsBySearch(?int $categoryId, ?int $countryId, ?int $remoteId, ?array $tagIds, ?int $limit): LengthAwarePaginator
    {
        $query = Item::with(['company.country', 'category', 'contractType', 'itemTags.tag', 'remote']);

        if ($categoryId !== null) {
            $query->where('category_id', $categoryId);
        }

        if ($countryId !== null) {
            $query->whereHas('company', function (Builder $query) use ($countryId) {
                $query->where('country_id', $countryId);
            });
        }

        if ($remoteId !== null) {
            $query->where('remote_id', $remoteId);
        }

        if ($tagIds !== null) {
            $query->whereHas('itemTags', function (Builder $query) use ($tagIds) {
                $query->whereIn('tag_id', $tagIds);
            });
        }

        $limit = $limit ?? Job::PAGINATION_LIMIT_10;
        $items = $query->paginate($limit);
        if (!$items) {
            throw new ModelNotFoundException('Job not found');
        }

        $formattedJobs = $items->map(function ($item) {
            return $this->formatItem($item);
        })->all();

        $items->setCollection(collect($formattedJobs));
        return $items;
    }

    /**
     * 指定されたIDの求人情報を取得します。
     *
     * @param int $id
     * @return array
     * 指定されたIDに対応する求人情報を連想配列として返します。
     * 指定されたIDに対応する求人情報が見つからない場合は例外を投げます。
     * @throws ModelNotFoundException
     */
    public function getJobById(int $id): array
    {
        $item = Item::with(['company.country', 'category', 'contractType', 'itemTags.tag', 'remote'])->findOrFail($id);
        if (!$item) {
            throw new ModelNotFoundException('Job not found');
        }

        $formattedJob = $this->formatItem($item);
        $formattedJob['url'] = $item->htmlTag->job->url;

        $relatedItems = Item::whereHas('itemTags', function ($query) use ($item) {
            $query->whereIn('tag_id', $item->itemTags->pluck('tag_id'));
        })->where('id', '!=', $item->id)->limit(Job::RELATE_DISPLAY_LIMIT)->get();

        $formattedJob['relate'] = $relatedItems->map(function ($relatedItem) {
            return $this->formatItem($relatedItem);
        })->all();

        return $formattedJob;
    }

    /**
     * アイテムデータをフォーマットします。
     *
     * @param \App\Models\Domain\Entities\Item $item フォーマットするアイテム
     * @return array フォーマットされたアイテムデータの連想配列
     */
    private function formatItem(Item $item): array
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'body' => $item->body,
            'published_at' => $item->published_at,
            'image_url' => $item->image_url,
            'price' => $item->price,
            'company' => [
                'id' => $item->company->id,
                'name' => $item->company->name,
                'address' => $item->company->address,
                'country' => [
                    'id' => $item->company->country->id,
                    'name' => $item->company->country->name,
                ],
            ],
            'category' => [
                'id' => $item->category->id,
                'name' => $item->category->name,
            ],
            'contract_type' => [
                'id' => $item->contractType->id,
                'name' => $item->contractType->name,
            ],
            'tag' => $item->itemTags->map(function ($itemTag) {
                return [
                    'id' => $itemTag->tag->id,
                    'name' => $itemTag->tag->name,
                ];
            })->all(),
            'remote' => [
                'id' => $item->remote->id,
                'name' => $item->remote->name,
            ],
        ];
    }
}
