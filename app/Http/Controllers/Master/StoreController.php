<?php

namespace App\Http\Controllers\Master;
use App\SysStores;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class FeeGroupController extends BaseController
{
    public function index()
    {
        return SysStores::all();

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
         $stores = SysStores::find($id);
         if($stores)
         {
         	return response()->json([
            'store' => $stores
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Stores not exists'
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
        $store=SysStores::find($id);
        if($store)
        {
        	$store->delete();
	        return response()->json([
	            'message' => 'Store successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Store fail deleted'
	        ], 402);
        }
    }
}
