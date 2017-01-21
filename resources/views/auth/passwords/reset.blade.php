@extends('layouts.app')

@section('content')
<div class="container">
  <br><br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default"  style="background-color:#000;border-color:#555;">
                <div class="panel-heading" style="background-color:#222;border-color:#555; color:#aaa;">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input style="border-radius:10px; border-color:#555; background-color:#000;" id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <i id="checkemail"></i>
                            <script>
                            $('#email').keyup(function(){
                                var url2 = "{{ url('/checkemailresetpass') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: $("#email").serialize(), // serializes the form's elements.
                                       success: function(result){
                                         console.log(result);
                                         if(result=='success'){
                                           $( "#checkemail" ).css("color","#5d962b");
                                           $( "#checkemail" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
                                         }else{
                                           $( "#checkemail" ).css("color","red");
                                           $( "#checkemail" ).removeClass( "glyphicon glyphicon-ok-circle" ).addClass( "glyphicon glyphicon-remove-circle" );
                                         }
                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                     });
                            });
                            </script>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input style="border-radius:10px; border-color:#555; background-color:#000;" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <i id="checkpass"></i>
                            <script>
                              $('#password').keyup(function(){
                                if( $("#password").val().length < 8){
                                   $( "#checkpass" ).css("color","red");
                                   $( "#checkpass" ).removeClass( "glyphicon glyphicon-ok-circle" ).addClass( "glyphicon glyphicon-remove-circle" );
                                }else{
                                   $( "#checkpass" ).css("color","#5d962b");
                                   $( "#checkpass" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
                                }
                              });
                            </script>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input style="border-radius:10px; border-color:#555; background-color:#000;" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <i id="checkpass2"></i>
                            <script>
                              $('#password-confirm').keyup(function(){
                                if( $("#password-confirm").val() != $("#password").val() ){
                                   $( "#checkpass2" ).css("color","red");
                                   $( "#checkpass2" ).removeClass( "glyphicon glyphicon-ok-circle" ).addClass( "glyphicon glyphicon-remove-circle" );
                                }else{
                                   $( "#checkpass2" ).css("color","#5d962b");
                                   $( "#checkpass2" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
                                }
                              });
                            </script>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
