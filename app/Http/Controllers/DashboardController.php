<?php

namespace App\Http\Controllers;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Shipment;
use App\Models\ShipmentSender;
use App\Models\User;
use App\Models\Partner;

class DashboardController extends Controller
{
    public function Dashboard(){
        //! Total Shipment Count
        $shipmentCount = Shipment::count();
        $shipments = Shipment::latest()->paginate(6);
        //! Dialy Shipment Count
        $DailyShipmentCount = Shipment::whereDate('created_at', now())->count();
        // //! Daily Profits
        $dailyProfits = Shipment::whereDate('created_at', now())
            ->sum('shipment_costs');
        // //! Totaly Profits
        $totalMoneyCollected = Shipment::sum('shipment_costs');
        //! Clients
        $totalClients = ShipmentSender::count('id');
        $registerdClients =  User::count('id');

        //! Partners
        $partners = Partner::count();

        //! logs
        $logs = ActivityLog::with('user')->latest()->paginate(8);



        // Pass data to the view
        return view('backend.admin', compact('logs','shipments','partners','shipmentCount' , 'dailyProfits' ,'totalMoneyCollected' , 'totalClients' , 'DailyShipmentCount' , 'registerdClients'));
    }

    public function viewActivityLogs()
    {
        //! 001 => get logs data
        $logs = ActivityLog::with('user')->latest()->paginate(10);

        //! 002 => return and push
        return view('backend.logs.index', compact('logs'));
    }

    public function destroy($id){
         //! 001 => get governorate data based on sended Id
         $log = ActivityLog::findOrFail($id);

         if(!$log){
             return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

         }
         //! 002 => delete record
         $log->delete();


         //! 003 => redirect user to table with success message
         return redirect()->back()->with('message', 'تم الحذف بنجاح😒');
     }
    }





