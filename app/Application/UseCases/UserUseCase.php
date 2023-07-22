<?php

namespace App\Application\UseCases;

use App\Application\Contracts\UserUseCaseInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

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
     * @return User 作成されたユーザーのインスタンス
     */
    public function createUser(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
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
     * @return User 更新後のユーザーのインスタンス
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException ユーザーが見つからない場合は例外をスローします
     */
    public function updateUser(string $name, string $email, string $password): User
    {
        $userId = auth()->id();

        try {
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('User not found', 404);
        }

        $user->update([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $user;
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
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('User not found', 404);
        }

        $user->delete();
    }
}
