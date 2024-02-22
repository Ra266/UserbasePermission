<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Userlog;


class Edituser extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "user") {
            echo 'Access denied';
            die();
        }
    }
    public function index()
    {
        $user = new Userlog();
        $data = [];
        $data['userdatashow'] = $user->findAll();
        // print_r($data);
        // die;
        return view("edituser/display.php", $data);
    }
    public function createuser()
    {
        return view('edituser/add');
    }

    public function adduser()
    {
        $data = [];
        $user = new Userlog();
        helper(['form', 'url']);
        if ($this->request->is('post')) {
            $rules = [
                'name' => 'required|min_length[5]',
                'email' => 'required|min_length[5]',
                'phone' => 'required',
                'address' => 'required',
                'role' => 'required',


            ];

            if (!$this->validate($rules)) {
                return view('edituser/add', ['validation' => $this->validator]);
            } else {
                $file = $this->request->getFile('image');

                $newfile = $file->getRandomName();
                // print_r($newfile);
                // die();
                $file->move('public/Asset/image', $newfile);
                $datanew = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'address' => $this->request->getvar('address'),
                    'role' => $this->request->getVar('role'),
                    'image' => $newfile,
                ];
                // print_r($datanew);
                // die();
                $user->insert($datanew);
                return redirect()->to(base_url() . 'user/editoruser');
            }
        }
        // return view('user/add');
    }
    public function modifyuser($id)
    {
        helper(['url', 'form']);

        // print_r($id); $id = $this->request->getVar('id');
        $user = new Userlog();
        $data['edituser'] = $user->where('id', $id)->first();
        // print_r($data);
        // die();

        return view('user/edit', $data);
    }
    public function updateuser()
    {
        $user = new Userlog();
        $id = $this->request->getVar('id');
        $file = $this->request->getFile('image');
        $newsetfile = $file->getRandomName();
        $file->move('public/Asset/image', $newsetfile);
        $setdatanew = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'address' => $this->request->getVar('address'),
            'role' => $this->request->getVar('role'),
            'image' => $newsetfile,

        ];
        $user->update($id, $setdatanew);
        return redirect()->to(base_url() . '/user/editoruser');
    }
    public function deleteuser($id)
    {
        if (session()->get('role') == "user") {
            $str = 'Permission not allow to user';
            $dataerr = [
                '1'  => $str,
            ];
            // print_r($dataerr);
            // print_r('hello');
            // die;
            $_SESSION['error'] = $str;
            $session = session();
            $session->markAsFlashdata('error');

            return redirect()->to(base_url() . 'user/user');
        }
    }
}
