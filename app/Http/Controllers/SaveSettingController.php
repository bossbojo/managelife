<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class SaveSettingController extends Controller
{
  public function changepassword(Request $reques){
    $data = Input::all();
    $new = $data['oldpassword'];
    if(Hash::check($new,Auth::user()->password)){
      $update = User::find(  Auth::user()->id );
      $update->password = bcrypt($data['newpassword']);
      $update->save();
      return 'yes';
    }else{
      return 'no';
    }
  //  return $data['oldpassword'];
  }
}
