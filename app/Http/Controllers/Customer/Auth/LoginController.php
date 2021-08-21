<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::CUSTOMER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer-web')->except('logout');
    }

   public function showLoginForm()
    {
        return view('customers.login');
    }

   /* protected function loggedOut(Request $request)
    {
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/customer');
    }*/

    protected function logout(Request $request)
    {
       if(Auth::guard('customer-web')->check()) // this means that the admin was logged in.
{
     Auth::guard('customer-web')->logout();
     return redirect()->route('customer.login');
}
    }

    protected function guard()
    {
        return Auth::guard('customer-web');
    }

}
