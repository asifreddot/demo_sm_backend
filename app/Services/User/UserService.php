<?php

namespace App\Services\User;

use App\Utils\ResponseUtils;
use App\Utils\ValidatorUtils;
use Illuminate\Http\Request;

class UserService extends UserRepository implements UserInterface
{

    public function getUsers()
    {
        $data= $this->findAll("User");
        return ResponseUtils::message($data, 'Success');
    }

    public function profile()
    {
        return ResponseUtils::message(auth()->user(), 'Success');
    }

    public function saveUser(Request $request)
    {
        $validator = ValidatorUtils::userCreateValidate($request->all());
        if ($validator->fails()) {
            return ResponseUtils::message(['errors' => $validator->errors()], 'Validation error',401);
        }
        $user = $this->save("User",$request->all());
        return ResponseUtils::message($user, 'User create successful');
    }

    public function saveOnlyUser(Request $request){
        return $this->save("User",$request->all());
    }

    public function updateUser(Request $request)
    {
        $validator = ValidatorUtils::userUpdateValidate($request->all());
        if ($validator->fails()) {
            return ResponseUtils::message(['errors' => $validator->errors()], 'Validation error',401);
        }
        $user = $this->update("User",$request->all(), $request->id);
        return ResponseUtils::message($user, 'User update successful');
    }


    public function getUserInfo($id)
    {
        $data= $this->findById("User" , $id);
        return ResponseUtils::message($data, 'success');
    }
}
