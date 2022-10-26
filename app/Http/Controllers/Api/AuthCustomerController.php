<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthCustomerController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer', ['except' => ['login']]);
        $this->guard = "customer";
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'string', 'min:6']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        config()->set('auth.defaults.guard', 'customer');
        \Config::set('jwt.user', 'App\Models\Customer');
        \Config::set('auth.providers.user.model', Customer::class);

        $customer = Customer::where('code',$request->get('code'))->first();
        try {
            // verify the credentials and create a token for the user
//            if (! $token = JWTAuth::fromUser($customer)) {
            if (! $token = auth('customer')->login($customer)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
//        $token = JWTAuth::fromUser($customer);
//        if($customer == null || $token == null){
//            return response()->json(['error' => 'Unauthorized', 'token' => $token, "customer_id" => $customer_id], Response::HTTP_UNAUTHORIZED); // 401
//        }

        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     *
     * @return CustomerResource
     */
    public function me()
    {
        return new CustomerResource(auth('customer')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('customer')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
//            'user' => new CustomerResource(auth()->customer())
            'customer' => new CustomerResource(auth('customer')->user())
        ]);
    }
}
