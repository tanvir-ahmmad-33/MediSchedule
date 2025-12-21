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
            'phone'      => ['required', 'regex:/^01[3-9]\d{8}$/', 'unique:users,phone'],
            'role'       => ['required', 'in:patient,staff,doctor'],
            'gender'     => ['required', 'in:male,female,other'],
            'age'        => ['required', 'integer', 'min:1', 'max:120'],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $userId = $this->genereteUserId($request->first_name, $request->last_name, $request->role);
        while (User::where('user_id', $userId)->exists()) {
            $userId = $this->genereteUserId($request->first_name, $request->last_name, $request->role);
        }

        $user = User::create([
            'user_id'        => $userId,
            'name'           => $request->first_name . ' ' . $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'role'           => $request->role,
            'gender'         => $request->gender,
            'age'            => $request->age,
            'admin_verified' => 0,
            'password'       => Hash::make($request->password),
        ]);

        if($user) {
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        }  else {
            return redirect()->route('register')->with('error', 'Registration failed. Please try again.');
        }
    }

    public function genereteUserId($first_name, $last_name, $role) {
        $firstAlpabet = strtoupper(substr($first_name, 0, 1));
        $lastAlpabet = strtoupper(substr($last_name, 0, 1));
        
        $randomString  = strtoupper(\Illuminate\Support\Str::random(6));
        $rolePrefix = '';

        switch($role) {
            case 'doctor':
                $rolePrefix = 'DOC';
                break;
            case 'staff':
                $rolePrefix = 'STF';
                break;
            case 'patient':
                $rolePrefix = 'PAT';
                break;
            default:
                $rolePrefix = 'USR';
                break;
        }

        return "$rolePrefix-$firstAlpabet$lastAlpabet-$randomString";
    }
}
