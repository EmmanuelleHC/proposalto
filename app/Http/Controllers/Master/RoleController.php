<?php

namespace App\Http\Controllers\Master;
use App\SysRole;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController
{
      /**
        * Display a listing of the resource.
        *
        * @return Response
        */
    public function index()
    {
        return SysRole::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|between:2,100'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $role = new SysRole();
        $role->role_name = $request->role_name;
        $role->save();
        return response()->json([
            'message' => 'Role successfully stored',
            'role' => $role
        ], 201);
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show($id)
    {
         $role = SysRole::find($id);
         if($role)
         {
         	return response()->json([
            'role' => $role
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Role not exists'
        ], 201);
         }

    }


    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|between:2,100'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $role_name=$request->role_name;
        $role=SysRole::find($id);
        if($role)
        {
        	$role->role_name=$role_name;
        	$role->save();
        	return response()->json([
	            'message' => 'Role successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Role fail updated'
	        ], 200);
        }
        
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    {
        $role=SysRole::find($id);
        if($role)
        {
	        return response()->json([
	            'message' => 'Role successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Role fail deleted'
	        ], 400);
        }
    }
}
