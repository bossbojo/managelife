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
use App\Favorite;
use App\Feedback;

class SavePortController extends Controller
{
    public function showportfolioUser($id){
      $ohter_users = User::find($id);
      return  view('portfolio.portfolioUser', ['UserView' => $ohter_users]);
    }
    public function showportfolio(){
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
         return view('portfolio.portfolio');
      }else{
         return view('portfolio.portfolio');
      }
    }
    public function saveBackground(){
        $input = Input::all();
        $dataform =Input::all();
        print_r ($dataform) ;
        $update = Indexportfolio::find(Auth::user()->id);
        if($dataform['select']=='img'){
          $update->background = $dataform['bgset'];
          $update->save();
        }
        if($dataform['select']=='color'){
          $update->background = $dataform['color'];
          $update->save();
        }
        if($dataform['select']=='upload'){
          if(Input::hasFile('imgInp')) {
            $file = Input::file('imgInp');
            $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/portfolio/bgportfolio';
            if( !is_dir($url)){ //create folder crop
              mkdir($url, 0700,true);
            }
            $path = $url;
            $file->move($path,$file->getClientOriginalName());
            $update->background = $path.'/'.$file->getClientOriginalName();
          }
          $update->save();
        }
    }
    public function saveportfolioall(){
          $input =Input::all();
          $save = Indexportfolio::find(Auth::user()->id);
          if($save == ''){
            print('<br>สร้างใหม่');
            $save = new Indexportfolio;
            $save->id = Auth::user()->id;
            $save->position = $input['position'];
            $save->id_fk = $input['idtolist'];
            $save->indexbox = $input['idtolist'];
            $save->phpindex = $input['idtolist2'];
            $save->save();
          }else{
            if($input['position']=='[]'){
              print('<br>อัพเดท');
              $save->position = '[]';
              $save->id_fk = '[]';
              $save->indexbox = '[]';
              $save->phpindex = $input['idtolist2'];
              $save->save();
            }else{
              print('<br>อัพเดท');
              $save->position = $input['position'];
              $save->id_fk = $input['idtolist'];
              $save->indexbox = $input['idtolist'];
              $save->phpindex = $input['idtolist2'];
              $save->save();
            }
          }
          $id = explode(",", $input['idtolist2']);
          $g = explode(",", $input['idtolist2']);
          for($i =0 ;$i<sizeof($id);$i++){
            $savedata = Dataportfolio::find($id[$i]);
            if($savedata == ''){
              if($g[$i]%6==0){ //profile
                $savedata = new dataportfolio;
                $savedata->id = $id[$i];
                $savedata->titlesmall	 = 'Title description';
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($g[$i]%6==1){ //videoandtext
                $savedata = new Dataportfolio;
                $savedata->id = $id[$i];
                $savedata->video = "empty";
                $savedata->title = "TITLE VIDEO";
                $savedata->titlesmall = "Title description";
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($g[$i]%6==2){ //photoandtext
                $savedata = new Dataportfolio;
                $savedata->id = $id[$i];
                $savedata->img = "public/img/icon/photo.png";
                $savedata->title = "TITLE PHOTO";
                $savedata->titlesmall = "Title description";
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
              if($g[$i]%6==3){//text
                $savedata = new Dataportfolio;
                $savedata->id = $id[$i];
                $savedata->title = "TITLE Article";
                $savedata->titlesmall = "Title description";
                $savedata->text = "description";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();

            }
            if($g[$i]%6==4){//photo
                $savedata = new Dataportfolio;
                $savedata->id = $id[$i];
                $savedata->video = "empty";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();

            }
            if($g[$i]%6==5){//video
                $savedata = new Dataportfolio;
                $savedata->id = $id[$i];
                $savedata->img = "public/img/icon/photo.png";
                $savedata->colorfont1	 = '#000000';
                $savedata->colorfont2	 = '#000000';
                $savedata->colorbg1	 = '#ffffff';
                $savedata->colorbg2	 = '#ffffff';
                $savedata->save();
              }
            }
          }
          if($input['id_delete']!=''){//delete id data
            $id = explode(",", $input['id_delete']);
            for($i =0 ;$i<sizeof($id);$i++){
                $savedata = Dataportfolio::find($id[$i]);
                if($savedata != ''){
                  $disk = User::find(Auth::user()->id);
                  $disk->disk = (Auth::user()->disk + 0)-($savedata->sizefile + 0);
                  $disk->save();
                  $savedata->delete();
                }
            }
          }

    }
    public function saveprofileport(){
      print('<br>profile');
      print_r(Input::all());
      $dataform = Input::all();
      $update = Dataportfolio::find($dataform['id1']);
      $update->text = sumall($dataform['detail0']);
      $update->titlesmall =  sumall($dataform['titledescription0']);
      $update->save();
    }
    public function savevideotextport(){
      $dataform = Input::all();
      $update = Dataportfolio::find($dataform['id2']);
      if(Input::hasFile('filevideo')) {
        $file = Input::file('filevideo');
        $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/portfolio/videoportfolio';
        if( !is_dir($url)){ //create folder crop
          mkdir($url, 0700,true);
        }
        $nowsize2 = ((Auth::user()->disk + 0) - ($update->sizefile + 0))+($dataform['sizefilevideo']+0);
        $savesize1 = User::find(Auth::user()->id);
        $savesize1->disk = $nowsize2;
        $savesize1->save();

        $path = $url;
        $file->move($path,$file->getClientOriginalName());
        $update->video = $path.'/'.$file->getClientOriginalName();
        $update->sizefile = $dataform['sizefilevideo'];
      }
      //---------------save in database----------------------
      $update->text = sumall($dataform['detail1']);
      $update->title = sumall($dataform['titlename1']);
      $update->titlesmall = sumall($dataform['titledescription1']);
      $update->save();
      return 'success';
    }
    public function savephototextport(){
      $dataform = Input::all();
      $update = Dataportfolio::find($dataform['id3']);
      $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/portfolio/imgportfolio';
      if(Input::hasFile('filephoto')) {
        $file = Input::file('filephoto');
        if( !is_dir($url)){ //create folder crop
          mkdir($url, 0700,true);
        }
        $nowsize2 = ((Auth::user()->disk + 0) - ($update->sizefile + 0))+($dataform['sizefilephoto']+0);
        $savesize1 = User::find(Auth::user()->id);
        $savesize1->disk = $nowsize2;
        $savesize1->save();

        $path = $url;
        $file->move($path,$file->getClientOriginalName());
        $update->img = $path.'/'.$file->getClientOriginalName();
        $update->text = sumall($dataform['detail2']);
        $update->sizefile = $dataform['sizefilephoto'];
        $update->title = sumall($dataform['titlename2']);
        $update->titlesmall = sumall($dataform['titledescription2']);
        $update->save();
        return 'success';
      }
      return 'fail';

    }
    public function savetextport(){
      print('<br>text');
      print_r(Input::all());
      $dataform = Input::all();
      $update = Dataportfolio::find($dataform['id4']);
      $update->text = sumall(sum($dataform['detail3']));
      $update->title = sumall($dataform['titlename3']);
      $update->titlesmall = sumall($dataform['titledescription3']);
      $update->save();
    }
    public function savevideoport(){
      $dataform = Input::all();
      $update = Dataportfolio::find($dataform['id5']);
      $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/portfolio/videoportfolio';
      if(Input::hasFile('filevideo')) {
        $file = Input::file('filevideo');
        if( !is_dir($url)){ //create folder crop
          mkdir($url, 0700,true);
        }
        $nowsize2 = ((Auth::user()->disk + 0) - ($update->sizefile + 0))+($dataform['sizefilevideo2']+0);
        $savesize1 = User::find(Auth::user()->id);
        $savesize1->disk = $nowsize2;
        $savesize1->save();

        $path = $url;
        $file->move($path,$file->getClientOriginalName());
        $update->video = $path.'/'.$file->getClientOriginalName();
        $update->sizefile = $dataform['sizefilevideo2'];
        $update->save();
        return 'success';
      }
      return 'failed';
      //---------------save in database----------------------

    }
    public function savephotoport(){
      $dataform = Input::all();
      $update = Dataportfolio::find($dataform['id6']);
      $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/portfolio/imgportfolio';
      if(Input::hasFile('filephoto')) {
        $file = Input::file('filephoto');
        if( !is_dir($url)){ //create folder crop
          mkdir($url, 0700,true);
        }
          $nowsize = ((Auth::user()->disk + 0) - ($update->sizefile + 0))+($dataform['sizefilephoto21']+0);
          $savesize1 = User::find(Auth::user()->id);
          $savesize1->disk = $nowsize;
          $savesize1->save();
        $path = $url;
        $file->move($path,$file->getClientOriginalName());
        $update->img = $path.'/'.$file->getClientOriginalName();
        $update->sizefile = $dataform['sizefilephoto21'];
        $update->save();


        return 'success';
      }
      return 'fail';

    }
    public function savecolorport(){
      $dataform =Input::all();
      if($dataform['type']=='all'){
        $index = Indexportfolio::find(Auth::user()->id);
        $id = explode(",", $index['phpindex']);
        for($i =0 ;$i<sizeof($id);$i++){
            $update = Dataportfolio::find($id[$i]);
            $update->colorfont1 = $dataform['color1'];
            $update->colorfont2 = $dataform['color2'];
            $update->colorbg1 = $dataform['color3'];
            $update->colorbg2 = $dataform['color4'];
            $update->save();
        }
      }
      if($dataform['type']=='only'){
        $update = Dataportfolio::find($dataform['idcolor']);
        $update->colorfont1 = $dataform['color1'];
        $update->colorfont2 = $dataform['color2'];
        $update->colorbg1 = $dataform['color3'];
        $update->colorbg2 = $dataform['color4'];
        $update->save();
      }
    }
    public function enfavorite(){
      $dataform =Input::all();
      $find = Favorite::find($dataform['Id']);
      $favoritenow;
      if($find == ''){
        $new = new Favorite;
        $new->id = $dataform['Id'];
        $new->favorite = $dataform['user_Id'];
        $new->save();
        $favoritenow = $dataform['user_Id'];
      }else{
        if($find->favorite == ''){
          $find->favorite .= $dataform['user_Id'];
        }else{
          $find->favorite .= ','.$dataform['user_Id'];
        }

        $favoritenow = $find->favorite;
        $find->save();
      }

      if(Auth::user()->id != $dataform['Id']){
        $Alert = new Alert;
        $Alert->user_id = $dataform['Id'];
        $Alert->friend_id =$dataform['user_Id'];
        $Alert->type = 'favorite';
        $Alert->data = $dataform['Id'];
        $Alert->open = 0;
        $Alert->save();
      }

      $pieces = explode(",", $favoritenow);
      return sizeof($pieces);
    }
    public function defavorite(){
      $dataform =Input::all();
      $find = Favorite::find($dataform['Id']);
      $pieces = explode(",", $find->favorite);
      $delete ='';
      for ($i=0; $i < sizeof($pieces)-1; $i++) {
        if($pieces[$i] != $dataform['user_Id']){
          if($i==0){
            $delete .= $pieces[$i];
          }else{
            $delete .= ','.$pieces[$i];
          }
        }
      }
      $find->favorite = $delete;
      $find->save();

      $pieces = explode(",", $delete);
      return sizeof($pieces)-1;
    }
    public function showportfolioUserAlert($id,$idalert){
      $Alert = Alert::find($idalert);
      $Alert->open = 1;
      $Alert->save();
      return redirect('/feedback');
    }
    public function savefeedback(){
      $dataform =Input::all();
      $new = new Feedback;
      $new->user_id = $dataform['Id'];
      $new->user_feedback = $dataform['user_Id'];
      $new->feedback = $dataform['feedback'];
      $new->save();

      $Alert = new Alert;
      $Alert->user_id = $dataform['Id'];
      $Alert->friend_id =$dataform['user_Id'];
      $Alert->type = 'feedback';
      $Alert->data = $dataform['Id'];
      $Alert->open = 0;
      $Alert->save();

      return 'success';
    }
}//end class
//----------------------------------------method------------------------------------------
function sum($textsum) {
     $textdata = explode("\n",$textsum);
     $all = '';
     if( sizeof($textdata)>1){
       for($i = 0;$i<sizeof($textdata) ;$i++){
         if($i != sizeof($textdata)-1){
             $all .= substr($textdata[$i], 0, -1).'\\';
         }else{
             $all .= $textdata[$i];
         }

       }
        return $all;
     }else{
        return $textdata[0];
     }
}
function sumall($textsum) {
     $textdata = explode('\'',$textsum);
     $all = '';
     if( sizeof($textdata)>1){
       for($i = 0;$i<sizeof($textdata) ;$i++){
         if($i != sizeof($textdata)-1){
             $all .= $textdata[$i].'\\\'';
         }else{
             $all .= $textdata[$i];
         }

       }
       if(substr($all, -1)=='\\'){
         return substr($all, 0, -1);
       }
        return $all;
     }else{
        return  $textdata[0];
     }
}
