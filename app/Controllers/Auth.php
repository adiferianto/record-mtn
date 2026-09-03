<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuthModel;

class Auth extends BaseController
{
    public function index()
    {
        helper('form');
        return view('auth/login');
    }

    //--------------------------------------------------------------------

    public function login()
    {
        $session = session();
        $model = new AuthModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_password = password_verify($password, $pass);
            if ($verify_password) {
                $sess_data = [
                    'id'        => $data['id'],
                    'fullname'  => $data['fullname'],
                    'username'  => $data['username'],
                    'level'     => $data['level'],
                    'logged_in' => TRUE,
                ];

                $session->set($sess_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Invalid Password');
                return redirect()->to('/auth');
            }
        } else {
            $session->setFlashdata('msg', 'Invalid Username');
            return redirect()->to('/auth');
        }
    }

    //--------------------------------------------------------------------
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }
}
