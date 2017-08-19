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
<link rel="stylesheet" href="{{ asset('public\css\bubble.css') }}">
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
  <?php
  use Illuminate\Support\Facades\DB;
  use App\Indexportfolio;
  use App\Dataportfolio;
  use App\Favorite;
  use App\Feedback;
  use App\User;
  use App\Fileupload;

   ?>
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default  border-radiusbox" style="background-color:#111; border-color:#111; color:#777;" align="center" >
      <h1><img src="{{ asset('public\icon\MLblock.png') }}" alt="" width="150px"> You can't use your Managelife</h1>
      <hr style="border-color:#333; width:60%;">
      <h2>Contact us</h2>
    </div>
    <div class="panel panel-default  border-radiusbox" style="background-color:#111; border-color:#111; ">
      <div class="panel-body" style="border-color:#111;">
        <div class="col-md-2" align="right">
          <?php
            $img = Auth::user()->avatar;
            $pieces = explode("/", $img);
            if($pieces[0] != 'public'){
                print '<img class="img-thumbnail" style="'.Auth::user()->filter.'" src="'.$img.'" alt="" width="150px">';
            }else{
                print '<img class="img-thumbnail" style="'.Auth::user()->filter.'" src="'.asset($img).'" alt=""  width="150px">';
            }
           ?>
        </div>
        <form id="contacttosave" >
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
            <div class="col-md-10" align="left">
               <div class="talk-bubble tri-right left-top" >
                 <div class="talktext"  >
                   <p >
                     <textarea id="contact"  class="form-control" name="contact" rows="8" style="width:100%;" placeholder="Input your messages"></textarea>
                   </p>
                 </div>
               </div>
               <div class="alert alert-success" align="left" id="success" style="display:none; width:250px;">
                 <strong>Success!</strong> Your messages
               </div>
            </div>
            <div class="col-md-12" align="right" style="padding:50px;">
              <button name="button" type="su" class="btn btn-success">submit</button>
            </div>
      </form>
      </div>
    </div>
  </div>
</div>
<br>
<!-- <p style="font-size:30px; text-align:center; padding:20px;">
  <b>You not friend !</b>
</p> -->
<script type="text/javascript">

 $('#contacttosave').ajaxForm({
   type: "POST",
   url: "{{ url('/contacttosave') }}",
   dataType: 'html', // serializes the form's elements.
   uploadProgress: function (event,position,total,percent) {
     $('#pg').css('display','block');
     $('#pc').css('width',percent+'%');
     console.log(percent);
   },
   success: function(result) {
     console.log(result);
     if(result == 'success'){
       $('#contact').val('');
       $('#success').fadeIn();
       setTimeout(function(){ $('#success').fadeOut(); },5000);
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
@endsection
