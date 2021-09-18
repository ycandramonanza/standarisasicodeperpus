<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\Backend\BukuRepository;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userRepo;
    protected $bukuRepo;
    public function __construct()
    {
        $this->middleware('auth');
        $this->userRepo = new UserRepository;
        $this->bukuRepo = new BukuRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // getDataRoleRepo
        $dataLogins = $this->userRepo->getDataLogin();
        $dataLogin     = $dataLogins['message'];
      
        // getDataBukuRepo
        $dataBukus = $this->bukuRepo->getDataBuku();
        $dataBuku     = $dataBukus['message'];
       
        

        // branching login according to role
        if($dataLogin == 'Admin'){
            return view('backend/homeAdmin', compact('dataBuku'));
        }else if($dataLogin == 'User'){
            return view('frontend/homeUser', compact('dataBuku'));
        }else{
            Auth::logout();
            Session::flash('status', $dataLogin);
            return redirect('/login');
        }
    }
}
