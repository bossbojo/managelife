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

class CandRController extends Controller
{
  public function contacttosave(){
    $input = Input::all();
    $new = new Contact;
    if($input['contact'] != ''){
      $new->user_id = $input['id'];
      $new->contact = $input['contact'];
      $new->save();
      return 'success';
    }
   return 'failed';
  }
}
