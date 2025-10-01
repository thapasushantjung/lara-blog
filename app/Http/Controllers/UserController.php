<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],

        ]);
        $user = new User;

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();
        Auth::login($user, true);

        /* $user = User::create([ */
        /*     'name' => $validated['name'], */
        /*     'email' => $validated[email], */
        /*     'password' => Hash::make($validated['password']), */
        /* ]); */

        return redirect('/');

    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([

            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('ram');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function ram(): View
    {

        $user = Auth::user();

        if ($user) {
            return view('ram')->with('user', $user);
        } else {
            return 'not loggedin';
        }
    }
}
