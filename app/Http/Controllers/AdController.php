<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
  public function show_all_ad()
  {
    $ad = Ad::all();
    
    return AdResource::collection($ad);
  }
  public function create_ad(Request $request)
  {
    $ad = new Ad();
    $ad->title = $request->title;
    $ad->content = $request->content;
    $ad->save();
    return  response()->json([
      'message' => '  تم انشاءالاعلان بنجاح',
      'ad' => new AdResource($ad)
    ],);
  }

  public function update_ad(Request $request, $id)
  {
    $ad = Ad::find($id);
    $ad->title = $request->title;
    $ad->content = $request->content;
    $ad->save();
    return  response()->json([
      'message' => '  تم تعديل الاعلان بنجاح',
      'ad' => new AdResource($ad)
    ],);
  }

  public function show_ad($id)
  {
    $ad = Ad::find($id);

    return new AdResource($ad);
  }
}
