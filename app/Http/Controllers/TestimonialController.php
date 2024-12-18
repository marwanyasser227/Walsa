<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
class TestimonialController extends Controller
{

    public function index()
    {
        //! 001 => Get data of testimonials from model
        $testimonials = Testimonial::all();

        //! 002 => Return admin to targeted page with getted data
        return view('backend.testimonails.testimonials' , compact('testimonials'));
    }

  
    public function create()
    {
        //! 001 => Return Admin to create page
        return view('backend.testimonails.create');
    }


    public function store(Request $request)
    {
        //! 001 => Check request
        if(!$request){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجى إعادة المحاولة']);
        }

        //! 002 => Set Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'message' => 'required|string|max:1000',
        ]);

        //! 003 => Declare new object from testimonial class
        $testimonial = new Testimonial;

        //! 004 => Check if there is an image to store it
        if($request->hasFile('image') && $request->hasFile('image') != Null){
            $imagePath = $request->file('image');
            $location = "assets/testimonails/";
            $imageName = $request->name.time().".".$request->image->extension();
            $uploaded = move_uploaded_file($imagePath ,$location.$imageName);
            $testimonial->image = $location.$imageName;
        }

        //! 005 => Store data in model
        $testimonial->name = $request->name;
        $testimonial->jobTitle = $request->jobTitle;
        $testimonial->message = $request->message;
        $testimonial->save();

        //! 006 => Make sure that every thing is ok
        if(!$testimonial){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجى إعادة المحاولة']);

        }

        //! 007 => Set logs to admin 
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => ' قام بإنشاء بيانات التوصية'.$testimonial->id,
            'details' => json_encode($request->all()),
        ]);

        //! 008 => Redirect admin to page with toaster message
        return redirect()->route('dashboard.testimonails')->with(['message' => 'تم الإضافة بنجاح😊']);

    }


    public function show($id)
    {
        //! 001 => Find the testimonial by ID
        $testimonial = Testimonial::find($id);

        //! 002 => Pass the testimonial data to the view
        return view('backend.testimonails.show' , compact('testimonial'));

    }


    public function edit($id)
    {
        //! 001 => Get data of record based on Id
        $testimonail = Testimonial::findOrFail($id);

        //! 002 => Return admin to edit page with data
        return view('backend.testimonails.edit', compact('testimonail'));
    }

    public function update(Request $request, $id)
    {

        //! 001 => Set validation
        $request->validate([
            'name' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'image' => 'nullable|max:2048',
            'message' => 'required|string|max:1000',
        ]);

        //! 002 => Search the object wants to update data 
        $testimonail = Testimonial::findOrFail($id);

        //! 003 => Store data
         //^ Handling image upload
         if ($request->hasFile('image')) {
            //* Delete the old image if exists
            if ($testimonail->image && file_exists(($testimonail->image))) {
                unlink($testimonail->image);
            }
            $imagePath = $request->file('image');
            $location = "assets/testimonails/";
            $imageName = $request->name.time().".".$request->image->extension();
            $imagefinalPath = $location.$imageName;
            $uploaded = move_uploaded_file($imagePath ,$location.$imageName);
            $testimonail->image = $imagefinalPath;
        }
            //* Store normal data
            $testimonail->name = $request->name;
            $testimonail->jobTitle = $request->jobTitle;
            $testimonail->message = $request->message;

        //! 004 => Save changes
        $done =  $testimonail->save();

        //! 005 => Check if any problem occured
        if(!$done){
            return redirect()->back()->with(['error' => 'هنالك خطأ ما ... أعد الكرة لاحقًا🥲']);

        }

        //! 006 => Redirect to route and set logs to admin and message to user
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => ' قام بتعديل بيانات التوصية'.$testimonail->id,
                'details' => json_encode($request->all()),
            ]);

            return redirect()->route('dashboard.testimonails')->with(['message' => 'تم التعديل بنجاح😊']);
    }

    public function destroy($id)
    {
        //! 001 => Search record
        $testimonail= Testimonial::find($id);

        //! 002 => Handle probabiltes errors
        if(!$testimonail){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجى إعادة المحاولة']);
        }

        //! 003 => Delete record and set logs for admin and messages
        $testimonail->delete();

        //! 004 => Check if the targeted person has any image to delete it
        if(file_exists($testimonail->image)){
            unlink($testimonail->image);
        }

        //! 005 => Send log to admin with the activity data
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => ' قام بحذف التوصية'.$testimonail->id,
        ]);

        //! 006 => Redirect admin back with toaster message
        return redirect()->back()->with(['message' => 'تم حذف التوصية بنجاح😢']);

    }
}
