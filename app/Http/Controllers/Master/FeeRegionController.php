<?php

namespace App\Http\Controllers\Master;
use App\SysFeeRegion;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class FeeRegionController extends BaseController
{
    public function index()
    {
        return SysFeeRegion::all();

    }

   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show($id)
    {
         $fee_region = SysFeeRegion::find($id);
         if($fee_region)
         {
         	return response()->json([
            'fee_region' => $fee_region
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Fee Region not exists'
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
        
        
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    {
        $fee_region=SysFeeRegion::find($id);
        if($fee_region)
        {
        	$fee_region->delete();
	        return response()->json([
	            'message' => 'Fee Region successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Fee Region fail deleted'
	        ], 400);
        }
    }
}
