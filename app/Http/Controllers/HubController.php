<?php

namespace App\Http\Controllers;

use App\Models\Hub;
use App\Models\Map;
use App\Models\City;
use App\Models\ShipmentSender;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class HubController extends Controller
{

    public function index()
    {
        //! 001 => Get data from table
        $hubs = Hub::latest()->paginate(10);

        //! 002 => Return user to page of branchs
        return view('backend.hubs.index' , compact('hubs'));
    }
    public function create()
    {
        //! 001 => Get cities data from model
        $cities = City::all();

        //! 002 => Return user to create page
        return view('backend.hubs.create', compact('cities'));
    }

    public function store(Request $request)
    {

        //! 001 => Set validation
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'map' => 'required',
        ]);

        //! 002 => Get data of city to check duplicate
        $city = City::find($request->city_id);

        //! 003 => Check if there is an hub for city already.
        if($city->hub != null){
            return redirect()->back()->withErrors(['errors' => '🤷‍♂️للمدينة مستودع بالفعل الرجاء اختيار مدينة أخرى']);
        }

        //! 004 => Create Hub
        $hub = Hub::create([
            'name_ar' => $request->name_ar,
            'address' => $request->address,
            'city_id' => $request->city_id
        ]);
        //! 005 => Create Map for hub
        Map::create([
            'map' => $request->map,
            'hub_id' => $hub->id,
        ]);

        //! 006 => Send Log to admin with activites
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بإنشاء مستودع جديد'.Auth::user()->name,

        ]);
        //! 007 => Return redirect to index table with toaster message
        return redirect()->route('hubs.index')->with('success', 'تم إنشاء المستودع بنجاح😀');
    }

    public function edit(Hub $hub)
    {

        //! 001 => Get all cities
        $cities = City::all();

        //! 002 => Return user to edit page
        return view('components.hubs.edit' , compact('hub' , 'cities'));
    }



    public function show($id){

        //! 001 => Get data form model of shipments based on relations
         $hub = Hub::with('city.senders.shipments')->find($id); //* use eager loading to reduce time complixity

        //! 002 => Send status
        $shipmentSteps = [
            0 => ['title' => 'تم استلام الطلب', 'color' => 'primary'],
            1 => ['title' => 'جارٍ التجهيز', 'icon' => 'bi-box', 'color' => 'primary'],
            2 => ['title' => 'قيد الشحن', 'icon' => 'bi-truck', 'color' => 'warning'],
            3 => ['title' => 'وصل إلى الوجهة', 'icon' => 'bi-geo-alt', 'color' => 'success'],
            4 => ['title' => 'تم تأجيل الشحنة', 'icon' => 'bi-hourglass-split', 'color' => 'primary'],
            5 => ['title' => 'تمت إلغاء الشحنة', 'icon' => 'bi-arrow-clockwise', 'color' => 'danger'],
            6 => ['title' => 'تمت استعادة الشحنة', 'icon' => 'bi-arrow-clockwise', 'color' => 'success'],
            7 => ['title' => 'غير معروفة الحالة', 'icon' => 'bi-eye-slash', 'color' => 'secondary'],

            ];
            
        //! 003 => Send data with return page of show
         return view('backend.hubs.show' , compact('hub' , 'shipmentSteps'));
    }
    public function update(Request $request, $id)
    {

        //! 001 => Set validation
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'map' => 'string',
        ]);

        //! 002 => Find hub data based on Id
        $hub = Hub::findOrFail($id);
        $hub->name_ar = $request->name_ar;
        $hub->address = $request->address;
        $hub->city_id = $request->city_id;
        $hub->save();
        $map = $hub->map;
        $map->map = $request->map;
        $map->save();



        //! 003 => Send Log to admin
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بإنشاء مستودع جديد'.Auth::user()->name,

        ]);

        //! 004 => redirect admin to hub index table
        return redirect()->route('hubs.index')->with('message', 'تم تحديث المستودع بنجاح!');
    }

    public function destroy($id)
    {
        //! 001 => Search Hub based on Id
        $hub = Hub::find($id);

        //! 002 => Set security layer to avoid problems

        if(!$hub){
            return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطأ قد حدث🥲']);
        }

        //! 003 => Delete hub
        $hub->delete();

        //! 003 => Send log to admin and redirect
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بحذف المستودع'.Auth::user()->name,

        ]);
        return redirect()->route('hubs.index')->with('message', 'تم حذف بيانات المستودع بنجاح😀');
    }
}
