<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
        public function sendVerificationCode(MailRequest $request){
               $email = $request->input('email');
               $code = Str::random(6);

               Mail::to($email)->send(1);
               return response()->json(["success" => true, "code" => $code]);
        }
}
