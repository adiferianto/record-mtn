<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data['users'] = $this->usersModel->getUsers();
        return view('users/index', $data);
    }

    //--------------------------------------------------------------------

    public function add()
    {
        $data['validation'] = \Config\Services::validation();

        return view('users/add', $data);
    }

    public function save()
    {
        //Validasi Input
        if (!$this->validate([
            'fullname' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terpakai.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'level' => [
                'rules' => 'required',
                'error' => '{field} belum dipilih'
            ]
        ])) {
            return redirect()->to('/users/add')->withInput();
        }

        $this->usersModel->save([
            'fullname' => $this->request->getVar('fullname'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('pesan', 'Data user berhasil ditambah.');

        return redirect()->to('/users');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->usersModel->getUsers($id)
        ];

        return view('users/edit', $data);
    }
    //--------------------------------------------------------------------

    public function update($id)
    {
        //Validasi Input

        //cek username
        $username_old = $this->usersModel->getUsers($id);
        if ($username_old['username'] == $this->request->getVar('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|is_unique[users.username]';
        }

        if (!$this->validate([
            'fullname' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terpakai.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'level' => [
                'rules' => 'required',
                'error' => '{field} belum dipilih'
            ]
        ])) {
            return redirect()->to('/users/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->usersModel->save([
            'id' => $id,
            'fullname' => $this->request->getVar('fullname'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('pesan', 'Data user berhasil diubah.');

        return redirect()->to('/users');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->usersModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/users');
    }
}
