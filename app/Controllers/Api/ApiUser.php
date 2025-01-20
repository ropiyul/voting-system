<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Myth\Auth\Models\UserModel;
use Exception;

class ApiUser extends ResourceController
{
    use ResponseTrait;
    
    protected $auth;
    protected $configToken;
    protected $userModel;

    public function __construct()
    {
        $this->auth = service('authentication');
        $this->userModel = new UserModel();

        $this->configToken = [
            'key' => getenv('JWT_SECRET_KEY'),
            'expire' => 3600, // 1 jam
            'algo' => 'HS256'
        ];
    }

    public function login()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'username' => [
                'required' => 'username required',
                'valid_username' => 'username address is not in format'
            ],
            'password' => [
                'required' => 'Password is required'
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->respond([
                'status' => 400,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ], 400);
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        // Cek user exists
        $user = $this->userModel->where('username', $username)->first();
        
        if (!$user) {
            return $this->respond([
                'status' => 404,
                'error' => true,
                'message' => 'User not found',
                'data' => []
            ], 404);
        }

        // Attempt login
        if ($this->auth->attempt(['username' => $username, 'password' => $password], false)) {
            // Generate JWT token
            $token = $this->generateJWT($user);
            
            return $this->respond([
                'status' => 200,
                'error' => false,
                'message' => 'Login successful',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                   
                    ],
                    'access_token' => $token
                ]
            ], 200);
        }

        return $this->respond([
            'status' => 401,
            'error' => true,
            'message' => 'Invalid credentials',
            'data' => []
        ], 401);
    }

    public function details()
    {
        try {
            $token = $this->getTokenFromHeader();
            if (!$token) {
                throw new Exception('No token provided');
            }

            $decoded = $this->validateToken($token);
            
            // Get fresh user data
            $user = $this->userModel->find($decoded->data->id);
            
            if (!$user) {
                throw new Exception('User not found');
            }

            return $this->respond([
                'status' => 200,
                'error' => false,
                'message' => 'User details retrieved successfully',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        // Add other needed user details
                    ]
                ]
            ], 200);

        } catch (Exception $e) {
            return $this->respond([
                'status' => 401,
                'error' => true,
                'message' => $e->getMessage(),
                'data' => []
            ], 401);
        }
    }

    public function logout()
    {
        // Implement token blacklisting if needed
        return $this->respond([
            'status' => 200,
            'error' => false,
            'message' => 'Successfully logged out',
            'data' => []
        ], 200);
    }

    private function generateJWT($user)
    {
        $iat = time(); // current timestamp value
        $exp = $iat + $this->configToken['expire'];

        $payload = [
            'iss' => 'your_app_name',
            'aud' => 'your_app_audience',
            'iat' => $iat,
            'exp' => $exp,
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
        ];

        return JWT::encode($payload, $this->configToken['key'], $this->configToken['algo']);
    }

    private function validateToken($token)
    {
        return JWT::decode(
            $token, 
            new Key($this->configToken['key'], $this->configToken['algo'])
        );
    }

    private function getTokenFromHeader()
    {
        $authHeader = $this->request->getHeader('Authorization');
        if (!$authHeader) {
            return null;
        }

        $token = $authHeader->getValue();
        
        // Remove 'Bearer ' if present
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }

        return $token;
    }
}