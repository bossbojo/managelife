<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Statuspost;
use App\Commentpost;
use App\OtherDetail;
use App\DetailProfile;
use App\User;
use Storage;
use File;
use App\Alert_friends;
use App\Alert;

class EditprofileController extends Controller
{
    public function editname(){
      $input = Input::all();
      $updatename = User::find($input['Id']);
      $updatename->name = $input['Editname'];
      $updatename->save();
      return $input['Editname'];
    }
    public function editgender(){
      $input = Input::all();
      $updategender = DetailProfile::find($input['Id']);
      if($updategender == ''){
        $new = new DetailProfile;
        $new->id = $input['Id'];
        $new->gender = $input['Editgender'];
        $new->save();
      }else{
        $updategender->gender = $input['Editgender'];
        $updategender->save();
      }
      return $input['Editgender'];
    }
    public function editbirthday(){
      $input = Input::all();
      $updatebirthday = DetailProfile::find($input['Id']);
      if($updatebirthday == ''){
        $new = new DetailProfile;
        $new->id = $input['Id'];
        $new->birthday = $input['Editbirthday'];
        $new->save();
      }else{
        $updatebirthday->birthday = $input['Editbirthday'];
        $updatebirthday->save();
      }
      return $input['Editbirthday'];
    }
    public function addotherTopic(){
      $input = Input::all();
      $new = new OtherDetail;
      $new->user_id = $input['Id'];
      $new->icon = $input['icon'];
      $new->topic = $input['topic'];
      $new->detail = $input['detail'];
      $new->save();
      return $input;
    }
    public function deleteOther(){
      $input = Input::all();
      $delete2 = OtherDetail::find($input['Id']);
      $delete2->delete();
      return 'success';
    }
    public function editother(){
      $input = Input::all();
      $edit = OtherDetail::find($input['Id']);
      $edit->topic = $input['topic'];
      $edit->detail = $input['detail'];
      $edit->save();
      return 'success';
    }
}
