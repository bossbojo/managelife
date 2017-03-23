<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link href="{{asset('public/bootstrap-social-gh-pages\bootstrap-social.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/bootstrap-3.3.7\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public\css\home.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('public\bootstrap-3.3.7\js\bootstrap.min.js') }}"></script>
<?php
use App\Answer;
use App\Question;
use App\User;
use Illuminate\Support\Facades\DB;

$q = Question::all();

if($q != '[]'){
foreach ($q as $qAll) {
  $showQ = url('/showQ');
  $showQ .= '/'.$qAll->id;
   ?>
    <div class="" style="background-color:#444; margin-bottom:20px;" id="{{ $qAll->id }}">
      <div class="panel-body">
        <a href="{{ $showQ }}" style="text-decoration: none !important;">
          <div class="qa" style="padding-left:10px;padding-right:10px;">
            <?php
              $findid = DB::table('answer')
                            ->where('Q_id', '=',$qAll->id)
                            ->count();
             ?>
            <div class="" style="font-size:20px; float: right; color:#aaa;">
              <p>Answer({{ $findid }})</p>
            </div>
            <div class="" style="font-size:15px;  color:#aaa;">
              <p>{{ $qAll->created_at }}</p>
            </div>
            <div class="">
              <p style="font-size:20px; color:#fff;">
                {{ $qAll->topic }}
              </p>
            </div>
          </div>
        </a>
        <hr style="margin:10px; border-color:#aaa;">
        <?php
        $user = User::find($qAll->user_id);
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
        <?php
        $toedit = url('/toedit');
        $toedit .= '/'.$qAll->id;
        $todeleteQ = url('/deleteQ').'/'.$qAll->id;
         ?>
         @if($qAll->user_id == Auth::user()->id)
        <p style="float: right; font-size:18px;">
          <a href="{{ $toedit }}"><i class="glyphicon glyphicon-pencil"></i></a>
          <a href="{{ $todeleteQ }}"><i class="glyphicon glyphicon-trash"></i></a>
        </p>
        @endif
        <br>
        <span for="" style="font-size:17px; color:#aaa; float: right;">{{ humanTiming(strtotime($qAll->created_at)) }}</span>
      </div>
    </div>
  <?php
  }
}else{
   ?>
   <div class="" align="center" style="background-color:#555;border-radius:5px;padding:5px; margin-top:10px;">
     <h4> Not question and answer</h4>
   </div>
   <?php
}
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
<script type="text/javascript">

</script>
