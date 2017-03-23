@extends('layouts.app')
@section('content')
<!-- import css and js-->
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
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
}
</style>                                            <!-- menu bar  -->
<?php
use App\Listpresent;

$list = Listpresent::find(Auth::user()->id);
$listpresent = explode(",", $list->idfodata);
 ?>
<div class="container-fluid" style="background-color:#111; margin-left:-0px; " >
  <div class="col-md-4" >
    <div class="" style="background-color:#555; font-size:20px; padding:10px;  color:#fff;" align="">
      <i class="glyphicon glyphicon-th-list"></i> List your present
      <span style="float:right;">
        <a href="{{ url('customportfolio') }}" class="btnicon" ><i class="glyphicon glyphicon-move"></i></a>&nbsp;&nbsp;
        <a href="{{ url('portfolio') }}" class="btnicon" ><i class="glyphicon glyphicon-briefcase"></i></a>&nbsp;&nbsp;
        <a href="{{ url('presentfull') }}" class="btnicon" ><i class="glyphicon glyphicon-fullscreen"></i></a>&nbsp;&nbsp;
        <a id="save" href="#" class="btnicon" onclick="getallslide('{{ Auth::user()->id }}')"><i class="glyphicon glyphicon-floppy-disk"></i></a>
      </span>
    </div>
    <div class="" style="background-color:#444; height:900px; overflow-y:scroll;" align="center" id="style-1">
      <div class="col-md-2" >
        <?php
        for ($i=0; $i < sizeof($listpresent) ; $i++) {
         ?>
         <div class="" style="height:220px; padding-top:110px; color:#fff; border-right: 6px solid #666; font-size:18px;">
             {{ $i+1 }}
         </div>
        <?php } ?>

      </div>
      <div class="col-md-10">
        <div class='span4'>
          <ol class='limited_drop_targets vertical' style="width:362px;"  align="center" id="listallslide">
              <?php
              for ($i=0; $i < sizeof($listpresent) ; $i++) {
               ?>
              <li id="{{ $listpresent[$i] }}" class="listdrag">
                  <a href="#" class="listdrag" onclick="openpage('{{ $listpresent[$i] }}','{{ $i+1 }}')" disabled="disabled">
                    <div class="listdrag" style="background-color:#888; width:300px; height:200px;">
                      <img id="box{{ $listpresent[$i] }}" src="{{ asset('public\img\loading-ring-400x300.gif') }}" alt="" width="300px" height="200px">
                    </div>
                </a>
              </li>
              <?php } ?>
            </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8" style="background-color:#222;">
    <div class="" style="background-color:#555; padding:10px; border-radius:10px; color:#fff;" align="center">
      <span id="nowslide"></span>/<span id="maxslide"></span>
    </div>
    <img id="imgload" src="{{ asset('public\img\loading-ring-400x300.gif') }}" alt="" width="98%" height="800" style="margin:20px;">
    <div class="" id="showslide"></div>
  </div>
</div>
<div class="modal" id="download">
  <div class="centered" style="background-color:#555; border-radius:10px; padding:50px;" align="center">
    <span style="color:#aaa;">loading </span><img src="{{ asset('public\img\Loading1.gif') }}" width="50px" alt="">
    <div id="boxpg" class="progress" style="width:350px;">
      <div id="pg" class="progress-bar progress-bar-striped active" role="progressbar"
        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
        0%
      </div>
    </div>
  </div>
</div>
<div class="modal" id="saving">
  <div class="centered" align="center">
    saving <img src="{{ asset('public\img\saving.gif') }}" width="50px" alt="">
  </div>
