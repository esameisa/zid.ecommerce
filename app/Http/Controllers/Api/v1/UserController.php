<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserDefaultDataResource;

class UserController extends Controller
{
    public function me()
    {
        return response()->json([
            'status' => true,
            'message' => 'User data',
            'data' => new UserDefaultDataResource(auth()->user())
        ]);
    }
}
