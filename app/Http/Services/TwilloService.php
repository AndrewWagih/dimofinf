<?php

namespace App\Http\Services;

use Exception;
use Twilio\Rest\Client;

class TwilloService
{
    public function otp($user){
        $verificationCode = 1232;
        $twilio = new Client(config('app.twilio_sid'), config('app.twilio_auth_token'));
        try{
            $twilio->messages->create(
                $user->mobile_number,
                [
                    'from' => '+2012773275345',
                    'body' => 'Your verification code: ' . $verificationCode,
                ]
            );
            $user->update([
                'otp' => $verificationCode
            ]);

        }catch(Exception $e){
        }
        return $verificationCode;
    }
}