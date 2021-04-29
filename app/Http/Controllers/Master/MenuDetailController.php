<?php

namespace App\Http\Controllers\Master;
use App\SysMenuDetail;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class MenuDetailController extends BaseController
{
    public function index()
    {
        return SysMenuDetail::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'menu_id' => 'required|exists:sys_menu,id',
            'seq' => 'required',
            'prompt' => 'required|string',
            'description' => 'required|string',
            'active_flag' => 'required|in:Y,N',


        ]);

          
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $menu_detail = new SysMenuDetail();
        $menu_detail->menu_id = $request->menu_id;
        $menu_detail->seq = $request->seq;
        $menu_detail->prompt = $request->prompt;
        $menu_detail->description = $request->description;
        $menu_detail->active_flag = $request->active_flag;
        $menu_detail->save();
        return response()->json([
            'message' => 'Menu Detail successfully stored',
            'menu_detail' => $menu_detail
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
         $menu_detail = SysMenuDetail::find($id);
         if($menu_detail)
         {
         	return response()->json([
            'menu_detail' => $menu_detail
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Menu Detail not exists'
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
         	'menu_id' => 'required|exists:sys_menu,id',
            'seq' => 'required',
            'prompt' => 'required|string',
            'description' => 'required|string',
            'active_flag' => 'required|in:Y,N',


        ]);

          
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $menu_detail=SysMenuDetail::find($id);
        if($menu_detail)
        {
        	$menu_detail->menu_id = $request->menu_id;
        	$menu_detail->seq = $request->seq;
	        $menu_detail->prompt = $request->prompt;
	        $menu_detail->description = $request->description;
	        $menu_detail->active_flag = $request->active_flag;
        	$menu_detail->save();
        	return response()->json([
	            'message' => 'Menu Detail successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Menu Detail fail updated'
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
        $menu_detail=SysMenuDetail::find($id);
        if($menu_detail)
        {
        	$menu_detail->delete();
	        return response()->json([
	            'message' => 'Menu Detail successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Menu Detail fail deleted'
	        ], 400);
        }
    }
}
