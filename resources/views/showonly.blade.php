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

                                                                  <!-- tag post  -->
        <div class="col-md-8 col-md-offset-2" style="overflow-y:scroll; " id="style-1">

          <br><br>
            <script src="{{ asset('public/js/home.js') }}"></script>
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
                 var audio = new Audio('{{ asset("public/tones/post.mp3") }}');
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
               var audio = new Audio('{{ asset("public/tones/post.mp3") }}');
               audio.play();
             },
             error: function(xhr,textStatus){ alert(textStatus);}
           });
          </script>

              <div class="result">
                <div align="center" >
                  <img src="{{ asset('public\icon\loading_spinner.gif') }}" alt="" width="5%">
                </div>
              </div>
              <input id="get_id" name="get_id" type="text" style="display:none;">
              <script>

              setTimeout(function(){ loadpage(); }, 1000);
              setTimeout(function(){ loadpage(); }, 1000);
              function loadpage() {
                $( ".result" ).load( "{{ url('showonlystatus') }}"+"/{{ $idstatus }}" );
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

        <script>
            function addfriend(my_id,friend_id) {
              console.log('addfriend my '+my_id+' frined '+friend_id);
              var data2 = { Id : my_id ,
                            Id_friend : friend_id };
              var url2 = "{{ url('/addfriend') }}"; // the script where you handle the form input.
              $.ajax({
                     type: "get",
                     url: url2,
                     data: data2, // serializes the form's elements.
                     success: function(result){
                       console.log(result);
                       if(result=='success'){
                         $('#Addfriend').hide();
                         $('#CancelAddFriend').fadeIn();
                       }
                     },
                     error: function(xhr,textStatus){ alert(textStatus);}
                   });
            }
            function CancelAddFriend(my_id,friend_id) {
              console.log('CancelAddFriend my '+my_id+' frined '+friend_id);
              var data2 = { Id : my_id ,
                            Id_friend : friend_id };
              var url2 = "{{ url('/canceladdfriend') }}"; // the script where you handle the form input.
              $.ajax({
                     type: "get",
                     url: url2,
                     data: data2, // serializes the form's elements.
                     success: function(result){
                       console.log(result);
                       if(result=='success'){
                         $('#CancelAddFriend').hide();
                         $('#Addfriend').fadeIn();
                       }
                     },
                     error: function(xhr,textStatus){ alert(textStatus);}
                   });
            }
            function RemoveFriend(my_id,friend_id) {
              console.log('removeFriend my '+my_id+' frined '+friend_id);
              var data2 = { Id : my_id ,
                            Id_friend : friend_id };
              var url2 = "{{ url('/removefriend') }}"; // the script where you handle the form input.
              $.ajax({
                     type: "get",
                     url: url2,
                     data: data2, // serializes the form's elements.
                     success: function(result){
                       console.log(result);
                       if(result=='success'){
                         $('#RemoveFriend').hide();
                         $('#RemoveFriend2').hide();
                         $('#CancelAddFriend').hide();
                         $('#Addfriend').fadeIn();
                       }
                     },
                     error: function(xhr,textStatus){ alert(textStatus);}
                   });
            }
        </script>
</div>
<script type="text/javascript">


  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();

</script>
@endsection
