<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Statuspost;
use App\Commentpost;
use App\User;
use Storage;
use File;
use App\Alert_friends;
use App\Alert;

class savePostController extends Controller
{
  public function savePost(){
      $input = Input::all();
      $SaveStatus = new Statuspost;
      $url = '';
      if(Input::hasFile('fileall')) {
       $file = Input::file('fileall');
       if($input['typefile']=='image'){
         print 'image';
         $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/status/img';
         print $url;
         if( !is_dir($url)){ //create folder
            mkdir($url, 0777, true);
         }
       }
       if($input['typefile']=='video'){
         $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/status/video';
         if( !is_dir($url)){ //create folder
           mkdir($url, 0700,true);
         }
       }
       if($input['typefile']=='application'){
         $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/status/application';
         if( !is_dir($url)){ //create folder
           mkdir($url, 0700,true);
         }
       }
       if($input['typefile']=='audio'){
         $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/status/audio';
         if( !is_dir($url)){ //create folder
           mkdir($url, 0700,true);
         }
       }
       if($input['typefile']=='otherfile'){
         $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/status/otherfile';
         if( !is_dir($url)){ //create folder
           mkdir($url, 0700,true);
         }
       }
       $path2 = $url;
       //move file in server
       if($input['typefile'] !='application'){
         $temp = explode(".", $_FILES["fileall"]["name"]);
         $newfilename = Auth::user()->id.'_'.round(microtime(true)) . '.' . end($temp);
         $file->move($path2,$newfilename);
         $SaveStatus->path = $path2.'/'.$newfilename;
       }else{
         $temp = explode(".", $_FILES["fileall"]["name"]);
         $newfilename = $temp[0].' '.Auth::user()->id.'_'.round(microtime(true)) . '.' . end($temp);
         $file->move($path2,$newfilename);
         $SaveStatus->path = $path2.'/'.$newfilename;
       }
       //save in data base
       $SaveStatus->type = $input['typefile'];
      }else{
       $SaveStatus->type = 'text';
      }
      $SaveStatus->user_id = Auth::user()->id;
      $SaveStatus->status = $input['feel'];
      $SaveStatus->vision = $input['level-look'];
      $SaveStatus->save();
      return 'success';
  }
  public function deletePost(){
      $input = Input::all();
      $delete = Statuspost::find($input['Id']);
      Storage::delete( asset($delete->path) );
      File::delete( asset($delete->path) );
      $delete_comment = DB::table('comment_post')
                        ->where('status_id', 'like', $delete->id)
                        ->get();
      foreach ($delete_comment as $delete_comments) {
        $delete_commentall = Commentpost::find($delete_comments->id)->delete();
      }
      $delete->delete();
      return 'success';
  }
  public function delete_comment(){
      $input = Input::all();
      $delete = Commentpost::find($input['Id']);
      $delete->delete();
      return 'success';
  }
  public function comment_post(){
      $input = Input::all();
      $addcomment = new Commentpost;
      $findIdStatus = Statuspost::find($input['Id']);
      $alert_comment_all = DB::table('comment_post')
                          ->where('status_id', '=', $input['Id'])
                          ->get();
      $users_comment;
      // alert comment
        if($alert_comment_all == '[]'){
          if(Auth::user()->id != $findIdStatus->user_id){
            $Alert = new Alert;
            $Alert->user_id = $findIdStatus->user_id;
            $Alert->friend_id = $input['Id_user'];
            $Alert->type = 'comment';
            $Alert->data = $input['Id'];
            $Alert->open = 0;
            $Alert->save();
          }
        }else{
          $check =  DB::table('comment_post')
                              ->where([
                                      ['status_id', '=', $input['Id']],
                                      ['user_id', '=', $input['Id_user']]
                                      ])
                              ->get();
            foreach ($alert_comment_all as $alert_comment_alls) {
              $users_comment[$alert_comment_alls->user_id] = $alert_comment_alls->user_id;
            }
            foreach ($users_comment as $users_comments) {
                if(Auth::user()->id != $users_comments ){
                  if($check == '[]'){
                    if($input['Id_user'] == $findIdStatus->user_id){
                      $Alert = new Alert;
                      $Alert->user_id = $users_comments;
                      $Alert->friend_id = $input['Id_user'];
                      $Alert->type = 'replycomment';
                      $Alert->data = $input['Id'];
                      $Alert->open = 0;
                      $Alert->save();
                    }else{
                      $Alert = new Alert;
                      $Alert->user_id = $users_comments;
                      $Alert->friend_id = $input['Id_user'];
                      $Alert->type = 'comment';
                      $Alert->data = $input['Id'];
                      $Alert->open = 0;
                      $Alert->save();
                    }
                  }else{
                    $Alert = new Alert;
                    $Alert->user_id = $users_comments;
                    $Alert->friend_id = $input['Id_user'];
                    $Alert->type = 'replycomment';
                    $Alert->data = $input['Id'];
                    $Alert->open = 0;
                    $Alert->save();
                  }
                }
            }

        }
        // end alert comment
        $addcomment->status_id = $input['Id'];
        $addcomment->user_id = $input['Id_user'];
        $addcomment->comment = $input['comment'];
        $addcomment->save();
      return 'success';
  }
  public function edit_comment(){
      $input = Input::all();
      $update = Commentpost::find($input['Id']);
      $update->comment = $input['comment'];
      $update->save();
      return 'success';
  }

  public function getcomment($idstatus){
    // $getcomment = DB::table('users')
    //               ->join('comment_post', 'users.id', '=', 'comment_post.user_id')
    $getcomment = DB::table('comment_post')
                  ->join('users', 'users.id', '=', 'comment_post.user_id')
                  ->select('comment_post.*', 'users.avatar', 'users.name' , 'users.filter')
                  ->where('status_id', 'like', $idstatus)
                  ->orderBy('comment_post.created_at', 'asc')
                  ->get();
      return json_encode(array("result" => $getcomment));
  }
  public function getcomentUser($idstatus){
    $getcomment = DB::table('comment_post')
                  ->join('users', 'users.id', '=', 'comment_post.user_id')
                  ->select('comment_post.*', 'users.avatar', 'users.name' , 'users.filter')
                  ->where('status_id', 'like', $idstatus)
                  ->orderBy('comment_post.created_at', 'asc')
                  ->get();
      return json_encode(array("result" => $getcomment));
  }
  public function getdatauser($iduser){
      $getdatauser = User::find($iduser);
      return json_encode(array("result" => $getdatauser));
  }
  public function showonlystatus($id){
    return  view('ShowOnlyStatus', ['idstatus' => $id]);
  }
  public function showonly($id,$idalert){
    $update = Alert::find($idalert);
    if($update != '[]'){
      if($update->open != 1){
        $update->open = 1;
        $update->save();
      }
    }
    return view('showonly', ['idstatus' => $id]);
  }
  public function save_editposturl_text(){
   $input = Input::all();
   $update = Statuspost::find($input['idstatus']);
   $update->status = $input['feele_edit'];
   $update->save();
   return $input;
  }
  public function save_editposturl_file(){
   $input = Input::all();
   $update = Statuspost::find($input['idstatus']);
   $update->status = $input['feele_edit'];
   $update->save();
   return $input;
  }
}
