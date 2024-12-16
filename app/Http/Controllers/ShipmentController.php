<?php

namespace App\Http\Controllers;
use App\Notifications\ShipmentStatusChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipment;
use App\Models\ShipmentSender;
use App\Models\ShipmentReciver;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Governate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Notifications\ShipmentCreatedNotification;
use App\Notifications\ShipmentUpdatedNotification;
use App\Notifications\AccountCreatedNotification;
use App\Models\ActivityLog;

class ShipmentController extends Controller
{


    public function createShipment(){
        $governates = Governate::all();
        return view('Frontend.User.Shipments.create_shipment' , compact('governates'));
    }


    public function StoreShipment(ShipmentRequest $request){

        //! 001 => handle if request is valid and set some global variables
        if($request == null){
            return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);

        }

        $user_id = 0;
        $user = false;
        //! 002 => Get Validation from Custom Request

        //! 003 => Store Informations data
            //^ checkDuplicateIfexists
            if(!Auth::user()){
                $sender = ShipmentSender::where('email',$request->sender_email)->orWhere('phone' , $request->sender_phone)->first();

                if(!$sender){
                    $sender = New ShipmentSender;
                    //^ Case Guest
                    $sender->name = $request->sender_name;
                    $sender->email = $request->sender_email;
                    $sender->phone = $request->sender_phone;
                    $sender->SecondPhone = $request->sender_S_phone;
                    $sender->bulid_Number =  $request->sender_build;
                    $sender->street = $request->sender_street;
                    $sender->floor = $request->sender_floor;
                    $sender->appartement = $request->sender_appartament;
                    $sender->city_id = $request->city_id;
                    $sender->postCode = $request->postCode;

                    $sender->save();

                }
            }elseif(Auth::user()){
                //^ Case Auth
                $sender = ShipmentSender::where('email',Auth::user()->email)->orWhere('phone' , Auth::user()->phone)->first();

                if(count(Auth::user()->addresses) < 1 && $request->city_id != null){
                    $address = new UserAddress;
                    $address->street =$request->sender_street;
                    $address->floor = $request->sender_floor;
                    $address->appartement = $request->sender_appartement;
                    $address->postCode = $request->sender_postCode;
                    $address->bulid_Number = $request->sender_build;
                    $address->city_id = $request->city_id;
                    $address->user_id = Auth::user()->id;
                    $address->secondPhone = $request->sender_S_phone;
                    $address->save();


                    $sender = New ShipmentSender;
                    $sender->name = Auth::user()->name;
                    $sender->email = Auth::user()->email;
                    $sender->phone = Auth::user()->phone;
                    $sender->SecondPhone = $request->sender_S_phone;
                    $sender->bulid_Number = $request->sender_build;
                    $sender->street =$request->sender_street;
                    $sender->floor = $request->sender_floor;
                    $sender->appartement = $request->sender_appartement;
                    $sender->city_id = $request->city_id;
                    $sender->postCode = $request->sender_postCode;
                    $sender->save();
                    //* to modify value of user to store in into shipment table;
                     $user_id = Auth::id();
                }
                if(!$sender && count(Auth::user()->addresses)>=1){
                    $sender = New ShipmentSender;
                    $address = $request->selected_address;
                    $address = UserAddress::find($address);

                    $sender->name = Auth::user()->name;
                    $sender->email = Auth::user()->email;
                    $sender->phone = Auth::user()->phone;

                    $sender->SecondPhone = $address->secondPhone;
                    $sender->bulid_Number = $address->bulid_Number;
                    $sender->street = $address->street;
                    $sender->floor = $address->floor;
                    $sender->appartement = $address->appartement;
                    $sender->city_id = $address->city_id;
                    $sender->postCode = $address->postCode;
                    $sender->save();
                    //* to modify value of user to store in into shipment table;
                     $user_id = Auth::id();
                }

            }

