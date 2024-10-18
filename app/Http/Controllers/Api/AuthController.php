<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseTrait;
    public function login(Request $request) {
        try {

            $request->validate(
                [
                    'email' => 'required | email',
                    'password' => 'required'
                    ]
                );
                
                $validatedData = $request->only(['email', 'password']);
                return (new LoginAction())->execute($validatedData);
            }
         catch(\Exception $exception){
            logger($exception);
            return $this->badRequestResponse("Application error | {$exception->getMessage()}");
        }
                
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return $this->successResponse("Logged out successfully");
    }
}