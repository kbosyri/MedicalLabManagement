<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdvertisResource;
use App\Models\Advertis;
use Illuminate\Http\Request;

class AdvertisController extends Controller
{

    public function show_all_ad(){
        $ad=Advertis::all();
       if($ad->count() >0){
        return  AdvertisResource::collection($ad);
       }
       else{
        return  response()->json([
            'message'=>' لا يوجد إعلانات '
              ],500);
       }    
}

    public function create_advertis(Request $request)
{
$ad=new Advertis;
$ad->ad_number=$request->ad_number;
$ad->ad_title=$request->ad_title;
$ad->ad_content=$request->ad_content;
$ad->save();
return response()->json([
    'message'=>'تم انشأ الإعلان بنجاح',
    'ad'=>new AdvertisResource ($ad),
      ]); 
}


public function update_advertis(Request $request,$id)
{
$ad=Advertis::find($id);
$ad->ad_number=$request->ad_number;
$ad->ad_title=$request->ad_title;
$ad->ad_content=$request->ad_content;
$ad->save();
return response()->json([
    'message'=>'تم تعديل  الإعلان بنجاح',
    'ad'=>new AdvertisResource ($ad),
      ]); 
}

}
