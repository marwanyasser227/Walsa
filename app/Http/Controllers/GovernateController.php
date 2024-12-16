<?php

namespace App\Http\Controllers;

use App\Models\Governate;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class GovernateController extends Controller
{
    public function index()
    {
        //! 001 => get Governates data
        $governates = Governate::all();

        //! 002 => set route direction with data we getted
        return view('backend.governates.index', compact('governates'));
    }


    public function show($id)
    {
        //! 001 => filter data based Elqouent Realtions
        $governate = Governate::find($id);
        //! 002 => return data
        return view('backend.governates.show', compact('governate'));
    }

    public function create()
    {
        //! 001 => get areas data
        $areas = Area::all();

        //! 002 => set route direction with data we getted
        return view('backend.governates.create', compact('areas'));

    }

    public function store(Request $request)
    {
        //! 001 => set validation
        $request->validate([
            'name' => 'unique:governates|required|string|max:255',
            'area_id' => 'required',
        ]);

        //! 002 => but data in model
        $governate = Governate::create($request->all());

        //! 003 => redirect user to table with success message and log for admin

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بإنشاء محافظة '.$governate->name,
            'details' => json_encode($request->all()),
        ]);


        return redirect()->route('governorates.index')->with('message', '😎تم الأضافة بنجاح');
    }

    public function edit($id)
    {
        //! 001 => get governorate data based on sended Id
        $governorate = Governate::findOrFail($id);
        //! 002 => get areas data
        $areas = Area::all();

        //! 003 => redirect user to form per edit
        return view('backend.governates.edit', compact('governorate' , 'areas'));
    }

    public function update(Request $request, $id)
    {
        //! 001 => set validation
        $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required',

        ]);

        //! 002 => update sended data and set logs for admin
        $governorate = Governate::findOrFail($id);
        $governorate->update($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بتعديل محافظة '.$governorate->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('governorates.index')->with('message', 'تم التطوير بنجاح😊');
    }

    public function destroy($id)
    {
        //! 001 => get governorate data based on sended Id
        $governorate = Governate::findOrFail($id);

        if(!$governorate){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }
        //! 002 => delete record
        $governorate->delete();


        //! 003 => redirect user to table with success message and set log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بحذف محافظة '.$governorate->name,
        ]);


        return redirect()->back()->with('message', 'تم الحذف بنجاح😒');
    }

}
