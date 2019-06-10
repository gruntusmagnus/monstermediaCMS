<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class MeController extends Controller
{
    public function index() {
        return new UserResource(auth('api')->user()->authenticable);
    }
}
