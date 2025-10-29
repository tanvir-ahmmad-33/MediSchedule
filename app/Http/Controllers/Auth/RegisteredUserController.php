<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone'      => ['required', 'regex:/^\+88(01[3-9]\d{8})$/', 'unique:users,phone'],
            'role'       => ['required', 'in:patient,staff,doctor'],
            'gender'     => ['required', 'in:male,female,other'],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        

        $user = User::create([
            'name'           => $request->first_name . ' ' . $request->last_name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'role'           => $request->role,
            'gender'         => $request->gender,
            'admin_verified' => 0,
            'password'       => Hash::make($request->password),
        ]);

        if($user) {
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        }  else {
            return redirect()->route('register')->with('error', 'Registration failed. Please try again.');
        }
    }
}
