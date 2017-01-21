@extends('layouts.app')
@section('content')
<div class="container">
  <br><br><br>
    <div class="row">
      <div class="col-md-7">
        <img src="{{ asset('public\logoweb.png') }}" width="100%" alt="">
      </div>
        <div class="col-md-5">
            <div class="panel panel-default" style="background-color:#000;border-color:#555;">
                <div class="panel-body">
                  <br>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-7">
                                <input style="border-radius:10px; border-color:#555; background-color:#000;" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-7">
                                <input style="border-radius:10px; border-color:#555; background-color:#000;"  id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-danger">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                            <br><br>
                            <div class="col-md-8 col-md-offset-2">
                           <a class="btn btn-block btn-social btn-facebook"  href="redirect/facebook">
                             <span class="fa fa-facebook"></span> Sign in with Facebook
                           </a>
                           <a class="btn btn-block btn-social btn-google"  href="redirect/google">
                             <span class="fa fa-google"></span> Sign in with Google+
                           </a>
                           <a class="btn btn-block btn-social btn-twitter"  href="redirect/twitter">
                             <span class="fa fa-twitter"></span> Sign in with Twitter
                           </a>
                         </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
