<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if ($session->get('isLoggedIn') === true) {
            return null;
        }

        // Remember the page the guest wanted (GET only) so login can send them back.
        if ($request->is('get')) {
            $session->set('redirect_url', (string) current_url());
        }

        return redirect()->to('/login')->with('error', 'Please log in to manage tasks.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}