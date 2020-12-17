<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
        /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
       try {
        	$http = new \GuzzleHttp\Client;
			$response = $http->post('http://localhost/service-provider/oauth/token', [
			    'form_params' => [
			        'grant_type' => 'password',
                    'client_id' => Config::get('auth.clients.admins.client_id'),
			        'client_secret' => Config::get('auth.clients.admins.client_secret'),
			        'username' => $request->email,
			        'password' => $request->password,
			    ],
            ]);
            $authTokens = json_decode((string) $response->getBody(), true);

            return response()->json(['token' => $authTokens['access_token'], 'refresh_token' => $authTokens['refresh_token']], 200);
        } catch(BadResponseException $ex) {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
