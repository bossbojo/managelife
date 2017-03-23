@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/css/chagneimage.css') }}" type="text/css" />
<script src="{{ asset('public/js/cropbox.js') }}"></script>
<script src="{{ asset('public/jquery_from/jquery.form.js') }}" type="text/javascript" ></script>
<style media="screen">
.containerimg {
  position: relative;
  width: 100%;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay2 {
  position: absolute;
  bottom: 0%;
  left: 0;
  right: 0;
  background-color:rgba(0, 0, 0, 0.66);
  overflow: hidden;
  width: 100%;
  height:0;
  transition: .5s ease;
}

.containerimg:hover .overlay2 {
  bottom: 0;
  height: 30%;
}

.text {
  white-space: nowrap;
  color: white;
  font-size: 20px;
  position: absolute;
  overflow: hidden;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}
</style>
<div class="col-md-8 col-md-offset-2">
  <div class="panel panel-default  border-radiusbox" style="background-color:#333; border-color:#222; ">
    <div class="panel-heading border-radius-top-20px2" style="background-color:#cc9900; border-color:#222;">
      <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-user"></i> Change your image profile</label>
    </div>
    <div class="panel-body" style="border-color:#222;">

      <div class="col-md-6 col-md-offset-3" align="center">
        <div id="oldprofile" >
          <label for="" style="font-size:20px;"><b><u>Please chose file image</u></b> for new image cover</label>
          <div class="container2">
            <div class="" style="width:350px; height:350px;">
              <img id="image"  src="{{ asset('').Auth::user()->cover }}" width="350px" height="350px" style="object-fit: cover;">
            </div>
            <div class="middle">
              <a href="#" class="text" id="clickfile"><i class="glyphicon glyphicon-camera" style="font-size:20px;" ></i> Chose file</a>
            </div>
          </div>
        </div>
        <form id="saveCover" class="" action="index.html" method="post">
          <hr>
          <div id="pg" class="progress" style="height:2px; margin:0; display:none;">
            <div id="pc" class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="height:2px; width:50%"></div>
          </div>
          <input id="file" type="file" name="file" style="display:none;">
          <input type="hidden" value="{{csrf_token() }}" name="_token">
          <div class="" align="right">
            <button type="submit" name="button" class="btn btn-success">submit</button>
          </div>
        </form>
        <a id="togo" href="{{ url('/home') }}"></a>
      <script type="text/javascript">
      $('#clickfile').click( function() {
        $('#file').click();
      });
      document.querySelector('#file').addEventListener('change', function(){
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#image').attr("src",e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
          this.files = [];
      })
      var url2 = "{{ url('/saveImgCover') }}";
       $('#saveCover').ajaxForm({
         type: "POST",
         url: url2,
         dataType: 'html', // serializes the form's elements.
         uploadProgress: function (event,position,total,percent) {
           $('#pg').css('display','block');
           $('#pc').css('width',percent+'%');
           console.log(percent);
         },
         success: function(result) {
           console.log(result);
           if(result == 'success'){
             document.getElementById('togo').click();
           }
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
      </script>
    </div>
  </div>
</div>
@endsection
