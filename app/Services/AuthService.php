<?php

namespace App\Services;

use App\Models\User;
use Twilio\Rest\Client;

class AuthService
{
    public function sendFactorSms(User $user)
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            '+4552112257',
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+18438859382',
                // the body of the text message you'd like to send
                'body' => 'Hey Jenny! Good luck on the bar exam!'
            ]
        );
    }
}
