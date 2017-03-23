<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Statuspost;
use App\Commentpost;
use App\User;
use App\Alert_friends;
use App\Alert;
use App\Indexportfolio;
use App\Dataportfolio;
use App\Listpresent;

class ListpresentController extends Controller
{
  public function showlist(){
    $listold = Listpresent::find(Auth::user()->id);
    $pieces = explode(",", $listold->idfodata);
    $arrbuff;
    $k=0;
    for ($i=0; $i < sizeof($pieces) ; $i++) {
      $check = Dataportfolio::find($pieces[$i]);
      if($check != ''){
          $arrbuff[$k] = $pieces[$i];
          $k++;
      }
    }
    $listNew = Indexportfolio::find(Auth::user()->id);
    $pieces = explode(",", $listNew->phpindex);
    $arrbuff2;
    for ($i=0; $i < sizeof($pieces); $i++) {
      $arrbuff2[$i] = $pieces[$i];
    }
    $result = array_diff($arrbuff2, $arrbuff);
    foreach ($result as $results) {
      array_push($arrbuff,$results);
    }
    $updatelist = '';
    for ($i=0; $i < sizeof($arrbuff); $i++) {
      if($i != sizeof($arrbuff)-1){
        $updatelist .= $arrbuff[$i].",";
      }else{
        $updatelist .= $arrbuff[$i];
      }
    }
    print $updatelist;
    $listold->idfodata = $updatelist;
    $listold->save();
    return view('portfolio.listpresent');
  }
  public function getdataslide($id){
    $data = Dataportfolio::find($id);
    return json_encode(array("result" => $data));
  }
  public function savedataslide(){
    $input = Input::all();
    $data = Listpresent::find($input['Id']);
    $data->idfodata = $input['index'];
    $data->save();
    return 'success';
  }
  public function presentfull(){
    $listold = Listpresent::find(Auth::user()->id);
    $pieces = explode(",", $listold->idfodata);
    $arrbuff;
    $k=0;
    for ($i=0; $i < sizeof($pieces) ; $i++) {
      $check = Dataportfolio::find($pieces[$i]);
      if($check != ''){
          $arrbuff[$k] = $pieces[$i];
          $k++;
      }
    }
    $listNew = Indexportfolio::find(Auth::user()->id);
    $pieces = explode(",", $listNew->phpindex);
    $arrbuff2;
    for ($i=0; $i < sizeof($pieces); $i++) {
      $arrbuff2[$i] = $pieces[$i];
    }
    $result = array_diff($arrbuff2, $arrbuff);
    foreach ($result as $results) {
      array_push($arrbuff,$results);
    }
    $updatelist = '';
    for ($i=0; $i < sizeof($arrbuff); $i++) {
      if($i != sizeof($arrbuff)-1){
        $updatelist .= $arrbuff[$i].",";
      }else{
        $updatelist .= $arrbuff[$i];
      }
    }
    $listold->idfodata = $updatelist;
    $listold->save();
    return view('portfolio.presentfull');
  }
  public function presentUserfull($id){
    $listold = Listpresent::find($id);
    $pieces = explode(",", $listold->idfodata);
    $arrbuff;
    $k=0;
    for ($i=0; $i < sizeof($pieces) ; $i++) {
      $check = Dataportfolio::find($pieces[$i]);
      if($check != ''){
          $arrbuff[$k] = $pieces[$i];
          $k++;
      }
    }
    $listNew = Indexportfolio::find($id);
    $pieces = explode(",", $listNew->phpindex);
    $arrbuff2;
    for ($i=0; $i < sizeof($pieces); $i++) {
      $arrbuff2[$i] = $pieces[$i];
    }
    $result = array_diff($arrbuff2, $arrbuff);
    foreach ($result as $results) {
      array_push($arrbuff,$results);
    }
    $updatelist = '';
    for ($i=0; $i < sizeof($arrbuff); $i++) {
      if($i != sizeof($arrbuff)-1){
        $updatelist .= $arrbuff[$i].",";
      }else{
        $updatelist .= $arrbuff[$i];
      }
    }
    $listold->idfodata = $updatelist;
    $listold->save();
    $users = User::find($id);

    return view('portfolio.presentUserfull', ['Users' => $users]);
  }
}