        //! 004 => check if happend an error to exit before get more worth
        if(!$sender){
            return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);

        }
        //! 005 => Store reciver Data
         //^ checkDuplicateIfexists
         $reciver = ShipmentReciver::where('email' ,$request->recipient_email)->orWhere('phone' , $request->recipient_phone)->first();

        if(!$reciver){

            $reciver = New ShipmentReciver;
            $reciver->name = $request->recipient_name;
            $reciver->email =  $request->recipient_email;
            $reciver->phone = $request->recipient_phone;
            $reciver->SecondPhone = $request->recipient_S_phone;
            $reciver->bulid_Number = $request->recipient_build;
            $reciver->street = $request->recipient_street;
            $reciver->floor = $request->recipient_floor;
            $reciver->appartement = $request->recipient_appartament;
            $reciver->city_id = $request->r_city_id;
            $reciver->postCode = $request->postCode;
            $reciver->save();
        }

        //! 006 => check if happend an error to exit before get more worth
        if(!$reciver){
                $reciver->delete();
                return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);

        }

        //! 007 => Check if Guest Want ann account
            //^ Duplicate issue check
            $checkDuplicate = User::where('email',$sender->email)->orWhere('phone' ,$sender->phone)->first();
            if($request->createAccount == 1 && !$checkDuplicate){
                $user = User::create([
                    'name' => $sender->name,
                    'phone' => $sender->phone,
                    'email' => $sender->email,
                    'password' => Hash::make("Password")
                ]);
                $address = UserAddress::create([
                    'street' => $sender->street,
                    'floor' => $sender->floor,
                    'appartement'=> $sender->appartement,
                    'postCode' => $sender->postCode,
                    'build_number' => $sender->build,
                    'city_id' => $sender->city_id,
                    'user_id' => $user->id,
                    'secondPhone'=> $sender->secondPhone,
                ]);


                $user_id = $user->id;
        }

            //* to modify value of user to store in into shipment table;
            if($checkDuplicate){
                $user_id = $checkDuplicate->id;
            }

        //! 008 => Get Shipment Data
            $weight = $request->package_weight;
            $package_type = $request->package_type;
            $shipping_option = $request->shipping_option;
            $trackNumber = "MSH_".time();

        //! 009 Set costs of ship
            $netCost = $reciver->city->governate->area->shipmentPrice;
            $price = $netCost;
            if($weight > 10){
                for($i=$weight; $i > 10 ; $i--){
                    $price += 10;
                };
            };

         if($shipping_option == "express"){
                $price+=20;
         }

         if($package_type == "fragile"){
                $price+=50;
         }


        //! 010 => Store shipment Data
            $shipment = new Shipment;
            $shipment->trackNumber = $trackNumber;
            $shipment->itemSize = $weight;
            $shipment->itemType = $package_type;
            $shipment->shipment_reciver_id = $reciver->id;
            $shipment->shipment_sender_id = $sender->id;
            $shipment->user_id = $user_id;
            $shipment->shipmentType = $shipping_option;
            $shipment->shipment_costs = $price;

            if($request->collectMoney == true){
                $shipment->collectMoney = $request->collectMoney;
                $shipment->collectedPrice = $request->collectedPrice;
            }
            $shipment->save();

        //! 011 => check if happend an error to exit before get more worth
        if(!$shipment){
                $sender->delete();
                $reciver->delete();

                return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);

        }


        //! 012 Set Logs to admin and message to customer
        //! 013 => redirect user to the page

        if(!Auth::user()&&!$user && $request->createAccount == 0){

            //^ set log and routes for guests
            ActivityLog::create([
                'sender_id' => $sender->id,
                'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

            ]);
            return redirect()->route('shipment.details' , $shipment->id)->with('message' , '😎تهانينا تم الطلب بنجاح .ل');

        }elseif(!Auth::user()&&!$user && $request->createAccount == 1){
            //^ set log and routes for guests
            ActivityLog::create([
                'sender_id' => $sender->id,
                'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

            ]);
            return redirect()->route('shipment.details' , $shipment->id)->with('message' , 'لا يمكنك إنشاء حساب لديك حساب بالفعل يرجى تسجيل الدخول؛ ولكن تم إنشاء الطلبية بنجاح😄');

        }elseif(Auth::user()){
            //^ set log and routes for users
             ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

            ]);
            $shipment->user->notify(new ShipmentCreatedNotification($shipment));
            return redirect()->route('shipment.list')->with('message' , 'تهانينا لقد تم إنشاء الشحنة بنجاح😎');

        }
            //^ set log and routes for users
                ActivityLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

                ]);
            Auth::loginUsingId($user->id);
            $user->notify(new AccountCreatedNotification());
            $shipment->user->notify(new ShipmentCreatedNotification($shipment));

            return redirect()->route('shipment.list')->with('message' , '😎تهانينا تم الطلب بنجاح ... مرحبًا بك ');

    }




    public function userShipments(){

        //! 001 => check if user has an account [more secure with middleware]
        if(!Auth::user()){
            return view('Frontend.User.Shipments.track_order')->withErrors(['error' => ' سجل حسابًا كي تتمكن من تخزين سجل الشحنات 😀']);
        }

        //! 002 => get the page with shipmentsDetails
        //  $user = User::find(Auth::id())->with('shipments')->get()->first();
            $shipments = Shipment::where('user_id' , Auth::id())->get();
        //! 003 => let user view the targeted page
            return view('Frontend.User.Shipments.myShipments' , compact('shipments'));

    }


    public function ShipmentTrackDetails($id){

        //! 001 => get the page with ushipmentsDetails
            $shipment = Shipment::find($id);
         //! 002 => Shipments status
            $shipmentSteps = [
                0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],
                1 => ['title' => 'جارٍ التجهيز', 'icon' => 'bi-box', 'color' => 'green'],
                2 => ['title' => 'قيد الشحن', 'icon' => 'bi-truck', 'color' => 'green'],
                3 => ['title' => 'وصل إلى الوجهة', 'icon' => 'bi-geo-alt', 'color' => 'green'],

                ];

        //! 003 => check if every thing is good
         if($shipment == null){
                return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);
         }



            return view('Frontend.User.Shipments.track_details' , compact('shipment' , 'shipmentSteps'));

    }



    public function trackPage(){
            return view('Frontend.User.Shipments.track_order');
    }



    public function trackOrder(Request $request){

        //! 001 => check is a valid request
        $request->validate([
            'email' => 'email|required',
            'trackOrder' =>'required',
        ]);
        if($request == Null){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما حاول مجددًا 🤷‍♂️']);
        }
        //! 002 => get data from request
            $email = $request->email;
            $trackNumber = $request->trackOrder;
            $shipment = Shipment::where('trackNumber' , $trackNumber)->get()->first();

        //! 003 => confirm that user send the track number
        if($shipment == null){
            return redirect()->back()->withErrors(['error' => 'عفوًا منك ... لم نجد شحنتك, يبدوا أن رقم التحقق خطأ🥲']);

        }

        //! 004 check the authorize of email
        if($email == $shipment->sender->email || $email == $shipment->reciver->email){

            return redirect()->route('shipment.details' , $shipment->id);
        }

        //! 005 => if user is not Authorize

            return redirect()->back()->withErrors(['error' => 'عفوًا هذا البريد ليس لصاحب الشحنة أو مستلمها الرجاء إدخال بريد صالح😒']);

    }

    public function ShipmentDashboard(){

            $shipments = Shipment::all();
            if(!$shipments){
                return redirect('main')->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }
            $shipmentSteps = [
                0 => ['title' => 'تم استلام الطلب', 'color' => 'primary'],
                1 => ['title' => 'جارٍ التجهيز', 'icon' => 'bi-box', 'color' => 'primary'],
                2 => ['title' => 'قيد الشحن', 'icon' => 'bi-truck', 'color' => 'warning'],
                3 => ['title' => 'وصل إلى الوجهة', 'icon' => 'bi-geo-alt', 'color' => 'success'],
                4 => ['title' => 'تم تأجيل الشحنة', 'icon' => 'bi-hourglass-split', 'color' => 'primary'],
                5 => ['title' => 'تمت إلغاء الشحنة', 'icon' => 'bi-arrow-clockwise', 'color' => 'danger'],
                6 => ['title' => 'تمت استعادة الشحنة', 'icon' => 'bi-arrow-clockwise', 'color' => 'success'],
                7 => ['title' => 'غير معروفة الحالة', 'icon' => 'bi-eye-slash', 'color' => 'secondary'],

                ];
            return view('backend.shipments.shipments' , compact('shipments' , 'shipmentSteps'));
    }
    public function delete($id){

            //! 001 => Get trageted record by use id
            $shipment = Shipment::find($id);
            //! 002 => make a secure layer to make certain that there are no issues will happen
            if(!$shipment){
                return redirect('main')->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }

            //! 003 => Delete Record and Redirect user back with flash message
            $shipment->delete();

            return redirect()->back()->with('message' , '😎تم الحذف بنجاح');
        }

        public function TrackDetailsDashboard($id){
        //! 001 => get the page with ushipmentsDetails
            $shipment = Shipment::find($id);
        //! 002 => Shipments status
                $shipmentSteps = [
                    0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],
                    1 => ['title' => 'جارٍ التجهيز', 'icon' => 'bi-box', 'color' => 'green'],
                    2 => ['title' => 'قيد الشحن', 'icon' => 'bi-truck', 'color' => 'green'],
                    3 => ['title' => 'وصل إلى الوجهة', 'icon' => 'bi-geo-alt', 'color' => 'green'],

                    ];

            //! 003 => check if every thing is good
            if($shipment == null){
                    return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);
            }



                    return view('backend.shipments.track_details' , compact('shipment' , 'shipmentSteps'));
            }
        public function edit($id){
            //! 001 => Get trageted record by use id
            $shipment = Shipment::find($id);
            //! 002 => make a secure layer to make certain that there are no issues will happen
            if(!$shipment){
                return redirect('main')->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }

            //! 003 =>  Redirect user to page with data
             //& Shipments status
             $shipmentSteps = [
                0 => ['title' => 'تم استلام الطلب'],
                1 => ['title' => 'جارٍ التجهيز'],
                2 => ['title' => 'قيد الشحن'],
                3 => ['title' => 'وصل إلى الوجهة'],
                4 => ['title' => 'تم تأجيل الشحنة'],
                5 => ['title' => 'تمت إلغاء الشحنة'],
                6 => ['title' => 'تمت استعادة الشحنة'],
                7 => ['title' => 'غير معروفة الحالة'],
                ];

            $governates = Governate::all();

            return view('backend.shipments.edit' , compact('shipment' , 'governates' ,'shipmentSteps'));
        }
        public function DashboardDetailsView($id){

            //! 001 => Get trageted record by use id
            $shipment = Shipment::find($id);
            //! 002 => make a secure layer to make certain that there are no issues will happen
            if(!$shipment){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }

            //! 003 => Delete Record and Redirect user back with flash message
            $shipment->delete();

            return redirect()->back()->with('message' , '😎تم الحذف بنجاح');
        }

        public function statusChange($id , Request $request){
            //! 001 => validate request
            if(!$request){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

            }

            //! 002 => Set Validation
            $request->validate([
                'status' => 'required',
            ]);

            //! 003 =>get data of shipment
            $shipment = Shipment::find($id);

            //! 004 => More Security
            if(!$shipment){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

            }

            //! 005 => Update status
            $shipment->status = $request->status;

            $shipment->save();


            //! 006 Send notification to the user and log for admin
            $details = "لقد تم تعديل حالة شحنتك اذهب لتتبعها 😀" ;
            $shipment->user->notify(new ShipmentUpdatedNotification($details));

            //^ set log
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بتعديل حالة الطلبية رقم'.$shipment->trackNumber,
                'details' => json_encode($request->all()),

            ]);
            // $shipment->user->notify(new ShipmentStatusChangedNotification($shipment));
            return redirect()->back()->with('message' , '😎تم تعديل الحالة بنجاح');

        }

        public function shipmentDetailsUpdate(UpdateShipmentRequest $request , $id){

            //! 001 => check Request
            if(!$request){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

            }

            //! 002 => get data of shipment
            $shipment = Shipment::find($id);

            //! 003 => Shipment
             //^ set shipment price
             $price = $shipment->shipment_costs;



            //! 004 => set some cost calculation
             if($request->Additional_shipment_costs > 0 ){
                $price += $request->Additional_shipment_costs;
             }


            //!005 => check if the sender has an account
            //  $user_id = 0;
            //  if($user){
            //     $user_id = $user->id;
            //  }

            if($request->collectMoney == null){
                $shipment->collectMoney =0;
                $shipment->collectedPrice = 0;

            }else{
                $shipment->collectMoney = $request->collectMoney;
                $shipment->collectedPrice = $request->collectedPrice;

            }
             $shipment->itemSize = $request->package_weight;
             $shipment->itemType = $request->package_type;
             $shipment->shipmentType = $request->shipping_option;
             $shipment->shipment_costs = $price;
             $ok = $shipment->save();

             //! 006 => Add more secure layers
             if(!$ok){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

             }


             //! 007 => Send Notification and logs
             $details = "لقد تم تعديل بيانات شحنتك اذهب لتفقدها 😀" ;
             $shipment->user->notify(new ShipmentUpdatedNotification($details));


             //^ set log
             ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بتعديل بيانات الطلبية رقم'.$shipment->trackNumber,
                'details' => json_encode($request->all()),

            ]);
             return redirect()->back()->with('message' , '😎تم تعديل الطلبية بنجاح');

        }

}
