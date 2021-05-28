<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cargarArchivoController extends Controller
{
    public  function uploadFile(Request $request){
        if($request->hasFile('file')){
            $file =$request->file('file');
            $fileName = $file->getClientOriginalName();

            $fileName = pathinfo($fileName,PATHINFO_FILENAME);
            $name_file = str_replace(" ","_",$fileName);

            $extension =$file->getClientOriginalExtension();
            $picture = date('His').'-'.$name_file.'.'.$extension;

            $file->move(public_path('Prueba/'),$picture);


            return response()->json([
                'menseje'=>'Archiivo cargado',
                'Data'=>[
                    'name'=>$name_file,
                    'extension'=>$extension,
                    'nameFull'=>$picture,
                    'paht'=>'prueba'
                ]
            ]);
        }else{
            return response()->json([
                'menseje'=>'Error',

            ]);
        }
    }
}
