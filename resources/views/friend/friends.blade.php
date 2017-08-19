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
  <div class="col-md-9">
    <div class="panel panel-default  border-radiusbox" style="background-color:#333; border-color:#222; ">
      <div class="panel-heading border-radius-top-20px2" style="background-color:#cc9900; border-color:#222;">
        <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-user"></i> Your friends</label>
      </div>
      <div class="panel-body" style="border-color:#222;">
        <?php
        use Illuminate\Support\Facades\DB;
        use App\Alert;
        use App\Alert_friends;
        use App\User;
        $friend = DB::table('alert_friend')
                  ->where([
                    ['user_id', 'like', Auth::user()->id],
                    ['status_alert', 'like', 'friend'],
                  ])
                  ->get();
        if($friend == '[]'){
        ?>
        <p style="font-size:30px; text-align:center; padding:20px;">
          <b>You not friend !</b>
        </p>
        <?php
        }else{
        foreach ($friend as $friends) {
          if($friends->status_alert	== 'friend'){
            $user = User::find($friends->friend_id);
            $touer = url('/user');
            $touer .= '/'.$user->id;
         ?>
        <div class="col-md-2" id="div{{ $user->id }}">
          <div class="panel panel-default  border-radiusbox " style="background-color:#444; border-color:#333; " align="center">
            <div class="shadow" >
              <a href="{{ $touer }}" class="btnMenulife">
                <img  style="{{ $user->avatar }}" src="{{ $user->avatar }}" alt="" width="100%">
                <span for="" style="font-size:17px; color:#777;"><b>{{ $user->name }}</b></span>
              </a>
              <hr style="margin:2px; border-color:#555;">
              <a href="#" onclick="popup_worng('คุณต้องการที่จะลบเพื่อนคนนี้ใช่หรือไม่',{{$user->id}})" class="btnMenulife" style="color:#777">
                <span for="" style="font-size:13px;"><b>Remove friend</b></span>
              </a>
            </div>
          </div>
        </div>

        <?php   } } } ?>
      </div>
    </div>
  </div>
</div>
<br>

<script type="text/javascript">
function popup_worng(title2,id) {
   var p = new Popelt({
        title: title2,
        closeButton: false,
        escClose: false,
        modal: true
      });
      p.addButton('Yes','btn btn-danger', function(){
              var data2 = { Id : '{{ Auth::user()->id }}' ,
                            Id_friend : id };
              var url2 = "{{ url('/removefriend') }}"; // the script where you handle the form input.
              $.ajax({
                     type: "get",
                     url: url2,
                     data: data2, // serializes the form's elements.
                     success: function(result){
                       console.log(result);
                       if(result=='success'){
                        $('#div'+id).fadeOut();
                       }
                     },
                     error: function(xhr,textStatus){ alert(textStatus);}
                   });
        p.close();
      });
      p.addCancelButton();
      p.show();
}
</script>
@endsection
