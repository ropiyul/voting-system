<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $response = service('response');

        try {
            $token = $this->getTokenFromHeader($request);
            if (!$token) {
                throw new Exception('No token provided');
            }

            $key = getenv('JWT_SECRET_KEY') ?: 'my_application_secret';
            JWT::decode($token, new Key($key, 'HS256'));
            
            return $request;

        } catch (Exception $e) {
            return $response->setJSON([
                'status' => 401,
                'error' => true,
                'message' => $e->getMessage(),
                'data' => []
            ])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }

    private function getTokenFromHeader($request)
    {
        $authHeader = $request->getHeader('Authorization');
        if (!$authHeader) {
            return null;
        }

        $token = $authHeader->getValue();
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }

        return $token;
    }
}