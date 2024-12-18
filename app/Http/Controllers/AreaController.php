<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Governate;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    public function index()
    {
        //! 001 => Get All Areas from model
        $areas = Area::all();

        //! 002 => Let user show the page of areas with pushed data
        return view('backend.areas.areas' , compact('areas'));
    }

    public function create()
    {
        //! 001 => Let user show the page of create
        return view('backend.areas.create');
    }

    public function store(Request $request)
    {
        //! 001 => Set validation
        $request->validate([
            'name' => 'unique:areas|required|string|max:255',
            'shipmentPrice' => 'required'

        ]);

        //! 002 => Store data in model
        Area::create($request->all());


        //! 003 => Return to table and set logs
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام' .Auth::user()->name."بإنشاء منطقة جديدة",
            'details' => json_encode($request->all()),
        ]);
        return redirect()->route('areas.index')->with('message', 'تم الإضافة البيانات بنجاح😎');
    }

    public function edit($id)
    {
        //! 001 => Get City data based on Id from model
        $area = Area::findOrFail($id);

        //! 002 => Let user show the page of edit areas with pushed data
        return view('backend.areas.edit', compact('area'));
    }

    public function show($id)
    {
        //! 001 => Filter data based Elqouent Realtions
        $area = Area::find($id);

        //! 002 => Return data and set log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام' .Auth::user()->name."بإنشاء منطقة ".$area->name,
            'details' => json_encode($request->all()),
        ]);

        //! 003 => Let user show the page of area with targeted area information
        return view('backend.areas.show', compact('area'));
    }

    public function update(Request $request, $id)
    {
        //! 001 => Set validation
        $request->validate([
            'name' => 'required|string|max:255',
            'shipmentPrice' => 'required'
        ]);

        //! 002 => Get area data based on Id
        $area = Area::findOrFail($id);

        //! 003 => Update the data on model
        $area->update($request->all());

        //! 004 => Send log to admin with the new activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام'.Auth::user()->name.'بتطوير بيانات منطقة'.$area->name,
            'details' => json_encode($request->all()),
        ]);

        //! 005 => Return redirect to index page of areas with toaster message
        return redirect()->route('areas.index')->with('message', 'تم تطوير البيانات بنجاح😊');
    }

    public function destroy($id)
    {
        
        //! 001 => Get area data based on Id
        $area = Area::findOrFail($id);

        //! 002 => Make sure that the area is exists in DB 
        if(!$area){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }

        //! 003 => Delete Area
        $area->delete();

        //! 003 => Send a log to admin with new activites
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام'.Auth::user()->name.'بحذف منطقة'.$area->name,
        ]);

        //! 004 => Return reidrect back with toaster message for user
        return redirect()->back()->with('message', 'تم حذف البيانات بنجاح😒');
    }

}
