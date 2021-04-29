<?php

namespace App\Http\Controllers\Master;
use App\SysTipeTO;
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
        return SysTipeTO::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        	'type_number' => 'required|string|between:2,100',
            'type_code' => 'required|string|between:2,100',
            'type_desc' => 'required|string|between:2,100',
            'active_flag' => 'required|in:Y,N',


        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $tipe_to = new SysTipeTO();
        $tipe_to->type_number = $request->type_number;
        $tipe_to->type_code = $request->type_code;
        $tipe_to->type_desc = $request->type_desc;
        $tipe_to->active_flag = $request->active_flag;
        $tipe_to->save();
        return response()->json([
            'message' => 'Tipe TO successfully stored',
            'tipe_to' => $tipe_to
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
         $tipe_to = SysTipeTO::find($id);
         if($tipe_to)
         {
         	return response()->json([
            'tipe_to' => $tipe_to
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Tipe TO not exists'
        ], 402);
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
        	'type_number' => 'required|string|between:2,100',
            'type_code' => 'required|string|between:2,100',
            'type_desc' => 'required|string|between:2,100',
            'active_flag' => 'required|in:Y,N',


        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $type_number=$request->type_number;
        $type_code=$request->type_code;
        $type_desc=$request->type_desc;
        $active_flag=$request->active_flag;

        $tipe_to=SysTipeTO::find($id);
        if($tipe_to)
        {
        	$tipe_to->type_number = $request->type_number;
	        $tipe_to->type_code = $request->type_code;
	        $tipe_to->type_desc = $request->type_desc;
	        $tipe_to->active_flag = $request->active_flag;
        	$type_code->save();
        	return response()->json([
	            'message' => 'Tipe TO successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Tipe TO fail updated'
	        ], 402);
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
        $tipe_to=SysTipeTO::find($id);
        if($tipe_to)
        {
            $tipe_to->delete();

	        return response()->json([
	            'message' => 'Tipe TO successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Tipe TO fail deleted'
	        ], 402);
        }
    }
}
