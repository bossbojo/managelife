<!-- import css and js-->
<link href="{{ asset('public/bootstrap-social-gh-pages\bootstrap-social.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/bootstrap-3.3.7\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="{{ asset('public') }}/jquery-3.1.1.min.js"></script>
<script src="{{ asset('public') }}\bootstrap-3.3.7\js\bootstrap.min.js"></script>
<title>Managelife</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('public/css/scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/scrollbar.css') }}">
<script src="{{ asset('public/jquery_from/jquery.form.js') }}" type="text/javascript" ></script>


<link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
<script src="{{ asset('public/popelt-v1.0-source.js') }}"></script>

<link rel="stylesheet" href="{{ asset('public/css/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/menubar/bs_leftnavi.css') }}">
<script src="{{ asset('public/css/menubar/bs_leftnavi.js') }}"></script>
<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery_from/jquery.form.js') }}" type="text/javascript" ></script>
<script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/jquery-ui\jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
<link rel="stylesheet" href="https://johnny.github.io/jquery-sortable/css/vendor.css">
<link rel="stylesheet" href="{{ asset('public\css\application.css') }}">
<script src="{{ asset('public/popelt-v1.0-source.js') }}"></script>
<!-- body show  -->
<script src="{{ asset('public\js\jquery-sortable.js') }}"></script>
<script src="{{ asset('public\canvas\html2canvas.js') }}" charset="utf-8"></script>
<style >
 .listdrag{
   text-decoration: none !important;
 }
 .listdrag:hover{
   box-shadow: 0 8px 16px 0 rgba(255,255,255,0.2), 0 1px 30px 0 rgba(255,255,255,0.19);
 }
 .listdrag:active{
 }
 .btnicon{
   color: #aaa;
   transition: all 0.5s;
 }
 .btnicon:hover{
   transition: all 0.5s;
   color: #fff;
 }
 .bottomleft {
    position: absolute;
    bottom: 8px;
    left: 16px;
    font-size: 18px;
}
.bottomright {
    position: absolute;
    bottom: 8px;
    right: 16px;
    font-size: 18px;
}
.centered {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
    transition: all 0.5s;
}
.btnplay:hover{
  transition: all 0.5s;
  color: #fff;
  text-decoration: none !important;
  padding: 25px;
  background-color: rgba(78, 78, 78, 0.61);
  border-radius: 10px;
}
.btnplay{
  color: #fff;
  text-decoration: none !important;
  padding: 20px;
  background-color: rgba(0, 0, 0, 0.71);
  border-radius: 10px;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.7);
}
</style>
<?php
use App\Listpresent;
$list = Listpresent::find(Auth::user()->id);
 ?>
<body style="background-color:#111;">
  <div class="" id="result" onclick="onNextPage()"></div>
  <div id="startpre" class="centered" align="center">
    <h1>Start for "Your presentation"</h1>
    <hr style="margin:10px; border-color:#222;">
    Push <span style="padding:5px; border-style: solid; border-width:1px; border-radius:5px;">space bar</span> or <u><a href="#" class="btnicon" onclick="full()">click here</a></u>
  </div>
  <div id="endpre" class="centered" align="center" style="display:none;">
    <h1>End for presentation</h1>
    <hr style="margin:10px; border-color:#222;">
    Double push <span style="padding:5px; border-style: solid; border-width:1px; border-radius:5px;">Esc</span> or <u><a href="#" class="btnicon" onclick="back()">click here</a></u>
  </div>
</body>
<a href="{{ url('portfolio') }}" id="back"></a>
<script>
var allid = '{{ $list->idfodata }}';
var res = allid.split(",");
var i = 0;

