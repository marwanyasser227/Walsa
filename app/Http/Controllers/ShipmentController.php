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
use Illuminate\Support\Str;

//^ => Set some consts for shipping options
const EXPRESS = 'express';
const FRAGILE = 'fragile';

class ShipmentController extends Controller
{


    public function createShipment(){

        //! 001 => Get Governates informations
        $governates = Governate::all();

        //! 002 => Return user to create page with governates
        return view('Frontend.User.Shipments.create_shipment' , compact('governates'));
    }


    public function StoreShipment(ShipmentRequest $request){

        //! 001 => Set some global variables
        $user_id = 0;
        $user = false;
        //! 002 => Handle if request is valid and set some global variables
        if($request == null){
            return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);
        }

        //! 003 => Get Validation from Custom Request

        //! 004 => Store Informations data
            //^ 4.1 => check Duplicate If exists => In case of Guest
            if(!Auth::user()){
                $sender = ShipmentSender::where('email',$request->sender_email)->orWhere('phone' , $request->sender_phone)->first();
                //*4.1.1 => Create sender if it's not has any saved data in records and create address if he does not has
                if(!$sender){
                    //& 4.1.1.1 => Create sender new account
                    $sender = New ShipmentSender;
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
            //^ 4.2 check Duplicate If exists => In case of Registerd User
            }elseif(Auth::user()){
                $sender = ShipmentSender::where('email',Auth::user()->email)->orWhere('phone' , Auth::user()->phone)->first();
                //*4.2.1 => Create sender if it's not has any saved data in records and create address if he does not has
                if($sender && count(Auth::user()->addresses) < 1 && $request->city_id != null){
                    //& 4.2.1.1 => Create Address
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

                    //& 4.2.1.2 => Create Sender Account matched with user data
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

                    //& 4.2.1.3 => Modify value of user var to store in into shipment table
                    $user_id = Auth::id();
                }
                //*4.2.2 => Create sender if it's not has any saved data in records and get address data after confirmed that he has one
                if(!$sender && count(Auth::user()->addresses)>=1){

                    //& 4.2.2.1 => Find Address based on id sended in request by user
                    $address = $request->selected_address;
                    $address = UserAddress::find($address);

                    //& 4.2.2.2 => Create new Sender Account
                    $sender = New ShipmentSender;
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

                    //& 4.2.1.3 => Modify value of user var to store in into shipment table
                    $user_id = Auth::id();
                }
            }

        //! 005 => check if happend an error to exit before get more worth
        if(!$sender){
            return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);

        }

        //! 006 => Store reciver Data
         //^ 6.1 => check Duplicate If exists
          $reciver = ShipmentReciver::where('email' ,$request->recipient_email)->orWhere('phone' , $request->recipient_phone)->first();

