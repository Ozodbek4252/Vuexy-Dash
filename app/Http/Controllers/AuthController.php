<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /**
             * @var User
             */
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            // Check the user's role and redirect accordingly
            if (in_array($user->role->slug, ['owner', 'admin'])) {
                return redirect()->route('dash.dashboard')->with('token', $token);
            } else {
                return redirect()->route('home')->with('token', $token);
            }
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(RegisterRequest $request)
    {
        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => Role::where('slug', 'regular')->first()->id,
        ]);

        // Create a token for the new user
        $token = $user->createToken('auth-token')->plainTextToken;

        // Redirect the user to the dashboard route with the token
        return redirect()->route('home')->with('token', $token);
    }

    public function logout(Request $request)
    {
        /**
         * @var User
         */
        $user = Auth::user();
        // Revoke all tokens issued to the user
        $user->tokens->each->delete();

        // Clear all session data
        $request->session()->flush();

        return redirect()->route('login');
    }
}
