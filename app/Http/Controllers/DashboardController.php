<?php

namespace app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\Message;
use app\Pet;
use app\RequestPet;
use app\Rescue;

class DashboardController extends Controller
{
    
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsActive');
    }

    private function getInfoRescate(){
    		$done = collect();
		$nd = collect();
		$inProgress = collect();
			for ($i=-6; $i <=0 ; $i++) { 
				 	$done->push(Rescue::whereDate('created_at', '>=', Carbon::now()->firstOfMonth()->addMonth($i))
			              ->whereDate('created_at', '<', Carbon::now()->firstOfMonth()->addMonth($i+1))
			              ->where('status', '=', 0)->count());
				 	$nd->push(Rescue::whereDate('created_at', '>=', Carbon::now()->firstOfMonth()->addMonth($i))
			              ->whereDate('created_at', '<', Carbon::now()->firstOfMonth()->addMonth($i+1))
			              ->where('status', '=', 2)->count());
				 	$inProgress->push(Rescue::whereDate('created_at', '>=', Carbon::now()->firstOfMonth()->addMonth($i))
			              ->whereDate('created_at', '<', Carbon::now()->firstOfMonth()->addMonth($i+1))
			              ->where('status', '=', 1)->count());
			}

		return [
					'done' => $done,
					'nd' => $nd,
					'inProgress' => $inProgress
			];
    }

     private function getInfoPet(){
    		$done = collect();
		$nd = collect();
		$inProgress = collect();
		$dateBegin = Carbon::now()->firstOfMonth()->addMonth(-6);
			for ($i=-6; $i <=0 ; $i++) { 
				 	$done->push(Pet::whereDate('created_at', '>=', Carbon::now()->addMonth($i))
			              ->whereDate('created_at', '<=', Carbon::now()->addMonth($i+1))
			              ->where('status', '=', 2)->count());
				 	$nd->push(Pet::whereDate('created_at', '>=', Carbon::now()->addMonth($i))
			              ->whereDate('created_at', '<=', Carbon::now()->addMonth($i+1))
			              ->where('status', '=', 0)->count());
				 	$inProgress->push(Pet::whereDate('created_at', '>=', Carbon::now()->addMonth($i))
			              ->whereDate('created_at', '<=', Carbon::now()->addMonth($i+1))
			              ->where('status', '=', 1)->count());
			}
		return [
					'done' => $done,
					'nd' => $nd,
					'inProgress' => $inProgress
			];
    }


	public function getInfoDashboard(){
		if (Auth::user()->role >= 1) {

			$messagesNotSeen = Message::where('status', '=', 0)->count();
			$pets = Pet::where('avaible', '=', 0)->count();
			$requestsPets = RequestPet::where('seen', '=', 0)->count();
			$rescues = Rescue::where('status', '=', 2)->count();

			return [
				'Messages' => [
					'NotSeen' => $messagesNotSeen
				],
				'Pets' => [
					'pets' => $pets
				],
				'RequestsPets' => [
					'NotSeen' => $requestsPets
				],
				'Rescues' => [
					'NotAttend' => $rescues
				]
			];
		}
	}


	public function getInfoDiagram(Request $request){

		Carbon::setlocale(LC_TIME, 'es');


		if (Auth::user()->role >= 1) {

			$rescues = $this->getInfoRescate();
			$pets = $this->getInfoPet();
			return [
				'rescues' => $rescues,
				'pets' => $pets
			];
		}
	}





	}

