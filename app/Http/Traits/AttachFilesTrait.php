<?php

namespace App\Http\Traits;



use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{

    public function uploadFile($request,$name,$folder){

            $file_name=$request->file($name)->getClientOriginalName();
            $request->file($name)->storeAs('attachments/'.$folder.'/',$file_name,'upload_attachments');
//            $name=$file->getClientOriginalName();
//            $fileName=iconv('utf-8','windows-1256', $file->getClientOriginalName());
    }

    public function deleteFile($name,$folder){
        $exist=Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$name);
        if ($exist){
            Storage::disk('upload_attachments')->delete('attachments/'.$folder.'/'.$name);
        }

    }

}
