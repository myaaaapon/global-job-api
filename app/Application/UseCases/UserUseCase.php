<?php

namespace App\Application\UseCases;

use App\Application\Contracts\UserUseCaseInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\Domain\Entities\User as UserEntity;
use App\Models\User;
use App\Models\Domain\Entities\UserStatus;
use App\Models\Domain\Entities\UserTag;

class UserUseCase implements UserUseCaseInterface
{
    /**
     * ユーザーをログインさせる。
     *
     * @param string $email ユーザーのメールアドレス
     * @param string $password ユーザーのパスワード
     * @return string|null ログインに成功した場合はトークンを返し、失敗した場合はnullを返す。
     */
    public function login(string $email, string $password): ?string
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email', $email)->first();
            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;
            return $token;
        }

        return null;
    }

    /**
     * ユーザーをログアウトします。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function logout()
    {
        $userId = auth()->id();

        try {
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('User not found', 404);
        }

        $user->tokens->each(function ($token) {
            $token->delete();
        });

        Auth::guard('web')->logout();
    }

    /**
     * ユーザーを作成します。
     *
     * @param string $name ユーザーの名前
     * @param string $email ユーザーのメールアドレス
     * @param string $password ユーザーのパスワード
     * @param int[] $tagIds タグのID配列
     * @return void
     */
    public function createUser(string $name, string $email, string $password, array $tagIds): void
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'status_id' => UserStatus::FREE_USER,
            'password' => Hash::make($password),
        ]);

        foreach ($tagIds as $tagId) {
            $userTag = new UserTag([
                'user_id' => $user->id,
                'tag_id' => $tagId,
            ]);
            $userTag->save();
        }
    }

    /**
     * ユーザー情報を取得します。
     *
     * @return User ユーザーのインスタンス
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function getUser(): User
    {
        $user = auth()->user();
        if (!$user) {
            throw new \Exception('User not found', 404);
        }

        return $user;
    }

    /**
     * ユーザー情報を更新します。
     *
     * @param string $name ユーザーの名前
     * @param string $email ユーザーのメールアドレス
     * @param string $password ユーザーのパスワード
     * @param array $tagIds タグのID配列
     * @return void
     */
    public function updateUser(string $name, string $email, string $password, array $tagIds): void
    {
        $userId = Auth::id();
        $user = UserEntity::findOrFail($userId);

        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $userTagIds = UserTag::where('user_id', $userId)->pluck('tag_id')->toArray();
        $tagsToAttach = array_diff($tagIds, $userTagIds);
        $tagsToDetach = array_diff($userTagIds, $tagIds);
        foreach ($tagsToAttach as $tagId) {
            UserTag::create([
                'user_id' => $userId,
                'tag_id' => $tagId,
            ]);
        }
        UserTag::where('user_id', $userId)->whereIn('tag_id', $tagsToDetach)->delete();
    }

    /**
     * ユーザーを削除します。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function deleteUser()
    {
        $userId = auth()->id();

        try {
            $user = UserEntity::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('User not found', 404);
        }

        $user->userTags()->delete();
        $user->delete();
    }

    /**
     * ユーザーのステータスを取得します。
     *
     * @param int $userId ユーザーID
     * @return UserStatus|null ユーザーのステータスが見つかった場合はUserStatusのインスタンスを返します。見つからない場合はnullを返します。
     */
    public function getStatusByUserId(int $userId): ?UserStatus
    {
        try {
            $user = UserEntity::findOrFail($userId);
            return $user->status;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    /**
     * ユーザーに紐づくタグを取得します。
     *
     * @param int $userId ユーザーID
     * @return array|null ユーザーに紐づくタグの配列を返します。紐づくタグがない場合はnullを返します。
     */
    public function getUserTagsByUserId(int $userId): ?array
    {
        try {
            $user = UserEntity::findOrFail($userId);
            $usertags = $user->usertags->map(function ($usertag) {
                return [
                    'id' => $usertag->tag->id,
                    'name' => $usertag->tag->name,
                ];
            })->toArray();

            return $usertags;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
