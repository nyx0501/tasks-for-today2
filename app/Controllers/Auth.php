<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login(): string|RedirectResponse
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to('/tasks');
        }

        return view('auth/login', ['title' => 'Login']);
    }

    public function attempt(): RedirectResponse
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = (new UserModel())->attempt(
            trim((string) $this->request->getPost('username')),
            (string) $this->request->getPost('password'),
        );

        if ($user === null) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $session = session();
        $target  = $session->get('redirect_url');
        $session->regenerate(true); // prevents session fixation
        $session->set([
            'isLoggedIn' => true,
            'userId'     => $user['id'],
            'username'   => $user['username'],
            'fullName'   => $user['full_name'],
        ]);
        $session->remove('redirect_url');

        // Only follow redirects that stay on this site.
        if (is_string($target) && str_starts_with($target, base_url())) {
            return redirect()->to($target)->with('success', 'Welcome back, ' . $user['full_name'] . '!');
        }

        return redirect()->to('/tasks')->with('success', 'Welcome back, ' . $user['full_name'] . '!');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}