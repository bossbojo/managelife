<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link href="{{asset('public/bootstrap-social-gh-pages\bootstrap-social.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/bootstrap-3.3.7\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public\css\home.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('public\bootstrap-3.3.7\js\bootstrap.min.js') }}"></script>
<?php
use App\Statuspost;
use App\Commentpost;
use Illuminate\Support\Facades\DB;
use App\User;

$users = DB::table('alert_friend')
                ->join('status', 'status.user_id', '=', 'alert_friend.friend_id')
                ->join('users', 'users.id', '=', 'alert_friend.friend_id')
                ->select('status.*','alert_friend.friend_id','users.avatar','users.name','users.filter')
                ->where([
                          ['alert_friend.user_id', '=', Auth::user()->id],
                        ])
                ->orderBy('status.updated_at', 'desc')
                ->get();

if($users == '[]'){ ?>
  <div class="panel panel-default" style=" border:0px; background-color:#111;">
    <div class="panel-body" style="background-color:#111; border:0px;"  align="center">
      <img src="{{ asset('public\icon\not_status.png') }}" alt="" width="50%">
      <h1 style="color:#999;">{{ Auth::user()->name }} no status!</h1>
    </div>
  </div>
<?php
}else{
foreach ($users as $yourstatus) {
  if($yourstatus->vision == 'friends' || $yourstatus->vision == 'public'){
 ?>

  <div class="panel panel-default border-radiusbox" id="{{ $yourstatus->id }}">
      <div class="panel-heading border-radius-top-20px2" style="background-color:#cc9900;">
        <div class="" style="position:absolute; right:20px;">
            <div class="dropdown " >
              <a class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="border:0px; background-color:#cc9900; color:#666;">
              <i class="glyphicon glyphicon-cog"></i><span style="" class="caret">
              </a>
            </a>
            <?php
              $path = explode("/", $yourstatus->path);
              $namefile = $path[sizeof($path)-1];
              $pieces = explode(".", $yourstatus->path);
              $typefile = $pieces[count($pieces)-1];
             ?>
             @if($yourstatus->friend_id == Auth::user()->id)
              <ul class="dropdown-menu dropdown-menu-right" style="background-color:#888;">
                @if($yourstatus->type != 'text')
                <li><a href="#" onclick="editport( '{{ $yourstatus->id }}' ,'{{ $yourstatus->status }}' ,'{{ asset($yourstatus->path) }}' ,'{{ $typefile }}','{{ $yourstatus->type }}' )"><i class="glyphicon glyphicon-cog"></i> Edit</a></li>
                @else
                <li><a href="#" onclick="editporttext( '{{ $yourstatus->id }}' ,'{{ $yourstatus->status }}'  )"><i class="glyphicon glyphicon-cog"></i> Edit</a></li>
                @endif
                <li><a href="#" onclick="deleteport( '{{ $yourstatus->id }}' )"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
              </ul>
              @else
              <ul class="dropdown-menu dropdown-menu-right" style="background-color:#888;">
                <li><a href="#" onclick="More( '{{ $yourstatus->id }}' )"><i class="glyphicon glyphicon-exclamation-sign"></i> Report</a></li>
              </ul>
              @endif
            </div>
        </div>
          <a href="{{ url('/user/').'/'.$yourstatus->friend_id }}" class="btnMenulife" style="color:#000;">
            <img class="img-circle" style="{{ $yourstatus->filter }}" src="{{ asset(''.$yourstatus->avatar) }}" width="60px">
            <label for="" style="font-size:18px;">{{ $yourstatus->name }}</label>
          </a>
          <span style="color:#555; padding-top:-20; font-size:12px;" >
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <i class="glyphicon glyphicon-time"></i>
            <?php print humanTiming(strtotime($yourstatus->created_at)); ?>
          </span>
          <span style="color:#555; padding-top:-20; font-size:12px;" >
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <i class="glyphicon glyphicon-eye-open"></i>
            <?php print $yourstatus->vision; ?>
          </span>

      </div>
      <div class="panel-body">
          <label id="status{{ $yourstatus->id }}" for="" style="font-size:15px; color:#fff;"><?php print $yourstatus->status; ?></label>
          @if($yourstatus->type != 'text')
          <hr style="border-color:#888; ">
          <div class="panel-body" style="text-align:center;">
          @endif
            @if($yourstatus->type == 'image')
              <img style="margin:-20px;" class="img-thumbnail" src="{{ asset($yourstatus->path) }}" alt="" width="75%">
            @endif
            @if($yourstatus->type == 'video')
              <video style="width:75%;" controls  src="{{ asset($yourstatus->path) }}"></video>
            @endif
            @if($yourstatus->type == 'audio')
              <audio style="width:75%;" controls  src="{{ asset($yourstatus->path) }}"></audio>
            @endif
            @if($yourstatus->type == 'application')
                  @if($typefile =='pdf')
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="background-color:#333; border-color:#222;">
                      <div class="panel-body">
                        <a href="{{ asset($yourstatus->path) }}" class="btnMenulife">
                          <div class="col-md-4" style="border-right: 2px solid #222;">
                            <img src="{{ asset('public\icon\preview_pdf.png') }}" alt="" width="100%">
                          </div>
                          <div class="col-md-8" >
                            <button type="button" class="btnview" style="background-color:#444; ">
                              {{ $namefile }}
                            </button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  @elseif($typefile =='doc' || $typefile =='docx')
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="background-color:#333; border-color:#222;">
                      <div class="panel-body">
                        <a href="{{ asset($yourstatus->path) }}" class="btnMenulife">
                          <div class="col-md-4" style="border-right: 2px solid #222;">
                            <img src="{{ asset('public\icon\preview_doc.png') }}" alt="" width="100%">
                          </div>
                          <div class="col-md-8" >
                            <button type="button" class="btnview" style="background-color:#444; ">
                              {{ $namefile }}
                            </button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  @elseif($typefile =='ppt' || $typefile =='pptx')
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="background-color:#333; border-color:#222;">
                      <div class="panel-body">
                        <a href="{{ asset($yourstatus->path) }}" class="btnMenulife">
                          <div class="col-md-4" style="border-right: 2px solid #222;">
                            <img src="{{ asset('public\icon\preview_pp.png') }}" alt="" width="100%">
                          </div>
                          <div class="col-md-8" >
                            <button type="button" class="btnview" style="background-color:#444; ">
                              {{ $namefile }}
                            </button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  @elseif($typefile =='xlsx' || $typefile =='xlsm' || $typefile =='xlsb')
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="background-color:#333; border-color:#222;">
                      <div class="panel-body">
                        <a href="{{ asset($yourstatus->path) }}" class="btnMenulife">
                          <div class="col-md-4" style="border-right: 2px solid #222;">
                            <img src=" {{ asset('public\icon\preview_excel.png' )}}" alt="" width="100%">
                          </div>
                          <div class="col-md-8" >
                            <button type="button" class="btnview" style="background-color:#444; ">
                              {{ $namefile }}
                            </button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="background-color:#333; border-color:#222;">
                      <div class="panel-body">
                        <a href="{{ asset($yourstatus->path) }}" class="btnMenulife">
                          <div class="col-md-4" style="border-right: 2px solid #222;">
                            <img src="{{ asset('public\icon\preview_file.png') }}" alt="" width="100%">
                          </div>
                          <div class="col-md-8" >
                            <button type="button" class="btnview" style="background-color:#444; ">
                              {{ $namefile }}
                            </button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  @endif
            @endif
          @if($yourstatus->type != 'text')
          </div>
          @endif
          <hr style="border-color:#888; margin-top:20px; margin-bottom:0px;">
          <div style="padding-top:-10px;">

            <?php
            // check i think so
              $thinksomeme = explode(",", $yourstatus->thinkso);
              $thinksome = 'no';
              $thinksomeId = '';
              $thinksopoint = '';
              if(sizeof($thinksomeme) != 0){
                if($thinksomeme[0] != ''){
                  $thinksopoint = "(".sizeof($thinksomeme).")";
                }
              }
              for($i = 0 ; $i< sizeof($thinksomeme) ;$i++ ){
                if($thinksomeme[$i] == Auth::user()->id){
                  $thinksome = 'yes';
                  $thinksomeId = $thinksomeme[$i];
                  print '<a href="#" style="display:none;" id="saveThinkso'.$yourstatus->id.'" onclick="saveThinkso(\''.$yourstatus->id.'\',\''.url('/saveThinkso').'\',\''.Auth::user()->id.'\')" class="btn btn-default" style="background-color:#555; border:0px;">I think so. '.$thinksopoint.'</a> ';
                  print '<a href="#" id="deleteThinkso'.$yourstatus->id.'" onclick="deleteThinkso(\''.$yourstatus->id.'\',\''.url('/deleteThinkso').'\',\''.Auth::user()->id.'\')" class="btn btn-default" style="background-color:#555; border:0px; color:#fff;">I think so. '.$thinksopoint.'</a> ';
                }
              }
              if($thinksome == 'no'){
                print '<a href="#" id="saveThinkso'.$yourstatus->id.'" onclick="saveThinkso(\''.$yourstatus->id.'\',\''.url('/saveThinkso').'\',\''.Auth::user()->id.'\')" class="btn btn-default" style="background-color:#555; border:0px;">I think so. '.$thinksopoint.'</a> ';
                print '<a href="#" style="display:none;" id="deleteThinkso'.$yourstatus->id.'" onclick="deleteThinkso(\''.$yourstatus->id.'\',\''.url('/deleteThinkso').'\',\''.Auth::user()->id.'\')" class="btn btn-default " style="background-color:#555; border:0px; color:#fff;">I think so. '.$thinksopoint.'</a> ';
              }

            $getcomment = DB::table('comment_post')
                    ->join('users', 'comment_post.user_id', '=', 'users.id')
                    ->where('status_id', 'like', $yourstatus->id)
                    ->get();
             ?>
            <a href="#" class="btn btn-default" id="countcommnet{{ $yourstatus->id }}" onclick="showComment('{{ $yourstatus->id }}')" style="background-color:#555; border:0px;"><i class="glyphicon glyphicon-comment"></i> Comments ({{ sizeof($getcomment) }})</a>
          </div>
          <div class="comments" style="display:none;" id="showcommet{{ $yourstatus->id }}">

            <div class="panel-body" >
              <div class="col-md-10 col-md-offset-1" style=" margin-top:-15px; ">

                <div id="showdatatable{{ $yourstatus->id }}">
                  <table style="width:100%" >
                    <tr>
                        <td align="center">
                          <img src="{{ asset('public/icon/loading.gif') }}" alt="" width="25px">
                        </td>
                    </tr>
                  </table>
                </div>
                <hr style="border-color:#888; margin:5px;">
                <table style="width:100%">
                <tr>
                  <?php
                    $img = Auth::user()->avatar;
                    $check = explode("/", $img);
                    if($check[0] == 'public'){
                      $img = asset(Auth::user()->avatar);
                    }
                   ?>
                  <td style="width:{{ strlen(Auth::user()->name)+150 }}px;">
                    <img  class="img-circle" style="border-color:#000; {{ Auth::user()->filter }}" src="{{ $img }}" width="40px">
                    &nbsp;{{ Auth::user()->name }}
                  </td>
                  <td>
                      <input type="text"  class="form-control"  onkeydown="if (event.keyCode == 13) { submitComment('{{ $yourstatus->id }}' , '{{  Auth::user()->id }}') }" style=" resize: none;" id="comment{{ $yourstatus->id }}" name="comment{{ $yourstatus->id }}" rows="1" width="100%" placeholder="แสดงความคิดเห็น" >
                  </td>
                </tr>
                </table>
              </div>
            </div>
          </div>
      </div>
  </div>
<?php } } }?>
<div style="height:700px;"></div>
<?php
function humanTiming ($time){
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
 ?>
