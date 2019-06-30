<?php


namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;

class SocialAuthFacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function callback()
    {
        try {
        
            $facebookUser = Socialite::driver('facebook')->user();
            $existUser = User::where('email',$facebookUser->email)->first();

            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->name = $facebookUser->name;
                $user->email = $facebookUser->email;
                $user->facebook_id = $facebookUser->id;
                $user->user_id = md5(rand(1,100));
                $user->password = md5(rand(1,10000));
                $user->save();
                
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/home');
        } 
        catch (Exception $e) {
            dd($e);
            return 'error';
        }
    }
}