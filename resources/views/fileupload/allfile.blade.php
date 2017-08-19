@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/menubar/bs_leftnavi.css') }}">
<script src="{{ asset('public/css/menubar/bs_leftnavi.js') }}"></script>
<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery_from/jquery.form.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/jquery-ui\jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('public/popelt-v1.0-source.js') }}"></script>
<style media="screen">
  .shadow{
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.0);
    -moz-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.0);
    box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.0);
    transition: all 0.5s;
  }
  .shadow:hover{
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 29px 0px rgba(0,0,0,0.75);
    transition: all 0.5s;
  }
</style>
<div class="container-fluid" style="background-color:#111; margin-left:-0px;" >
  <div class="col-md-3" id="menubarleft" style=" margin-left:-25px;" >

    <div class="panel panel-default" style="border-radius-: 20px; background-color:#111; border-color:#111;">
        <div class="panel-heading border-radius-top-20px" style=" background-color:#cc9900; border-color:#888; text-align:center;" align="center" >
          <a href="{{ url('home') }}" class="btnMenulife" align="center">
              <img  class="img-circle" style="border-color:#000; {{ Auth::user()->filter }} " src="{{ asset(''.Auth::user()->avatar) }}" width="100px">
              <span for="" style="font-size:150%; color:#000;"> {{ Auth::user()->name }}</span>
          </a>
        </div>
        <div class=" border-radius-bottom-20px" style="border-color:#111;">
              <div class="nano-content">
                <ul class="gw-nav gw-nav-list">
                  <li class="init-arrow-down">
                    <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                      <img  src="{{ asset('public/icon/portfolio.png') }}" width="35" alt=""> Portfolio <b class="gw-arrow"></b>
                    </a>
                    <ul class="gw-submenu">
                      <li>
                        <a href="{{ url('/portfolio') }}" style=" font-size:17px; padding-top:10px; padding-left:120px; " >
                          <img  src="{{ asset('public/icon/preview.png') }}" width="25" alt=""> Preview Portfolio
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/feedback') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/feedback-icon-3.png') }}" width="25" alt=""> Feedback Portfolio
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/customportfolio') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/edit.png') }}" width="25" alt=""> Edit Portfolio
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="gw-submenu">
                    <a href="{{ url('/fileupload') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                      <img  src="{{ asset('public/icon/uploadpng.png') }}" width="35" alt=""> File Upload
                    </a>
                  </li>
                  <li class="gw-submenu">
                    <a href="{{ url('/yourfavouriteto') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                      <img  src="{{ asset('public/icon/star.png') }}" width="35" alt=""> Your favourite
                    </a>
                  </li>
                  <li class="gw-submenu">
                    <a href="{{ url('/yourfriends') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                      <img  src="{{ asset('public/icon/friend.png') }}" width="35" alt=""> Friends
                    </a>
                  </li>
                  <li class="init-arrow-down">
                    <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                      <img  src="{{ asset('public/icon/settings.png') }}" width="35" alt=""> Setting <b class="gw-arrow"></b>
                    </a>
                    <ul class="gw-submenu">
                      <li>
                        <a href="{{ url('settings') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/settings.png') }}" width="25" alt=""> Setting
                        </a>
                      </li>
                      @if(Auth::user()->provider == 'managelife')
                      <li>
                        <a href="{{ url('settings/changepass') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/changepass.ico') }}" width="25" alt=""> Change Password
                        </a>
                      </li>
                      @endif
                      <li>
                        <a href="{{ url('settings/changeimage') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/camerachage.png') }}" width="25" alt=""> Change image profile
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('settings/changeimagecover') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/imgcover.png') }}" width="25" alt=""> Change image cover
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('settings/editprofile') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                          <img  src="{{ asset('public/icon/editprofile.png') }}" width="25" alt=""> Edit Profile
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="gw-submenu">
                    <a href="#" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                      <img  src="{{ asset('public/icon/contact-us.png') }}" width="35" alt=""> contact us
                    </a>
                  </li>
                  <li class="gw-submenu">
                    <a href="#" onclick="confirmclosebox()" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                      <img  src="{{ asset('public/icon/logout.png') }}" width="35" alt=""> Logout
                    </a>
                  </li>
                  <br><br>
                  <li class="gw-submenu" style="text-align:center;">
                      <button href="#" class="btnMenulife"><img style="margin:-16px ;" src="{{ asset('favicon.ico') }}" width="200" alt=""></button>
                  </li>
              </div>
              <br><br><br><br><br>
        </div>
    </div>
  </div>
  <?php
  use Illuminate\Support\Facades\DB;
  use App\Indexportfolio;
  use App\Dataportfolio;
  use App\Favorite;
  use App\Feedback;
  use App\User;
  use App\Fileupload;

  $p = (Auth::user()->disk*100)/Auth::user()->limitdisk;
  $p = number_format($p, 2, '.', '');
   ?>
  <div class="col-md-9">
    <div class="panel panel-default  border-radiusbox" style="background-color:#333; border-color:#222; ">
      <div class="panel-heading border-radius-top-20px2" style="background-color:#cc9900; border-color:#222;">
        <label for="" style="font-size:20px;"><i style="color:rgb(71, 111, 213);" class="glyphicon glyphicon-folder-open"></i> File all</label>
        <span style="float:right;" >
          <div class="" style="width:250px;">
            <i class="glyphicon glyphicon-hdd"></i> your disk :  <span>{{ number_format(Auth::user()->disk, 2, '.', '') }} MB</span>/<span>{{ Auth::user()->limitdisk }} MB</span>
            <div class="progress" style="height:10px; width:220px;">
              <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{ $p }}%;" style="height:20px;"></div>
            </div>
          </div>
         </span>
      </div>
      <div class="panel-body" style="border-color:#222;">
        <div class="col-md-12">
          <div class="col-md-2">
            <div class="panel panel-default  border-radiusbox " style="background-color:#444; border-color:#333; " align="center">
              <div class="shadow" >
                <a href="#" onclick="openportfile()" class="btnMenulife">
                  <img  src="{{ asset('public\icon\Folder-icon.png') }}" alt="" width="100%">
                  <span for="" style="font-size:17px; color:#777;"><b>Portfolio</b></span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="panel panel-default  border-radiusbox " style="background-color:#444; border-color:#333; " align="center">
              <div class="shadow" >
                <a href="#" onclick="openyourfile()" class="btnMenulife">
                  <img  src="{{ asset('public\icon\Folder-icon.png') }}" alt="" width="100%">
                  <span for="" style="font-size:17px; color:#777;"><b>Your file</b></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- table portfolio-->
        <div id="portfoliofile" class="col-md-12" style="color:rgb(128, 128, 128); display:none;">
          <table id="example" class="table  table-bordered" cellspacing="0" width="100%" style="border-color:#555;">
            <thead style="border-color:#555;">
                <tr>
                    <th style="border-color:#555;">Namefile</th>
                    <th style="border-color:#555;">Size file</th>
                    <th style="border-color:#555;">Type file</th>
                    <th style="border-color:#555;">Date</th>
                    <th style="border-color:#555;">Manage</th>
                </tr>
            </thead>
            <tbody>
              <?php
              $fileall = Indexportfolio::find(Auth::user()->id);
              $idsplit = explode(",", $fileall->phpindex);
              for ($i=0; $i < sizeof($idsplit) ; $i++) {
                $file = Dataportfolio::find($idsplit[$i]);
                if($file->sizefile != ''){
                  $filedetail;
                  $pathfile;
                  if($file->video != ''){
                    $pathfile =  $file->video;
                    $path = explode("/", $file->video );
                    $filedetail = explode(".", $path[sizeof($path)-1]);
                  }
                  if($file->img != ''){
                    $pathfile =  $file->img;
                    $path = explode("/", $file->img);
                    $filedetail = explode(".", $path[sizeof($path)-1]);
                  }
               ?>
                <tr>
                    <td style="border-color:#555;">{{ $filedetail[0] }}</td>
                    <td style="border-color:#555;">{{ $file->sizefile }}</td>
                    <td style="border-color:#555;">{{ $filedetail[1] }}</td>
                    <td style="border-color:#555;">{{ $file->created_at }}</td>
                    <td style="border-color:#555;" style="" align="center">
                      <a href="{{ $pathfile }}" onclick="Download( {{ $pathfile }})">
                        <img src="{{ asset('public\icon\Downloads.ico') }}" alt="" width="30px">
                      </a>
                    </td>
                </tr>
                <?php
                  }
                }
                 ?>
            </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        </script>
        </div>
        <!-- table Your file-->
        <div class="col-md-12" >
          <hr style="margin:10px; border-color:#555;">
          <div id="showupload" class="" style="display:;padding:5px;" align="right">
            <a href="#" class="btnMenulife" style="color:#aaa;" onclick="clickto()">
              <img src="{{ asset('public\icon\upload-icon.png') }}" alt="" width="40px"> Upload your file
            </a>
          </div>
        </div>
        <div id="yourfile" class="col-md-12" style="color:rgb(128, 128, 128); display:;">
          <table id="example2" class="table  table-bordered" cellspacing="0" width="100%" style="border-color:#555;">
            <thead style="border-color:#555;">
                <tr>
                    <th style="border-color:#555;">Namefile</th>
                    <th style="border-color:#555;">Size file</th>
                    <th style="border-color:#555;">Type file</th>
                    <th style="border-color:#555;">Date</th>
                    <th style="border-color:#555;">Manage</th>
                </tr>
            </thead>
            <tbody>
              <?php
              $yourfiles = DB::table('fileupload')
                              ->where([
                                ['user_id', '=', Auth::user()->id ]
                              ])->get();
              foreach ($yourfiles as $yourfile) {

               ?>
                <tr id="t{{ $yourfile->id }}">
                    <td style="border-color:#555;">{{ $yourfile->namefile }}</td>
                    <td style="border-color:#555;">{{ $yourfile->sizefile }}</td>
                    <td style="border-color:#555;">{{ $yourfile->type }}</td>
                    <td style="border-color:#555;">{{ $yourfile->created_at }}</td>
                    <td style="border-color:#555;" style="" align="center">
                      <a href="{{ $yourfile->file }}">
                        <img src="{{ asset('public\icon\Downloads.ico') }}" alt="" width="30px">
                      </a>
                      <a href="{{ url('/delectfile').'/'.$yourfile->id }}">
                        <img src="{{ asset('public\icon\delete-xxl.png') }}" alt="" width="30px">
                      </a>
                    </td>
                </tr>
                <?php
              }
                 ?>
            </tbody>
        </table>
        <form id="uploadfiletosave">
          <input type="hidden" value="{{csrf_token() }}" name="_token">
          <input id="file" type="file" name="file" value="" style="display:none;" onchange="gotosumit()">
          <input id="Isubmit" type="submit" name="" value="" style="display:none;">
        </form>
        <div id="pg" class="progress" style="height:5px; display:none;">
          <div id="pc" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%"></div>
        </div>
        <script>
        $(document).ready(function() {
            $('#example2').DataTable();
        } );
        </script>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<!-- <p style="font-size:30px; text-align:center; padding:20px;">
  <b>You not friend !</b>
