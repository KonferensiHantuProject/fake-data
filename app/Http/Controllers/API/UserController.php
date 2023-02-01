<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ResponseBuilder;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    use ResponseBuilder;

    // All Data
    public function index()
    {
        $data = User::all();

        return $this->success($data);
    }

    // Find One Data
    public function show(int $id)
    {
        // Find User
        $data = User::find($id);

        return $this->success($data);
    }

    // Add Data
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{

            $this->validate($request, [
                'username' => 'required|unique:users',
                'age' => 'required|numeric',
                'email' => 'required|email|unique:users',
                'gender' => 'required',
                'short_description' => 'required',
                'date_of_birth' => 'required|date'
            ]);

            // Prepare Data
            $user = new User;
            $user->username = $request->username;
            $user->age = $request->age;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->short_description = $request->short_description;
            $user->date_of_birth = $request->date_of_birth;
            $user->save();

            return $this->success($user);
        }catch(Exception $e){
            DB::rollback();
            return $this->error(400, null, $e);
        }
    }
}