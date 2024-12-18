<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //! 001 => User Parent control Abstruct function to call toaster in all sub controllers by middleware
    public function __construct(){
        $this->middleware(function($request , $next){
                toast(session('message'),'success');
            return $next($request);
        });
    }




}
