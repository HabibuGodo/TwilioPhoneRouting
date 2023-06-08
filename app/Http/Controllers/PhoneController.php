<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;

class PhoneController extends Controller
{
    /**
     * Get twilio access token.
     */
    public function getAccessToken(Request $request)
    {
        // Get the access token from twilio via their package.
        $access_token = new AccessToken(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_API_KEY'),
            env('TWILIO_API_SECRET'),
            3600,
            'Habibu_Godo',
            'us1'
        );

        // Grant voice permissions.
        $voiceGrant = new VoiceGrant();
        $voiceGrant->setOutgoingApplicationSid(env('TWILIO_TWIML_APP_SID'));

        // Grant incoming call permissions.
        $voiceGrant->setIncomingAllow(true);

        // Add grant to access token.
        $access_token->addGrant($voiceGrant);

        // Render our token to a JWT
        $token = $access_token->toJWT();

        return response()->json([
            'identity' => 'Habibu_Godo',
            'token' => $token
        ]);
    }

    /**
     * Function to handle inbound/outbound phone calls for twilio.
     */
    public function handleCallRouting(Request $request)
    {
        // Get the number we are calling.
        // $dialledNumber = $request->get('To') ?? null;

        // Where to make a voice call (your cell phone?)
        $to_number = "+255673135158";

        // Set up instance of voice response.
        $voiceResponse = new VoiceResponse();


        $account_sid = env('TWILIO_ACCOUNT_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');

        // A Twilio number you own with Voice capabilities
        // $twilio_number = "+15153052213";

        $client = new Client($account_sid, $auth_token);
        if ($to_number != env('TWILIO_CALLER_ID')) {
            # Outbound phone call.

            // Remove any html special characters.
            // $number = htmlspecialchars($to_number);

            $client->account->calls->create(
                $to_number,
                env('TWILIO_CALLER_ID'),
                array(
                    "url" => "http://demo.twilio.com/docs/voice.xml"
                )
            );

            // // Dial.
            // $dial = $voiceResponse->dial('', ['callerId' => env('TWILIO_CALLER_ID')]);

            // if (preg_match("/^[\d+\-\(\) ]+$/", $number)) {
            //     # Standard outbound phone call to telephone number.
            //     $dial->number($number);
            // } else {
            //     # Client to client (Agent - Agent) phone call.
            // }
        } elseif ($to_number == env('TWILIO_CALLER_ID')) {
            # Inbound phone calls
            // Setup a dial / response.
            $dial = $voiceResponse->dial('');
            // Dial the client. (Hardcoded for now.)
            $dial->client('Habibu Test');
            // // A Twilio number you own with Voice capabilities
            // $response = new VoiceResponse;
            $voiceResponse->say("Hello Habibu Welcome!");
            print $voiceResponse;
        } else {
            $voiceResponse->say("Thank you for calling up!");
        }

        return (string)$voiceResponse;
    }

    /**
     * Function to handle inbound/outbound phone calls for twilio.
     */
    public function handleCallOutgoing(Request $request)
    {

        $account_sid = env('TWILIO_ACCOUNT_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');

        // A Twilio number you own with Voice capabilities
        $twilio_number = "+15153052213";

        // Where to make a voice call (your cell phone?)
        $to_number = "+255673135158";

        $client = new Client($account_sid, $auth_token);
        $client->account->calls->create(
            $to_number,
            $twilio_number,
            array(
                "url" => "http://demo.twilio.com/docs/voice.xml"
            )
        );
    }

    // public function handleCallReceiving(Request $request)
    // {

    //     $account_sid = env('TWILIO_ACCOUNT_SID');
    //     $auth_token = env('TWILIO_AUTH_TOKEN');

    //     // A Twilio number you own with Voice capabilities
    //     $response = new VoiceResponse;
    //     $response->say("Hello world!");
    //     print $response;
    // }
}
