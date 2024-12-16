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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //! 001 => collect price of shipments, profits
          //^ profits
          $shipments = Shipment::all();
          $collectedPrice = Shipment::where('status' , 3)->where('collectMoney', 1) ->sum('collectedPrice');
          $shipmentPrice = Shipment::sum('shipment_costs');
          $profits = $collectedPrice - $shipmentPrice;
          $losses = 0;
          foreach ($shipments as $shipment) {
            if ($shipment->status == 7 || $shipment->status == 5 ) {
                $losses += ($shipment->shipment_costs - $shipment->collectedPrice);
            }


          }
          $losses = min($losses, $profits);


        //! 002 => get users informations
         $clients = ShipmentSender::all();


        //! 003 => push data to targeted route
         return view('backend.clients.users' , compact('clients'  , 'profits' ,'losses' , 'collectedPrice'));
    }

    public function show(string $id)
    {
        $client = ShipmentSender::find($id);
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

        return view('backend.clients.show' , compact('client' , 'shipmentSteps'));
    }


    public function notifications()
{
    $notifications = auth()->user()->unreadNotifications;;
    return view('Frontend.notifications.index', compact('notifications'));
}


public function markAllAsRead()
{
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back()->with('message', 'لقد تم قراءة كافة الإشعارات😊.');
}


public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->where('id', $id)->first();

    if ($notification) {
        $notification->markAsRead();
        return redirect()->back()->with('message', 'تم فراءة الإشعار الذي تم تحديدة😎.');
    }

    return redirect()->back()->withErrors(['error' => 'لم يتم العثور على الإشعارات.']);
}


    public function delete($id)
    {
        //! 001 => get user informations based on Id
        $client = ShipmentSender::find($id);

        //! 002 => check if user is not exists
        if(!$client){
            return redirect()->back()->with('message' , 'يعذر العثور على معرف هذا المستخدم');

        }

        //! 003 => delete user and redirect - Send Notification and logs

        //^ set log
        ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'قام بحذف بيانات العميل '.$client->name,

            ]);
        $client->delete();

        //! 004 => redirect to targeted page and push message and logs
        return redirect()->back()->with('message' , '😎تم الحذف بنجاح');

    }
}
