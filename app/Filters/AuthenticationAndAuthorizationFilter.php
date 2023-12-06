<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;

class AuthenticationAndAuthorizationFilter implements FilterInterface
{

    public function before(\CodeIgniter\HTTP\RequestInterface $request, $arguments = null)
    {
        // mendapatkan segment path awal
        $userUrirequest = $request->getUri()->getSegment(1);
        $userRole       = session()->get('role');
        $userSession    = session()->get('is_logged_in');

        log_message('info','user role '.$userRole.' user uri '.$userUrirequest);
        if(!$userSession){
            return redirect()->to(base_url());
        }else{
            // pencocokan header role user dengan path segment 1 yang diambil
            if ($userRole != $userUrirequest){
                return redirect()->to(base_url());
            }
        }

    }

    public function after(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}