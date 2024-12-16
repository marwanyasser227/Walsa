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
        $messages = Contact::all();
        return view('backend.contact.index' , compact('messages'));

    }
    public function create(){
        return view('Frontend.General.contact');

    }


    public function store(Request $request){

        //! 001 => set validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required',
        ]);

        //! 002 => store data

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);


        //! 003 =>  send notification and logs
        if(!$contact){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما عاود المحاولة🥲']);
        }


        $details = "لقد أرسلت رسالة جديدة لنا يا".Auth::user()->name."😊";
        Auth::user()->notify(new ContactFormNotification($details));

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.'بإرسال رسالة جديدة لنا ',
            'details' => json_encode($request->all()),
        ]);


        //! 004 => set Route redirect
        return redirect()->back()->with('message' , 'تم إرسال الرسالة بنجاح سيتم الرد عليك قريبً, إن شاء الله😄');


    }

    public function show($id){
        //! 001 => get data based on Id
        $contact = Contact::find($id);

        //! 002 => push data to route
        return view('backend.contact.show' , compact('contact'));
    }

    public function delete($id){
        //! 001 => get data based on Id
        $contact = Contact::find($id);

        //! 002 => more security
        if(!$contact){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما عاود المحاولة🥲']);

        }


        //! 003 => delete item
        $contact = $contact->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'قام '.Auth::user()->name.'بحذف الرسالة',

        ]);

        if(!$contact){
            return redirect()->back()->withErrors(['error' => 'يبدو أن هنالك خطب ما عاود المحاولة🥲']);

        }

        return redirect()->back()->with('message' , 'تم حذف الرسالة بنجاح😎');

    }
}


