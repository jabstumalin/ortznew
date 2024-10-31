<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Hash;
use Illuminate\Support\facades\Validator;
use Illuminate\Validation\ValidationException;
// use App\Http\Controllers\ValidatonException;


class UserController extends Controller
{
    public function register()
    {
        return view('auth/register');

    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'

        ]);

        return redirect()->route('login');

    }
        public function login(){

             return view('auth/login');
        }
//  public function show(string $id): View
//     {
    public function loginAction(Request $request)

        {

         validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'

         ])->validate();

         if (!Auth::attempt($request->only('email', 'password'), $request->boolean ('remember'))){
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);

        }

        $request->session()->regenerate();

        return redirect()->route('products');

    }

    public function logout(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    return redirect('products');

}

    public function profile()
{
    return view('profile');
}


}
