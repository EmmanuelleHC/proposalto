<?php

namespace App\Http\Controllers\Master;
use App\SysFeeGroup;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class FeeGroupController extends BaseController
{
    public function index()
    {
        return SysFeeGroup::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'fee_group_code' => 'required|string|between:2,100',
            'fee_code_description' => 'required|string|between:2,100',
            'active_flag' => 'required|in:Y,N',
            'fee_non_24' => 'required',
            'fee_24' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }


        $fee_group = new SysFeeGroup();
        $fee_group->fee_group_code = $request->fee_group_code;
        $fee_group->fee_code_description = $request->fee_code_description;
        $fee_group->active_flag = $request->active_flag;
        $fee_group->fee_non_24 = $request->fee_non_24;
        $fee_group->save();
        return response()->json([
            'message' => 'Fee Group successfully stored',
            'fee_group' => $fee_group
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
         $fee_group = SysFeeGroup::find($id);
         if($fee_group)
         {
         	return response()->json([
            'fee_group' => $fee_group
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Fee Group not exists'
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
            'fee_group_code' => 'required|string|between:2,100',
            'fee_code_description' => 'required|string|between:2,100',
            'active_flag' => 'required|in:Y,N',
            'fee_non_24' => 'required',
            'fee_24' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $fee_group=SysFeeGroup::find($id);
        if($fee_group)
        {
        	$fee_group->fee_group_code = $request->fee_group_code;
	        $fee_group->fee_code_description = $request->fee_code_description;
	        $fee_group->active_flag = $request->active_flag;
	        $branch->fee_non_24 = $request->fee_non_24;
	        $branch->fee_24 = $request->fee_24;
        	$branch->save();
        	return response()->json([
	            'message' => 'Fee Group successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Fee Group fail updated'
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
        $fee_group=SysFeeGroup::find($id);
        if($fee_group)
        {
        	$fee_group->delete();
	        return response()->json([
	            'message' => 'Fee Group successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Fee Group fail deleted'
	        ], 400);
        }
    }
}
