<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    private $tenantId = 'e0c49df4-8848-42cf-8942-0438105254ec';
    private $clientId = 'b7e41036-5fa0-4b10-947d-89f010a3ccb4';
    private $clientSecret = '~cC8Q~FJQjFN80cz6n2jxuJUONQSy42b3bWOedp3';
    private $grantType = 'client_credentials';
    private $scope = 'https://graph.microsoft.com/.default';
    private $userPrincipalName = 'Ravi.s@qitsolution.co.in';
    public function booking(Request $request)
    {   // get the token
        $url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token";
        
        $response = Http::asForm()->post($url, [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $this->grantType,
            'scope' => $this->scope,
        ]);
        
        $data = $response->json();
        // retrieve the config object from the request
        $config = $request->all();
        // return $config;
        // make the API call to create a new event
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$data['access_token'],
            'Content-Type' => 'application/json',
        ])->post('https://graph.microsoft.com/v1.0/users/Ravi.s@qitsolution.co.in/calendar/events', $config);

        // check the response status code and return a response accordingly
        if ($response->ok()) {
            return response()->json(['message' => 'Event created successfully']);
        } else {
            return response()->json(['message' => 'Failed to create event'], $response->status());
        }
    }
};
