<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\duta_wakaf;
use App\Models\NazhirModel;
use App\Models\ProjectModel;
use App\Models\jf_pinjam;
use App\Models\group_anggota;
use App\Models\GroupModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginAdmin(Request $request){
        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]) && !$credentials->fails()){
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors($credentials->errors()->add('credentials_error', "Credentials doesn't match!"))->onlyInput('email');
        }
    }

    public function loginUser(Request $request){

        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['duta_email' => $request->email, 'password' => $request->password]) && !$credentials->fails()){
            return redirect()->route('anggota.dashboard');
        } else {
            return back()->withErrors($credentials->errors()->add('credentials_error', "Credentials doesn't match!"))->onlyInput('email');
        }
    }

    public function logoutUser(Request $request){

        if (Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function logoutAdmin(Request $request){
        if (Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin');
    }
}
