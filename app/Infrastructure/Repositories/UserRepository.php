<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Domain\Entities\User;
use App\Domain\Entities\UserStatus;
use App\Domain\Entities\UserTag;
use App\Domain\Entities\Item;
use App\Domain\Entities\Job;
use App\Domain\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
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
    public function logout(): void
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
     * ユーザー情報とマッチしたアイテム情報を取得します。
     *
     * @return array ユーザー情報とマッチしたアイテム情報の連想配列
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function getUserWithMatchingItems(): array
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        if (!$user) {
            throw new \Exception('User not found', 404);
        }

        // ユーザーが持つタグのIDの配列を取得
        $userTagIds = $user->userTags->pluck('tag_id')->toArray();

        // ユーザーが持つタグIDと一致するItemを取得
        $items = Item::whereHas('itemTags', function ($query) use ($userTagIds) {
            $query->whereIn('tag_id', $userTagIds);
        })->take(Job::RELATE_DISPLAY_LIMIT)->get();

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => [
                'id' => $user->status->id,
                'name' => $user->status->name,
            ],
            'tag' => $user->userTags->map(function ($userTag) {
                return [
                    'id' => $userTag->tag->id,
                    'name' => $userTag->tag->name,
                ];
            })->all(),
            'match' => $items->map(function ($item) {
                return $this->formatItemData($item);
            })->all(),
        ];
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
        $user = User::findOrFail($userId);

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
    public function deleteUser(): void
    {
        $userId = auth()->id();

        try {
            $user = User::findOrFail($userId);
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
            $user = User::findOrFail($userId);
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
            $user = User::findOrFail($userId);
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

    /**
     * Itemデータをフォーマットします。
     *
     * @param Item $item
     * @return array
     */
    private function formatItemData(Item $item): array
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
