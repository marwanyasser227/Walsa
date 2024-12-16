<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //! 001 => get data
        $partners = Partner::all();

        //! 002 => push to route
        return view('backend.partners.index' , compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //! 001 => redirect user to route
        return view('backend.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //! 001 define validation's reocrds
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //! 002 => store data and storage image
        $partner = new Partner();
        $partner->name = $request->name;

        if ($request->hasFile('image')) {
            $imageName = "assets/partners/".time() . '.' . $request->image->extension();
            move_uploaded_file($request->image , $imageName);
            $partner->image = $imageName;
        }
        $partner->save();

        //! 003 => redirect to table with message of success and logs for Admin
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بإضافة الشريك'.$partner->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('partners.index')->with('message', 'تم إضافة الشريك بنجاح😍!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
          //! 001 => get governorate data based on sended Id
          $partner = Partner::findOrFail($id);

          //! 002 => redirect user to form per edit
          return view('backend.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
        //! 001 define validation's reocrds
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //! 002 get partner data based on Id
        $partner = Partner::findOrFail($id);
        $partner->name = $request->name;

        //! 003 check if there is an image
        if ($request->hasFile('image')) {
            //^ Delete the old image if it exists
            if ($partner->image && file_exists(public_path($partner->image))) {
                unlink(public_path($partner->image));
            }

            //^ Upload the new image
            $imageName = "assets/partners/".time() . '.' . $request->image->extension();
            move_uploaded_file($request->image , $imageName);
            $partner->image = $imageName;
        }
        $partner->save();

        //! 004 redirect to table with logs and success messages
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بتعديل بيانات الشريك'.$partner->name,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('partners.index')->with('message', 'تم تعديل بيانات الشريك بنجاح😎!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //! 001 => get partner data based on sended Id
        $partner = Partner::findOrFail($id);

        if(!$partner){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }

        if(file_exists($partner->image)){
            unlink($partner->image);
        }
        //! 002 => delete record
        $partner->delete();


        //! 003 => redirect user to table with success message and logs for user

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بحذف الشريك'.$partner->name,

        ]);

        return redirect()->back()->with('message', 'تم الحذف بنجاح😒');
    }
}
