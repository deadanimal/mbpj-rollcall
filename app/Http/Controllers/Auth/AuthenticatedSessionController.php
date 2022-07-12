<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Audit;
use App\Models\PrUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // setup audit trail

        $user = $request->user();
        $audit = new Audit;
        $audit->user_id = $user->id;
        $audit->name = $user->name;
        $audit->peranan = $user->role;
        $audit->nric = $user->nric;
        $audit->description = 'Log Masuk';

        $audit->save();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        // setup audit trail

        $user = $request->user();
        $audit = new Audit;
        $audit->user_id = $user->id;
        $audit->name = $user->name;
        $audit->peranan = $user->role;
        $audit->nric = $user->nric;
        $audit->description = 'Log Keluar';
        $audit->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function new_store(LoginRequest $request)
    {

        $userLocal = User::where('nric', $request->nric)
            ->where('password', Hash::make($request->password))
            ->first();

        if ($userLocal == null) {
            $userOracle = PrUser::where('USERPASSWORD', md5($request->password))
                ->where('USERNAME', $request->nric)
                ->first();
        }

        if ($userOracle != null) {
            $userLocal = User::where('nric', $request->nric)->first();
        }

        if ($userOracle != null && $userLocal != null) {
            User::where('nric', $request->nric)
                ->update([
                    'status' => 'aktif',
                    'password' => Hash::make($request->password),
                ]);
        }

        if ($userOracle != null && $userLocal == null) {
            $userLocal = User::create([
                'name' => $userOracle->NAME,
                'email' => $userOracle->EMAIL,
                'user_code' => $userOracle->CUSTOMERID,
                'department_code' => $userOracle->DEPARTMENTCODE,
                'nric' => $userOracle->USERNAME,
                'phone' => $userOracle->MOBILE_PHONE,
                'role' => 'kakitangan',
                'status' => 'aktif',
                'password' => Hash::make($request->password),
            ]);
            $user = $userLocal;
            $audit = new Audit;
            $audit->user_id = $user->id;
            $audit->name = $user->name;
            $audit->peranan = $user->role;
            $audit->description = 'Log Masuk';
            $audit->save();

            Auth::login($userLocal);
            return redirect('/dashboard');
        }

        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();
        $audit = new Audit;
        $audit->user_id = $user->id;
        $audit->name = $user->name;
        $audit->peranan = $user->role;
        $audit->description = 'Log Masuk';
        $audit->save();

        return redirect()->intended(RouteServiceProvider::HOME);

    }

}
