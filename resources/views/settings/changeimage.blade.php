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
          <label for="" style="font-size:20px;"><b><u>Please chose file image</u></b> for new image profile</label>
          <div class="container2">
            <img alt="Avatar" class="image" id="images" style="{{ Auth::user()->filter }}" src="{{ asset(''.Auth::user()->avatar) }}" alt="" width="350px" height="350px">
            <div class="middle">
              <a href="#" class="text" id="clickfile"><i class="glyphicon glyphicon-camera" style="font-size:20px;" ></i> Chose file</a>
            </div>
          </div>
        </div>
        <div id="newpor" class=""style="display:none;">
          <label for="" style="font-size:15px;">Please move image or Zoom-in and Zoom-out for custom position image</label>
          <div class="imageBox" id="img">
            <div class="thumbBox"></div>
            <div class="spinner" style="display:none;"><img  src="{{ asset('public\icon\loading.gif') }}" alt="" width="20px"></div>
          </div>
        </div>
        <div id="newprofile" style="display:none;">
          <label for="" style="font-size:15px;">Please select filter for custom position image</label>
          <div class="col-md-9">
            <img alt="Avatar" id="photo" class="image cropped" src="{{ asset('public/default-img/profile-icon.png') }}" alt="" width="350px" height="350px">
          </div>
          <div class="col-md-3">
            <div class="filter" style="isplay:inline; width:120px; height:400px;  overflow-y:scroll; " id="style-2">
              <img src="{{ asset('public\icon\loading.gif') }}" alt="" width="20px">
            </div>
          </div>
          <div class="col-md-12" align="right">
            <hr style="border-color:rgb(69, 69, 69); margin:5px;">
            <a href="#" class="btn btn-success" onclick="save()">Apply</a>
          </div>
        </div>
        <div class="action">
            <input type="file" id="file" style="float:left; width:250px; display:none;">
            <input type="range"  class="form-control" id="zoom" name="" value="" style="display:none; width:300px;">
            <hr style="border-color:rgb(69, 69, 69); margin:5px;">
            <input type="button" class="btn btn-success" id="btnCrop" value="Next" style="float: right; display:none;" >
        </div>
        <form style="display:none;" id="PostStatus">
          <input type="hidden" value="{{csrf_token() }}" name="_token">
          <input type="text" id="newimg" name="newimg" value="">
          <input type="text" id="css" name="css" value="">
          <input type="submit" id="submitchange" name="" value="">
        </form>
      </div>
      <a id="togo" href="{{ url('/home') }}"></a>
      <script type="text/javascript">
       var src;
          $('#clickfile').click(function() {
            $('#file').click();
          });
          window.onload = function() {
              var options =
              {
                  imageBox: '.imageBox',
                  thumbBox: '.thumbBox',
                  spinner: '.spinner',
                  imgSrc: "{{ asset(''.Auth::user()->avatar) }}",
                  fillter: '{{ Auth::user()->filter }}'
              }
              var cropper = new cropbox(options);
              document.querySelector('#file').addEventListener('change', function(){
                  var reader = new FileReader();
                  reader.onload = function(e) {
                      $('#oldprofile').hide();
                      $('#newpor').fadeIn();
                      $('#zoom').fadeIn();
                      $('#btnCrop').fadeIn();
                      options.imgSrc = e.target.result;
                      cropper = new cropbox(options);
                  }
                  reader.readAsDataURL(this.files[0]);
                  this.files = [];
              })
              document.querySelector('#btnCrop').addEventListener('click', function(){
                  var img = cropper.getDataURL();
                  src = img;
                  $('#newpor').hide();
                  $('#zoom').hide();
                  $('#btnCrop').hide();
                  $('#newprofile').fadeIn();
                   filter();
                  document.querySelector('.cropped').src = img;
              })
              var num;
              $(document).on('input', '#zoom', function() {
                if(num < $('#zoom').val()){
                    num = $('#zoom').val();
                    cropper.zoomIn();
                }else{
                    num = $('#zoom').val();
                    cropper.zoomOut();
                }
              });
          };
          function filter() {
            var strhtml ='';
            var style = ['filter: none;',
                         'filter: brightness(1.6) contrast(1.1) grayscale(0) hue-rotate(0deg) invert(0.1) saturate(0.9) sepia(0);',
                         'filter: brightness(1.3) contrast(0.8) grayscale(0.9) hue-rotate(0deg) invert(0) saturate(1) sepia(0);',
                         'filter: brightness(1.3) contrast(1.1) grayscale(0) hue-rotate(180deg) invert(0) saturate(2) sepia(0);',
                         'filter: brightness(2.4) contrast(0.8) grayscale(0) hue-rotate(0deg) invert(0.3) saturate(1) sepia(1);',
                         'filter: brightness(1.5) contrast(9.99) grayscale(0.6) hue-rotate(0deg) invert(0.23) saturate(1) sepia(0.2);',
                         'filter: brightness(0.5) contrast(1.7) grayscale(0) hue-rotate(0deg) invert(0.13) saturate(0.1) sepia(0.2);',
                         'filter: brightness(1.3) contrast(1.4) grayscale(0) hue-rotate(0deg) invert(0.07) saturate(0.5) sepia(0);',
                         'filter: brightness(1.1) contrast(2.4) grayscale(1) hue-rotate(0deg) invert(0.32) saturate(0) sepia(0.11);',
                         'filter: brightness(1.2) contrast(1.2) grayscale(0) hue-rotate(0deg) invert(0) saturate(1) sepia(1);',
                         'filter: brightness(1.9) contrast(1.6) grayscale(0) hue-rotate(0deg) invert(0.2) saturate(0) sepia(0);',
                         'filter: brightness(1.3) contrast(1.2) grayscale(0) hue-rotate(0deg) invert(0.1) saturate(1.8) sepia(0);',
                         'filter: brightness(1.1) contrast(1.2) grayscale(0) hue-rotate(0deg) invert(0.9) saturate(0.7) sepia(0.3);',];
            var name = ['None','Eureka','London','FlipFlop','Copper','LoFi','Night','Rocky','Karl','Gold','Silver','Butterfly','Introvert',];
            for (var i = 0; i < 13; i++) {
              strhtml +='<a href="#" onclick="setfilter(\''+style[i]+'\')"> \
                            <div class="containerimg"> \
                            <img style="padding-top:5px; '+style[i]+'"  src="'+src+'" alt="Avatar" class="image" width="100%">\
                            <div class="overlay2">\
                            <div class="text">'+name[i]+'</div>\
                          </div>\
                         </div><a>' ;
            }
            $('.filter').html(strhtml);
          }
        var csspro;
        function setfilter(css) {
          csspro = css;
          document.getElementById('photo').style = css;
          console.log(css);


        }
        function save() {
          $('#newprofile').hide();
          document.getElementById('images').src = src;
          document.getElementById('images').style = csspro;
          $('#newimg').val(src);
          $('#css').val(csspro);
          $('#oldprofile').fadeIn();
          $('#submitchange').click();
        }
        var url2 = "{{ url('/saveImgPro') }}";
         $('#PostStatus').ajaxForm({
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
              setTimeout(function(){  document.getElementById('togo').click(); }, 1000);
               
             }
           },
           error: function(xhr,textStatus){ alert(textStatus);}
         });
      </script>
    </div>
  </div>
</div>
@endsection
