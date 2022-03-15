<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

  
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        // $request->validate([

        $rules =[
            // 'current_password' => ['required', new MatchOldPassword],
            // 'new_password' => ['required','min:8'],
            'new_password' => [
                        'required',
                        'string',
                        Password::min(8)
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                            ->uncompromised(),
                    ],
            'new_confirm_password' => ['same:new_password'],
        ];

        // $rules = [
        //     'current_password' => ['required', new MatchOldPassword],
        //     'new_password' => [
        //         'required','min:8',
        //         Password::min(0)
        //             ->letters()
        //             ->mixedCase()
        //             ->numbers()
        //             ->symbols()
        //     ],
        //     'new_confirm_password' => [
        //         'same:new_password',
        //         'required',
        //     ],
        // ];

        $validator = Validator::make($request->all(), $rules, $messages = [
            'min'=>'Kata laluan yang dimasukkan mesti tidak kurang 8 abjad',
            'required' => 'Sila masukkan kata laluan baru jika ingin kemaskini',
            'same' => 'Kata laluan yang dimasukkan tidak sama',
            // 'new_password.Password::min(8)' => 'AAAAA',
            // 'regex' => 'Password must be in alphanumeric'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        };
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->back()->with ('success','Kata Laluan Berjaya Dikemaskini.');
    }
}