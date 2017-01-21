@extends('layouts.app')
@section('content')
  @if (!Auth::guest())
  <link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
  <script src="asset('public/popelt-v1.0-source.js')"></script>
  <link rel="stylesheet" href="{{ asset('public/css/setting.css') }}">
<div style="height:10px;"></div>
<div class="container">
    <div class="col-md-3" style="background-color:#333; padding:0px; border-top-left-radius: 2em; border-bottom-left-radius: 2em;">
      <div class="btn-group-vertical" style="width:100%;">
        <div class="" align="center" style="padding: 10px;">
          <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-cog"></i> settings</label>
        </div>
        <!-- btnsetting_that -->
        <a href="{{ url('settings\changepass') }}" class="btn btnsetting btnsetting_that" style="text-align:left; padding-left: 1cm; "><i class="glyphicon glyphicon-repeat"></i> Change password</a>
        <a href="{{ url('settings\editprofile') }}" class="btn btnsetting " style="text-align:left; padding-left: 1cm;"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
      </div>
      <div style="height:60px;"></div>
    </div>
    <div class="col-md-9 solid" style="background-color:#555; height:800px; border-top-right-radius: 2em; border-bottom-right-radius: 2em;">
        <div class="col-md-12">
          <div class="panel-body">
           <label for="" style="color:#fff; font-size:20px;"><img  src="{{ asset('public/icon/changepass.ico') }}" width="25" alt=""> Change Password</label>
             <div class="panel-body solid-top">
                <div class="col-md-10 col-md-offset-1" ><br>
                  <div class="panel panel-default"  style="background-color:#000;border-color:#555;">
                    <div class="panel-body">
                      <form id="changepassword" class="form-horizontal" role="form">
                          {{ csrf_field() }}
                          <label for="email" class="col-md-4 control-label">Old Password</label>
                          <div class="col-md-6">
                            <input style="border-radius:10px; border-color:#555; background-color:#000;" id="oldpassword" type="password" class="form-control" name="oldpassword"><br>
                          </div>
                          <div class="col-md-2">
                            <i id="oldcheck"></i>
                          </div>
                          <label for="email" class="col-md-4 control-label">New Password</label>
                          <div class="col-md-6">
                            <input style="border-radius:10px; border-color:#555; background-color:#000;" id="newpassword" type="password" class="form-control" name="newpassword"><br>
                          </div>
                          <div class="col-md-2">
                            <i id="checkpass"></i>
                          </div>
                          <label for="email" class="col-md-4 control-label">Confirm Password</label>
                          <div class="col-md-6">
                            <input style="border-radius:10px; border-color:#555; background-color:#000;" id="confirmpassword" type="password" class="form-control" name="confirmpassword"><br>
                          </div>
                          <div class="col-md-2">
                            <i id="checkpass2"></i>
                          </div>
                          <div class="form-group">
                              <div class="col-md-8 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary" disabled="" id="submitto">
                                      Reset Password
                                  </button>
                                  <label id="Worng" style="color:red; display:none;">**Old Password Worng**</label>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
             </div>
          </div>
        </div>
    </div>
</div>
<script>
  $('#newpassword').keyup(function(){
    if( $("#newpassword").val().length < 8){
       $('#submitto').prop('disabled', true);
       $( "#checkpass" ).css("color","red");
       $( "#checkpass" ).removeClass( "glyphicon glyphicon-ok-circle" ).addClass( "glyphicon glyphicon-remove-circle" );
    }else{
       $( "#checkpass" ).css("color","#5d962b");
       $( "#checkpass" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
    }
  });
  $('#confirmpassword').keyup(function(){
    if( ($("#confirmpassword").val() != $("#newpassword").val() ) ){
       $('#submitto').prop('disabled', true);
       $( "#checkpass2" ).css("color","red");
       $( "#checkpass2" ).removeClass( "glyphicon glyphicon-ok-circle" ).addClass( "glyphicon glyphicon-remove-circle" );
    }else{
       $('#submitto').prop('disabled', false);
       $( "#checkpass2" ).css("color","#5d962b");
       $( "#checkpass2" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
    }
  });
  function confirmclosebox() {
      var p = new Popelt({
        title: 'ท่านต้องการ "ออกจากระบบ" หรือไม่ เพื่อเริ่มระบบใหม่อีกครั้ง โดย login เข้าสู้ระบบใหม่โดยใช้ password ใหม่ของท่าน ',
        closeButton: false,
        escClose: false,
        modal: true
      });
      p.addButton('Yes','btn btn-danger', function(){
        $('#logout').click();
        p.close();
      });
      p.addCancelButton();
      p.show();
  }
  $("#changepassword").submit(function(e) {
  var url2 = "{{ url('/changepassword') }}"; // the script where you handle the form input.
  $.ajax({
         type: "POST",
         url: url2,
         data: $("#changepassword").serialize(), // serializes the form's elements.
         success: function(result) {
           console.log(result);
           if(result=='no'){
             $( "#oldcheck" ).css("color","red");
             $( "#oldcheck" ).addClass( "glyphicon glyphicon-remove-circle" );
             $('#Worng').fadeIn();
           }else{
            confirmclosebox();
            console.log(result);
             $( "#oldcheck" ).css("color","#5d962b");
             $( "#oldcheck" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
             $('#Worng').fadeOut();
           }
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
  e.preventDefault(); // avoid to execute the actual submit of the form.
});

</script>

@else
<a href="{{ url('login') }}" id="nologin"></a>
<script>
    $('#nologin')[0].click();
</script>
@endif
@endsection
