<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;

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
        $audit->description =  'Log Masuk';
        
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
        $audit->description =  'Log Keluar'; 
        $audit->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
