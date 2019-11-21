<?php
namespace App\Http\Controllers\Employee;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

    public function username()
    {
        return 'email';
    }

    public function showLoginForm()
    {
        return view('employee.auth.login');
    }

    public function guard()
    {
        return Auth::guard('user');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return redirect('/login');
    }
}
