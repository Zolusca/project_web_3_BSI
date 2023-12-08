<?php

namespace App\Controllers\Person;

use App\Controllers\BaseController;
use App\Controllers\ValidationsRequest;
use CodeIgniter\Email\Email;
use Config\Services;
use Exception;

class Persons extends BaseController
{
    protected ValidationsRequest $validationsRequest;
    protected $DatabaseConnection;

    /**
     * @param ValidationsRequest $validationsRequest
     */
    public function __construct()
    {
        $this->DatabaseConnection = Services::getDatabaseConnection();
        $this->validationsRequest = new ValidationsRequest();
    }

    public function sendMail()
    {
        $to = $this->request->getVar('alamat_kirim');
        $subject = $this->request->getVar('subject');
        $body = $this->request->getVar('body');

        $fileOauthMail = "gmail_secret.json";
        $redirect_uri ='http://localhost:8080/pengelolaproduk/dashboard';

        $client = new \Google_Client();

        try {
            $client->setApplicationName("belajar gmail");
            $client->setAuthConfig(ROOTPATH . 'oauth_gmail/' . $fileOauthMail);
            $client->addScope(\Google_Service_Gmail::GMAIL_SEND);
            $client->setRedirectUri($redirect_uri);

            // If there is an authorization code
            $authorizationCode = $this->request->getGet('code');
            if (isset($authorizationCode)) {
                $token = $client->fetchAccessTokenWithAuthCode($authorizationCode);
                $client->setAccessToken($token);

                // Create Gmail API instance
                $gmail = new \Google_Service_Gmail($client);

                // Create a message
                $message = new \Google_Service_Gmail_Message();
                $rawMessageString = "From: <haslamhdz71@gmail.com>\r\n";
                $rawMessageString .= "To: <isempa31@gmail.com>\r\n";
                $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
                $rawMessageString .= "MIME-Version: 1.0\r\n";
                $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
                $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
                $rawMessageString .= "{$body}\r\n";
                $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
                $message->setRaw($rawMessage);

                // Encode the message in base64url format
                $base64Message = rtrim(strtr(base64_encode($rawMessage), '+/', '-_'), '=');
                $message->setRaw($base64Message);

                // Send the message
                $sentMessage = $gmail->users_messages->send('me', $message);

                // Get the sent message ID
                $sentMessageId = $sentMessage->getId();

                return  "Pesan berhasil dikirim dengan ID: " . $sentMessageId;
            } else {
                // If there is no authorization code, redirect to the authentication URL
                $authUrl = $client->createAuthUrl();
                header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
                exit;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

}