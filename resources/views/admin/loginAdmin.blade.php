<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin ML</title>
    <script type="text/javascript" src="{{ asset('public') }}/jquery-3.1.1.min.js"></script>
    <link href="{{ asset('public/bootstrap-social-gh-pages\bootstrap-social.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/bootstrap-3.3.7\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('public') }}/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('public') }}\bootstrap-3.3.7\js\bootstrap.min.js"></script>
  </head>
  <body>
    <div class="col-md-4 col-md-offset-4" style="margin-top:100px;">
      <div class="panel panel-default" style="border-color:#aaa;">
        <form class="" action="{{ url('/checklogin') }}" method="post">
          {{ csrf_field() }}
          <div class="panel-body">
            <div class="" align="center">
              <img src="{{ asset('public\icon.png') }}" alt="" width="180px"><br>
              <hr style="width:200px; border-color:#aaa; margin:5px;">
              <label for="" style="font-size:20px;">Managelife(ML) - Admin</label>
              <hr>
            </div>
            <div class="" align="center">
              <div class="" style="width:300px;">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input id="id" type="text" class="form-control" name="id" placeholder="id">
                </div><br>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
              </div>
              <hr>
            </div>
            <div class="" align="center">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Login</button>
            </div>
            <div class="" align="center" style="background-color:rgb(113, 113, 113); margin:10px; border-radius:5px; padding:10px;color:#fff;">
              www.Managelife.com By Paramat Singkon
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
