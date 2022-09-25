<?php

namespace App\EmailProvider;

use \Illuminate\Http\Request;
use SendinBlue\Client\Api\ContactsApi;
use SendinBlue\Client\Configuration;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;

class SendInBlueProvider implements EmailProviderInterface
{
    protected static $config;

    public function __construct()
    {
        $this->apiConnection();
    }

    function apiConnection() : Configuration
    {
        //connect only once
        if (!self::$config) {
            self::$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_KEY'));
        }

        return self::$config;
    }

    public function getLists() : array|bool
    {
        $apiInstance = new ContactsApi(
            new Client(),
            self::$config
        );

        try {
            return SendInBlueApiTransform::getSelectList(
                $apiInstance->getLists(50, 0, 'desc')
            );
        }
        catch (Exception $e)
        {
            echo 'Exception when calling ContactsApi->getLists: ', $e->getMessage(), PHP_EOL;

            return false;
        }
    }

    public function send( int $list_id, Request $request) : string|bool
    {
        $apiInstanceEmails = new TransactionalEmailsApi(
            new Client(),
            self::$config
        );

        try {

            $apiInstanceLists = new ContactsApi(
                new Client(),
                self::$config
            );

            $list = $apiInstanceLists->getContactsFromList($list_id);

            foreach ($list->getContacts() as $email) {

                $sendData = array_merge($request->only('subject', 'htmlContent', 'sender'),[
                   'to' => $email['email']
                ]);

                $sendSmtpEmail = new SendSmtpEmail($sendData);
                $result = $apiInstanceEmails->sendTransacEmail($sendSmtpEmail);
            }

            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling EmailCampaignsApi->sendEmailCampaignNow: ', $e->getMessage(), PHP_EOL;

            return false;
        }
    }
}
