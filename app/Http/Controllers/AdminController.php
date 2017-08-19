<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Statuspost;
use App\Commentpost;
use App\User;
use App\DetailProfile;
use App\Alert_friends;
use App\Alert;
use App\Indexportfolio;
use App\Dataportfolio;
use App\Listpresent;
use App\Fileupload;
use App\Contact;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function checklogin(){
       $input = Input::all();
       if($input['id'] == 'Managelife' && $input['password'] == '123/*-+Bj'){
         Session::put('login', 'ture');
         Session::save();
         return  redirect('/adminhome');
       }
       return  redirect('/adminlogin');
    }
    public function logOutadmin(){
      session()->forget('login');
      return  redirect('/adminlogin');
    }
    public function getdatauserto($id){
      $users = User::find($id);
      $d_user = DetailProfile::find($id);
      return json_encode(array("result" => $users , "result2" => $d_user));
    }
    public function getalluser(){
      $users = User::all();
      return json_encode(array("result" => $users));
    }
    public function block(){
      $input = Input::all();
      $users = User::find($input['Id']);
      $users->blocking = 'block';
      $users->save();
      return 'success';
    }
    public function unblock(){
      $input = Input::all();
      $users = User::find($input['Id']);
      $users->blocking = 'normal';
      $users->save();
      return 'success';
    }
    public function getcontact($id){
      $get = DB::table('contact')
                ->where([
                  ['user_id', '=', $id ]
                ])
                ->get();
      return json_encode(array("result" => $get));
    }
    public function delectcontact(){
      $input = Input::all();
      $delect = Contact::find($input['Id']);
      $delect->delete();
      return 'success';
    }
}
