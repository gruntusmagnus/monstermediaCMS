<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Modules\Order\Order;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        sendLoginResponse as originalSendLoginResponse;
    }
    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/';

    protected function credentials(Request $request)
    {
        return [
            $this->username()    => $request->{$this->username()},
            'password'           => $request->password,
            'active'             => true,
            'authenticable_type' => User::class
        ];
    }

    protected function sendLoginResponse(Request $request)
    {

        // create token for user
        $user = $this->guard()
                     ->user();

        $token = JWTAuth::fromUser($user);
        session(['jwtToken' => $token]);

        return $this->originalSendLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
//        $ords = $user->orders()->get();
//        if(!($ords->isEmpty())){
//            $order = new Order();
//            $order->user_id = $user->id;
//            $order->save();
//        }
    }
}
