<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Message;
use app\Rules\Captcha;

class InputMessageController extends Controller
{
    //
	public function store(Request $request){
		if ($request['contactTel'] === 'on') {
			$request['contactTel'] = 1;
		}

		if ($request['contactEmail'] === 'on') {
			$request['contactEmail'] = 1;
		}

		$reason = $request['reason'];
		
		if ($reason > 1 && $reason < 5) {
			if ($request['email'] != null && $request['g-recaptcha-response'] != null) {
					$response = $request->validate([
					'name' => 'required|string|min:3|max:25',
					'lastName' => 'required|string|min:3|max:25',
					'email' => 'required|email',
					'telephone' => 'nullable|numeric|between:00000000,99999999',
					'reason' => 'required|integer|between:2,4',
					'message' => 'nullable|max:255',
					'contactTel' => 'nullable|integer|between:0,1',
					'contactEmail' => 'nullable|integer|between:0,1',
					'g-recaptcha-response' => 'required',
					'g-recaptcha-response' => new Captcha()
				]);
					return Message::create($response) ? 1 : 0;
				}else if ($request['telephone'] != null && $request['g-recaptcha-response'] != null) {
					$response = $request->validate([
					'name' => 'required|string|min:3|max:25',
					'lastName' => 'required|string|min:3|max:25',
					'email' => 'nullable|email',
					'telephone' => 'required|numeric|between:00000000,99999999',
					'reason' => 'required|integer|between:2,4',
					'message' => 'nullable|max:255',
					'contactTel' => 'nullable|integer|between:0,1',
					'contactEmail' => 'nullable|integer|between:0,1',
					'g-recaptcha-response' => 'required',
					'g-recaptcha-response' => new Captcha()
				]);
					return Message::create($response) ? 1 : 0;
				}else{
					return 0;
				}
		}else{
			return 0;
		}
		
	}
}
