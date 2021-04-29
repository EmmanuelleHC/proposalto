<?php

namespace App\Http\Controllers\Master;
use App\SysFeeRegion;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Illuminate\Support\Facades\Storage;

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
         $validator = Validator::make($request->all(), 
              [ 
              'fee_group_id' => 'required|exists:sys_fee_group,id',
              'branch_id' => 'required|exists:sys_branch,id',
              'no_doc' => 'required|string',
              'kodya_desc'=>'required|string',
              'fee_ump'=>'required',
              'fee_reg_store_kasir'=>'required',
              'fee_con_store_kasir'=>'required',
              'fee_reg_store_pramu'=>'required',
              'fee_con_store_pramu'=>'required',
              'fee_lembur'=>'required',
              'file_fee_region' => 'required|mimes:doc,docx,pdf,txt|max:2048',
             ]);   

 
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
                 }
              if ($files = $request->file('file_fee_region')) {
                     
                    $file = $request->file_fee_region->store('public/setup/fee_region');

                    $file_path='public/setup/fee_region/'.$request->file('file_fee_region')->hashName();
                    //store your file into database
                    $fee_region = new SysFeeRegion();
                    $fee_region->fee_group_id = $request->fee_group_id;
                    $fee_region->branch_id = $request->branch_id;
                    $fee_region->no_doc = $request->no_doc;
                    $fee_region->kodya_desc = $request->kodya_desc;
                    $fee_region->file_path = $file_path;
                    $fee_region->filename = $request->file('file_fee_region')->getClientOriginalName();
                    $fee_region->fee_ump = $request->fee_ump;
                    $fee_region->fee_lembur = $request->fee_lembur;
                    $fee_region->fee_reg_store_kasir = $request->fee_reg_store_kasir;
                    $fee_region->fee_con_store_kasir = $request->fee_con_store_kasir;
                    $fee_region->fee_reg_store_pramu = $request->fee_reg_store_pramu;
                    $fee_region->fee_con_store_pramu = $request->fee_con_store_pramu;
                    $fee_region->save();
                      
                    return response()->json([
                        "success" => true,
                        "message" => "File successfully uploaded",
                        "file" => $file
                    ]);
          
                }  
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
    public function fee_region_update(Request $request)
    {
        
         $validator = Validator::make($request->all(), 
              [ 
              'fee_region_id' => 'required|exists:sys_fee_region,id',
              'fee_group_id' => 'required|exists:sys_fee_group,id',
              'branch_id' => 'required|exists:sys_branch,id',
              'no_doc' => 'required|string',
              'kodya_desc'=>'required|string',
              'fee_ump'=>'required',
              'fee_reg_store_kasir'=>'required',
              'fee_con_store_kasir'=>'required',
              'fee_reg_store_pramu'=>'required',
              'fee_con_store_pramu'=>'required',
              'fee_lembur'=>'required',
              'file_fee_region' => 'required|mimes:doc,docx,pdf,txt|max:2048',
             ]);   

            
 
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
            }  
         
            $id=$request->fee_region_id;
            $fee_region=SysFeeRegion::find($id)->first();

            if($fee_region)
            {
                    $fee_region->fee_group_id = $request->fee_group_id;
                    $fee_region->branch_id = $request->branch_id;
                    $fee_region->no_doc = $request->no_doc;
                    $fee_region->kodya_desc = $request->kodya_desc;
                    $fee_region->fee_ump = $request->fee_ump;
                    $fee_region->fee_lembur = $request->fee_lembur;
                    $fee_region->fee_reg_store_kasir = $request->fee_reg_store_kasir;
                    $fee_region->fee_con_store_kasir = $request->fee_con_store_kasir;
                    $fee_region->fee_reg_store_pramu = $request->fee_reg_store_pramu;
                    $fee_region->fee_con_store_pramu = $request->fee_con_store_pramu;
                if($request->hasfile('file_fee_region'))
                {   

                    $file_path =$fee_region['file_path'];
                    if(Storage::exists($file_path)) {
                     //   echo "masuk sini";
                        Storage::delete($file_path); //Or you can do it as well
                    }
                    $file = $request->file_fee_region->store('public/setup/fee_region');
                    $file_path='public/setup/fee_region/'.$request->file('file_fee_region')->hashName();
                    

                   
                    $fee_region->file_path = $file_path;
                    $fee_region->filename = $request->file('file_fee_region')->getClientOriginalName();
                    
                      
                    return response()->json([
                        "success" => true,
                        "message" => "File successfully updated",
                        "file" => $file
                    ]);
                }

                 $fee_region->save();
                 return response()->json([
                        "success" => true,
                        "message" => "Data successfully updated"
                    ]);
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
