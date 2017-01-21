@extends('layouts.app')
@section('content')
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
<br>
<div class="col-md-8 col-md-offset-2">
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
      <div class="col-md-2">
        <div class="panel panel-default  border-radiusbox " style="background-color:#444; border-color:#333; " align="center">
          <div class="shadow" >
            <a href="{{ $touer }}" class="btnMenulife">
              <img  style="{{ $user->avatar }}" src="{{ $user->avatar }}" alt="" width="100%">
              <span for="" style="font-size:17px; color:#777;"><b>{{ $user->name }}</b></span>
            </a>
            <hr style="margin:2px; border-color:#555;">
            <a href="#" onclick="popup_worng('ssssssssss')" class="btnMenulife" style="color:#777">
              <span for="" style="font-size:13px;"><b>Remove friend</b></span>
            </a>
          </div>
        </div>
      </div>
      <?php   } } } ?>
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
@endsection
