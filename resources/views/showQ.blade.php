@extends('layouts.app')
@section('content')
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link href="{{asset('public/bootstrap-social-gh-pages\bootstrap-social.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('public\css\home.css') }}" rel="stylesheet" type="text/css">
<?php
use App\Answer;
use App\Question;
use App\User;
use Illuminate\Support\Facades\DB;

$touer = url('/user');
$touer .= '/'.$Q->user_id;
   ?>
   <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
      bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
   </script>
<div class="col-md-10 col-md-offset-1">
  <div class="" style="background-color:#444; margin-bottom:20px;">
    <div class="panel-body">
      <form class="" action="{{ url('EditQuestion') }}" method="post">
          <div style="padding-left:10px;padding-right:10px;">
            <?php
              $findid = DB::table('answer')
                            ->where('Q_id', '=',$Q->id)
                            ->count();
             ?>
             <div class="">
               <p>
                {{ $Q->created_at }}
               </p>
              <p style="font-size:20px; float:right; color:#aaa;">Answer({{ $findid }})</p>
             </div>
             <div id="showtopic" class="">
               <p style="font-size:20px; color:#fff;">{{ $Q->topic }}</p>
             </div>

        <hr style="margin:10px; border-color:#aaa;">
        <div style="padding:10px; color:#aaa;" >
          <div id="showquestioned" class="">
            <?php
            print $Q->questioned;
             ?>
          </div>
          </div>
        </div>
      </form>
      <br>
      <hr style="margin:10px; border-color:#aaa;">
      <?php
      $user = User::find($Q->user_id);
      $touer = url('/user');
      $touer .= '/'.$user->id;
       ?>
      <a href="{{ $touer }}" class="btnMenulife">
        @if($user->provider == 'managelife')
        <img class="img-circle"   style="{{ $user->filter }}" src="{{ asset($user->avatar) }}" alt="" width="40px">
        @else
        <img class="img-circle"   style="{{ $user->filter }}" src="{{ $user->avatar }}" alt="" width="40px">
        @endif
        <span for="" style="font-size:17px; color:#aaa;"><b>{{ $user->name }}</b></span>
      </a>
      @if(Auth::user()->id ==  $user->id)
      <?php
      $toedit = url('/toedit');
      $toedit .= '/'.$Q->id;
      $todeleteQ = url('/deleteQ').'/'.$Q->id;
       ?>
      <p style="float: right; font-size:18px;">
        <a href="{{ $toedit }}"><i class="glyphicon glyphicon-pencil"></i></a>
        <a href="{{ $todeleteQ }}"><i class="glyphicon glyphicon-trash"></i></a>
      </p>
      @endif
      <br>
      <span for="" style="font-size:17px; color:#aaa; float: right;">{{ humanTiming(strtotime($Q->created_at)) }}</span>
    </div>
  </div>
</div>
<script type="text/javascript">
  function EditQ() {
    $('#editquestioned').fadeIn();
    $('#edittopic').fadeIn();
  }
  function closeEditQ() {
    $('#EditQ').fadeOut();
  }
</script>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||| Answer ||||||||||||||||||||||||||||||||||||||||||-->
<?php
$answers = DB::table('answer')
              ->where('Q_id', '=',$Q->id)
              ->get();
foreach ($answers as $answer) {
 ?>
<div class="col-md-9 col-md-offset-2">
  <div class="" style="background-color:#444; margin-bottom:20px;">
    <div class="panel-body">
        <div style="padding-left:10px;padding-right:10px;">
           <div class="" >
             <span for="" style="font-size:15px; color:#aaa; float: left;">{{ humanTiming(strtotime($answer->created_at)) }}</span>
             <p align="right">
              {{ $answer->created_at }}
             </p>
           </div>

        </div>

      <hr style="margin:10px; border-color:#aaa;">
      <div style="padding:10px; color:#aaa;" >
        <?php
        print $answer->answered;
         ?>
      </div>
      <br>
      <hr style="margin:10px; border-color:#aaa;">
      <?php
      $user2 = User::find($answer->user_id);
      $touer = url('/user');
      $touer .= '/'.$user2->id;
       ?>
      <a href="{{ $touer }}" class="btnMenulife">
        @if($user->provider == 'managelife')
        <img class="img-circle"   style="{{ $user2->filter }}" src="{{ asset($user2->avatar) }}" alt="" width="40px">
        @else
        <img class="img-circle"   style="{{ $user2->filter }}" src="{{ $user2->avatar }}" alt="" width="40px">
        @endif
        <span for="" style="font-size:17px; color:#aaa;"><b>{{ $user2->name }}</b></span>
      </a>
      <p style="float: right; font-size:18px;">
        <?php
        $urldelete = url('deleteA').'/'.$answer->id.'/'.$Q->id;
        $urledit = url('editA').'/'.$answer->id.'/'.$Q->id;
         ?>
         @if($answer->user_id == Auth::user()->id)
           <a href="{{ $urledit }}"><i class="glyphicon glyphicon-pencil"></i></a>
           <a href="{{ $urldelete }}"><i class="glyphicon glyphicon-trash"></i></a>
         @endif
      </p>
      <br>

    </div>
  </div>
</div>
<?php
}
 ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||| Add Answer ||||||||||||||||||||||||||||||||||||||||||-->
<div class="col-md-10 col-md-offset-1">
  <div class="" style="background-color:#444; margin-bottom:20px;">
    <div class="panel-body">
        <div style="padding-left:10px;padding-right:10px;">
          <?php
            $findid = DB::table('answer')
                          ->where('Q_id', '=',$Q->id)
                          ->count();
           ?>

      <hr style="margin:10px; border-color:#aaa;">
      <form class="" action="{{ url('AddAnswer') }}" method="post">
      <div style="padding:10px; color:#aaa;" >
        <div id="sample" style="color:#aaa;">
            <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
          //<![CDATA[
                  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
            //]]>
            </script>
            <textarea name="answered" style="width:100%;height:200px;" >
                 Input yor answer
            </textarea>
            {{ csrf_field() }}
            <input type="hidden" name="Id_Q" value="{{ $Q->id }}">
            <input type="hidden" name="Id_user" value="{{ $Q->user_id }}">
            <div class="" align="right">
              <button href="#" class="btn btn-success" type="submit">
                Post answer
              </button>
            </div>
        </div>
      </div>
    </form>
      <br>
      <hr style="margin:10px; border-color:#aaa;">
      <?php
      $user = User::find($Q->user_id);
      $touer = url('/user');
      $touer .= '/'.$user->id;
       ?>
      <a href="{{ $touer }}" class="btnMenulife">
        @if($user->provider == 'managelife')
        <img class="img-circle"   style="{{ $user->filter }}" src="{{ asset($user->avatar) }}" alt="" width="40px">
        @else
        <img class="img-circle"   style="{{ $user->filter }}" src="{{ $user->avatar }}" alt="" width="40px">
        @endif
        <span for="" style="font-size:17px; color:#aaa;"><b>{{ Auth::user()->name }}</b></span>
      </a>
      <br>

    </div>
  </div>
</div>

   <?php
   function humanTiming ($time){
       $time = time() - $time; // to get the time since that moment
       $time = ($time<1)? 1 : $time;
       $tokens = array (
         31536000 => 'year ago',
         2592000 => 'month ago',
         604800 => 'week ago',
         86400 => 'day ago',
         3600 => 'hour ago',
         60 => 'minute ago',
         1 => 'second ago'
       );

       foreach ($tokens as $unit => $text) {
           if ($time < $unit) continue;
           $numberOfUnits = floor($time / $unit);
           return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
       }
   }
    ?>
    @endsection
