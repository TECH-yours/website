<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


function line_get_profile($id_token)
{
    $url = 'https://api.line.me/oauth2/v2.1/verify';
    $data = [
        'id_token' => $id_token,
        'client_id' => env('LINE_CLIENT_ID'),
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode == 200) {
        $responseData = json_decode($response, true);
        if ($responseData) {
            return $responseData;
        } else {
            echo 'Invalid JSON response';
        }
    } else {
        return NULL;
    }
}

function line_get_id($code, $state)
{
    $url = 'https://api.line.me/oauth2/v2.1/token';
    $data = [
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => env('APP_URL') . '/signin',
        'client_id' => env('LINE_CLIENT_ID'),
        'client_secret' => env('LINE_CLIENT_SECRET'),
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode == 200) {
        $responseData = json_decode($response, true);
        if ($responseData) {
            return line_get_profile($responseData['id_token']);
        } else {
            echo 'Invalid JSON response';
        }
    } else {
        return NULL;
    }
}

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'success',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'picture' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|string',
        ]);

        User::create($data);

        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }

    // signin
    public function signin(Request $request)
    {
        // get url params
        $params = request()->all();
        if (empty($params))
            return view('pages.user.signin');
        $code = $params['code'];
        $state = $params['state'];

        $data = $request->validate([
            'code' => 'required|string',
            'state' => 'required|string',
        ]);

        $line_info = line_get_id($data['code'], $data['state']);
        if (!$line_info) 
            return view('pages.user.signin');

        if (!isset($line_info['email']))
            return view('pages.user.signin');

        $new_user = false;
        $user = User::where('email', $line_info['email'])->first();
        if (!$user) {
            $new_user = true;
            $user = new User();
            $user->lineID = $line_info['sub'];
            $user->username = $line_info['name'];
            $user->name = $line_info['name'];
            $user->picture = $line_info['picture'];
            $user->email = $line_info['email'];
            $user->role = 'user';
            $user->save();
        }

        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        $token = explode('|', $token)[1];
        // Session::put('token', $token);
        if ($new_user)
            return redirect()->route('profile', ['token' => $token]);
        return redirect()->route('profile', ['token' => $token]);

    }

    public function show(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    
        return response()->json([
            'message' => 'success',
            'data' => $user
        ], 200);
    }

    // update
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user_id = $user->id;
        $user = User::find($user_id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'birthday' => 'nullable|date',
            'vat' => 'nullable|string',
        ]);

        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully'
        ], 200);
    }
    
    
    // Add other functions like edit, update, delete as needed
}