</p> -->
<script type="text/javascript">

 $('#uploadfiletosave').ajaxForm({
   type: "POST",
   url: "{{ url('/uploadfiletosave') }}",
   dataType: 'html', // serializes the form's elements.
   uploadProgress: function (event,position,total,percent) {
     $('#pg').css('display','block');
     $('#pc').css('width',percent+'%');
     console.log(percent);
   },
   success: function(result) {
     console.log(result);
     if(result == 'success'){
       $('#pg').fadeOut();
       location.reload();
     }
   },
   error: function(xhr,textStatus){ alert(textStatus);}
 });

function gotosumit() {
  $('#Isubmit').click();
}
function clickto() {
  $('#file').click();
}
function openportfile() {
  $('#showupload').hide();
  $('#yourfile').hide();
  $('#portfoliofile').fadeIn();
}
function openyourfile() {
  $('#portfoliofile').hide();
  $('#showupload').fadeIn();
  $('#yourfile').fadeIn();
}
function popup_worng(title2) {
  var p = new Popelt({
    title: title2,
    closeButton: false,
    escClose: false,
    modal: true
  });
  p.addButton('OK','btn btn-danger', function(){

    p.close();
  });
  p.show();
}
</script>

<iframe id="my_iframe" style="display:none;"></iframe>
<script>
function Download(url) {
    document.getElementById('my_iframe').src = url;
};
</script>
@endsection
