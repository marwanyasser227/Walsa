<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccountCreatedNotification;
use App\Notifications\AccountUpdatedNotification;
use App\Models\ActivityLog;

class AuthController extends Controller
{

    public function login(){
        return view('Frontend.Auth.login');
    }


    public function loginStore(Request $request)
    {

        //! 001 => Set the validation by get $request validation
        $request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]);

        //! 002 => Check if the credentials has invalid records
        if(!Auth::attempt(["email"=>$request->email ,"password"=>$request->password])){
            return redirect()->back()->withErrors(['error' => 'حسابك غير موجود في سجلاتنا أو كلمة مرورك بها خطب🤷‍♂️']);
            }

        //! 003 => redirect him with notification,log and message
            $message= "مرحى بعودتك يا".Auth::user()->name."😊";
            $details = " مرحبًا بك ... لقد سجلت دخولك للتو يا ".Auth::user()->name."😊";
            Auth::user()->notify(new AccountUpdatedNotification($details));

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام '.Auth::user()->name.'بتسجيل الدخول لحسابه لتوه',
            ]);
            return redirect()->intended(route('site.home'))->with('message' ,$message);

    }

    public function register(){
        return view('Frontend.Auth.register');
    }

    public function registerStore(RegisterRequest $request , User $user)
    {
        //! 001 => check if is a valid request
        if(!$request){
            return redirect()->route('site.login');
        }
        //! 002 => get data from request and Store it
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $name = $request->name;

        //! 003 => Store data in database use User Model
        $user = User::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'password' => $request->password,
        ]);

        //! 004 => Send notification to user and log to admin

        $user->notify(new AccountCreatedNotification());

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'قام '.$user->name.'بتسجيل حساب جديد',

        ]);

        //! 005 => Redirect user to mainpage
        return redirect()->route('login')->with('message' , 'مرحبًا بك في موقعنا ... يرجى تسجيل الدخول 😊');
    }

    public function logout(){
        //! 001 => Handle If User Is not registed
        if(!Auth::user()){
            return redirect()->route('login')->withErrors(["error" => 'أنت مسجل لخروجك بالفعل🤷‍♂️']);
        }
        //! 002 => If the user is already logged in and make him logout with message and log for admin
        $details = "لقد سجلت خروجك للتو يا".Auth::user()->name."😢";
        Auth::user()->notify(new AccountUpdatedNotification($details));

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.'بتسجيل الخروج من حسابه',

        ]);

        Auth::logout();

        return redirect()->route('site.home')->with('message' , '😢تم تسجيل الخروج بنجاح');
    }
    public function resetPassword(){

        return view('Frontend.Auth.resetPassword');
    }
}
