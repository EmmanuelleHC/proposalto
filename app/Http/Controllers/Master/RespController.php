<?php

namespace App\Http\Controllers\Master;
use App\SysResp;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class RespController extends BaseController
{
    public function index()
    {
        return SysResp::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:sys_role,id',
            'menu_id' => 'required|exists:sys_menu,id',
            'resp_name' => 'required|string',
            'resp_desc' => 'required|string',
            'active_flag' => 'required|in:Y,N',
            'branch_id' => 'required'


        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $resp = new SysResp();
        $resp->role_id = $request->role_id;
        $resp->menu_id = $request->menu_desc;
        $resp->resp_name = $request->resp_name;
        $resp->resp_desc = $request->resp_desc;
        $resp->active_flag = $request->active_flag;
        $resp->branch_id = $request->branch_id;
        $resp->save();
        return response()->json([
            'message' => 'Resp successfully stored',
            'menu' => $menu
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
         $resp = SysResp::find($id);
         if($resp)
         {
         	return response()->json([
            'resp' => $resp
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Resp not exists'
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
            'role_id' => 'required|exists:sys_role,id',
            'menu_id' => 'required|exists:sys_menu,id',
            'resp_name' => 'required|string',
            'resp_desc' => 'required|string',
            'active_flag' => 'required|in:Y,N',
            'branch_id' => 'required'


        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $resp=SysResp::find($id);
        if($resp)
        {
        	$resp->role_id = $request->role_id;
	        $resp->menu_id = $request->menu_id;
	        $resp->resp_name = $request->resp_name;
	        $resp->resp_desc = $request->resp_desc;
	       	$resp->active_flag = $request->active_flag;
	       	$resp->branch_id = $request->branch_id;

        	$resp->save();
        	return response()->json([
	            'message' => 'Resp successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Resp fail updated'
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
        $resp=SysResp::find($id);
        if($resp)
        {
	        return response()->json([
	            'message' => 'Resp successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Resp fail deleted'
	        ], 400);
        }
    }
}
