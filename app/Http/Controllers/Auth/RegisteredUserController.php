<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
    'username' => ['required', 'string', 'max:255', 'unique:users'],
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],

    'desig' => ['required'],
    'unit' => ['required'],
    'sec' => ['required'],
    'div' => ['required'],
    'group' => ['required'],
    'subgroup' => ['required'],
    'role' => ['required'],

    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    
        $user = User::create([
    'username' => $request->username,
    'name' => $request->name,
    'email' => $request->email,

    'desig' => $request->desig,
    'unit' => $request->unit,
    'sec' => $request->sec,
    'div' => $request->div,
    'group' => $request->group,
    'subgroup' => $request->subgroup,
    'role' => $request->role,

    'password' => Hash::make($request->password),
    ]);

        event(new Registered($user));

        
        return redirect('/');
    }
}
