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
        //! 001 => Get some statistcs data for Dashboard main page
        //^ Total Shipments Count
        $shipmentCount = Shipment::count();
        //^ Latest Shipments count
        $shipments = Shipment::latest()->paginate(6);
        //^ Dialy Shipment Count
        $DailyShipmentCount = Shipment::whereDate('created_at', now())->count();
        //^ Daily Profits
        $dailyProfits = Shipment::whereDate('created_at', now())
            ->sum('shipment_costs');
        //^ Totaly Profits
        $totalMoneyCollected = Shipment::sum('shipment_costs');
        //^ Total Clients
        $totalClients = ShipmentSender::count('id');
        //^ Registerd Clients
        $registerdClients =  User::count('id');
        //^ Partners
        $partners = Partner::count();
        //^ Logs
        $logs = ActivityLog::with('user')->latest()->paginate(8);



        //! 002 => Pass data to the view
        return view('backend.admin', compact('logs','shipments','partners','shipmentCount' , 'dailyProfits' ,'totalMoneyCollected' , 'totalClients' , 'DailyShipmentCount' , 'registerdClients'));
    }

    public function viewActivityLogs()
    {
        //! 001 => Get logs data
        $logs = ActivityLog::with('user')->latest()->paginate(10);

        //! 002 => Return and push
        return view('backend.logs.index', compact('logs'));
    }

    public function destroy($id){
         //! 001 => Get governorate data based on sended Id
         $log = ActivityLog::findOrFail($id);

         //! 002 => Make sure that the record is alreardy existed in model or end the program with message to user
         if(!$log){
             return redirect()->back()->withErrors(['error' => 'حدث خطأ عند في إرسال البيانات من فضلك حاول مرة اخرى']);

         }
         //! 003 => Delete record
         $log->delete();


         //! 004 => Redirect user to table with success message
         return redirect()->back()->with('message', 'تم الحذف بنجاح😒');
     }
    }





