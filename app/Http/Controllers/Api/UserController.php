<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function register(StoreUserRequest $storeUserRequest)
    {
        $user = User::create([
            'name' => $storeUserRequest->name,
            'email' => $storeUserRequest->email,
            'password' => bcrypt($storeUserRequest->password)
        ]);

        $token = $user->createToken('users')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1- Run this command to create new user provider => php artisan passport:client --password.
        // 2- User its client id and secret on login.

        try {
        	$http = new \GuzzleHttp\Client;
			$response = $http->post('http://localhost/service-provider/oauth/token', [
			    'form_params' => [
			        'grant_type' => 'password',
			        'client_id' => Config::get('auth.clients.users.client_id'),
			        'client_secret' => Config::get('auth.clients.users.client_secret'),
			        'username' => $request->email,
			        'password' => $request->password,
			    ],
			]);
            $authTokens = json_decode((string) $response->getBody(), true);
            // $token = auth('users')->user()->createToken('users')->accessToken;

            return response()->json(['token' => $authTokens['access_token'], 'refresh_token' => $authTokens['refresh_token']], 200);
        } catch(BadResponseException $ex) {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    public function photo()
    {
        echo asset('/storage/users/aYzpLUZcM9vyCX1IgMhD3jpTkEm8WcrZvyJNkaoq.png');
    }
}
