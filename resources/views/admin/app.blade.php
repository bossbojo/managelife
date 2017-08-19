<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="{{ asset('public') }}/jquery-3.1.1.min.js"></script>
    <link href="{{ asset('public/bootstrap-social-gh-pages\bootstrap-social.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/bootstrap-3.3.7\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('public') }}\bootstrap-3.3.7\js\bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('public/navbarleft/slidebars.css') }}">
    <link rel="stylesheet" href="{{ asset('public/navbarleft/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <title></title>
  </head>
  <style media="screen">
    .btnmanu{
      color: #888;
      margin: 5px;
      width: 100%;
      background-color: #222;
      text-align: left ;
      border-style: none;
      padding: 5px;
      font-size: 18px;
      border-bottom: 1px solid #444;
      transition-duration: 0.4s;
      border-radius: 5px;
    }
    .btnmanu:hover{
      color: #fff;
      background-color: #111;
    }
    .btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
    }
    .btn-circle.btn-lg {
      width: 50px;
      height: 50px;
      padding: 10px 16px;
      font-size: 18px;
      line-height: 1.33;
      border-radius: 25px;
    }
    .btn-circle.btn-xl {
      width: 70px;
      height: 70px;
      padding: 10px 16px;
      font-size: 24px;
      line-height: 1.33;
      border-radius: 35px;
    }
  </style>
  <body>
    <div off-canvas="slidebar-1 left push" style="background-color:#222; width:300px;">
      <div class="" align="center">
        <img src="public\icon\adminicon.png" alt="" width="80%"><br>
        Managelife - Admin
      </div>
      <hr style="margin:5px; border-color:#444;">
      <a id="home" href="{{ url('/adminhome') }}" class="btn btnmanu"><i class="glyphicon glyphicon-home"></i> Home</a>
      <a id="Blocking" href="{{ url('/Blocking') }}" class="btn btnmanu"><i class="glyphicon glyphicon-ban-circle"></i> Blocking</a>
      <a id="Contacting" href="{{ url('/Contacting') }}" class="btn btnmanu"><i class="glyphicon glyphicon-comment"></i> Contacting</a>
      <!-- <a id="Report" href="{{ url('/Report') }}" class="btn btnmanu"><i class="glyphicon glyphicon-info-sign"></i> Report</a> -->
      <a href="{{ url('/logOutadmin') }}" class="btn btnmanu"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
		</div>
  </body>
  <script src="{{ asset('public/navbarleft/slidebars.js') }}"></script>
  <script src="{{ asset('public/navbarleft/scripts.js') }}"></script>
</html>
