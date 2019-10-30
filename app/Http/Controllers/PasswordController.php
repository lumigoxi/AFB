<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use app\User;

class PasswordController extends Controller
{
    //
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsActive');
    }
	public function resetPassword(Request $request){

		if ($request['newPassword'] != $request['newPasswordConfirm']) {
			return 'Los campos de contraseña nueva no coinciden';
		}


		$verityPassword = Hash::check($request['password'], Auth::user()->password) ? 1 : 0;
		if (!$verityPassword) {
			return 'La contraseña no es correcta, debe asegurar que eres la persona quien dice ser.';
		}


		$respose = $request->validate([
			'newPassword' => 'required|min:7|alpha_dash'
		]);

		$password = bcrypt($respose['newPassword']);
		return User::whereId(Auth::user()->id)->update(['password' => $password]) ? 1 : 0;
	}
}
