<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form']);
        $session = session();

        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard/' . $session->get('level'));
        }
        return view('login_form');
    }

    public function doLogin()
    {
        $session = session();
        $model = new UserModel();

        $session = session();

        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard/' . $session->get('level'));
        }

        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password')); // demo only

        $user = $model->where('Username', $username)
            ->where('Password', $password)
            ->first();

        if ($user) {
            $session->set([
                'username' => $user['Username'],
                'semester' => $user['Semester'],
                'level'    => $user['Level'],
                'logged_in' => true,
            ]);
            return redirect()->to('/dashboard/' . $user['Level']);
        }

        return redirect()->back()->with('error', 'Login gagal!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
