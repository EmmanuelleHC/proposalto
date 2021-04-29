<?php

namespace App\Http\Controllers\Master;
use App\SysBranch;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class BranchController extends BaseController
{
    public function index()
    {
        return SysBranch::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'branch_code' => 'required|string|between:2,100',
            'branch_name' => 'required|string|between:2,100',
            'branch_type' => 'required|in:CBG,FRC',
            'region' => 'required|string',
            'alt_name' => 'required|string|between:3,4',
            'active_flag' => 'required|in:Y,N',
            'minus_gm_frc' => 'required',
            'batas_spd' => 'required',
            'batas_gm' => 'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }


        $branch = new SysBranch();
        $branch->branch_code = $request->branch_code;
        $branch->branch_name = $request->branch_name;
        $branch->branch_type = $request->branch_type;
        $branch->region = $request->region;
        $branch->alt_name = $request->alt_name;
        $branch->active_flag = $request->active_flag;
        $branch->minus_gm_frc = $request->minus_gm_frc;
        $branch->batas_spd = $request->batas_spd;
        $branch->batas_gm = $request->batas_gm;
        $branch->save();
        return response()->json([
            'message' => 'Branch successfully stored',
            'branch' => $branch
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
         $branch = SysBranch::find($id);
         if($branch)
         {
         	return response()->json([
            'branch' => $branch
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Branch not exists'
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
            'branch_code' => 'required|string|between:2,100',
            'branch_name' => 'required|string|between:2,100',
            'branch_type' => 'required|in:CBG,FRC',
            'region' => 'required|string',
            'alt_name' => 'required|string|between:3,4',
            'active_flag' => 'required|in:Y,N',
            'minus_gm_frc' => 'required',
            'batas_spd' => 'required',
            'batas_gm' => 'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $branch=SysBranch::find($id);
        if($branch)
        {
        	$branch->branch_code = $request->branch_code;
	        $branch->branch_name = $request->branch_name;
	        $branch->branch_type = $request->branch_type;
	        $branch->region = $request->region;
	        $branch->alt_name = $request->alt_name;
	        $branch->active_flag = $request->active_flag;
	        $branch->minus_gm_frc = $request->minus_gm_frc;
	        $branch->batas_spd = $request->batas_spd;
	        $branch->batas_gm = $request->batas_gm;
        	$branch->save();
        	return response()->json([
	            'message' => 'Branch successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Branch fail updated'
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
        $branch=SysBranch::find($id);
        if($branch)
        {
        	$branch->delete();
	        return response()->json([
	            'message' => 'Branch successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Branch fail deleted'
	        ], 400);
        }
    }
}
