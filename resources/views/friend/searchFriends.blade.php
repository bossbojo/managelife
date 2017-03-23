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
<style media="screen">
  .shadow{
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.0);
    -moz-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.0);
    box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.0);
    transition: all 0.5s;
  }
  .shadow:hover{
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.75);
    transition: all 0.5s;
  }
</style>
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
                    <a href="{{ url('/fileupload') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                      <img  src="{{ asset('public/icon/uploadpng.png') }}" width="35" alt=""> File Upload
                    </a>
                  </li>
                  <li class="gw-submenu">
                    <a href="{{ url('/yourfavouriteto') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
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
  <br>
  <div class="col-md-9">
    <div class="panel panel-default  border-radiusbox" style="background-color:#333; border-color:#222; ">
      <div class="panel-heading border-radius-top-20px2" style="background-color:#cc9900; border-color:#222;">
        <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-user"></i> Your friends</label>
      </div>
      <div class="panel-body" style="border-color:#222;">
        <?php
        use Illuminate\Support\Facades\DB;
        use App\Alert_friends;
        if($searchFriends != '[]'){
        foreach ($searchFriends as $friends) {
         if($friends->id != Auth::user()->id ){
          $statusfriend ='';
          $statusfriend2 ='';
          $selectfriend = DB::table('alert_friend')
                          ->where([
                            ['user_id', '=', Auth::user()->id],
                            ['friend_id', '=', $friends->id],
                          ])->get();
          $selectfriend2 = DB::table('alert_friend')
                          ->where([
                            ['friend_id', '=', Auth::user()->id],
                            ['user_id', '=', $friends->id],
                          ])->get();

          foreach ($selectfriend as $selectfriendonly) {
            $statusfriend = $selectfriendonly;
          }
          foreach ($selectfriend2 as $selectfriendonly2) {
            $statusfriend2 = $selectfriendonly2;
          }
          if($statusfriend == ''){
            $statusfriend = $statusfriend2;
          }
          if($statusfriend2 == ''){
            $statusfriend2 = $statusfriend;
          }
        ?>
        <div class="col-md-12">
          <div class="panel-body" style="border-color:#222;">
            <table class="table table-condensed">
              <tbody>
               <tr>
                 <td style="border-color:#222;">
                   <a href="{{ url('/user').'/'.$friends->id }}" class="btnMenulife" >
                     <img  class="img-circle" style="border-color:#000; {{ $friends->filter }} " src=" {{ $friends->avatar }}" width="75px">
                     <span for="" style="font-size:150%; color:#aaa;">&nbsp;&nbsp; {{ $friends->name }}</span>
                   </a>
                 </td>
                 <td style="width:300px; border-color:#222; padding-top:25px;" align="right">
                   @if($statusfriend == null)
                   <a href="#" id="Addfriend" class="btn btn-default" style="display:;" onclick="addfriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-plus"></i> Add friend</a>
                   <a href="#" id="CancelAddFriend" class="btn btn-default" style="display:none;" onclick="CancelAddFriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-option-horizontal"></i> Requesting Add friend</a>
                   @endif
                   @if($statusfriend != null)
                     @if($statusfriend->status_alert =='requesting')
                        @if( $statusfriend->friend_id == Auth::user()->id )
                          <a href="#" id="AcceptfromUser" class="btn btn-default"  onclick="Acceptfriend('{{ $statusfriend->id }}')"><i class="glyphicon glyphicon-share-alt"></i> Accept requesting add friend</a>
                          <a href="#" id="RefusefromUser" class="btn btn-default"  onclick="Cancelfriend('{{ $statusfriend->id }}')"><i class="glyphicon glyphicon-minus"></i> Refuse friend</a>
                        @else
                          <a href="#" id="Addfriend" class="btn btn-default" style="display:none;" onclick="addfriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-plus"></i> Add friend</a>
                          <a href="#" id="CancelAddFriend" class="btn btn-default" style="display:;" onclick="CancelAddFriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-option-horizontal"></i> Requesting Add friend</a>
                        @endif
                     @endif
                     @if($statusfriend->status_alert == 'friend')
                     <a href="#" id="RemoveFriend" class="btn btn-default" style="display:;" onclick="RemoveFriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-option-horizontal"></i> Remove friend</a>
                     @endif
                  @endif
                  <a href="#" id="CancelAddFriend" class="btn btn-default" style="display:none;" onclick="CancelAddFriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-option-horizontal"></i> Requesting Add friend</a>
                   <a href="#" id="Addfriend" class="btn btn-default" style="display:none;" onclick="addfriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-plus"></i> Add friend</a>
                  <a href="#" id="RemoveFriend2" class="btn btn-default" style="display:none;" onclick="RemoveFriend('{{ Auth::user()->id }}','{{ $friends->id }}')"><i class="glyphicon glyphicon-option-horizontal"></i> Remove friend</a>

                 </td>
               </tr>
             </tbody>
            </table>
          </div>
        </div>
        <?php
        }
        ?>

        <?php

      }
    }else{
      ?>
      <div class="col-md-12">
        <div align="center">
          <label for="" style="font-size:20px;">
            <i class="glyphicon glyphicon-alert"></i> <b> Not found </b>
          </label>
        </div>
      </div>
      <?php
    }
         ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function popup_worng(title2) {
  var p = new Popelt({
    title: title2,
    closeButton: false,
    escClose: false,
    modal: true
  });
  p.addButton('OK','btn btn-danger', function(){

    p.close();
  });
  p.show();
}
</script>
<script>
    function addfriend(my_id,friend_id) {
      console.log('addfriend my '+my_id+' frined '+friend_id);
      var data2 = { Id : my_id ,
                    Id_friend : friend_id };
      var url2 = "{{ url('/addfriend') }}"; // the script where you handle the form input.
      $.ajax({
             type: "get",
             url: url2,
             data: data2, // serializes the form's elements.
             success: function(result){
               console.log(result);
               if(result=='success'){
                 $('#Addfriend').hide();
                 $('#CancelAddFriend').fadeIn();
               }
             },
             error: function(xhr,textStatus){ alert(textStatus);}
           });
    }
    function CancelAddFriend(my_id,friend_id) {
      console.log('CancelAddFriend my '+my_id+' frined '+friend_id);
      var data2 = { Id : my_id ,
                    Id_friend : friend_id };
      var url2 = "{{ url('/canceladdfriend') }}"; // the script where you handle the form input.
      $.ajax({
             type: "get",
             url: url2,
             data: data2, // serializes the form's elements.
             success: function(result){
               console.log(result);
               if(result=='success'){
                 $('#CancelAddFriend').hide();
                 $('#Addfriend').fadeIn();
               }
             },
             error: function(xhr,textStatus){ alert(textStatus);}
           });
    }
    function RemoveFriend(my_id,friend_id) {
      console.log('removeFriend my '+my_id+' frined '+friend_id);
      var data2 = { Id : my_id ,
                    Id_friend : friend_id };
      var url2 = "{{ url('/removefriend') }}"; // the script where you handle the form input.
      $.ajax({
             type: "get",
             url: url2,
             data: data2, // serializes the form's elements.
             success: function(result){
               console.log(result);
               if(result=='success'){
                 $('#RemoveFriend').hide();
                 $('#RemoveFriend2').hide();
                 $('#CancelAddFriend').hide();
                 $('#Addfriend').fadeIn();
               }
             },
             error: function(xhr,textStatus){ alert(textStatus);}
           });
    }
</script>
@endsection
