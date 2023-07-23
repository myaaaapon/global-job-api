<?php

namespace App\Application\Contracts;

use App\Models\User;
use App\Models\Domain\Entities\UserStatus;

interface UserUseCaseInterface
{
    /**
     * ユーザーをログインさせます。
     *
     * @param string $email - ユーザーのメールアドレス
     * @param string $password - ユーザーのパスワード
     * @return string|null ログインに成功した場合はトークンを返します。失敗した場合はnullを返します。
     */
    public function login(string $email, string $password): ?string;

    /**
     * ユーザーをログアウトします。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function logout(): void;

    /**
     * ユーザーを作成します。
     *
     * @param string $name - ユーザーの名前
     * @param string $email - ユーザーのメールアドレス
     * @param string $password - ユーザーのパスワード
     * @param int[] $tagIds - タグのID配列
     * @return void
     */
    public function createUser(string $name, string $email, string $password, array $tagIds): void;

    /**
     * ユーザー情報を取得します。
     *
     * @return User ユーザーのインスタンス
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function getUser(): User;

    /**
     * ユーザー情報を更新します。
     *
     * @param string $name - ユーザーの名前
     * @param string $email - ユーザーのメールアドレス
     * @param string $password - ユーザーのパスワード
     * @param int[] $tagIds - タグのID配列
     * @return void
     */
    public function updateUser(string $name, string $email, string $password, array $tagIds): void;

    /**
     * ユーザーを削除します。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function deleteUser(): void;

    /**
     * ユーザーのステータスを取得します。
     *
     * @param int $userId ユーザーID
     * @return UserStatus|null ユーザーのステータスが見つかった場合はUserStatusのインスタンスを返します。見つからない場合はnullを返します。
     */
    public function getStatusByUserId(int $userId): ?UserStatus;

    /**
     * ユーザーに紐づくタグを取得します。
     *
     * @param int $userId ユーザーID
     * @return array|null ユーザーに紐づくタグの配列を返します。紐づくタグがない場合はnullを返します。
     */
    public function getUserTagsByUserId(int $userId): ?array;
}
