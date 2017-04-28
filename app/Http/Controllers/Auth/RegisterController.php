<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Session;
use App\MSG91;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard/calendar';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        if($data['mobile']) {
            $otp = rand(100000, 999999);
            $MSG91 = new MSG91();

            // $msg91Response = $MSG91->sendSMS($otp,$data['mobile']);

            // if($msg91Response['error']){
            //     //$response['error'] = 1;
            //     //$response['message'] = $msg91Response['message'];
            //     //$response['loggedIn'] = 1;
            // }else{
            //     session(['OTP' => $otp]);
            //     //$response['error'] = 0;
            //     //$response['message'] = 'Your OTP is created.';
            //     //$response['OTP'] = $otp;
            //     //$response['loggedIn'] = 1;
            // }
        } else {
            $data['mobile'] = "";
        }

        return User::create([
            'name' => $data['name'],
            'type' => User::$types['Staff'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
