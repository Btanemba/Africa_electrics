<?php

namespace App\Http\Controllers\Admin\Auth;

use Backpack\CRUD\app\Http\Controllers\Auth\RegisterController as BackpackRegisterController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BackpackRegisterController
{
    protected function validator(array $data)
    {
        $user_model_fqn = config('backpack.base.user_model_fqn');
        $user = new $user_model_fqn();
        $users_table = $user->getTable();
        $email_validation = backpack_authentication_column() == 'email' ? 'email|' : '';

        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            backpack_authentication_column() => 'required|'.$email_validation.'max:255|unique:'.$users_table,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'post_code' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        $user_model_fqn = config('backpack.base.user_model_fqn');
        $user = new $user_model_fqn();

        return $user->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            backpack_authentication_column() => $data[backpack_authentication_column()],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'post_code' => $data['post_code'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
