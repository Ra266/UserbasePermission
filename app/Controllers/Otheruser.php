<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Userlog;

class Otheruser extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != ("SDE1" || "SDE2")) {
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
        return view("otheruser/display", $data);
    }

    public function adduser()
    {
        if (session()->get('role') == "SDE1" || 'SDE2') {
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
