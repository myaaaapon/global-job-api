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
     * @return ?string ログインに成功した場合はトークンを返します。失敗した場合はnullを返します。
     */
    public function login(string $email, string $password): ?string;

    /**
     * ユーザーをログアウトします。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function logout();

    /**
     * ユーザーを作成します。
     *
     * @param string $name - ユーザーの名前
     * @param string $email - ユーザーのメールアドレス
     * @param string $password - ユーザーのパスワード
     * @return User 作成されたユーザーのインスタンス
     */
    public function createUser(string $name, string $email, string $password): User;

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
     * @param string $name - 更新後のユーザーの名前
     * @param string $email - 更新後のユーザーのメールアドレス
     * @param string $password - 更新後のユーザーのパスワード
     * @return User 更新後のユーザーのインスタンス
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function updateUser(string $name, string $email, string $password): User;

    /**
     * ユーザーを削除します。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function deleteUser();

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
