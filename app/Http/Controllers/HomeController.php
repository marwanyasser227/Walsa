<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Hub;
use App\Models\City;
use App\Models\ShipmentSender as Sender;
use App\Models\ShipmentReciver as Reciver;
use App\Models\Map;

class HomeController extends Controller
{

    public function index()
    {

        //! 001 =>Get dynamic data for home
         //^ 1.1 Testimonails
         $testimonails = Testimonial::latest()->paginate(5);
         //^ 1.2 Partners
         $partners = Partner::latest()->paginate(9);
         //^ 1.3 Send Partners like groups to slider
         $groupedPartners = $partners->chunk(3);

        //! 002 => Redirect to main Site's Page with getted data
        return view('Frontend.home' , compact('testimonails' , 'groupedPartners'));
    }


    public function about(){

        //! 001 => Return user to page of abouts
        return view('Frontend.General.about');

    }


    public function branchs(){
        //! 001 => Get data from Hub Model
          $hubs = Hub::with('map')->latest()->paginate(10);

        //! 002 => Return user to page of branchs
        return view('Frontend.General.branchs' , compact('hubs'));

    }

}
