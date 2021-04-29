<?php

namespace App\Http\Controllers\Master;
use App\SysPersonel;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Illuminate\Support\Facades\Storage;


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
          $validator = Validator::make($request->all(), 
              [ 
              'no_doc' => 'required|string',
              'store_type' => 'required|string',
              'min_spd'=>'required',
              'max_spd'=>'required',
              'total_personel'=>'required',
              'total_pramu'=>'required',
              'total_kasir'=>'required',
              'file_personel' => 'required|mimes:doc,docx,pdf,txt|max:2048',
             ]);   

          
 
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
                 }  
         
          
                if ($files = $request->file('file_personel')) {
                     
                    $file = $request->file_personel->store('public/setup/personel');

                  //  rename("public/setup/personel/".$request->file('file')->getClientOriginalName(),"public/setup/personel/".$fileName);



                    $file_path='public/setup/personel/'.$request->file('file_personel')->hashName();
                    //store your file into database
                    $personel = new SysPersonel();

                    $personel->store_type = $request->store_type;
                    $personel->no_doc = $request->no_doc;
                    $personel->min_spd = $request->min_spd;
                    $personel->file_path = $file_path;
                    $personel->filename = $request->file('file_personel')->getClientOriginalName();
                    $personel->max_spd = $request->max_spd;
                    $personel->total_personel = $request->total_personel;
                    $personel->total_kasir = $request->total_kasir;
                    $personel->total_pramu = $request->total_pramu;
                    $personel->save();
                      
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
    public function personel_update(Request $request)
    {
       

      //  dd($request->all());
           $validator = Validator::make($request->all(), 
              [ 
                  'personel_id' => 'required|exists:sys_personel,id',
                  'no_doc' => 'required|string',
                  'store_type' => 'required|string',
                  'min_spd'=>'required',
                  'max_spd'=>'required',
                  'total_personel'=>'required',
                  'total_pramu'=>'required',
                  'total_kasir'=>'required',
                  'file_personel' => 'mimes:doc,docx,pdf,txt|max:2048',
             ]);   

            
 
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
            }  
         
            $id=$request->personel_id;
            $personel=SysPersonel::find($id)->first();

            if($personel)
            {
                $personel->no_doc = $request->no_doc;
                $personel->min_spd = $request->min_spd;
                $personel->max_spd = $request->max_spd;
                $personel->store_type = $request->store_type;
                $personel->total_personel = $request->total_personel;
                $personel->total_kasir = $request->total_kasir;
                $personel->total_pramu = $request->total_pramu;
                if($request->hasfile('file_personel'))
                {   


                    
                    $file_path =$personel['file_path'];
                    if(Storage::exists($file_path)) {
                        echo "masuk sini";
                        Storage::delete($file_path); //Or you can do it as well
                    }
                    $file = $request->file_personel->store('public/setup/personel');
                    $file_path='public/setup/personel/'.$request->file('file_personel')->hashName();
                    

                   
                    $personel->file_path = $file_path;
                    $personel->filename = $request->file('file_personel')->getClientOriginalName();
                  
                      
                    return response()->json([
                        "success" => true,
                        "message" => "File successfully updated",
                        "file" => $file
                    ]);
                }
                $personel->save();
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
