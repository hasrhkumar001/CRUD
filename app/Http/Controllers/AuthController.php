<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
   public function register(UserRegisterRequest $request){
    $validatedData= $request->validated();

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password'])
    ]);

    

    return response()->json([
        'message' => 'User successfully registered.'
    ]);

   }

   public function googleLogin(Request $request)
    {
        

        $data = $request->input('userData');
        
    
        $user = User::updateOrCreate(
            ['email' => $data['email']], // Accessing the 'email' field from the array
            [
                'name' => $data['name'],  // Accessing the 'name' field from the array
                'password' => bcrypt('123456'), // Hash the password
            ]
        );

        // Generate a token for the user
        $accessToken = $user->createToken('DriveDetails')->accessToken;
        Log::error('Access token: ' .$accessToken);

        return response()->json([
            'access_token' => $accessToken,
            'user' => $user,
        ]);
    }

    

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        return  response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'message' => "Login Successfully."
        ]);
    }

  
    public function me()
    {
        return response()->json(auth('api')->user());
    }

   
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

   
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        // Update user information
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Update password if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully!'], 200);
    }
   
   
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
            
        ]);
    }
}