<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require '../vendor/autoload.php';

use Aws\Ses\SesClient;

$client = SesClient::factory(array(
    'key'    => 'AKIAJUARX7MUORQT3CEA',
    'secret' => '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',
    'region' => 'us-east-1',
));

$emailSentId = $client->sendEmail(array(
    // Source is required
    'Source' => 'andrecastilho007@hotmail.com',
    // Destination is required
    'Destination' => array(
        'ToAddresses' => array('andrecastilho007@hotmail.com') 
    ),
    // Message is required
    'Message' => array(
        // Subject is required
        'Subject' => array(
            // Data is required
            'Data' => 'SES Testing............',
            'Charset' => 'UTF-8',
        ),
        // Body is required
        'Body' => array(
            'Text' => array(
                // Data is required
                'Data' => 'My plain text email........',
                'Charset' => 'UTF-8',
            ),
            'Html' => array(
                // Data is required
                'Data' => '<b>My HTML Email</b>.....',
                'Charset' => 'UTF-8',
            ),
        ),
    ),
    'ReplyToAddresses' => array( 'andrecastilho007@hotmail.com' ),
    'ReturnPath' => 'andrecastilho007@hotmail.com'
));



//$result = $client->verifyEmailAddress(array(
    // EmailAddress is required
//    'EmailAddress' => 'andrecastilho007@hotmail.com',
//));
echo "Email Send Id";
var_dump($emailSentId);
