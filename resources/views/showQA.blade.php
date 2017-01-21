<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link href="{{asset('public/bootstrap-social-gh-pages\bootstrap-social.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/bootstrap-3.3.7\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public\css\home.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('public\bootstrap-3.3.7\js\bootstrap.min.js') }}"></script>
<?php
$touer = url('/user');
$touer .= '/'.Auth::user()->id;
  for ($i=0; $i < 10; $i++) {
   ?>
    <div class="" style="background-color:#444; margin-bottom:20px;">
      <div class="panel-body">
        <a href="#" style="text-decoration: none !important;">
          <div class="qa" style="padding-left:10px;padding-right:10px;">
            <p style="font-size:20px; text-align:right; color:#aaa;">
              Answer(10)
            </p>
            <p style="font-size:20px; color:#fff;">
              QUESTION
            </p>
          </div>
        </a>
        <hr style="margin:10px; border-color:#aaa;">
        <a href="{{ $touer }}" class="btnMenulife">
          <img class="img-circle"   style="{{ Auth::user()->avatar }}" src="{{ Auth::user()->avatar }}" alt="" width="40px">
          <span for="" style="font-size:17px; color:#aaa;"><b>{{ Auth::user()->name }}</b></span>
        </a>
        <span for="" style="font-size:17px; color:#aaa; float: right;">2 minute ago</span>
      </div>
    </div>
  <?php
}
   ?>
