<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Demomail;

class MailController extends Controller
{
    public function index()
    {
        $mailData =[
            'title'=> 'Mail From Quantum',
            'body'=> 'This is body'
        ];
        Mail::to('qitschedular2023@gmail.com')->send(new Demomail($mailData));
        dd('Email Send Successfully');
    }
}
