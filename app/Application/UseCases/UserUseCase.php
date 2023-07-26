<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\Contracts\UserUseCaseInterface;
use App\Domain\Entities\UserStatus;

class UserUseCase implements UserUseCaseInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserUseCase コンストラクタ
     *
     * @param UserRepositoryInterface $userRepository ユーザーリポジトリのインスタンス
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * ユーザーをログインさせる。
     *
     * @param string $email ユーザーのメールアドレス
     * @param string $password ユーザーのパスワード
     * @return string|null ログインに成功した場合はトークンを返し、失敗した場合はnullを返す。
     */
    public function login(string $email, string $password): ?string
    {
        return $this->userRepository->login($email, $password);
    }

    /**
     * ユーザーをログアウトします。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function logout(): void
    {
        $this->userRepository->logout();
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
        $this->userRepository->createUser($name, $email, $password, $tagIds);
    }

    /**
     * ユーザー情報とマッチしたアイテム情報を取得します。
     *
     * @return array ユーザー情報とマッチしたアイテム情報の連想配列
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function getUserWithMatchingItems(): array
    {
        return $this->userRepository->getUserWithMatchingItems();
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
        $this->userRepository->updateUser($name, $email, $password, $tagIds);
    }

    /**
     * ユーザーを削除します。
     *
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function deleteUser(): void
    {
        $this->userRepository->deleteUser();
    }

    /**
     * ユーザーのステータスを取得します。
     *
     * @param int $userId ユーザーID
     * @return UserStatus|null ユーザーのステータスが見つかった場合はUserStatusのインスタンスを返します。見つからない場合はnullを返します。
     */
    public function getStatusByUserId(int $userId): ?UserStatus
    {
        return $this->userRepository->getStatusByUserId($userId);
    }

    /**
     * ユーザーに紐づくタグを取得します。
     *
     * @param int $userId ユーザーID
     * @return array|null ユーザーに紐づくタグの配列を返します。紐づくタグがない場合はnullを返します。
     */
    public function getUserTagsByUserId(int $userId): ?array
    {
        return $this->userRepository->getUserTagsByUserId($userId);
    }
}
