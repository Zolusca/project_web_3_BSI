<?php

namespace App\Controllers;

use App\Entities\ProdukEntity;
use App\Exception\DatabaseFailedInsert;
use App\Libraries\MyDateTime;
use App\Libraries\PdfGenerator;
use App\Models\Penyalur;
use App\Models\Produk;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use Config\Mimes;
use Config\Services;
use Google\Client;
use Google\Exception;
use Google\Service\Gmail;

class Home extends BaseController
{
    public function listNamaIdPenyalur(array $dataPenyalur)
    {
        $mail = new Gmail();

        $listData = [];
        foreach ($dataPenyalur as $index => $value) {
            $listData[$index] = ['id' => $value->id_penyalur, 'nama_penyalur' => $value->nama];
        }
        return $listData;
    }
    public function index(){
        log_message('info','hello',['data'=>'hello txt']);
        echo 'sukses';
    }

//    public function index()
//    {
//        $fileOauthMail = "gmail-client-secret.json";
//        $redirect_uri = 'http://localhost:8080/test';
//        $client = new \Google_Client();
//     try{
//         $client->setApplicationName("belajar gmail");
//         $client->setAuthConfig(ROOTPATH.'oauth_gmail/'.$fileOauthMail);
//         $client->addScope(\Google_Service_Gmail::GMAIL_SEND);
//         $client->setRedirectUri($redirect_uri);
//
//         // Jika ada kode otorisasi
//         if (isset($_GET['code'])) {
//             $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//             $client->setAccessToken($token);
//
//             // Membuat instance Gmail API
//             $gmail = new \Google_Service_Gmail($client);
//             // Contoh: Membuat pesan
//             $message = new \Google_Service_Gmail_Message();
//             $rawMessage = "From: haslamhdz71@gmail.com\r\n";
//             $rawMessage .= "To: isempa31@gmail.com\r\n";
//             $rawMessage .= "Subject: Subject of the email\r\n";
//             $rawMessage .= "Content-Type: text/plain; charset=utf-8\r\n\r\n";
//             $rawMessage .= "Body of the email here.";
//
//             // Encode pesan dalam format base64url
//             $base64Message = rtrim(strtr(base64_encode($rawMessage), '+/', '-_'), '=');
//             $message->setRaw($base64Message);
//
//             // Kirim pesan
//             $sentMessage = $gmail->users_messages->send('me', $message);
//
//             // Dapatkan ID pesan yang terkirim
//             $sentMessageId = $sentMessage->getId();
//
//             echo "Pesan berhasil dikirim dengan ID: " . $sentMessageId;
//         } else {
//             // Jika tidak ada kode otorisasi, arahkan ke URL otentikasi
//             $authUrl = $client->createAuthUrl();
//             header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
//             exit;
//         }
//     } catch (Exception $e) {
//        var_dump($e->getMessage());
//     }
//
//    }

    public function tes(){
        return $this->index();
    }


//    public function index()
//    {
//        $this->response
//            ->setContentType('application/json')
//            ->setHeader("Location",base_url())
//            ->setStatusCode(200)
//            ->setJSON(["url"=>base_url()."download/barky.png"])
//            ->send();
//
//    }
//
//    public function download($file_name){
//        $file_path = FCPATH . 'download/' . $file_name;
//
//        if (file_exists($file_path))
//        {
//            header('Content-Type: application/octet-stream');
//            header('Content-Disposition: attachment; filename="' . $file_name . '"');
//            header('Content-Length: ' . filesize($file_path));
//
//            // Mengirimkan isi file ke output buffer
//            readfile($file_path);
//            exit;
//        }
//        else
//        {
//            echo "errpr";// Tampilkan halaman 404 jika file tidak ditemukan
//        }
//    }
//
//    public function dto(){
//
//
//        $this->response
//            ->setContentType('application/json')
//            ->setJSON()
//            ->setStatusCode(200)
//            ->send();
//    }

}
