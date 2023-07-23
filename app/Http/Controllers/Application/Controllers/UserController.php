<?php

namespace App\Http\Controllers\Application\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Application\Contracts\UserUseCaseInterface as UserUseCase;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userUseCase;

    /**
     * UserControllerのコンストラクタ
     *
     * @param  UserUseCase  $userUseCase
     */
    public function __construct(UserUseCase $userUseCase)
    {
        $this->userUseCase = $userUseCase;
    }

    /**
     * ユーザーをログインさせる。
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $token = $this->userUseCase->login($request->email, $request->password);
        if ($token) {
            return response()->json(['token' => $token], Response::HTTP_OK);
        }
        return response()->json('User unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * ユーザーをログアウトする。
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->userUseCase->logout();
        return response()->json('User logged out', Response::HTTP_OK);
    }

    /**
     * ユーザーを作成する。
     *
     * @param  CreateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(CreateUserRequest $request)
    {
        $tagIds = $request->input('tag', []);
        $tagIds = array_map(fn ($tag) => $tag['id'], $tagIds);

        $this->userUseCase->createUser(
            $request->name,
            $request->email,
            $request->password,
            $tagIds
        );
        return response()->json(['message' => 'Create successfully'], Response::HTTP_OK);
    }

    /**
     * ユーザー情報を取得する。
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        $user = $this->userUseCase->getUser();
        $status = $this->userUseCase->getStatusByUserId($user->id);
        $tags = $this->userUseCase->getUserTagsByUserId($user->id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => [
                'id' => $status->id,
                'name' => $status->name,
            ],
            'tag' => $tags,
            'match' => [],  // TODO: マッチングしたJOBを返す
        ], Response::HTTP_OK);
    }

    /**
     * ユーザー情報を更新する。
     *
     * @param  UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $tagIds = $request->input('tag', []);
        $tagIds = array_map(fn ($tag) => $tag['id'], $tagIds);

        $this->userUseCase->updateUser(
            $request->name,
            $request->email,
            $request->password,
            $tagIds
        );
        return response()->json(['message' => 'Update successfully'], Response::HTTP_OK);
    }

    /**
     * ユーザーを削除する。
     *
     * @return \Illuminate\Http\JsonResponse JSONレスポンス
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException モデルが見つからなかった場合の例外
     */
    public function deleteUser(): JsonResponse
    {
        $this->userUseCase->deleteUser();
        return response()->json('Delete successfully', \Illuminate\Http\Response::HTTP_OK);
    }
}
