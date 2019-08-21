<?php

namespace App\GraphQL\Mutations;


use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMutator
{

    public function login($root, array $args) {
        $user = User::where('email', $args['email'])->first();
        $credentials = ['email' => $args['email'], 'password' => $args['password']];

        if (!$user) {
            return null;
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if ( ! $token = JWTAuth::attempt($credentials)) {
                return null;
            }

            $user->token = $token;
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return null;
        }

        return $user;
    }
}
