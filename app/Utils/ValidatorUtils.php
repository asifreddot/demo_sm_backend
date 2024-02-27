<?php

namespace App\Utils;
use Validator;

class ValidatorUtils
{
    public static function loginValidate(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    }

    public static function socialLoginValidate(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'provider_id' => 'required',
            'name' => 'required',
        ]);
    }

    public static function userCreateValidate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role' => 'in:user,admin',
        ]);
    }

    public static function userUpdateValidate(array $data)
    {
        return Validator::make($data, [
            'id' => 'required',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role' => 'in:user,admin',
        ]);
    }

    public static function taskCreateValidate(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    }

    public static function taskUpdateValidate(array $data)
    {
        return Validator::make($data, [
            'id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    }

}
