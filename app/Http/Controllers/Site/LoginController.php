<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    //

    use AuthenticatesUsers {
        logout as protected originalLogout;
    }
    public function getLogin()
    {
        return view('pages.site.auth.login');
    }

    public function login(Request $request)
    {
        if (auth('web')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])){



            return redirect()->route('site.index');
        }else{
            return back()->with([

                'message' => 'يوجد خطأ في البيانات, يرجى المحاولة مرة أخرى !',
                'alert-type' => 'danger'
            ]);
        }
    }

    public function getRegister()
    {
        return view('pages.site.auth.register');
    }

    public function register(RegisterRequest $request)
    {

        $customer = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'user_image' => 'avatar.png'
        ]);

        return redirect()->route('site.index');
    }


    public function logout(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        /* Call original logout method */
        $response = $this->originalLogout($request);

        /* Repopulate Sesssion with Cart */
        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) use ($request){
                $request->session()->put('cart.'. $identifier, $rows);
            });
        }

        /* Return original response */
        return $response;

    }

//    protected function originalLogout(){
//
//        Auth::logout();
//        return redirect()->route('site.login');
//    }
}
