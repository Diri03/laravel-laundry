<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function loginAction(Request $request){
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
        }

        // Kita ini generate token pake Sanctum atau jwt
        // $token =
        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json(['status' => 'success', 'user' => $user, 'token' => $token]);
    }

    public function me(){
        return response()->json(['status' => 'success', 'data' => Auth::user()]);
    }

    public function getUser(){
        $users = User::get();
        return response()->json(['data' => $users]);
    }

    public function storeUser(Request $request){
        try {
            $validator =Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);
    
            if($validator->fails()){
                return response()->json(['status' => 'error', 'errors'=> $validator->errors()], 422);
            }
            $users = User::create($request->all());
            return response()->json(['data' => $users, 'message' => 'Request success'], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Request failed', 'errors' => $th->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, $id){
        try {
            $user = User::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'nullable'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = $request->password;
            }
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Request update success', 'data' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Request update failed', 'error' => $th->getMessage()], 500);
        }
    }

    public function deleteUser($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'Request Delete Success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Request Delete Failed']);
        }
    }

    public function editUser($id){
        $user = User::findOrFail($id);
        return response()->json(['status' => 'success', 'message' => 'Request success', 'data' => $user]);
    }
}
