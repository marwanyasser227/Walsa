<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Governate;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function index()
    {
        //! 001 => Get Cites data
        $cities = City::all();

        //! 002 => Set route direction with data we getted
        return view('backend.cities.index', compact('cities'));
    }

    public function create()
    {
        //! 001 => Get Cites data
        $governates = Governate::all();

        //! 002 => Set route direction with data we getted
        return view('backend.cities.create' ,compact('governates') );
    }

    public function store(Request $request)
    {
        //! 001 => Set validation
        $request->validate([
            'name' => 'unique:cities|required|string|max:255',
            'governate_id' => 'required'
        ]);

        //! 002 => But data in model
        $city = City::create($request->all());

        //! 003 => Redirect user to table with success message and log for admin
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.' بتسجيل مدينة'.$city->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('cities.index')->with('message', 'تم إضافة البيانات بنجاح😎');
    }

    public function edit($id)
    {
        //! 001 => Get city data based on sended Id and Governates 
        $city = City::findOrFail($id);
        $governates = Governate::all();

        //! 002 => Get areas data
        return view('backend.cities.edit', compact('city' , 'governates'));
    }

    public function update(Request $request, $id)
    {
        //! 001 => Set validation
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //! 002 => Get city data based on Id
        $city = City::findOrFail($id);

        //! 003 => But data in model
        $city->update($request->all());

        //! 004 => Redirect user to table with success message and log for admin
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.' بتعديل مدينة'.$city->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('cities.index')->with('message', 'تم تحديث البيانات بنجاح😎');
    }

    public function destroy($id)
    {

        //! 001 => Get governorate data based on sended Id
        $city = City::findOrFail($id);

        //! 002 => Set flow to check if an problem had occured
        if(!$city){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }
        //! 002 => Delete record
        $city->delete();

        //! 003 => Redirect user to table with success message and log for admin

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.' بحذف مدينة'.$city->name,
        ]);

        return redirect()->back()->with('message', 'تم حذف البيانات بنجاح😒');
    }

}
