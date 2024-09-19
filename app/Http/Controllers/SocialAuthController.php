<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Userモデルをインポート
use Illuminate\Support\Facades\Auth; // Authをインポート

class SocialAuthController extends Controller
{
    // Google認証をリダイレクトするメソッド
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google認証後のコールバックメソッド
    public function handleGoogleCallback()
    {
        // Googleから返ってきたユーザー情報を取得
        $googleUser = Socialite::driver('google')->stateless()->user();

        // ユーザーがすでに存在するか確認
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // 新規ユーザーを登録
            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password'  => bcrypt('password'),  // パスワードを適切に設定
            ]);
        }

        // ユーザーにログインさせる
        Auth::login($user);

        // ホーム画面にリダイレクト
        return redirect('/sample');
    }
}