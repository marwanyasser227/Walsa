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
        //! 001 => get Cites data
        $cities = City::all();

        //! 002 => set route direction with data we getted
        return view('backend.cities.index', compact('cities'));
    }

    public function create()
    {
        //! 001 => get Cites data
        $governates = Governate::all();

        //! 002 => set route direction with data we getted
        return view('backend.cities.create' ,compact('governates') );
    }

    public function store(Request $request)
    {
        //! 001 => set validation
        $request->validate([
            'name' => 'unique:cities|required|string|max:255',
            'governate_id' => 'required'
        ]);

        //! 002 => but data in model
        $city = City::create($request->all());

        //! 003 => redirect user to table with success message and log for admin

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.' بتسجيل مدينة'.$city->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('cities.index')->with('message', 'تم إضافة البيانات بنجاح😎');
    }

    public function edit($id)
    {
        //! 001 => get city data based on sended Id
        $city = City::findOrFail($id);
        $governates = Governate::all();
        //! 002 => get areas data
        return view('backend.cities.edit', compact('city' , 'governates'));
    }

    public function update(Request $request, $id)
    {
        //! 001 => set validation
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //! 002 => but data in model
        $city = City::findOrFail($id);
        $city->update($request->all());

        //! 003 => redirect user to table with success message and log for admin

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.' بتعديل مدينة'.$city->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('cities.index')->with('message', 'تم تحديث البيانات بنجاح😎');
    }

    public function destroy($id)
    {

        //! 001 => get governorate data based on sended Id
        $city = City::findOrFail($id);

        if(!$city){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }
        //! 002 => delete record
        $city->delete();

        //! 003 => redirect user to table with success message and log for admin

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.' بحذف مدينة'.$city->name,
        ]);

        return redirect()->back()->with('message', 'تم حذف البيانات بنجاح😒');
    }

}
