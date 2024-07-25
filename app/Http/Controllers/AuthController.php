<?php

namespace App\Http\Controllers;

use App\Http\Requests\medicine;
use App\Http\Requests\requestpharmacist;
use App\Http\Requests\requestpharmacist2;
use App\Models\med;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use  Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['login', 'register']]);
    }
    public function login(requestpharmacist2 $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|max:10|min:10',
            'password'=>'required|min:6'
        ]);

        if ($request->phone==null) {
            return response()->json(['masseage'=>'error'], 422);
        }
        $user=User::where('phone',"=",$request->phone)->first();
        if ($user==null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } $token = JWTAuth::fromUser($user);
        return response()->json([
            'token'=>$token,
            'user'=>$user,
        ],200);
    }
    public function register(requestpharmacist $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone'=> 'required|max:10|min:10|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'type'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $user->save();
        $token=auth()->attempt($request->only('phone', 'password'));
        return response()->json([
            'message' => 'User successfully registered',
            'data'=>$this->createNewToken($token),
        ], 201);
    }
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    public function refresh() {
        return $this->createNewToken(Auth::refresh());
    }
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }



}
