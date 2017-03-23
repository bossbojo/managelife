@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/menubar/bs_leftnavi.css') }}">
<script src="{{ asset('public/css/menubar/bs_leftnavi.js') }}"></script>
<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery_from/jquery.form.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/jquery-ui\jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
<script src="{{ asset('public/popelt-v1.0-source.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public\css\bubble.css') }}">
<style media="screen">
.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 18px;
}
</style>
<?php
use Illuminate\Support\Facades\DB;
use App\Indexportfolio;
use App\Favorite;
use App\Feedback;
use App\User;

$thisport = Indexportfolio::find(Auth::user()->id);
$favorite = Favorite::find(Auth::user()->id);
$users;
$num = 0;
if($favorite != ''){
  $users = explode(",", $favorite->favorite);

  for ($i=0; $i <  sizeof($users) ; $i++) {
    if($users[$i] != ''){
      $num++;
    }
  }
}

 ?>
 <div class="container-fluid" style="background-color:#111; margin-left:-0px;" >
   <div class="col-md-3" id="menubarleft" style=" margin-left:-25px;" >

     <div class="panel panel-default" style="border-radius-: 20px; background-color:#111; border-color:#111;">
         <div class="panel-heading border-radius-top-20px" style=" background-color:#cc9900; border-color:#888; text-align:center;" align="center" >
           <a href="{{ url('home') }}" class="btnMenulife" align="center">
               <img  class="img-circle" style="border-color:#000; {{ Auth::user()->filter }} " src="{{ asset(''.Auth::user()->avatar) }}" width="100px">
               <span for="" style="font-size:150%; color:#000;"> {{ Auth::user()->name }}</span>
           </a>
         </div>
         <div class=" border-radius-bottom-20px" style="border-color:#111;">
               <div class="nano-content">
                 <ul class="gw-nav gw-nav-list">
                   <li class="init-arrow-down">
                     <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                       <img  src="{{ asset('public/icon/portfolio.png') }}" width="35" alt=""> Portfolio <b class="gw-arrow"></b>
                     </a>
                     <ul class="gw-submenu">
                       <li>
                         <a href="{{ url('/portfolio') }}" style=" font-size:17px; padding-top:10px; padding-left:120px; " >
                           <img  src="{{ asset('public/icon/preview.png') }}" width="25" alt=""> Preview Portfolio
                         </a>
                       </li>
                       <li>
                         <a href="{{ url('/feedback') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/feedback-icon-3.png') }}" width="25" alt=""> Feedback Portfolio
                         </a>
                       </li>
                       <li>
                         <a href="{{ url('/customportfolio') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/edit.png') }}" width="25" alt=""> Edit Portfolio
                         </a>
                       </li>
                     </ul>
                   </li>
                   <li class="gw-submenu">
                     <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                       <img  src="{{ asset('public/icon/uploadpng.png') }}" width="35" alt=""> File Upload
                     </a>
                   </li>
                   <li class="gw-submenu">
                     <a href="#" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                       <img  src="{{ asset('public/icon/star.png') }}" width="35" alt=""> Your favourite
                     </a>
                   </li>
                   <li class="gw-submenu">
                     <a href="{{ url('/yourfriends') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                       <img  src="{{ asset('public/icon/friend.png') }}" width="35" alt=""> Friends
                     </a>
                   </li>
                   <li class="init-arrow-down">
                     <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                       <img  src="{{ asset('public/icon/settings.png') }}" width="35" alt=""> Setting <b class="gw-arrow"></b>
                     </a>
                     <ul class="gw-submenu">
                       <li>
                         <a href="{{ url('settings') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/settings.png') }}" width="25" alt=""> Setting
                         </a>
                       </li>
                       @if(Auth::user()->provider == 'managelife')
                       <li>
                         <a href="{{ url('settings/changepass') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/changepass.ico') }}" width="25" alt=""> Change Password
                         </a>
                       </li>
                       @endif
                       <li>
                         <a href="{{ url('settings/changeimage') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/camerachage.png') }}" width="25" alt=""> Change image profile
                         </a>
                       </li>
                       <li>
                         <a href="{{ url('settings/changeimagecover') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/imgcover.png') }}" width="25" alt=""> Change image cover
                         </a>
                       </li>
                       <li>
                         <a href="{{ url('settings/editprofile') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                           <img  src="{{ asset('public/icon/editprofile.png') }}" width="25" alt=""> Edit Profile
                         </a>
                       </li>
                     </ul>
                   </li>
                   <li class="gw-submenu">
                     <a href="#" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                       <img  src="{{ asset('public/icon/contact-us.png') }}" width="35" alt=""> contact us
                     </a>
                   </li>
                   <li class="gw-submenu">
                     <a href="#" onclick="confirmclosebox()" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                       <img  src="{{ asset('public/icon/logout.png') }}" width="35" alt=""> Logout
                     </a>
                   </li>
                   <br><br>
                   <li class="gw-submenu" style="text-align:center;">
                       <button href="#" class="btnMenulife"><img style="margin:-16px ;" src="{{ asset('favicon.ico') }}" width="200" alt=""></button>
                   </li>
               </div>
               <br><br><br><br><br>
         </div>
     </div>
   </div>
  <div class="col-md-9" style="background-color:#333; padding:10px;">
    <!-- portfolio -->
    <div class="" style="background-image:url('<?=  asset($thisport->background) ?>'); border-radius:5px; padding:10px;">
      <div class="" style="position: relative;">
        <img src="{{ asset('public/img/bg_port/coverport.jpg') }}" alt="" width="100%">
        <div class="center">
          <?php
            $img = Auth::user()->avatar;
            $pieces = explode("/", $img);
            if($pieces[0] != 'public'){
                print '<img class="img-thumbnail" style="'.Auth::user()->filter.'" src="'.$img.'" alt="" width="150px">';
            }else{
                print '<img class="img-thumbnail" style="'.Auth::user()->filter.'" src="'.asset($img).'" alt=""  width="150px">';
            }
           ?>
           <br>
           <span style="padding:5px; background-color:rgba(0, 0, 0, 0.67);color:#fff; border-radius:5px;">{{ Auth::user()->name }}</span>
        </div>
      </div>
    </div>
    <!-- feedback and Favorite -->
    <div class="">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <?php
            $count = DB::table('feedback')
                            ->where([
                              ['user_id', '=', Auth::user()->id ],
                            ])->count();
             ?>
            <td style="border-color:#222;">
              <h3><img src="{{ asset('public/icon/feedback-icon-3.png') }}" alt="" width="30px"> Feedback  (<span>{{ $count }}</span>)</h3>
              <hr style="border-color:#444;">
              <!-- feedback -->
              <?php
                $feedbackall = DB::table('feedback')
                                ->where([
                                  ['user_id', '=', Auth::user()->id ],
                                ])->get();
                foreach ($feedbackall as $feedbackalls) {
                  $usernow = User::find($feedbackalls->user_feedback);
               ?>
              <table>
                <tbody>
                  <tr>
                    <td style="border-color:#222;">
                      <a href="{{ url('user').'/'.$usernow->id }}">
                        <img class="img-thumbnail" style="{{$usernow->filter}}" src="{{ asset($usernow->avatar) }}" alt="" width="100px">
                      </a>
                    </td>
                    <td style="border-color:#222;">
                      <div class="talk-bubble tri-right left-top">
                        <div class="talktext">
                          <p>{{ $feedbackalls->feedback }}</p>
                        </div>
                      </div>
                    </td>
                  <tr>
                <tbody>
              </table>
              <?php } ?>
              <!-- feedback -->
            </td>
            <td style="width:450px;border-color:#222;">
              <h3><img src="{{ asset('public/icon/star.png') }}" alt="" width="30px"> Favorite ( <span>{{ $num }}</span> )</h3>
              <hr style="border-color:#444;">
              <?php
              if($favorite != '' ){
              for ($i=0; $i < sizeof($users); $i++) {
                if($users[$i] != ''){
                  $usernow = User::find($users[$i]);

               ?>
                <div class="">
                  <a href="{{ url('user').'/'.$usernow->id }}">
                    <?php
                      $img = $usernow->avatar;
                      $pieces = explode("/", $img);
                      if($pieces[0] != 'public'){
                          print '<img class="img-thumbnail" style="'.$usernow->filter.'" src="'.$img.'" alt="" width="50px"> ';
                      }else{
                          print '<img class="img-thumbnail" style="'.$usernow->filter.'" src="'.asset($img).'" alt=""  width="50px"> ';
                      }
                     ?>
                     <span style="padding-left:10px; font-size:18px; color:#aaa;"> {{$usernow->name}}</span>
                  </a>

                  <hr  style="border-color:#444;">
                </div>
              <?php } } } ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
