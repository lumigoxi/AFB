<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('IsActive');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.dashBase');
    }

    public function control(){
        if (Auth::user()->role == 1) {
            return redirect('/dashboard');
        }
        return view('dashboard.control');
    }
}