            //*6.1.1 => Create reciver if it's not has any saved data in records and create address if he does not has
            if(!$reciver){
                //& 6.1.1.1 => Create new reciver account
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
                return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);

        }

        //! 007 => Check if Guest Want an account
            //^ 7.1 => Duplicate issue check
            $checkDuplicate = User::where('email',$sender->email)->orWhere('phone' ,$sender->phone)->first();
            //^ 7.2 => Check if user want to make account
            if($request->createAccount == 1 && !$checkDuplicate){
                //* 7.2.1 => Set Random Password
                $password = Str::random(12); //! improvement

                //* 7.2.2 => Create an user account
                $user = User::create([
                    'name' => $sender->name,
                    'phone' => $sender->phone,
                    'email' => $sender->email,
                    'password' => Hash::make($password)
                ]);

                //* 7.2.3 => Make address for user based on informations sended in post
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


                //* 7.2.4 to modify value of user to store in into shipment table in user_id column ;
                $user_id = $user->id;
        }
            //^ 7.3 => If the user finded in users table assign global variable 'user_id' with the id of founded record
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

         if($shipping_option == EXPRESS){
                $price+=20;
         }

         if($package_type == FRAGILE){
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

        //! 011 => If user Select collect money option store the value wants to collect from his client
            if($request->collectMoney == true){
                $shipment->collectMoney = $request->collectMoney;
                $shipment->collectedPrice = $request->collectedPrice;
            }
            $shipment->save();

        //! 011 => Check if happend an error to exit before get more worth
        if(!$shipment){
                return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);
        }

        //! 012 Set Logs to admin and message to customer

        //! 013 => redirect user to the shipments page based on his case

         //^ 013.1 => If he was a guest and does not want to make user
         if(!Auth::user()&&!$user && $request->createAccount == 0){
            //* 013.1.1 => Set log and routes for guests
            ActivityLog::create([
                'sender_id' => $sender->id,
                'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

            ]);
            //* 013.1.2 => Redirect to page
            return redirect()->route('shipment.details' , $shipment->id)->with('message' , '😎تهانينا تم الطلب بنجاح .ل');

        }
        //^ 013.2 => If he was a guest and want to make user
        elseif(!Auth::user()&&!$user && $request->createAccount == 1){
            //* 013.2.1 => Set log and routes for guests
            ActivityLog::create([
                'sender_id' => $sender->id,
                'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

            ]);

            //* 013.1.2 => Redirect to page
            return redirect()->route('shipment.details' , $shipment->id)->with('message' , 'لا يمكنك إنشاء حساب لديك حساب بالفعل يرجى تسجيل الدخول؛ ولكن تم إنشاء الطلبية بنجاح😄');

        }
        //^ 013.3 => If he was an user
        elseif(Auth::user()){
            //* 013.3.1 => Set log and routes for userShipment as a Auth
             ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,

            ]);

            //* 013.3.2 => Send notifications to user with shipment status
            $shipment->user->notify(new ShipmentCreatedNotification($shipment));

            //* 013.3.3 => Redirect to page
            return redirect()->route('shipment.list')->with('message' , 'تهانينا لقد تم إنشاء الشحنة بنجاح😎');

        }

        //^ 013.4 => If he was an guest and make a user account in process

            //* 013.4.1 => Set log and routes for userShipment as a Auth
            ActivityLog::create([
             'user_id' => Auth::id(),
             'action' => 'قام بإنشاء الطلبية رقم'.$trackNumber,
            ]);

            //* 013.4.2 => Make him login use new account id
            Auth::loginUsingId($user->id);

            //* 013.4.3 => Send him notification to welcome him in site
            $user->notify(new AccountCreatedNotification());

            //* 013.4.4 => Send him notification with details of shipment
            $shipment->user->notify(new ShipmentCreatedNotification($shipment));

            //* 013.4.5 => Redirect him to shipment list with toaster message
            return redirect()->route('shipment.list')->with('message' , '😎تهانينا تم الطلب بنجاح ... مرحبًا بك ');

    }

    public function userShipments(){

        //! 001 => Check if user has an account [more secure with middleware]
        if(!Auth::user()){
            return view('Frontend.User.Shipments.track_order')->withErrors(['error' => ' سجل حسابًا كي تتمكن من تخزين سجل الشحنات 😀']);
        }

        //! 002 => Get the page with shipmentsDetails
        //  $user = User::find(Auth::id())->with('shipments')->get()->first();
            $shipments = Shipment::where('user_id' , Auth::id())->get();

        //! 003 => Let user view the targeted page
            return view('Frontend.User.Shipments.myShipments' , compact('shipments'));

    }

    public function ShipmentTrackDetails($id){

         //! 001 => Get the page with ushipmentsDetails
            $shipment = Shipment::find($id);

         //! 002 => Shipments status
            $shipmentSteps = [
                0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],
                1 => ['title' => 'جارٍ التجهيز', 'icon' => 'bi-box', 'color' => 'green'],
                2 => ['title' => 'قيد الشحن', 'icon' => 'bi-truck', 'color' => 'green'],
                3 => ['title' => 'وصل إلى الوجهة', 'icon' => 'bi-geo-alt', 'color' => 'green'],

                ];

        //! 003 => Check if every thing is good
         if($shipment == null){
            return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);
         }

        //! 004 => Redirect him to track details page with informations
            return view('Frontend.User.Shipments.track_details' , compact('shipment' , 'shipmentSteps'));

    }

    public function trackPage(){

        //! 001 => Return him to track order page
            return view('Frontend.User.Shipments.track_order');
    }



    public function trackOrder(Request $request){

        //! 001 => Check is a valid request
        $request->validate([
            'email' => 'email|required',
            'trackOrder' =>'required',
        ]);

        //! 002 => Check the validation of Request
        if($request == Null){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما حاول مجددًا 🤷‍♂️']);
        }

        //! 003 => Get data from request
            $email = $request->email;
            $trackNumber = $request->trackOrder;
            $shipment = Shipment::where('trackNumber' , $trackNumber)->get()->first();

        //! 004 => Confirm that user send the track number
        if($shipment == null){
            return redirect()->back()->withErrors(['error' => 'عفوًا منك ... لم نجد شحنتك, يبدوا أن رقم التحقق خطأ🥲']);

        }

        //! 005 => Check the authorize of email that can access the shipment or nor
        if($email == $shipment->sender->email || $email == $shipment->reciver->email){

            return redirect()->route('shipment.details' , $shipment->id);
        }

        //! 006 => If user is not Authorize
            return redirect()->back()->withErrors(['error' => 'عفوًا هذا البريد ليس لصاحب الشحنة أو مستلمها الرجاء إدخال بريد صالح😒']);
    }

    public function ShipmentDashboard(){

        //! 001 => Get all shipments data
            $shipments = Shipment::all();

        //! 002 => Check if the records is not exists in database
            if(!$shipments){
                return redirect('main')->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }

        //! 003 => Set arrays of status to push it to page
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

        //! 004 => Return user to details page with pushed data
            return view('backend.shipments.shipments' , compact('shipments' , 'shipmentSteps'));
    }

    public function delete($id){

            //! 001 => Get targeted record by use id
            $shipment = Shipment::find($id);

            //! 002 => Make a secure layer to make certain that there are no issues will happen
            if(!$shipment){
                return redirect('main')->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }

            //! 003 => Delete Record and Redirect user back with flash message
            $shipment->delete();

            //! 004 => Redirect admin back with toaster message
            return redirect()->back()->with('message' , '😎تم الحذف بنجاح');
        }

        public function TrackDetailsDashboard($id){

            //! 001 => Get the page with ushipmentsDetails
                $shipment = Shipment::find($id);

            //! 002 => Shipments status
                $shipmentSteps = [
                    0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],
                    1 => ['title' => 'جارٍ التجهيز', 'icon' => 'bi-box', 'color' => 'green'],
                    2 => ['title' => 'قيد الشحن', 'icon' => 'bi-truck', 'color' => 'green'],
                    3 => ['title' => 'وصل إلى الوجهة', 'icon' => 'bi-geo-alt', 'color' => 'green'],

                    ];

            //! 003 => Check if every thing is good
            if($shipment == null){
                    return redirect()->back()->withErrors(['errors' => 'يبدو أن هنالك خطب ما ... أعد المحاولة لاحقًا🤦‍♂️']);
            }

            //! 004 => Redirect admin to tracked page with details
            return view('backend.shipments.track_details' , compact('shipment' , 'shipmentSteps'));
            }


        public function edit($id){
            //! 001 => Get trageted record by use id
            $shipment = Shipment::find($id);
            //! 002 => Make a secure layer to make certain that there are no issues will happen
            if(!$shipment){
                return redirect('main')->withErrors(['error' => 'حدث خطأ عند جلب البيانات من فضلك حاول مرة اخرى']);

            }

            //! 003 =>  Redirect user to page with data
             //& 3.1 => Shipments status
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

              //& 3.2 => Get governated data
              $governates = Governate::all();

            //! 004 => Return user to page with data getted form database tables
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
            //! 001 => Validate request
            if(!$request){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

            }

            //! 002 => Set Validation
            $request->validate([
                'status' => 'required',
            ]);

            //! 003 =>Get data of shipment
            $shipment = Shipment::find($id);

            //! 004 => More Security
            if(!$shipment){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

            }

            //! 005 => Update status
            $shipment->status = $request->status;
            $shipment->save();


            //! 006 => Send notification to the user and log for admin
            $details = "لقد تم تعديل حالة شحنتك اذهب لتتبعها 😀" ;
            $shipment->user->notify(new ShipmentUpdatedNotification($details));

            //! 007 => Send log to admin with this activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بتعديل حالة الطلبية رقم'.$shipment->trackNumber,
                'details' => json_encode($request->all()),

            ]);

            //! 008 => Redirect admin back with toaster message
            return redirect()->back()->with('message' , '😎تم تعديل الحالة بنجاح');

        }

        public function shipmentDetailsUpdate(UpdateShipmentRequest $request , $id){

            //! 001 => Check Request
            if(!$request){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

            }

            //! 002 => Get data of shipment model
            $shipment = Shipment::find($id);


            //! 004 => Shipment costs logic

              //^ 4.1 => Define price based on shipment_costs in original shipment price
              $price = $shipment->shipment_costs;

              //^ 4.2 => Check if there is any additional costs
              if($request->Additional_shipment_costs > 0 ){
                $price += $request->Additional_shipment_costs;
              }

              //^ 4.3 => Check if User choice option of collect money from his guest
               //* 4.3.1 => Case no
                if($request->collectMoney == null){
                   $shipment->collectMoney =0;
                   $shipment->collectedPrice = 0;

              //* 4.3.2 => Case yes
               }else{
                  $shipment->collectMoney = $request->collectMoney;
                  $shipment->collectedPrice = $request->collectedPrice;
               }
            //! 005 => Store the new informations of shipment
             $shipment->itemSize = $request->package_weight;
             $shipment->itemType = $request->package_type;
             $shipment->shipmentType = $request->shipping_option;
             $shipment->shipment_costs = $price;
             $ok = $shipment->save();

            //! 006 => Add more secure layers
             if(!$ok){
                return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

             }

             //! 007 => Send Notification to user with updated of his shipment
             $details = "لقد تم تعديل بيانات شحنتك اذهب لتفقدها 😀" ;
             $shipment->user->notify(new ShipmentUpdatedNotification($details));


             //! 008 => Send log to admin with new activites
             ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بتعديل بيانات الطلبية رقم'.$shipment->trackNumber,
                'details' => json_encode($request->all()),

            ]);

             //! 009 => Redirect admin back with toaster notification
             return redirect()->back()->with('message' , '😎تم تعديل الطلبية بنجاح');
        }
}
