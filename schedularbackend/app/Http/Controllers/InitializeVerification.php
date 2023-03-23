<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Meeting;
use Mail;
use App\Mail\Demomail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class InitializeVerification extends Controller
{       private $tenantId = 'e0c49df4-8848-42cf-8942-0438105254ec';
    private $clientId = 'b7e41036-5fa0-4b10-947d-89f010a3ccb4';
    private $clientSecret = '~cC8Q~FJQjFN80cz6n2jxuJUONQSy42b3bWOedp3';
    private $grantType = 'client_credentials';
    private $scope = 'https://graph.microsoft.com/.default';
    private $userPrincipalName = 'Ravi.s@qitsolution.co.in';
    public function sendVerificationEmail(Request $request)
    {
        

        // Generate a random string for the rand field
        $token = str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT);

        $meeting = new Meeting();
        $meeting->email = $request->input('email');
        $meeting->name = $request->input('name');
        $meeting->companyName = $request->input('companyName');
        $meeting->website = $request->input('website');
        $meeting->subject = $request->input('subject');
        $meeting->token = $token;
        $meeting->isVerified = false;
        if (!$meeting->save()) {
            // Return an error response if there is an issue adding the data to the database
            return response()->json([
                'message' => 'Fail',
                'status' => 'error',
                'statuscode' => 500,
            ], 500);
        }

        // Return a success response with the randomly generated $token
        // $mailData =[
        //     'title'=> 'Email Verification',
        //     'body'=> 'Please click on the link below to verify your email..',
        //     'token'=> $token,
        // ];

        // Mail::to($request->input('email'))->send(new Demomail($mailData));
        // // Mail::send('mail',$mailData, function($message) use ($request){
        // //     $message->to($request->input('email'))
        // //     ->subject('Email Verification');
        // // } );

        $url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token";
        
        $response = Http::asForm()->post($url, [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $this->grantType,
            'scope' => $this->scope,
        ]);
        
        $data = $response->json();
        $routeName = 'http://localhost:8000/verification/'.$token; // the name of your route
        
       

        $messageContent = '<h1>Thank You...</h1><p>Please <a href="'.$routeName.'">Click Here</a> to confirm your Email...';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>'Bearer '.$data['access_token']
        ])->post('https://graph.microsoft.com/v1.0/users/Ravi.s@qitsolution.co.in/sendMail', [
            'message' => [
                'subject' => 'Complete Email Verification',
                'body' => [
                    'contentType' => 'HTML',
                    'content' => $messageContent,
                ],
                'toRecipients' => [
                    [
                        'emailAddress' => [
                            'address' => $request->input('email'),
                        ],
                    ],
                ],
            ],
            'saveToSentItems' => true,
        ]);

        
    

        return response()->json([
            'message' => 'Please, check your email, we have sent you a Link for Email Verification..',
            'status' => 'success',
            'statuscode' => 201,
            'rand' => $token,
            'isverified'=>false,
        ], 201);
    }

    public function email_verification(Request $request, $token)
    {
        $result = DB::table('meetings')
            ->where(['token'=>$token])
            ->get();
        if(isset($result[0])){
            $result = DB::table('meetings')
            ->where(['token'=>$token])
            ->update(['isVerified'=>1]); 
            return view('welcome');
        } else{
            dd('nothing');
        }
    }
    public function verificationStatus(Request $request, $token){
        $result = DB::table('meetings')
            ->where(['token'=>$token])
            ->get();
            if(isset($result[0])){
                return response()->json([
                    'data' => $result[0]
                ],200);
            } else{
                return response()->json([
                    'error' => 'No data found for the given token'
                ],404);
            }
    }
}
