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
<script src="{{ asset('public/popelt-v1.0-source.js') }}"></script>
<!-- body show  -->
                                            <!-- menu bar  -->
<div class="container-fluid" style="background-color:#111; margin-left:-0px;" id="style-1">
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
                                                                    <!-- tag post  -->
        <div class="col-md-6 showdatta" style="margin:-20px; overflow-y:scroll; z-index: 5;" id="style-1">
          <script type="text/javascript">
            var h = window.innerHeight;
            $('.showdatta').css("height" , h);
          </script>
          <br><br>
          <div class="panel panel-default" style="border-radius:20px; border-color:#111;background-color:#555;">
              <div class="panel-body" style="margin:-15px;">
                <div class="col-md-3" style=" padding:10px; height:220px; padding:2px; background-color:#cc9900; text-align:center; border-top-left-radius:20px; border-bottom-left-radius:20px;">
                  <a href="{{ url('home') }}" class="btnMenulife" ><img class="img-circle" style="margin-top:35px;  {{ Auth::user()->filter }}" width="75%" src="{{ asset(''.Auth::user()->avatar) }}" alt=""></a>
                </div>
                <div class="col-md-9" style="padding:10px;">
                  <form class="PostStatus" id="PostStatus">
                    <div id="status" class="col-md-12" style="padding:0px;">
                      <!--input textarea -->
                      <textarea  class="form-control" style=" resize: none;" id="feel" name="feel" rows="3" width="70%" placeholder="คุณกำลังคิดอะไร ?"></textarea>
                    </div>
                    <!-- IMG SHOW preview -->
                    <div id="showImg" class="col-md-3" style="padding:0px; display:none;">
                      <img id="Img" src="" class="imgshow" alt="" width="100%" height="80px">
                      <div class="topright">
                        <a href="#" style="z-index:99;" onclick="removefilePost();" class="btnremove" ><i class="dorpshadow-text glyphicon glyphicon-remove"></i></a>
                      </div>
                    </div>
                    <!-- video previwe -->
                    <div id="showVideo" class="col-md-3" style="padding:0px; display:none;">
                      <video id="Video"  width="100%" height="80px" controls></video>
                      <div class="topright">
                        <a href="#" style="z-index:99;" onclick="removefilePost();" class="btnremove"><i class="dorpshadow-text glyphicon glyphicon-remove"></i></a>
                      </div>
                    </div>
                     <script src="http://vjs.zencdn.net/5.8.8/video.js"></script>
                    <!--input shotcut file -->
                    <a  id="shotcutBtnfile" href="#" class="btn btn-default" >
                     <img src="public/icon/camera.png" width="20px"> image |
                     <img src="public/icon/video.png" width="20px"> video |
                     <img src="public/icon/audio.png" width="15px"> audio |
                     <img src="public/icon/blank-file-xxl.png" width="15px"> file
                    </a>
                    <a  style="display:none;" class="btn btn-default" onclick="check()">check input</a>
                    <span id="showDetil" style="font-size:5px; color:#aaa;"></span>
                    <br>
                    <!--input select -->
                    <select id="level-look" name="level-look" class="form-control" style="width:100px;">
                      <option value="public">public</option>
                      <option value="friends">friends</option>
                      <option value="private">private</option>
                    </select>

                      {{ csrf_field() }}
                    <div style="text-align:right;">
                      <!--input file and data -->
                      <input id="fileall" type="file" name="fileall" value="" style="display:none;">
                      <input id="typefile" type="text" name="typefile" value="" style="display:none;">
                      <input id="submitPost" class="btn btn-primary" type="submit" name="" value="Post" style="display:none;">
                      <a class="btn btn-primary" onclick="checkPost()">Post</a>
                    </div>
                  </form>
                  <div id="pg" class="progress" style="height:2px; margin:0; display:none;">
                    <div id="pc" class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="height:2px; width:50%"></div>
                  </div>
                  <script>
                    function checkPost() {
                      if($('#fileall').val()=="" && $('#feel').val()==""){
                        console.log('blank Post');
                        popup_worng("โพสต์นี้ว่างเปล่า โปรดเพิ่มเนื้อหาหรือแนบลิงก์หรือรูปภาพลงในโพสต์");
                        return;
                      }else{
                        $('#submitPost').click();
                      }
                    }
                    function check() {
                      console.log($('#fileall').val());
                      console.log($('#level-look').val());
                      console.log($('#feel').val());
                    }

                    var url2 = "{{ url('/savePost') }}";
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
                         $('#PostStatus')[0].reset();
                         setTimeout(function(){ $('#pg').css('display','none'); }, 400);
                         setTimeout(function(){ removefilePost(); }, 400);
                         loadpage();
                         setTimeout(function(){ loadpage(); }, 100);
                         var audio = new Audio('/tones/post.mp3');
                         audio.play();
                       },
                       error: function(xhr,textStatus){ alert(textStatus);}
                     });

                  </script>
                  <script src="{{ asset('public/js/home.js') }}"></script>
                </div>
              </div>
          </div>
                                                                  <!-- show post  -->
          <!-- if are text -->
          <div id="myModal" class="modal">
            <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default" style="background-color:#444;border-color:#222;">
                <div class="panel-heading" style="background-color:#777;border-color:#222;">
                  <span class="close" onclick="close_edit()">&times;</span>
                  <label for="">Edit Status</label>
                </div>
                <form id="save_editposturl_text">
                  {{ csrf_field() }}
                <div class="panel-body" style="background-color:#444;border-color:#222;">
                  <textarea  class="form-control" style=" resize: none;" id="feele_edit" name="feele_edit" rows="3" width="70%" placeholder="คุณกำลังคิดอะไร ?"></textarea>
                  <input type="hidden" name="idstatus" id="idstatustext" value="">
                </div>
                <div id="pg2" class="progress" style="height:2px; margin:0; display:none;">
                  <div id="pc2" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="height:2px; width:50%"></div>
                </div>
                <div class="panel-body" style="text-align:right;background-color:#777;border-color:#222;border:1px;">
                  <input type="submit" value="Save" class="btn btn-primary">
                  <a href="#" onclick="close_edit()" class="btn btn-default">Cancel</a>
                </div>
                </form>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            var save_editposturl_text = "{{ url('/save_editposturl_text') }}";
             $('#save_editposturl_text').ajaxForm({
               type: "POST",
               url: save_editposturl_text,
               dataType: 'html', // serializes the form's elements.
               uploadProgress: function (event,position,total,percent) {
                 $('#pg2').css('display','block');
                 $('#pc2').css('width',percent+'%');
                 console.log(percent);
               },
               success: function(result) {
                 var idstatus = '#status'+ $('#idstatustext').val();
                 $(idstatus).html(''+$('#feele_edit').val())
                 console.log(result);
                 $('#myModal').fadeOut();
                 setTimeout(function(){ $('#pg').css('display','none'); }, 400);
                 var audio = new Audio('/tones/post.mp3');
                 audio.play();
               },
               error: function(xhr,textStatus){ alert(textStatus);}
             });
          </script>
          <!-- if has file -->
          <div id="myModal2" class="modal">
            <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default" style="background-color:#444;border-color:#222;">
                <div class="panel-heading" style="background-color:#777;border-color:#222;">
                  <span class="close" onclick="close_edit()">&times;</span>
                  <label for="">Edit Status</label>
                </div>
                <form id="save_editposturl_file">
                  {{ csrf_field() }}
                <div class="panel-body" style="background-color:#444;border-color:#222;">
                  <textarea  class="form-control" style=" resize: none;" id="feele_edit2" name="feele_edit" rows="3" width="70%" placeholder="คุณกำลังคิดอะไร ?"></textarea>
                  <input type="hidden" name="idstatus" id="idstatusfile" value="">
                  <hr>
                  <img style="display:none;" id="image_edit" src="" alt="" width="20%">
                  <div id="pg3" class="progress" style="height:2px; margin:0; display:none;">
                    <div id="pc3" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="height:2px; width:50%"></div>
                  </div>
                </div>
                <div class="panel-body" style="text-align:right;background-color:#777;border-color:#222;border:1px;">
                  <input type="submit" value="Save" class="btn btn-primary">
                  <a href="#" onclick="close_edit()" class="btn btn-default">Cancel</a>
                </div>
                </form>
              </div>
            </div>
          </div>
          <script type="text/javascript">
          var save_editposturl_file = "{{ url('/save_editposturl_file') }}";
           $('#save_editposturl_file').ajaxForm({
             type: "POST",
             url: save_editposturl_file,
             dataType: 'html', // serializes the form's elements.
             uploadProgress: function (event,position,total,percent) {
               $('#pg3').css('display','block');
               $('#pc3').css('width',percent+'%');
               console.log(percent);
             },
             success: function(result) {
               console.log(result);
               var idstatus = '#status'+ $('#idstatusfile').val();
               $(idstatus).html(''+$('#feele_edit2').val())
               $('#myModal2').fadeOut();
               setTimeout(function(){ $('#pg').css('display','none'); }, 400);
               var audio = new Audio('/tones/post.mp3');
               audio.play();
             },
             error: function(xhr,textStatus){ alert(textStatus);}
           });
          </script>
              <div class="result">
                <div align="center" >
                  <img src="{{ asset('public/icon\loading_spinner.gif') }}" alt="" width="10%">
                </div>
              </div>
              <input id="get_id" name="get_id" type="text" style="display:none;">
              <script>
              setTimeout(function(){ loadpage(); }, 1000);
              setTimeout(function(){ loadpage(); }, 1000);
              function loadpage() {
                $( ".result" ).load( "{{ url('showstatusAll') }}");
              }
              function submitComment(id,id_user) {
                console.log(id);
                var data2 = { Id: id ,
                              Id_user : id_user ,
                              comment : $('#comment'+id).val()
                            }
                $('#comment'+id).val(null);
                var url2 = "{{ url('/comment_post') }}"; // the script where you handle the form input.
                $.ajax({
                       type: "get",
                       url: url2,
                       data: data2 , // serializes the form's elements.
                       success: function(result) {
                         console.log(result);
                         ajaxget_datacomment(id)
                       },
                       error: function(xhr,textStatus){ alert(textStatus);}
                     });
              }
              var stop;
              function showdatacomment(id) {
               stop = setInterval(function(){ ajaxget_datacomment(id) }, 1000);
              }
              function ajaxget_datacomment(id) {
                var link = "{{ url('getcoment') }}/"+id;
                $.getJSON( link, function( data ) {
                var datacommet = data.result;
                var add = '<hr style="border-color:#888; margin:5px;">';
                $('#countcommnet'+id).html('<i class="glyphicon glyphicon-comment"></i> Comments');
                for(var i = 0;i<datacommet.length;i++){
                  var img = datacommet[i].avatar;
                  var check = img.split("/");
                  if(check[0] == 'public'){
                    img = '{{ asset('') }}'+datacommet[i].avatar;
                  }
                  $('#countcommnet'+id).html('<i class="glyphicon glyphicon-comment"></i> Comments ('+(datacommet.length)+')');
                  add += '<div style="margin-top:10px;">'+
                      '<a class="btnMenulife" href="{{ url("user") }}/'+datacommet[i].user_id+'">'+
                      '<img  class="img-circle" style="border-color:#000; '+datacommet[i].filter+'" src="'+img+'" width="40px">&nbsp;&nbsp;'+
                      '</a>'+
                      '<a class="btnMenulife" href="{{ url("user") }}/'+datacommet[i].user_id+'">'+
                      '<span style="color:#000;">'+
                        datacommet[i].name+
                      '</span>'+
                      '</a> :';
                    if(datacommet[i].user_id == '{{ Auth::user()->id }}'){
                      add +=   ' <span style="margin:0px; padding-left:0px; width:100%; display:;"  id="comment'+datacommet[i].id+'" >  '+
                                     datacommet[i].comment+
                                     '<p style="float:right; padding-top:10px;" >'+
                                       '<a href="#" class="edit_tag_i" onclick="edit_comment('+datacommet[i].id+','+id+')"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;'+
                                       '<a href="#" class="edit_tag_i" onclick="delete_comment('+datacommet[i].id+','+id+')"><i class="glyphicon glyphicon-trash"></i></a>'+
                                     '</p>'+
                                '</span> ';
                      add +=  '<span style=" display:none; " id="editboxcomment'+datacommet[i].id+'" >'+
                                    '<input type="text"  id="editcomment'+datacommet[i].id+'" '+
                                    'onkeydown="if (event.keyCode == 13) { submitEditComment('+datacommet[i].id+' , '+id+') }" '+
                                    'style="display:none; width:60%; border-radius:5px; padding:5px;"  value="'+datacommet[i].comment+'" >'+
                                  '<span style="float:right; padding-top:10px;" id="close_comment'+datacommet[i].id+'">'+
                                    '<a href="#" class="edit_tag_i" onclick="close_comment('+datacommet[i].id+','+id+')"><i class="glyphicon glyphicon-remove"></i></a>'+
                                  '</span>'+
                              '</span><br>';

                    }else{
                      add +=   ' <span>'+datacommet[i].comment+' </span>';
                    }
                    add += '</div>';
                }
                if(datacommet.length!=0){
                  document.getElementById("showdatatable"+id).innerHTML = add;
                }else {
                  document.getElementById("showdatatable"+id).innerHTML = '';
                }
                console.log(datacommet.length);
              });
              }
              function delete_comment(id,status_id) {
                console.log('delete : ' +id);
                var data2 = { Id : id };
                var url2 = "{{ url('/delete_comment') }}"; // the script where you handle the form input.
                $.ajax({
                       type: "get",
                       url: url2,
                       data: data2, // serializes the form's elements.
                       success: function(result){
                         if(result=='success'){
                           console.log('Deleted');
                           ajaxget_datacomment(status_id)
                         }
                       },
                       error: function(xhr,textStatus){ alert(textStatus);}
                     });
              }
              function edit_comment(id,status_id) {
                clearInterval(stop);
                $('#closecomment'+id).fadeIn();
                $('#editcomment'+id).fadeIn();
                $('#editboxcomment'+id).fadeIn();
                $('#comment'+id).hide();
              }
              function close_comment(id) {
                $('#editcomment'+id).hide();
                $('#closecomment'+id).hide();
                $('#editboxcomment'+id).hide();
                $('#comment'+id).fadeIn();
              }
              function submitEditComment(id,status_id) {
                console.log($('#editcomment'+id).val());
                close_comment(id);
                var data2 = { Id : id ,
                              comment : $('#editcomment'+id).val() };
                var url2 = "{{ url('/edit_comment') }}"; // the script where you handle the form input.
                $.ajax({
                       type: "get",
                       url: url2,
                       data: data2 ,
                       success: function(result) {
                         console.log(result);
                         ajaxget_datacomment(status_id)
                       },
                       error: function(xhr,textStatus){ alert(textStatus);}
                     });
              }

              </script>
        </div>
                                                                    <!-- info user profile -->
        <?php
          use App\Alert_friends;
          $statusfriend ='';
          $statusfriend2 ='';
          $selectfriend = DB::table('alert_friend')
                          ->where([
                            ['user_id', '=', Auth::user()->id],
                            ['friend_id', '=', $UserView->id],
                          ])->get();
          $selectfriend2 = DB::table('alert_friend')
                          ->where([
                            ['friend_id', '=', Auth::user()->id],
                            ['user_id', '=', $UserView->id],
                          ])->get();

          foreach ($selectfriend as $selectfriendonly) {
            $statusfriend = $selectfriendonly;
          }
          foreach ($selectfriend2 as $selectfriendonly2) {
            $statusfriend2 = $selectfriendonly2;
          }
          if($statusfriend == ''){
            $statusfriend = $statusfriend2;
          }
          if($statusfriend2 == ''){
            $statusfriend2 = $statusfriend;
          }
         ?>
        <div class="col-md-3">
            <div class="panel panel-default" style="width:122%; border-radius:0px;  margin:0px; border-color:#888;">
                <div class="panel-heading" style="background-color:#cc9900; border-color:#888;  text-align:center;" >
                  <span style="font-size:30px;">Question and Answer&nbsp;&nbsp;&nbsp; <img src="{{ asset('public/icon/questions-and-answers-icon-1.png') }}" width="80px" alt=""></span>
                </div>
                <div class="panel-body" style="background-color:#555; width:100%;">
                  <div class="col-md-6 col-md-offset-6">
                    <form action="" method="get">
                      <div class="input-group">
                        <input type="text" name="searchQA" id="searchQA" class="form-control" placeholder="Search Question" style="background-color:#222; border-color:#333;">
                        <div class="input-group-btn">
                          <button class="btn btn-default" style="background-color:#aaa; border-color:#333;" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <hr>
                  <div class="col-md-10 col-md-offset-1" style="height:750px; background-color:#333;overflow-y:scroll;" id="style-1">
                    <div id="QA">
                      <div align="center" style="padding-top:80%;">
                        <img src="{{ asset('public\icon\loading_spinner.gif') }}" alt="" width="10%">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="" style="text-align:right;">
                     <a class="seemore" href="{{ url('/question.and.answer') }}"><i class="glyphicon glyphicon-plus"></i> see more...</a>
                    </div>
                    <div style="height:20px;"></div>
                  </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
  setTimeout(function() { loadQandA(); } , 100);
  setTimeout(function() { loadQandA(); } , 100);
  function loadQandA() {
    $( "#QA" ).load( "{{ url('show.QA') }}");
  }
  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();
  
  $('#searchQA').keyup(function(){
    var all = document.getElementById("QA");
    console.log(all.length;
  });
</script>
@endsection
