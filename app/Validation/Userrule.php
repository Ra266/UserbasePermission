<?php

namespace App\Validation;

use App\Models\UserModel;

class Userrule
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        $user = $model->where('email', $data['email'])
            ->first();
        // print_r($user);
        // die();

        if (empty($user)) {
            return false;
        }

        return ($data['password'] == $user['password']);
    }
}
