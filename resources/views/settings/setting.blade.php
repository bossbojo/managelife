@extends('layouts.app')
@section('content')
  @if (!Auth::guest())
<link rel="stylesheet" href="{{ asset('public/css/setting.css') }}">
<div style="height:10px;"></div>
<div class="container">
    <div class="col-md-3" style="background-color:#333; padding:0px; border-top-left-radius: 2em; border-bottom-left-radius: 2em;">
      <div class="btn-group-vertical" style="width:100%;">
        <div class="" align="center" style="padding: 10px;">
          <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-cog"></i> settings</label>
        </div>
        <!-- btnsetting_that -->
        @if(Auth::user()->provider == 'managelife')
        <a href="{{ url('settings\changepass') }}" class="btn btnsetting " style="text-align:left; padding-left: 1cm; "><i class="glyphicon glyphicon-repeat"></i> Change password</a>
        @endif
        <a href="{{ url('settings\editprofile') }}" class="btn btnsetting " style="text-align:left; padding-left: 1cm;"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
      </div>
      <div style="height:60px;"></div>
    </div>
    <div class="col-md-9 solid" style="background-color:#555; height:800px; border-top-right-radius: 2em; border-bottom-right-radius: 2em;">
        <div class="col-md-12">
          <img src="{{ asset('public\icon\settings.png') }}" alt="" width="100%">
        </div>
    </div>
</div>
  @else
  <a href="{{ url('login') }}" id="nologin"></a>
  <script>
      $('#nologin')[0].click();
  </script>
  @endif
@endsection
