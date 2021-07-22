<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        if ($role == 'penguatkuasa') {
            return view ('dashboard.penguatkuasa_dashboard');
        } elseif ($role == 'pentadbir_sistem') {
            return view ('dashboard.pentadbir_dashboard');
        } elseif ($role == 'penyelia') {
            return view ('dashboard.penyelia_dashboard');
        } elseif ($role == 'ketua_bahagian') {
            return view ('dashboard.ketua_bahagian_dashboard');
        } elseif ($role == 'ketua_jabatan') {
            return view ('dashboard.ketua_jabatan_dashboard');
        } elseif ($role == 'naziran') {
            return view ('dashboard.naziran_dashboard');
        } 
    }
    
}
