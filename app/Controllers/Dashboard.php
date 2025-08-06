<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Dashboard extends Controller
{
    public function index($level)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/');
        }

        if ($session->get('level') !== $level) {
            return redirect()->to('/dashboard/' . $session->get('level'));
        }

        $viewPath = "dashboard/$level";
        if (!is_file(APPPATH . 'Views/' . $viewPath . '.php')) {
            return "View untuk level '$level' belum tersedia.";
        }

        $model = new UserModel();
        $user = $model->where('username', $session->get('username'))->first();

        return view($viewPath, [
            'username' => $session->get('username'),
            'semester' => $session->get('semester'),
            'nama'     => $user['Nama'],
            'level'    => $level
        ]);
    }
}
