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

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
      $selectfriend = DB::table('alert_friend')
                      ->where([
                        ['user_id', '=', Auth::user()->id ],
                        ['friend_id', '=', Auth::user()->id ],
                      ])->get();
        if($selectfriend == '[]'){
          $acceptinword = new Alert_friends;
          $acceptinword->user_id = Auth::user()->id;
          $acceptinword->friend_id = Auth::user()->id;
          $acceptinword->status_alert	= 'myid';
          $acceptinword->open	= 3;
          $acceptinword->save();
        }
        $login = User::find(Auth::user()->id);
        $login->online = 'true';
        $login->save();

        $find = Indexportfolio::find(Auth::user()->id);
        if ($find == '') {
            //-----------------portfolio-------------------------------------
            $indexportfolio = new Indexportfolio;
            $indexportfolio->id = Auth::user()->id;
            $indexportfolio->background = 'public/img/bg_port/2.jpg';
            $indexportfolio->position = '[ { "x": 0, "y": 0, "width": 2, "height": 6 }, { "x": 2, "y": 0, "width": 10, "height": 6 }, { "x": 0, "y": 6, "width": 4, "height": 6 }, { "x": 4, "y": 6, "width": 2, "height": 6 }, { "x": 6, "y": 6, "width": 6, "height": 3 }, { "x": 6, "y": 9, "width": 6, "height": 3 } ]';
            $dataportfolio = dataportfolio::all();
            $maxid  = 1;
            $iddata = '';
              foreach ($dataportfolio as $id) {
                 if($id->id > $maxid ){
                   $maxid = $id->id;
                 }
              }
            $pointer  = array(0,5,1,2,3,3); //18,11,25,26,33,39
            for($i = 0 ; $i < sizeof($pointer);$i++){
              for($k = 0 ; $k<10 ;$k++) {
                $maxid++;
                if($maxid%6==$pointer[$i]){
                  $k = 10;
                }
              }
              if($i!=sizeof($pointer)-1){
                $iddata .= $maxid.',';
              }else{
                $iddata .= $maxid;
              }
              if($maxid%6==0){
                $savedata = new Dataportfolio;
                $savedata->id = $maxid;
                $savedata->titlesmall	 = 'Title description';
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($maxid%6==1){
                $savedata = new Dataportfolio;
                $savedata->id = $maxid;
                $savedata->video = "public/img/bg_port/videotest.mp4";
                $savedata->title = "TITLE VIDEO";
                $savedata->titlesmall = "Title description";
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($maxid%6==2){
                $savedata = new Dataportfolio;
                $savedata->id = $maxid;
                $savedata->img = "public/img/bg_port/imgtest.jpg";
                $savedata->title = "TITLE PHOTO";
                $savedata->titlesmall = "Title description";
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($maxid%6==3){
                $savedata = new Dataportfolio;
                $savedata->id = $maxid;
                $savedata->title = "TITLE Article";
                $savedata->titlesmall = "Title description";
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($maxid%6==4){
                $savedata = new Dataportfolio;
                $savedata->id = $maxid;
                $savedata->video = "empty";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($maxid%6==5){
                $savedata = new Dataportfolio;
                $savedata->id = $maxid;
                $savedata->img = "public/img/bg_port/coverport.jpg";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
            }
            $indexportfolio->indexbox = '['.$iddata.']';
            $indexportfolio->id_fk = '['.$iddata.']';
            $indexportfolio->phpindex = $iddata;
            $indexportfolio->save();
            //-----------------------------------------------
        }
        $find = Listpresent::find(Auth::user()->id);
        $findindex = Indexportfolio::find(Auth::user()->id);
        if($find == ''){
           $new = new Listpresent;
           $new->id = Auth::user()->id;
           $new->idfodata = $findindex->phpindex;
           $new->save();
        }
        return view('home');
    }
    public function ohter_users($id){
      if( $id == Auth::user()->id){
        return redirect('/home');
      }else{
        $ohter_users = User::find($id);
        return  view('homeUser', ['UserView' => $ohter_users]);
      }
    }
    public function ohter_users_status($id,$idalert){
     $update = Alert::find($idalert);
     if($update->open != 1){
       $update->open = 1;
       $update->save();
     }
      if( $id == Auth::user()->id){
        return redirect('/home');
      }else{
        $ohter_users = User::find($id);
        return  view('homeUser', ['UserView' => $ohter_users]);
      }
    }
    public function showstatusUser($id){
      $ohter_users = User::find($id);
      return  view('showstatusUser', ['UserView' => $ohter_users]);
    }
    public function searchUser($name){
      $users = DB::table('users')
                ->where('name', 'like', '%'.$name.'%')
                ->get();
      return json_encode(array("result" => $users));
    }
    public function deleteThinkso(){
      $input = Input::all();
      $statusfind = Statuspost::find($input['Id']);
      $thinksoId = explode(",",$statusfind->thinkso);
      $delete = '';
      for ($i=0; $i < sizeof($thinksoId)-1; $i++) {
        if($thinksoId[$i] != $input['Id_user']){
          if($i==0){
            $delete .= $thinksoId[$i];
          }else{
            $delete .= ','.$thinksoId[$i];
          }
        }
      }
        $statusfind->thinkso = $delete;
        $statusfind->save();
        return  sizeof($thinksoId)-1;

    }
    public function saveThinkso(){
      $input = Input::all();
      $statusfind = Statuspost::find($input['Id']);
      $thinksoId = explode(",",$statusfind->thinkso);
      if(Auth::user()->id != $statusfind->user_id){
        $Alert = new Alert;
        $Alert->user_id = $statusfind->user_id;
        $Alert->friend_id = $input['Id_user'];
        $Alert->type = 'ithinkso';
        $Alert->data = $input['Id'];
        $Alert->open = 0;
        $Alert->save();
      }
      if($statusfind->thinkso == null){
        $statusfind->thinkso = $input['Id_user'];
        $statusfind->save();
        return  sizeof($thinksoId);
      }else{
        $statusfind->thinkso = $statusfind->thinkso.','.$input['Id_user'];
        $statusfind->save();
        return  sizeof($thinksoId)+1;
      }
    }
    public function addfriend(){
      $input = Input::all();
      $add = new Alert_friends;
      $add->user_id = $input['Id'];
      $add->friend_id = $input['Id_friend'];
      $add->status_alert = 'requesting';
      $add->open = 0;
      $add->save();
      return 'success';
    }
    public function canceladdfriend(){
      $input = Input::all();
      $selectfriend = DB::table('alert_friend')
                      ->where([
                        ['user_id', '=', $input['Id'] ],
                        ['friend_id', '=', $input['Id_friend'] ],
                      ])->get();
      foreach ($selectfriend as $selectfriendonly) {
        $delete = Alert_friends::find($selectfriendonly->id);
        $delete->delete();
      }
      return 'success';
    }
    public function getalertaddfriends($id){
      $users = DB::table('alert_friend')
                ->where([
                  ['friend_id', '=', $id ],
                  ['status_alert', '=', 'requesting' ],
                  ['open', '=', 0 ],
                ])
                ->count();
      return json_encode(array("result" => $users));
    }
  public function getaddfriends($id){
    $getaddfriends = DB::table('alert_friend')
                  ->join('users', 'users.id', '=', 'alert_friend.user_id')
                  ->select('alert_friend.*', 'users.avatar','users.name')
                  ->where([
                    ['friend_id', 'like', $id ],
                    ['status_alert', '=', 'requesting' ],
                  ])
                  ->orderBy('alert_friend.created_at', 'desc')
                  ->get();
      return json_encode(array("result" => $getaddfriends));
  }
  public function getalertall($id){
    $users = DB::table('alert')
              ->where([
                ['user_id', '=', $id ],
                ['open', '=', 0 ],
              ])
              ->count();
    return json_encode(array("result" => $users));
  }
  public function getalert($id){
    $getaddfriends = DB::table('alert')
                  ->join('users', 'users.id', '=', 'alert.friend_id')
                  ->select('alert.*', 'users.avatar','users.name')
                  ->where('user_id', 'like', $id)
                  ->orderBy('alert.created_at', 'desc')
                  ->get();
      foreach ($getaddfriends as $value) {
        $time = humanTiming(strtotime($value->created_at));
        $value->created_at = $time;
      }
      return json_encode(array("result" => $getaddfriends));
  }
  public function acceptfriend(){
    $input = Input::all();
    $accept = Alert_friends::find($input['Id']);
    $accept->status_alert	= 'friend';
    $accept->open	= 1;
    $accept->save();
    $iduser = $accept->user_id;
    $idfriend = $accept->friend_id;
    $acceptinword = new Alert_friends;
    $acceptinword->user_id = $idfriend;
    $acceptinword->friend_id = $iduser;
    $acceptinword->status_alert	= 'friend';
    $acceptinword->open	= 1;
    $acceptinword->save();
    //---------alert-----------------
    $Alert = new Alert;
    $Alert->user_id = $iduser;
    $Alert->friend_id = $idfriend;
    $Alert->type = 'acceptfriend';
    $Alert->data = 'null';
    $Alert->open = 0;
    $Alert->save();
    return 'success';
  }
  public function cancelfriend(){
    $input = Input::all();
    $delete = Alert_friends::find($input['Id']);
    $delete->delete();
    return 'success';
  }
  public function close_alertfriends(){
    $input = Input::all();
    $update = DB::table('alert_friend')
              ->where([
                ['friend_id', '=', $input['Id'] ],
                ['open', '=', 0 ],
              ])
              ->get();
    foreach ($update as $updates) {
      $updateto = Alert_friends::find($updates->id);
      $updateto->open = 1;
      $updateto->save();
    }
    return 'success';
  }
  public function removefriend(){
    $input = Input::all();
    $delete = DB::table('alert_friend')
              ->where([
                ['friend_id', '=', $input['Id'] ],
                ['user_id', '=', $input['Id_friend'] ],
              ])
              ->get();
    foreach ($delete as $deleteID) {
      $deleteID2 = Alert_friends::find($deleteID->id);
      $deleteID2->delete();
    }

    $delete = DB::table('alert_friend')
              ->where([
                ['user_id', '=', $input['Id'] ],
                ['friend_id', '=', $input['Id_friend'] ],
              ])
              ->get();
    foreach ($delete as $deleteID) {
      $deleteID2 = Alert_friends::find($deleteID->id);
      $deleteID2->delete();
    }

    return 'success';
  }
  public function openalert(){
    $input = Input::all();
    $update = Alert::find($input['Id']);
    if($update->open != 1){
      $update->open = 1;
      $update->save();
    }
    return 'success';
  }
  public function saveImgPro(){
    $input = Input::all();
    $css;
    $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/profile';
    if( !is_dir($url)){ //create folder
       mkdir($url, 0777, true);
    }
    $namefile = 'crop_profile.jpg';
    $update1 = User::find(Auth::user()->id);
    $update1->avatar = $url.'/'.$namefile;
    $update1->filter = $input['css'];
    $update1->save();
    $data = $input['newimg'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    file_put_contents( $url.'/'.$namefile, $data);
    return 'success';
  }
  public function saveImgCover(){
    $file = Input::file('file');
    $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/cover';
    if( !is_dir($url)){ //create folder
       mkdir($url, 0777, true);
    }
    $file->move($url,$file->getClientOriginalName());

    $update1 = User::find(Auth::user()->id);
    $update1->cover = $url.'/'.$file->getClientOriginalName();
    $update1->save();

    return 'success';
  }
  public function readall(){
    $input = Input::all();
    $openall = DB::table('alert')
              ->where([
                ['user_id', '=', $input['Id'] ],
                ['open', '=', 0 ],
              ])
              ->get();
   if($openall != '[]'){
     foreach ($openall as $openalls) {
       $update = Alert::find($openalls->id);
       $update->open = 1;
       $update->save();
     }
   }
  }
  public function searchfriends(){
    $input = Input::all();
    $search = DB::table('users')
              ->where('name', 'like', '%'.$input['name_friend'].'%' )
              ->get();
    return  view('friend.searchFriends', ['searchFriends' => $search]);
  }
}
function humanTiming ($time){
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year ago',
        2592000 => 'month ago',
        604800 => 'week ago',
        86400 => 'day ago',
        3600 => 'hour ago',
        60 => 'minute ago',
        1 => 'second ago'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
