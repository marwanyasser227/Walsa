<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipmentSender;
use App\Models\ActivityLog;
use App\Models\Governate;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccountUpdatedNotification;


class UserController extends Controller
{

    public function index()
    {

        //! 001 => Collect price of shipments, profits and losses
          //^ profits
          $shipments = Shipment::all();
          $collectedPrice = Shipment::where('status' , 3)->where('collectMoney', 1) ->sum('collectedPrice');
          $shipmentPrice = Shipment::sum('shipment_costs');
          $profits = $collectedPrice - $shipmentPrice;
          $losses = 0;

        //! 002 => Set a condition in case of => refund or unkown state losses = cost of shipment and collectdprices that losted
          foreach ($shipments as $shipment) {
            if ($shipment->status == 5 ) {
                $losses += ($shipment->shipment_costs);
            }elseif($shipment->status == 7){
                $losses += ($shipment->shipment_costs + $shipment->collectedPrice);

            }
          }

        //! 003 => Return with losses money after check if it more or less than profits 
          $losses = min($losses, $profits);

        //! 004 => Get users informations
         $clients = ShipmentSender::all();

        //! 005 => Push data to targeted route
         return view('backend.clients.users' , compact('clients'  , 'profits' ,'losses' , 'collectedPrice'));
    }

    public function show(string $id)
    {

        //! 001 => Get client by id
        $client = ShipmentSender::find($id);

        //! 002 => Set status based on id
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

        //! 003 => Redirect to targeted page with pushed data
        return view('backend.clients.show' , compact('client' , 'shipmentSteps'));
    }


    public function notifications()
{

        //! 001 => Get notifications from db table
        $notifications = auth()->user()->unreadNotifications;

        //! 002 => Push notifications to targeted route
        return view('Frontend.notifications.index', compact('notifications'));
}


public function markAllAsRead()
{

        //! 001 => Mark all notifications as read
        auth()->user()->unreadNotifications->markAsRead();

        //! 002 => GO to targeted route with toaster message
        return redirect()->back()->with('message', 'لقد تم قراءة كافة الإشعارات😊.');
    }


public function markAsRead($id)
{

        //! 001 => Get notification from db table based on id
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        //! 002 => Set flow to make sure that this notificatin had been read before or not 
        if ($notification) {
            $notification->markAsRead();
            return redirect()->back()->with('message', 'تم فراءة الإشعار الذي تم تحديدة😎.');
        }

        //! 003 => Return redirect back with toaster message

        return redirect()->back()->withErrors(['error' => 'لم يتم العثور على الإشعارات.']);
}


    public function delete($id)
    {
        //! 001 => Get user informations based on Id
        $client = ShipmentSender::find($id);

        //! 002 => Check if user is not exists
        if(!$client){
            return redirect()->back()->with('message' , 'يعذر العثور على معرف هذا المستخدم');

        }

        //! 003 => Delete user and redirect - Send Notification and logs\

        //^ set log
        ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بحذف بيانات العميل '.$client->name,

            ]);

        //^ Delete record
        $client->delete();

        //! 005 => Redirect to targeted page and push message and logs
        return redirect()->back()->with('message' , '😎تم الحذف بنجاح');

    }
}
