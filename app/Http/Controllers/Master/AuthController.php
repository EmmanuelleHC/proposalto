<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function index()
    {
        return User::all();

    }

     public function show($id)
    {
         $user = User::find($id);
         if($user)
         {
            return response()->json([
            'user' => $user
            ], 200);
         }else{
            return response()->json([
            'message' => 'User not exists'
        ], 201);
         }

    }


     public function update(Request $request,$id)
    {
        
          $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100',
            'active_flag' => 'required|in:Y,N',
            'role_id'=>'required|exists:sys_role,id',

        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user=User::find($id);
        if($user)
        {
            $user->username = $request->username;
            $user->email = $request->email;
            $user->active_flag = $request->active_flag;
            $user->role_id = $request->role_id;

            $user->save();
            return response()->json([
                'message' => 'User successfully updated'
            ], 200);

        }else{
            return response()->json([
                'message' => 'User fail updated'
            ], 200);
        }
        
    }


    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'active_flag' => 'required|in:Y,N',
            'role_id'=>'required|exists:sys_role,id',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password),
                   
                	]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' =>  $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    public function destroy($id)
    {
        $user=User::find($id);
        if($user)
        {
            $user->delete();
            return response()->json([
                'message' => 'User successfully deleted'
            ], 200);
        }else{
            return response()->json([
                'message' => 'User fail deleted'
            ], 400);
        }
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
 }