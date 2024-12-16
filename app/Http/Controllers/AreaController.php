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
        $areas = Area::all();
        return view('backend.areas.areas' , compact('areas'));
    }

    public function create()
    {
        return view('backend.areas.create');
    }

    public function store(Request $request)
    {
        //! 001 => Set validation
        $request->validate([
            'name' => 'unique:areas|required|string|max:255',
            'shipmentPrice' => 'required'

        ]);
        //! 002 => store data in model
        Area::create($request->all());


        //! 003 => return to table and set logs
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام' .Auth::user()->name."بإنشاء منطقة جديدة",
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('areas.index')->with('message', 'تم الإضافة البيانات بنجاح😎');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('backend.areas.edit', compact('area'));
    }

    public function show($id)
    {
        //! 001 => filter data based Elqouent Realtions
        $area = Area::find($id);
        //! 002 => return data and set log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام' .Auth::user()->name."بإنشاء منطقة جديدة",
            'details' => json_encode($request->all()),
        ]);
        return view('backend.areas.show', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'shipmentPrice' => 'required'
        ]);

        $area = Area::findOrFail($id);
        $area->update($request->all());
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام'.Auth::user()->name.'بتطوير بيانات منطقة'.$area->name,
            'details' => json_encode($request->all()),
        ]);
        return redirect()->route('areas.index')->with('message', 'تم تطوير البيانات بنجاح😊');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        if(!$area){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }
        $area->delete();
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام'.Auth::user()->name.'بحذف منطقة'.$area->name,
        ]);
        return redirect()->back()->with('message', 'تم حذف البيانات بنجاح😒');
    }

}
