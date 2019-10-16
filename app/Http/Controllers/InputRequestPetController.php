<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\RequestPet;
use app\Rules\Captcha;

class InputRequestPetController extends Controller
{
    //
	public function store(Request $request){
		if ($request['contactTel'] === 'on') {
			$request['contactTel'] = 1;
		}

		if ($request['contactEmail'] === 'on') {
			$request['contactEmail'] = 1;
		}

		
			if ($request['email'] != null && $request['g-recaptcha-response']=! null) {
					$response = $request->validate([
					'name' => 'required|string|min:3|max:25',
					'pet_id' => 'required',
					'lastName' => 'required|string|min:3|max:25',
					'email' => 'required|email',
					'telephone' => 'nullable|numeric|between:00000000,99999999',
					'message' => 'nullable|max:255',
					'contactTel' => 'nullable|integer|between:0,1',
					'contactEmail' => 'nullable|integer|between:0,1',
					'g-recaptcha-response' => 'required',
					'g-recaptcha-response' => new Captcha()
				]);
					return RequestPet::create($response) ? 1 : 0;
				}else if ($request['telephone'] != null && $request['g-recaptcha-response']=! null) {
					$response = $request->validate([
					'name' => 'required|string|min:3|max:25',
					'pet_id' => 'required',
					'lastName' => 'required|string|min:3|max:25',
					'email' => 'nullable|email',
					'telephone' => 'required|numeric|between:00000000,99999999',
					'message' => 'nullable|max:255',
					'contactTel' => 'nullable|integer|between:0,1',
					'contactEmail' => 'nullable|integer|between:0,1',
					'g-recaptcha-response' => 'required',
					'g-recaptcha-response' => new Captcha()
				]);
					return RequestPet::create($response) ? 1 : 0;
				}else{
					return 0;
				}
		
	}
}
