<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ResponseBuilder;

class UserController extends Controller
{
    use ResponseBuilder;

    public function index()
    {
        // All Data
        $data = User::all();

        return $this->success($data);
    }
}