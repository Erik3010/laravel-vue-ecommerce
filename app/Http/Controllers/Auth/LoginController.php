<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\User;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $auth = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // User::create([
        //     'name' => 'andi',
        //     'email' => 'andi123@gmail.com',
        //     'password' => bcrypt('andi'),
        //     'api_token' => str_random(50)
        // ]);

        if(Auth::attempt($auth)) {
            Auth::user()->update(['api_token' => str_random(50)]);
            // return Auth::user()->is_admin;
            return response()->json([
                'message' => 'Success',
                'token' => Auth::user()->api_token,
                'is_admin' => Auth::user()->is_admin
            ], 200);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    public function index($token) {
        $user = User::where('api_token', $token)->first();

        return response()->json([
            'message' => 'success',
            'data' => $user
        ], 200);
    }
}
