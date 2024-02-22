<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function login()
    {
        $data = [];
        helper(['form', 'url']);

        if ($this->request->is('post')) {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password didn't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('admin/login', [
                    "validation" => $this->validator,
                ]);
            } else {
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
                // print_r($user);
                // die();
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if ($user['role'] == "admin") {

                    return redirect()->to(base_url() . 'admin/superuser');
                } elseif ($user['role'] == "user") {

                    return redirect()->to(base_url() . 'user/user');
                } elseif ($user['role'] == "SDE1") {

                    return redirect()->to(base_url() . 'otheruser/display');
                } elseif ($user['role'] == "SDE2") {

                    return redirect()->to(base_url() . 'otheruser/display');
                } else {
                    return redirect()->to(base_url() . 'login');
                }
            }
        }
        return view('admin/login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],

            'email' => $user['email'],
            'isLoggedIn' => true,
            "role" => $user['role'],
        ];

        session()->set($data);
        return true;
    }

    public function create()
    {
        return view("admin/sign");
    }
    public function signupuser()
    {
        helper(['form', 'url']);
        $user = new UserModel();
        $data = [];

        if ($this->request->is('post')) {
            $rules = [
                'name' => 'required|min_length[5]|max_length[30]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'role' => 'required',
                'password' => 'required|min_length[8]',
            ];

            $errors = [
                'name' => [
                    'required' => 'please enter name',
                    'min_length' => 'please enter more than 6 characters',
                    'max_length' => 'Please enter less than 30 characters'
                ],
                'email' => 'please validate or enter email',
                'role' => 'please select the role options',

                'password' => 'please enter password or more than of 8 character in password',
            ];
            if (!$this->validate($rules, $errors)) {
                // echo 'user is valid';
                // die();
                return view('admin/sign', ['uservalidation' => $this->validator]);
            } else {
                $datanew = [
                    'name' => $this->request->getPost('name'),

                    'email' => $this->request->getPost('email'),
                    'role' => $this->request->getPost('role'),
                    'password' => $this->request->getPost('password'),

                ];

                $user->insert($datanew);
                return redirect()->to(base_url() . 'login');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
