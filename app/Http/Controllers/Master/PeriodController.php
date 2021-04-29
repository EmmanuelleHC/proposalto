<?php

namespace App\Http\Controllers\Master;
use App\SysPeriod;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class PeriodController extends BaseController
{
    public function index()
    {
        return SysPeriod::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:sys_branch,id',
            'periode' => 'required|string',
            'status' => 'required|string'


        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $period = new SysPeriod();
        $period->branch_id = $request->branch_id;
        $period->periode = $request->periode;
        $period->status = $request->status;
        $period->save();
        return response()->json([
            'message' => 'Period successfully stored',
            'period' => $period
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
         $period = SysPeriod::find($id);
         if($period)
         {
         	return response()->json([
            'period' => $period
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Period not exists'
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
            'branch_id' => 'required|exists:sys_branch,id',
            'periode' => 'required|string',
            'status' => 'required|string'


        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $period=SysPeriod::find($id);
        if($period)
        {
        	
	        $period->branch_id = $request->branch_id;
	        $period->periode = $request->periode;
	        $period->status = $request->status;
        	$period->save();
        	return response()->json([
	            'message' => 'Period successfully updated'
	        ], 200);

        }else{
        	return response()->json([
	            'message' => 'Period fail updated'
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
        $period=SysPeriod::find($id);
        if($period)
        {
        	$period->delete();
	        return response()->json([
	            'message' => 'Period successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Period fail deleted'
	        ], 400);
        }
    }
}
