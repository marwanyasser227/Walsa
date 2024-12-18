<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Models\User;
use App\Models\City;
use App\Models\Governate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEssentailUserData;
use App\Http\Requests\C_UAddressRequest;
use App\Http\Requests\UpdateAddress;
use App\Notifications\AccountUpdatedNotification;

class UserProfileController extends Controller
{
   
    public function edit()
    {
        //! 001 => Handle condition to maintain that user can't enter without Auth even so pass the middleware[propaplity]
        if(!Auth::user()){
            return redirect()->route('site.home')->withErrors(['error' => 'انت غير مسجل لدخولك😒']);

        }
        //! 002 => Get user from Registered Id in Auth and push it to profile page
        $user = User::with('addresses')->find(Auth::id());

        //! 003 => Get governates data
        $governates = Governate::all();

        //! 004 => Get all cities data
        $cities = City::all(); 

        //! 005 => Return User to profile page with data
        return view('Frontend.User.Profile.profile',compact('user' , 'governates'));

    }

    public function UpdateUserMainData(UpdateEssentailUserData $request)
    {
        //! 001 => Confirm if there is a valid request
        if(!$request){
            return redirect()->route('site.home');
        }

        //! 002 => Check validation aleardy get in custom request

        //! 003 => Confirm that phone or email does not belongs to in other account
         $duplicateEmail = User::where('email',$request->email)->first();
         $duplicatePhone =  User::where('phone',$request->phone)->first();

         if($duplicateEmail && Auth::user()->id != $duplicateEmail->id  ){
            return redirect()->back()->withErrors(['error' => 'البريد مستخدم في حساب أخر أعد المحاولة']);
         }
         elseif($duplicatePhone && Auth::user()->id != $duplicatePhone->id ){
            return redirect()->back()->withErrors(['error' => 'الهاتف مستخدم في حساب أخر أعد المحاولة']);

         }

        //! 004 => Is every thing is okay lets save new data
        $user = User::find(Auth::id());
        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jobTitle' => $request->jobTitle,
        ]);

        //! 005 => Confirm that the update is done
        if(!$update){
            return redirect()->back()->withErrors(['error' => 'ربما حدث خطب ما أعد المحاولة']);

        }

        //! 006 => Send notification to user with changes
        $details = "لقد تم تحديث بياناتك بنجاح يا  ".Auth::user()->name." 😎";
        $user->notify(new AccountUpdatedNotification($details));

        //! 007 => Redirect it back to profile page with toaster message
        return redirect()->back()->with('message' , 'تهانينًا تم تحديث بياناتك بنجاح😁');


    }
    public function UpdateProfileImage(UpdateEssentailUserData $request, User $user)
    {
        //! 001 => Confirm if there is a valid request
        if(!$request){
            return redirect()->route('site.home');
        }

        //! 002 => Check validation already get in custom request

        //! 003 => Find user based on Auth id
        $user = User::find(Auth::id());
        if ($user->profileImage && file_exists(($user->profileImage) )) {
            unlink($user->profileImage);
        }
        //! 004 => Make sure that the request of input is not null !
        if(is_null($request->file('profile_image'))){
            return redirect()->back()->withErrors(['error' => 'يجب ان ترفع صورة😒']);
        }
        //! 005 => Store image into public path
         $imagePath = $request->file('profile_image');
         $location = "assets/profileimages/";
         $imageName = $user->name.time().".".$request->profile_image->extension();
         $uploaded = move_uploaded_file($imagePath ,$location.$imageName);
         
         if($uploaded){

        //! 005 => Is every thing is okay lets save new image path
            $update =$user->update([
                'profileImage' => $location.$imageName,
            ]);

        }

        //! 006 => Confirm that the update is done
         if(!$update){
            return redirect()->back()->withErrors(['error' => 'ربما حدث خطب ما أعد المحاولة']);

        }
        //! 006 => Send notification to user with successes changes
            $details = "لقد تم تحديث صورتك بنجاح يا  ".Auth::user()->name." 😎";
            $user->notify(new AccountUpdatedNotification($details));
        
        //! 007 => Return him redirect back with toaster message
            return redirect()->back()->with('message', '😎تم تحديث الصورة بنجاح!');
                
       


    }


    public function CreateUserAddress(C_UAddressRequest $request){
       //! 001 => confirm if there is a valid request
       if(!$request){
        return redirect()->route('site.home');
    }

      //! 002 => check validation already get in custom request

      //! 003 => check Possible Duplication


    if(!is_numeric($request->postCode)){
        return redirect()->back()->withErrors(['errors' =>'يجب أن يتكون الرمز البريدي من أرقام فقط!😒']);

    }
    //! 004 => is every thing is okay lets save new data
    $user = Auth::user();
    $userAddress = new UserAddress;
    $userAddress->street = $request->street;
    $userAddress->city_id = $request->city_id;
    $userAddress->postCode = $request->postCode;
    $userAddress->bulid_Number = $request->bulid_Number;
    $userAddress->user_id = $user->id;
    $userAddress->floor = $request->floor;
    $userAddress->appartement = $request->appartement;
    $userAddress->secondPhone = $request->secondPhone;
    $userAddress->save();

    //! 005 => if every thing is good let's redirect user
    if($userAddress){

        $details = "لقد تم إضافة العنوان بنجاح يا  ".Auth::user()->name." 😎";
        $user->notify(new AccountUpdatedNotification($details));
        return redirect()->back()->with('message', '👌تم إنشاء العنوان بنجاح!');
    }
    }

    public function editAddress($id){
    //! 001 => Get Important data for the page
        $address = UserAddress::find($id);
        $governates = Governate::all();
        $cities = City::all(); // Fetch all cities

    //! 002 => redirect the user into page with data
        return view('Frontend.User.Profile.editAddress' , compact('address' , 'governates'));
    }



    public function UpdateUserAddress(UpdateAddress $request , $id){
        //! 001 => confirm if there is a valid request
        if(!$request){
         return redirect()->route('site.home');
     }



     //! 002 => check validation already get in custom request

     //! 003 => is every thing is okay lets save new data
        $user = Auth::user();
        $address = UserAddress::find($id);
        $address->street = $request->street;
        $address->city_id = $request->city_id;
        $address->postCode = $request->postCode;
        $address->bulid_Number = $request->bulid_Number;
        $address->user_id = $user->id;
        $address->floor = $request->floor;
        $address->appartement = $request->appartement;
        $address->secondPhone = $request->secondPhone;
        $address->save();




     //! 004 => If every thing is good let's redirect user
        if($address){
        $details = "لقد تم تحديث العنوان بنجاح يا  ".Auth::user()->name." 😎";
        $user->notify(new AccountUpdatedNotification($details));
            return redirect()->back()->with('message', '👌تم تعديل العنوان بنجاح!');
        }
        }


    public function deleteUserAddress($id  ,Request $request){

     //! 001 => Confirm if there is a valid request
          if(!$request){
            return redirect()->route('site.home');
        }

         $address = UserAddress::find($id);
    //! 002 => Handle Delete manual error
         if(!$address || !$address != Null){
            return redirect()->back()->withErrors(['errors' => 'حدثت مشكلة ما عاود المحاولة🤷‍♂️']);
        }

    //! 003 => delete recored and send notification to user
        $address->delete();
        $details = "لقد تم حذف العنوان بنجاح يا  ".Auth::user()->name." 😎";
        $address->user->notify(new AccountUpdatedNotification($details));

    //! 004 => return back with toaster message
        return redirect()->back()->with('message', '👌تم الحذف العنوان بنجاح!');

    }


    public function getCities($governateId)
    {
        //! 001 => get cities from City model based on ajax and on click BOM JS 
        $cities = City::where('governate_id', $governateId)->get(['id', 'name']);

        //! 002 => return with data
        return response()->json($cities);
    }


}
