<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\AuthService;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request) {
        return response($this->authService->login($request));
    }

    public function register(Request $request) {
        return response($this->authService->register($request));
    }

    public function logout() {
        return response($this->authService->logout());
    }
}
