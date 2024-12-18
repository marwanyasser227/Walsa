<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ContactFormNotification;
use App\Models\Contact;
use App\Models\User;
class ContactController extends Controller
{


    public function index(){
        //! 001 => Get all messages from ContactForm
        $messages = Contact::all();

        //! 002 => Return to Dashboard page with data getted
        return view('backend.contact.index' , compact('messages'));

    }

    public function create(){
        //! 001 => Send user to page contacts of site
        return view('Frontend.General.contact');

    }


    public function store(Request $request){

        //! 001 => Set validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required',
        ]);

        //! 002 => Store data
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        //! 003 => Set flow to check if there is any issue occured
        if(!$contact){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما عاود المحاولة🥲']);
        }

        //! 004 =>  Send notification and logs 
        $details = "لقد أرسلت رسالة جديدة لنا يا".Auth::user()->name."😊";
        Auth::user()->notify(new ContactFormNotification($details));

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.'بإرسال رسالة جديدة لنا ',
            'details' => json_encode($request->all()),
        ]);


        //! 005 => Set Route redirect
        return redirect()->back()->with('message' , 'تم إرسال الرسالة بنجاح سيتم الرد عليك قريبً, إن شاء الله😄');


    }

    public function show($id){
        //! 001 => Get data based on Id
        $contact = Contact::find($id);

        //! 002 => Push data to route
        return view('backend.contact.show' , compact('contact'));
    }

    public function delete($id){
        //! 001 => Get data based on Id
        $contact = Contact::find($id);

        //! 002 => Set flow to check if there is any issue occured
        if(!$contact){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما عاود المحاولة🥲']);

        }


        //! 003 => Delete item
        $contact = $contact->delete();

        //! 004 => Set flow to check if there is any issue occured
        if(!$contact){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما عاود المحاولة🥲']);

        }
        //! 005 => Set notification to user to let him know whats happend
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.'بحذف الرسالة',

        ]);

        //! 006 => Redirect back with messages
        return redirect()->back()->with('message' , 'تم حذف الرسالة بنجاح😎');

    }
}


