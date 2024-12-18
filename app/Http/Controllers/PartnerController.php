<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
class PartnerController extends Controller
{

    public function index()
    {
        //! 001 => Get data
        $partners = Partner::all();

        //! 002 => Push to route
        return view('backend.partners.index' , compact('partners'));
    }

    public function create()
    {
        //! 001 => Redirect user to route
        return view('backend.partners.create');
    }

  
    public function store(Request $request)
    {
        //! 001 Define validation's reocrds
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //! 002 => Store data of partner by declare new object of model class
        $partner = new Partner();
        $partner->name = $request->name;

        //! 003 => Make sure that user has sended any image or not for store it
        if ($request->hasFile('image')) {
            $imageName = "assets/partners/".time() . '.' . $request->image->extension();
            move_uploaded_file($request->image , $imageName);
            $partner->image = $imageName;
        }
        //! 004 => Save changes of object
        $partner->save();

        //! 005 => redirect to table with message of success and logs for Admin
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بإضافة الشريك'.$partner->name,
            'details' => json_encode($request->all()),
        ]);
        return redirect()->route('partners.index')->with('message', 'تم إضافة الشريك بنجاح😍!');
    }

    public function show($id)
    {
        //! 001 => Search partner use id
        $partner = Partner::find($id);

        //! 002 => View page with data
        return view('backend.partners.show' , compact('partner'));
    }

    public function edit($id)
    {
        //! 001 => Get governorate data based on sended Id
        $partner = Partner::findOrFail($id);

        //! 002 => Redirect user to form per edit
        return view('backend.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
{
        //! 001 => Define validation's reocrds
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //! 002 => Get partner data based on Id
        $partner = Partner::findOrFail($id);

        //! 003 => Update data of name
        $partner->name = $request->name;

        //! 004 => Check if there is an image
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

        //! 005 => Save changes of object
        $partner->save();

        //! 006 => Redirect to table with logs and success messages
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بتعديل بيانات الشريك'.$partner->name,
            'details' => json_encode($request->all()),
        ]);
        return redirect()->route('partners.index')->with('message', 'تم تعديل بيانات الشريك بنجاح😎!');
}


    public function destroy( $id)
    {
        //! 001 => Get partner data based on sended Id
        $partner = Partner::findOrFail($id);

        //! 002 => Make sure that any problem will not happend after get data
        if(!$partner){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

        }

        //! 003 => Check if the partner has an image to delete it 
        if(file_exists($partner->image)){
            unlink($partner->image);
        }
        //! 004 => Delete record
        $partner->delete();


        //! 005 => Redirect user to table with success message and logs for user
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام بحذف الشريك'.$partner->name,

        ]);
        return redirect()->back()->with('message', 'تم الحذف بنجاح😒');
    }
}
