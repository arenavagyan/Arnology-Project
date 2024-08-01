<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mailgun\Mailgun;

class VerificationController extends Controller
{
        public function sendVerificationCode(MailRequest $request){
               $email = $request->input('email');
               $code = Str::random(6);
//     $mailgun = new Mailgun(env('MAILGUN_API_KEY'));

               Mail::to($email)->send(new VerificationCodeMail($code));

               return response()->json(["success" => true, "code" => $code]);
        }
}
