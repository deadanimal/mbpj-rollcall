<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index() {  
        $users = User::all();

        // status staff
        $stafjumlah = DB::table('users')
        ->count();

        $staffaktif = DB::table('users')
        ->where('status','=','aktif')
        ->count();

        $staffxaktif = DB::table('users')
        ->where('status','=','tidak_aktif')
        ->count();

        return view ('pentadbir_sistem.index',[
            'users'=>$users,
            'stafjumlah'=>$stafjumlah,
            'staffaktif' => $staffaktif,
            'staffxaktif' => $staffxaktif


            ]);

    }

    public function edit(User $user)
    {
        $roles = [
            "penguatkuasa" => "Penguatkuasa",
            "naziran" => "Naziran",
            "penyelia" => "Penyelia",
            "ketua_bahagian" => "Ketua Bahagian",
            "ketua_jabatan" => "Ketua jabatan",
            "pentadbir_sistem" => "Pentadbir Sistem"
        ];
        $status = [
            "aktif" => "Aktif",
            "tidak_aktif" =>"Tidak Aktif"

        ];
        return view('pentadbir_sistem.edit',[
            'user'=> $user,
            'roles' => $roles,
            'status' => $status

        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->status = $request-> status;
        $user->role = $request-> role;
       
        $user->save();
        $redirected_url= '/users/';
        return redirect($redirected_url);        
    }
    public function kemaskini(Request $request) 
    
    {
        $user =User::where('user_code', $request->user_code);
        $user->role = $request ->role;
        $user->status = $request ->status;
        $user->save();

        $redirected_url= '/users/';
        return redirect($redirected_url);        
    }

    public function tukar_kata_laluan() {
        
    }
}
