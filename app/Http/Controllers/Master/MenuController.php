<?php

namespace App\Http\Controllers\Master;
use App\SysMenu;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class MenuController extends BaseController
{
    public function index()
    {
        return SysMenu::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string|between:2,100',
            'menu_desc' => 'required|string|between:2,100',
            'role_id' => 'required|exists:sys_role,id',
            'active_flag' => 'required|in:Y,N',
            'is_detail' => 'required|string',


        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $menu = new SysMenu();
        $menu->menu_name = $request->menu_name;
        $menu->menu_desc = $request->menu_desc;
        $menu->role_id = $request->role_id;
        $menu->active_flag = $request->active_flag;
        $menu->is_detail = $request->is_detail;
        $menu->save();
        return response()->json([
            'message' => 'Menu successfully stored',
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
         $menu = SysMenu::find($id);
         if($menu)
         {
         	return response()->json([
            'menu' => $menu
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Menu not exists'
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
            'menu_name' => 'required|string|between:2,100',
            'menu_desc' => 'required|string|between:2,100',
            'role_id' => 'required|exists:sys_role,id',
            'active_flag' => 'required|in:Y,N',
            'is_detail' => 'required|in:Y,N',


        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $menu=SysMenu::find($id);
        if($menu)
        {
        	$menu->menu_name = $request->menu_name;
	        $menu->menu_desc = $request->menu_desc;
            $menu->role_id = $request->role_id;
	        $menu->active_flag = $request->active_flag;
	        $menu->is_detail = $request->is_detail;
        	$menu->save();
        	return response()->json([
	            'message' => 'Menu successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Menu fail updated'
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
        $menu=SysMenu::find($id);
        if($menu)
        {
        	$menu->delete();
	        return response()->json([
	            'message' => 'Menu successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Menu fail deleted'
	        ], 400);
        }
    }
}
