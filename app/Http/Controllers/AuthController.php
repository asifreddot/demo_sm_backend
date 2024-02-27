<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\UserService;
use App\Utils\ResponseUtils;
use App\Utils\ValidatorUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function login(Request $request):JsonResponse
    {

        // Use the LoginValidate to validate the request data
        $validator = ValidatorUtils::loginValidate($request->all());

        // Return validation error response if validation fails
        if ($validator->fails()) {
            return ResponseUtils::message(['errors' => $validator->errors()], 'error',401);
        }
        // Check if the user with the given email exists
        $userExists = User::where('email', $request->email)->first();
        // Return error response if the user does not exist
        if (!$userExists) {
            return ResponseUtils::message(['errors' => ["Incorrect Email"]], 'error' , 401);
        }
        // Check if the provided password matches the hashed password in the database
        if (!Hash::check($request->get('password'), $userExists->password)) {
            return ResponseUtils::message(['errors' => ["Incorrect Password"]], 'error',401);
        } else {
            // Generate a plain text token for the authenticated user
            $token = $userExists->createToken('web')->plainTextToken;
        }

        // Prepare the success response with access token and token type
        $response = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $userExists,
        ];
        // Return the success response
        return ResponseUtils::message($response, 'User login success');
    }

    public function register(Request $request):JsonResponse
    {
        return $this->userService->saveUser($request);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ResponseUtils::message(['message' => 'User successfully signed out'], 'success');
    }

    public function socialLogin(Request $request){

        $validator = ValidatorUtils::socialLoginValidate($request->all());
        // Return validation error response if validation fails
        if ($validator->fails()) {
            return ResponseUtils::message(['errors' => $validator->errors()], 'error',401);
        }
        // Check if the user with the given Provider ID exists
        $userExists = User::where('email', $request->email)->first();
        if (!$userExists) {
            $userExists = $this->userService->saveOnlyUser($request);
        }
        $token = $userExists->createToken('web')->plainTextToken;
        $response = [
            'access_token' => $token,
            'token_type' => 'bearer',
        ];
        return ResponseUtils::message($response, 'User login success');
    }
}
