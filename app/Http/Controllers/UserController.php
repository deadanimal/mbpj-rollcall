<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('department_code', 'like', '11%')
            ->orWhere('department_code', 'like', '17%')
            ->get();

        // dd($users);
        // $debug = [];
        // foreach($users as $us) {
        //     array_push($debug, $us->department_code);
        // }
        // dd($debug);
        // status staff
        $stafjumlah = DB::table('users')
            ->where('department_code', 'like', '11%')
            ->orWhere('department_code', 'like', '17%')
            ->count();

        $staffaktif = DB::table('users')
            ->where('department_code', 'like', '11%')
            ->orWhere('department_code', 'like', '17%')
            ->where('status', '=', 'aktif')
            ->count();

        $staffxaktif = DB::table('users')
        // ->where('department_code','like','11%')
            ->orWhere('department_code', 'like', '17%')
            ->where('status', '=', 'tidak_aktif')
            ->count();

        return view('pentadbir_sistem.index', [
            'users' => $users,
            'stafjumlah' => $stafjumlah,
            'staffaktif' => $staffaktif,
            'staffxaktif' => $staffxaktif,

        ]);

    }

    public function edit(User $user)
    {
        $roles = [
            "penguatkuasa" => "Penguatkuasa",
            "naziran" => "Naziran",
            "penyelia" => "Penyelia",
            "ketua_bahagian" => "Ketua Bahagian",
            "ketua_jabatan" => "Ketua Jabatan",
            "pentadbir_sistem" => "Pentadbir Sistem",
        ];
        $status = [
            "aktif" => "Aktif",
            "tidak_aktif" => "Tidak Aktif",

        ];
        return view('pentadbir_sistem.edit', [
            'user' => $user,
            'roles' => $roles,
            'status' => $status,

        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->status = $request->status;
        $user->role = $request->role;

        $user->save();
        $redirected_url = '/users/';
        return redirect($redirected_url);
    }
    public function kemaskini(Request $request)
    {
        $user = User::where('user_code', $request->user_code);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        $redirected_url = '/users/';
        return redirect($redirected_url);
    }

    public function tukar_kata_laluan()
    {

    }

    public function updateRole_naziran(Request $request)
    {
        $user = User::find($request->user_id);
        $user->update([
            'role' => $request->newRole,
        ]);

        return response()->json();
    }
}
