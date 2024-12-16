<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('backend.testimonails.testimonials' , compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.testimonails.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //! 001 => check request
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

        //! 003 => check if there is an image and declare new object
        $testimonial = new Testimonial;
        if($request->hasFile('image') && $request->hasFile('image') != Null){
            $imagePath = $request->file('image');
            $location = "assets/testimonails/";
            $imageName = $request->name.time().".".$request->image->extension();
            $uploaded = move_uploaded_file($imagePath ,$location.$imageName);
            $testimonial->image = $location.$imageName;
        }

        //! 004 => store data in model
        $testimonial->name = $request->name;
        $testimonial->jobTitle = $request->jobTitle;
        $testimonial->message = $request->message;
        $testimonial->save();

        //! 005 => make sure that every thing is ok
        if(!$testimonial){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجى إعادة المحاولة']);

        }


        //! 006 => set logs to admin and message to user and redirect
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => ' قام بإنشاء بيانات التوصية'.$testimonial->id,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('dashboard.testimonails')->with(['message' => 'تم الإضافة بنجاح😊']);

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //! 001 => Find the testimonial by ID
        $testimonial = Testimonial::find($id);
        //! 002 => Pass the testimonial data to the view
        return view('backend.testimonails.show' , compact('testimonial'));

    }

    // TestimonialController.php

public function edit($id)
{
    $testimonail = Testimonial::findOrFail($id);
    return view('backend.testimonails.edit', compact('testimonail'));
}

public function update(Request $request, $id)
{

    //! 001 => set validation
    $request->validate([
        'name' => 'required|string|max:255',
        'jobTitle' => 'required|string|max:255',
        'image' => 'nullable|max:2048',
        'message' => 'required|string|max:1000',
    ]);
    $testimonail = Testimonial::findOrFail($id);

    //! 002 =>store data
       //^ Handling image upload
       if ($request->hasFile('image')) {
        //^ Delete the old image if exists
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

        $testimonail->name = $request->name;
        $testimonail->jobTitle = $request->jobTitle;
        $testimonail->message = $request->message;
       $done =  $testimonail->save();
    if(!$done){
        return redirect()->back()->with(['error' => 'هنالك خطأ ما ... أعد الكرة لاحقًا🥲']);

    }

    //! 003 => redirect to route and set logs to admin and message to user
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => ' قام بتعديل بيانات التوصية'.$testimonail->id,
            'details' => json_encode($request->all()),
        ]);

        return redirect()->route('dashboard.testimonails')->with(['message' => 'تم التعديل بنجاح😊']);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //! 001 => Search record
        $testimonail= Testimonial::find($id);
        //! 002 => Handle probabiltes errors
        if(!$testimonail){
            return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجى إعادة المحاولة']);
        }

        if(file_exists($testimonail->image)){
            unlink($testimonail->image);
        }
        //! 003 => Delete record and set logs for admin and messages

        $testimonail->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => ' قام بحذف التوصية'.$testimonail->id,
        ]);
        return redirect()->back()->with(['message' => 'تم حذف التوصية بنجاح😢']);

    }
}