$(document).keydown(function(e) {
    console.log(e.which);
    switch(e.which) {
        case 37:onPrevPage();
              //alert('<-');// left
              break;
        case 39:onNextPage();
              //alert('->');// right
              break;
        case 27:document.getElementById('back').click();
                break;
        case 32:toggleFullScreen();
                setTimeout(function(){ openpage(res[0]); },200);
                break;
        default: return;
    }
    e.preventDefault();
});
function back() {
  document.getElementById('back').click();
}
function full() {
  $('#endpre').fadeOut();
  toggleFullScreen();
  setTimeout(function(){ openpage(res[0]); },200);
}
function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {
      document.documentElement.requestFullScreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullScreen) {
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
  }
}
function onPrevPage() {
  $('#endpre').fadeOut();
  if(i >= 0 ){
    console.log('<-');
    i--;
    openpage(res[i]);
  }
  if(i < 0){
    $('#startpre').fadeIn();
  }
}
function onNextPage() {
  if(i <= res.length-1){
    console.log('->');
    i++;
    openpage(res[i]);
  }
  if(i == res.length){
    $('#endpre').fadeIn();
  }
}
function openpage(id) {
  $('#startpre').fadeOut();
  var htmlstr = '';
  var sceen = $(document).height();
  console.log(sceen);
  console.log(id%6);
  $.getJSON( "{{ url('getdataslide') }}/"+id , function( data ) {
    var data = data.result;
    if(id%6==0){ //profile
      htmlstr = '<div id="div'+id+'" class="" align="center" style="display:none;position: relative;padding-top:100px; height:'+sceen+'px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                    '<h1>My portfolio</h1>'+
                    '<hr style="width:30%; border-color:'+data.colorbg2+';" >'+
                    '<img src="{{ Auth::user()->avatar }}" style="{{ Auth::user()->filter }}" alt="" width="30%"><br>'+
                    '<hr style="width:30%; border-color:'+data.colorbg2+';" >'+
                    '<h3>My name is {{ Auth::user()->name }}</h3>'+
                    '<div class="bottomleft">'+
                      '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                    '</div>'+
                    '<div class="bottomright">'+
                      '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                    '</div>'+
                '</div>';
    }
    if(id%6==1){ // video and text
      htmlstr = '<div id="div'+id+'" class=""  style="display:none;position: relative;padding:20px; height:'+sceen+'px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                    '<h1>'+data.title+'</h1>'+
                    '<hr style="margin:5px; border-color:'+data.colorbg2+';">'+
                    '<h2>'+data.titlesmall+'</h2>'+
                    '<div align="center">'+
                        '<video id="vdotext'+id+'" style="width:60%;" controls  src="{{ asset('') }}'+data.video+'"></video>'+
                    '</div>'+
                    '<hr style="margin:10px; border-color:'+data.colorbg2+';">'+
                    '<div style="background-color:'+data.colorbg2+'; border-radius:10px; font-size:25px;">'+
                      '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+data.text+
                    '</div>'+
                    '<div class="bottomleft">'+
                      '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                    '</div>'+
                    '<div class="bottomright">'+
                      '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                    '</div>'+
                '</div>';
    }
    if(id%6==2){ //photo and text
      htmlstr = '<div id="div'+id+'" class="" style="display:none;position: relative;padding:20px; height:'+sceen+'px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                    '<h1>'+data.title+'</h1>'+
                    '<hr style="margin:5px; border-color:'+data.colorbg2+';">'+
                    '<h2>'+data.titlesmall+'</h2>'+
                    '<div align="center">'+
                        '<img  src="{{ asset("") }}'+data.img+'" alt="" height="'+(sceen/2)+'px" >'+
                    '</div>'+
                    '<hr style="margin:10px; border-color:'+data.colorbg2+';">'+
                    '<div style="background-color:'+data.colorbg2+'; border-radius:10px ; font-size:25px;">'+
                      '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+data.text+
                    '</div>'+
                    '<div class="bottomleft">'+
                      '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                    '</div>'+
                    '<div class="bottomright">'+
                      '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                    '</div>'+
                '</div>';
    }
    if(id%6==3){ //text all
      htmlstr = '<div id="div'+id+'" class="" style="display:none;position: relative;padding:20px; height:'+sceen+'px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                    '<h1>'+data.title+'</h1>'+
                    '<hr style="margin:5px; border-color:'+data.colorbg2+';">'+
                    '<h2>'+data.titlesmall+'</h2>'+
                    '<div style="background-color:'+data.colorbg2+'; border-radius:10px; font-size:25px;">'+
                      '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+data.text+
                    '</div>'+
                    '<div class="bottomleft">'+
                      '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                    '</div>'+
                    '<div class="bottomright">'+
                      '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                    '</div>'+
                '</div>';
    }
    if(id%6==4){ //video
      htmlstr = '<div id="div'+id+'" class="" align="center" style="display:none;position: relative;padding-top:100px; height:'+sceen+'px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                    '<video id="vdo'+id+'" style="width:80%;" controls  src="{{ asset('') }}'+data.video+'"></video>'+
                    '<div class="bottomleft">'+
                      '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                    '</div>'+
                    '<div class="bottomright">'+
                      '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                    '</div>'+
                '</div>';
    }
    if(id%6==5){ //photo
      htmlstr = '<div id="div'+id+'" class="" align="center" style="display:none;position: relative;padding-top:10px; height:'+sceen+'px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                      '<img  src="{{ asset("") }}'+data.img+'" alt="" height="'+(sceen-100)+'px" >'+
                    '<div class="bottomleft">'+
                      '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                    '</div>'+
                    '<div class="bottomright">'+
                      '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                    '</div>'+
                '</div>';
    }

    $('#result').html(htmlstr);
    $('#div'+id).fadeIn();
   });
}
</script>