</div>
  <script>
  $(document).ready(function() {
    $('#download').fadeIn();
    //    alert("document ready occurred!");
  });
    //------------------------------slide---------------------------------
    var MAXs = document.getElementById('listallslide');
    $('#maxslide').html(MAXs.children.length);
    function getallslide(id) {
      $('#saving').fadeIn();
      var allslide = document.getElementById('listallslide');
      var save = '';
      for (var i = 0; i < allslide.children.length; i++) {
        if(i == allslide.children.length-1){
          save += allslide.children[i].id;
        }else{
          save += allslide.children[i].id +',';
        }

      }
      console.log(save);

      var data2 = { Id: id ,
                    index : save,
                  }
      var url2 = "{{ url('/savedataslide') }}"; // the script where you handle the form input.
      $.ajax({
       type: "get",
       url: url2,
       data: data2 , // serializes the form's elements.
       success: function(result) {
         console.log(result);
         if(result == 'success'){
          setTimeout(function(){ $('#saving').fadeOut(); },1000 );
          $('#save').css('color','#aaa');
         }
       },
       error: function(xhr,textStatus){ alert(textStatus);}
     });
    }

    var group = $("ol.limited_drop_targets").sortable({
    group: 'limited_drop_targets',
    isValidTarget: function  ($item, container) {
      if($item.is(".highlight"))
        return true;
      else
        return $item.parent("ol")[0] == container.el[0];
    },
    onDrop: function ($item, container, _super) {
      $('#serialize_output').text(
        group.sortable("serialize").get().join("\n"));
        console.log($item[0].id);
        $('#save').css('color','red');
      _super($item, container);
    },
    serialize: function (parent, children, isContainer) {
      $('#save').css('color','red');
      return isContainer ? children.join() : parent.text();
    },
    tolerance: 6,
    distance: 10
    });
    //--------------------------------------open all ---------------------------
    var allid = '{{ $list->idfodata }}';
    var res = allid.split(",");
    var i = 0;
    var nowpage = 0;
    setInterval( function() {
      if(i<res.length){
        var pc = ((i+1)*100)/res.length

        console.log(pc);
        $('#pg').css('width',pc.toFixed(2)+'%')
        $('#pg').html(pc.toFixed(2)+'%')
        openpage(res[i],i+1);
        i++;
        if(pc == 100){
          setTimeout(function(){ $('#download').fadeOut(); } , 200 );
          setTimeout(function(){ openpage(res[0],1); } , 100 );
        }
      }
    },1000);

    function divtoimg(id) {
      console.log('div'+id);
      html2canvas($('#div'+id), {
          onrendered: function(canvas) {
              var myImage = canvas.toDataURL("img/png");
              $("#box"+id).attr('src',myImage);
          }
      });
    }
    function playvdo(play,id) {
      console.log(play);
      $('#img'+id).hide();
      $('#btn'+id).hide();
      $('#'+play).fadeIn();
      document.getElementById(play).play();
    }
    function openpage(id,page) {
      nowpage = page;
      $('#nowslide').html(page);
      var htmlstr = '';
      $('#imgload').hide();
      console.log(id%6);
      $.getJSON( "{{ url('getdataslide') }}/"+id , function( data ) {
        var data = data.result;
        if(id%6==0){ //profile
          htmlstr = '<div id="div'+id+'" class="" align="center" style="position: relative;padding-top:100px;margin:20px;height:800px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                        '<h1>My portfolio</h1>'+
                        '<hr style="width:30%; border-color:'+data.colorbg2+';" >'+
                        '<img src="{{ Auth::user()->avatar }}" style="{{ Auth::user()->filter }}" alt=""><br>'+
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
          htmlstr = '<div id="div'+id+'" class=""  style="position: relative;padding:20px;margin:20px;height:800px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                        '<h3>'+data.title+'</h3>'+
                        '<hr style="margin:5px; border-color:'+data.colorbg2+';">'+
                        '<h4>'+data.titlesmall+'</h4>'+
                        '<div align="center">'+
                            '<video id="vdotext'+id+'" style="width:75%; display:none;" controls  src="{{ asset('') }}'+data.video+'"></video>'+
                            '<img id="img'+id+'" src="{{ asset("public/img/icon/video.png") }}" alt="" width="450px">'+
                            '<div id="btn'+id+'" class="centered"><a  href="#" class="btnplay" onclick="playvdo(\'vdotext'+id+'\',\''+id+'\')" >play</a></div>'+
                        '</div>'+
                        '<hr style="margin:10px; border-color:'+data.colorbg2+';">'+
                        '<div style="background-color:'+data.colorbg2+'; border-radius:10px;">'+
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
          htmlstr = '<div id="div'+id+'" class="" style="position: relative;padding:20px;margin:20px;height:800px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                        '<h3>'+data.title+'</h3>'+
                        '<hr style="margin:5px; border-color:'+data.colorbg2+';">'+
                        '<h4>'+data.titlesmall+'</h4>'+
                        '<div align="center">'+
                            '<img  src="{{ asset("") }}'+data.img+'" alt="" width="350px" style="object-fit: cover;">'+
                        '</div>'+
                        '<hr style="margin:10px; border-color:'+data.colorbg2+';">'+
                        '<div style="background-color:'+data.colorbg2+'; border-radius:10px;">'+
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
          htmlstr = '<div id="div'+id+'" class="" style="position: relative;padding:20px;margin:20px;height:800px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                        '<h3>'+data.title+'</h3>'+
                        '<hr style="margin:5px; border-color:'+data.colorbg2+';">'+
                        '<h4>'+data.titlesmall+'</h4>'+
                        '<div style="background-color:'+data.colorbg2+'; border-radius:10px;">'+
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
          htmlstr = '<div id="div'+id+'" class="" align="center" style="position: relative;padding-top:100px;margin:20px;height:800px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                        '<video id="vdo'+id+'" style="width:80%; display:none;" controls  src="{{ asset('') }}'+data.video+'"></video>'+
                        '<img id="img'+id+'" src="{{ asset("public/img/icon/video.png") }}" alt="" width="450px">'+
                        '<div id="btn'+id+'" class="centered"><a  href="#" class="btnplay" onclick="playvdo(\'vdo'+id+'\',\''+id+'\')" >play</a></div>'+
                        '<div class="bottomleft">'+
                          '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                        '</div>'+
                        '<div class="bottomright">'+
                          '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                        '</div>'+
                    '</div>';
        }
        if(id%6==5){ //photo
          htmlstr = '<div id="div'+id+'" class="" align="center" style="position: relative;padding-top:10px;margin:20px;height:800px; color:'+data.colorfont1+'; background-color:'+data.colorbg1+';" >'+
                        '<div style="height:750px;">'+
                          '<img  src="{{ asset("") }}'+data.img+'" alt="" width="90%" height="90%" style="object-fit: cover;">'+
                        '</div>'+
                        '<div class="bottomleft">'+
                          '<img src="{{ asset("favicon.ico") }}" alt="" width="30px"> <span style="font-size:15px;">www.ManageLife.com</span>'+
                        '</div>'+
                        '<div class="bottomright">'+
                          '<span style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</span>'+
                        '</div>'+
                    '</div>';
        }

        $('#showslide').html(htmlstr);
        $('#showslide').fadeIn();
       });
       setTimeout(function(){ divtoimg(id); }, 200) ;
    }
  </script>
@endsection
