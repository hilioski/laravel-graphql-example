<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller
{

    /**
     * @var
     */
    private $user;


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('jwt.auth', [ 'except' => [ 'login', 'register' ] ]);
        $this->user = $user;
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|string|exists:users,email',
            'password' => 'required|min:6',
        ]);

        // grab credentials from the request
        $credentials = request([ 'email', 'password' ]);
        $user = User::where('email', request('email'))->first();

        if (!$user) {
            return response()->json([ 'error' => 'invalid_credentials' ], 401);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if ( ! $token = JWTAuth::attempt($credentials)) {
                return response()->json([ 'error' => 'invalid_credentials' ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([ 'error' => 'could_not_create_token' ], 500);
        }

        // all good so return the token
        return $this->respondWithToken($token, $user);

        return response()->json(compact('token'));
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([ 'message' => 'Successfully logged out' ]);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::getJWTProvider()->decode($token)['exp'],
            'is_completed' => is_null($user) ? null : ($user->is_completed ? true : false),
            'setup_stage'  => is_null($user) ? null : $user->setup_stage
        ]);
    }
}
