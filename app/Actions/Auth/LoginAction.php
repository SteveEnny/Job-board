<?php

namespace App\Actions\Auth;

use App\Http\Traits\ResponseTrait;
use App\Models\User;
use Error;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LoginAction
{
    /**
     * Create a new class instance.
     */
    use ResponseTrait;
    public function __construct()
    {
        //
    }

    private function cleanBearerToken ($token) {
        return explode('|', $token);
    }
    public function execute(array $validatedData) {
        if(Auth::attempt($validatedData)) {
            $user = request()->user();
            // $user = User::where('email', request()->email)->first();
            $token = $user->createToken('Api-Token')->plainTextToken;
            // $refreshCode = Str::random(8);
            // Cache::put($refreshCode, $user);
            return $this->successResponse('Login successful', [
                'token' => $token,
                'token_expires' => Carbon::now()->addMinutes(30),
            ]);
            
        }
        else{
            throw new \ErrorException("Invalid credentials");
        }
    }
}