<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        // $this->middleware('auth')->only('logout');
    }

    public function index()
    {
        return view('auth/login');
    }

    public function formKolektor()
    {
        return view('kolektor.loginKolektor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        // Pengecekan login tanpa Hash
        if ($user && $credentials['password'] === $user->password) {
            Auth::login($user);
            $request->session()->regenerate();

            switch ($user->role) {
                case 'user':
                    return redirect()->route('user.dashboard');
                case 'kolektor':
                    return redirect()->route('kolektor.index');
                case 'kasir':
                    return redirect()->route('kasir.index');
                case 'admin':
                    return redirect()->route('admin.index');
                case 'superadmin':
                    return redirect()->route('superadmin.index');
                default:
                    return redirect('login/index')->withErrors(['access' => 'Role tidak dikenali']);
            }
        } else {
            return redirect('login/index')->withErrors(['login' => 'Username atau password salah']);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status == 1) {
            Auth::logout(); // Logout user jika status tidak aktif
            return redirect()->route('login.index')->with('error', 'Akun Anda dinonaktifkan.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    // hosting
    public function store_for_android(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            $loginAttempt = Hash::check($credentials['password'], $user->password);
        } else {
            $loginAttempt = false;
        }

        if ($loginAttempt) {
            Auth::login($user);
            // $request->session()->regenerate();
            $token = $user->createToken('authToken')->plainTextToken;

            switch ($user->role) {
                case 'user':
                    return response()->json([
                        'status' => 'gagal',
                        // 'user' => $user, 
                        // 'access_token' => $token
                    ], 404);
                case 'kolektor':
                    return response()->json([
                        'status' => 'success',
                        'user' => $user,
                        'access_token' => $token
                    ], 200);
            }
        } else {
            return response()->json([
                'status' => 'gagal',
                // 'user' => $user, 
                // 'access_token' => $token
            ], 404);
        }
    }

    public function login_petugas_for_android(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            $loginAttempt = Hash::check($credentials['password'], $user->password);
        } else {
            $loginAttempt = false;
        }

        if ($loginAttempt) {
            Auth::login($user);
            // $request->session()->regenerate();
            $token = $user->createToken('authToken')->plainTextToken;

            switch ($user->role) {
                case 'user':
                    return response()->json([
                        'status' => 'success',
                        'user' => $user,
                        'access_token' => $token
                    ], 200);
                case 'kolektor':
                    return response()->json([
                        'status' => 'gagal',
                        // 'user' => $user, 
                        // 'access_token' => $token
                    ], 404);
            }
        } else {
            return response()->json([
                'status' => 'gagal',
                // 'user' => $user, 
                // 'access_token' => $token
            ], 404);
        }
    }
}
