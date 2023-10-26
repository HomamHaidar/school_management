<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AttachFilesTrait;
  public function index(){

      $x=Setting::all();
      $setting['setting']=$x->flatMap(function ($x){
            return [$x->key =>$x->value];
      });

     return view('pages.Setting.index',$setting);

  }
  public function update(Request $request){
      try {
          $info= $request->except('_token','_method','logo');

        foreach ($info as $key=>$value){
                Setting::where('key',$key)->update(['value'=>$value]);
          }

        if ($request->hasFile('logo')){
            $name_to_delete= Setting::where('key','logo')->first()->value;
            $this->deleteFile($name_to_delete,'logo school');
            $this->uploadFile($request,'logo','logo school');
            $file_name_new=$request->file('logo')->getClientOriginalName();
            $logo_name=$request->file('logo')->getClientOriginalName();
            $logo_name= $logo_name !==$file_name_new ?$file_name_new:$logo_name;
            Setting::where('key','logo')->update(['value'=>$logo_name]);


        }

//          $key=array_keys($info);
//          $value=array_values($info);
//          for ($i=0;$i<count($info);$i++){
//            Setting::where('key',$key[$i])->update(['value'=>$value[$i]]);
//          }

          noty()->addInfo(trans('messages.Update'));
          return redirect()->route('Setting.index');

      }catch (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

  }

}
