<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Visitor;
use Mail;

class Visitor extends Model
{
    protected $fillable =['firstName','lastName','emailAddress','password','phoneNumber','address'];
    
    public static function saveVisitorInfo($request){
        $visitor = new Visitor();
        $visitor->firstName     =  $request->firstName;
        $visitor->lastName      =  $request->lastName;
        $visitor->emailAddress  =  $request->emailAddress;
        $visitor->password      = bcrypt($request->password);
        $visitor->phoneNumber   =  $request->phoneNumber;
        $visitor->address       =  $request->address;
        $visitor->save();
        
        Session::put('visitorId',$visitor->id);
        Session::put('visitorName',$visitor->firstName.' '.$visitor->lastName );
        
        $data = $visitor->toArray();
        Mail::send('front.mail.congratulation-mail',$data,function($message) use ($data){
            $message->to($data['emailAddress']);
            $message->subject('Congratulation Mail');
        });
    }
}
