@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
  <br><br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color:#000;border-color:#555;">
                <div class="panel-heading" style="background-color:#222;border-color:#555; color:#aaa;">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input style="border-radius:10px; border-color:#555; background-color:#000;" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
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
