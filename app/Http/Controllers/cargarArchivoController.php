<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cargarArchivoController extends Controller
{
    public  function uploadFile(Request $request, $path){

        if($request->hasFile('file')){
            $file =$request->file('file');
            $fileName = $file->getClientOriginalName();

            $fileName = pathinfo($fileName,PATHINFO_FILENAME);
            $name_file = str_replace(" ","_",$fileName);

            $extension =$file->getClientOriginalExtension();
            $picture = date('His').'-'.$name_file.'.'.$extension;

            $file->move(public_path($path),$picture);
           $tamanio=filesize($file);

            return json_encode([
                    'mensaje'=>'ok',
                    'name'=>$name_file,
                    'extension'=>$extension,
                    'nameFull'=>$picture,
                    'paht'=>'prueba',
                    'tamanio'=>$tamanio
            ]);
        }else{
            return json_encode(["mensaje"=>"Error"]);
        }
    }


    public function downloadFile(Request $request){
        $filePath  = public_path($request->ruta.$request->nombre);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time().'.pdf';

        return response()->download($filePath, $fileName, $headers);
    }
}
