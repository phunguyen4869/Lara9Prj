<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        // Sau khi xác thực, chuyển hướng về đây cùng với một token
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $error) {
            Log::error($error);
            return redirect()->route('login')->with('social_login', 'Đăng nhập không thành công');
        }

        if ($provider == 'github') {
            // Kiểm tra xem người dùng đăng nhập bằng github đã tồn tại
            $authUser = User::where('github_id', $socialUser->id)->first();

            if ($authUser) {
                Auth::login($authUser);
                return redirect()->route('home');
            } else {
                return view('admin.users.register',[
                    'title' => 'Đăng ký bổ sung',
                    'github_id' => $socialUser->id,
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                ])->with('social_login', 'Vui lòng điền bổ sung thông tin đăng ký');
            }
        }
    }
}
