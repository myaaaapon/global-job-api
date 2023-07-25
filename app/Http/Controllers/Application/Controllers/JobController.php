<?php

namespace App\Http\Controllers\Application\Controllers;

use App\Http\Controllers\Controller;
use App\Application\Contracts\JobUseCaseInterface as JobUseCase;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GetJobRequest;

class JobController extends Controller
{
    private $jobUseCase;

    /**
     * JobControllerのコンストラクタ
     *
     * @param  JobUseCase  $jobUseCase
     */
    public function __construct(JobUseCase $jobUseCase)
    {
        $this->jobUseCase = $jobUseCase;
    }

    /**
     * 検索条件に基づいて求人情報を取得する。
     *
     * @param GetJobRequest $request リクエストオブジェクト
     * @return JsonResponse JSONレスポンス
     */
    public function getAllJobsBySearch(GetJobRequest $request): JsonResponse
    {
        $jobs = $this->jobUseCase->getAllJobsBySearch(
            $request->input('category_id'),
            $request->input('country_id'),
            $request->input('remote_id'),
            $request->input('tag.*.id'),
            $request->input('limit')
        );
        return response()->json($jobs);
    }

    /**
     * 指定されたIDの求人情報を取得する。
     *
     * @param  int  $id
     * @return JsonResponse JSONレスポンス
     */
    public function getJobById(int $id): JsonResponse
    {
        $job = $this->jobUseCase->getJobById($id);
        return response()->json($job);
    }
}
