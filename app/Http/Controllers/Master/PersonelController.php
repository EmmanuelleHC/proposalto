<?php

namespace App\Http\Controllers\Master;
use App\SysPersonel;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Routing\Controller as BaseController;
class PersonelController extends BaseController
{
    public function index()
    {
        return SysPersonel::all();

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
         $personel = SysPersonel::find($id);
         if($personel)
         {
         	return response()->json([
            'personel' => $personel
        	], 200);
         }else{
         	return response()->json([
            'message' => 'Personel not exists'
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
       
        
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    {
        $personel=SysPersonel::find($id);
        if($personel)
        {
        	$personel->delete();
	        return response()->json([
	            'message' => 'Personel successfully deleted'
	        ], 200);
        }else{
        	return response()->json([
	            'message' => 'Personel fail deleted'
	        ], 400);
        }
    }
}
