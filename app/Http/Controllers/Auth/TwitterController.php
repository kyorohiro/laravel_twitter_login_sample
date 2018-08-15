<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Socialite;
use App\OauthAccount;
use App\User;

class TwitterController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $account = OauthAccount::firstOrCreate([
            "oauth_id" => $user->getId(),
            "type" => "twitter",
        ]);

        if (empty($account->user_id))
        {
            $u = User::create([
                'name'   => $user->getId,
                'email'  => (empty($user->getEmail())?$user->getId."@twitter.example.com":$user->getEmail()),
                'password' => uniqid(),
            ]);
            $account->user_id = $u->id;
        }
        $account->save();
        \Auth::login(User::find($account->user_id));
        var_dump(\Auth::check());
    }
}
