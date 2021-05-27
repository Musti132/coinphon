<?php

namespace App\Jobs;

use App\Models\PhoneNumber;
use App\Models\SmsCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class SendVerificationSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public SmsCode $sms;
    public PhoneNumber $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsCode $sms, PhoneNumber $phone)
    {
        $this->sms = $sms;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phone = $this->phone;
        
        $sms = $this->sms;

        $length = strlen($phone->number);

        $ending = substr($phone->number, $length - 2, $length);
        
        // Your Account SID and Auth Token from twilio.com/console
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        return $client->messages->create(
            // the number you'd like to send the message to
            '+4552112257',
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+18438859382',
                // the body of the text message you'd like to send
                'body' => 'Activation code: '.$sms->code,
            ]
        );
    }
}
