<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\DB;

class CheckinputController extends Controller
{
  public function checkemail(){
    $result = 'success';
    $data = Input::all();
    $users = DB::table('users')->where('email', $data['email'] )->get();
    if($users == '[]'){
      if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $result = "failed";
      }else{
        $result = 'success';
      }
    }else{
      if (!filter_var($users->email, FILTER_VALIDATE_EMAIL)) {
        $result = "failed";
      }else{
        $result = 'success';
      }
    }
    return $result;
  }
  public function checkemailresetpass(){
    $result = 'success';
    $data = Input::all();
    $users = DB::table('users')->where('email', $data['email'] )->get();
    if($users == '[]'){
      $result = "failed";
    }else{
      $result = 'success';
    }
    return $result;
  }
}
