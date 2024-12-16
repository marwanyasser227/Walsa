<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Partner;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //! 001 =>get dynamic data for home
        $testimonails = Testimonial::latest()->paginate(5);
        $partners = Partner::latest()->paginate(9);
        $groupedPartners = $partners->chunk(3);
        return view('Frontend.home' , compact('testimonails' , 'groupedPartners'));
    }


    public function about(){
        return view('Frontend.General.about');

    }
    

    public function branchs(){
        return view('Frontend.General.branchs');

    }
    /**
     * Show the form for creating a new resource.
     */
}
