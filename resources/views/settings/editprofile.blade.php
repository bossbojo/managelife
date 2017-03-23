@extends('layouts.app')
<?php
  use App\DetailProfile;
?>
@section('content')
<style media="screen">
  .add{
    padding: 10;
    border-radius: 5px;
    background-color:#000;
    border-style: dashed;
    border-color: #333;
    color: #aaa;
  }
  .add:hover{
    padding: 10;
    border-radius: 5px;
    background-color:#111;
    border-style: dashed;
    border-color: #333;
    color: #aaa;
  }
  .btnicon{
      color: #aaa;
  }
  .btnicon:hover{
    color: #fff;
    background-color: #444;
  }
  th{
     border-color:#555;
  }
</style>
  @if (!Auth::guest())
<link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/popup.css') }}">
<script src="asset('public/popelt-v1.0-source.js')"></script>
<link rel="stylesheet" href="{{ asset('public/css/setting.css') }}">
<div style="height:10px;"></div>
<div class="container">
  <?php
  $showdetail = DetailProfile::find(Auth::user()->id);
   ?>
    <div class="col-md-3" style="background-color:#333; padding:0px; border-top-left-radius: 2em; border-bottom-left-radius: 2em;">
      <div class="btn-group-vertical" style="width:100%;">
        <div class="" align="center" style="padding: 10px;">
          <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-cog"></i> settings</label>
        </div>
        <!-- btnsetting_that -->
        @if(Auth::user()->provider == 'managelife')
        <a href="{{ url('settings\changepass') }}" class="btn btnsetting " style="text-align:left; padding-left: 1cm; "><i class="glyphicon glyphicon-repeat"></i> Change password</a>
        @endif
        <a href="{{ url('settings\editprofile') }}" class="btn btnsetting btnsetting_that" style="text-align:left; padding-left: 1cm;"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
      </div>
      <div style="height:60px;"></div>
    </div>
    <div class="col-md-9 solid" style="background-color:#555; height:800px; border-top-right-radius: 2em; border-bottom-right-radius: 2em;">
        <div class="col-md-12">
          <div class="panel-body">
           <label for="" style="color:#fff; font-size:20px;"><img  src="{{ asset('public\icon\editprofile.png') }}" width="25" alt=""> Edit Profile</label>
             <div class="panel-body solid-top">
                <div class="col-md-10 col-md-offset-1" ><br>
                  <div class="panel panel-default"  style="background-color:#000;border-color:#555;">
                    <div class="panel-body">
                      <form id="editprofile">
                          {{ csrf_field() }}
                          <table class="table">
                            <!-- name -->
                            <tr>
                              <th style="width:160px;"><i class="glyphicon glyphicon-user"></i> Name</th>
                              <th id="showname" >{{ Auth::user()->name }}</th>
                              <th id="editshowname" ><a href="#" onclick="editname()"><i class="glyphicon glyphicon-pencil"></i></a></th>
                              <!-- edit -->
                              <th id="editname" style="display:none;">
                                <input id="inputEditname" class="form-control" type="text" name="" value="{{ Auth::user()->name }}"  onkeydown="if (event.keyCode == 13) { submiteditname('{{  Auth::user()->id }}') }" >
                              </th>
                              <th id="closename" style="display:none;">
                                <a href="#" onclick="closename()"><i class="glyphicon glyphicon-remove"></i></a>
                              </th>
                            </tr>
                            <script type="text/javascript">
                            function editname() {
                              $('#showname').hide();
                              $('#editshowname').hide();
                              $('#editname').fadeIn();
                              $('#closename').fadeIn();
                            }
                            function closename() {
                              $('#inputEditname').val('{{ Auth::user()->name }}');
                              $('#editname').hide();
                              $('#closename').hide();
                              $('#showname').fadeIn();
                              $('#editshowname').fadeIn();
                            }
                            function submiteditname(id) {
                              var data2 = { Id: id ,
                                            Editname : $('#inputEditname').val()
                                          };
                              var url2 = "{{ url('/editname') }}"; // the script where you handle the form input.
                              $.ajax({
                                     type: "get",
                                     url: url2,
                                     data: data2 , // serializes the form's elements.
                                     success: function(result) {
                                       console.log(result);
                                       $('#showname').html(''+result);
                                     },
                                     error: function(xhr,textStatus){ alert(textStatus);}
                               });
                              closename();
                            }
                            </script>
                            <!-- Email -->
                            <tr>
                              <th style="width:160px;"><i class="glyphicon glyphicon-envelope"></i> Email</th>
                              <th>{{ Auth::user()->email }}</th>
                              <th></th>
                            </tr>
                            <!-- gender -->
                            <tr>
                              <th style="width:160px;"><i class="glyphicon glyphicon-leaf"></i> Gender</th>
                              @if($showdetail == '')
                                <th id="showgender"> - </th>
                              @else
                                @if($showdetail->gender == '')
                                  <th id="showgender"> - </th>
                                @else
                                  <th id="showgender">{{ $showdetail->gender }}</th>
                                @endif
                              @endif
                              <th id="btndeitgender">
                                <a href="#"  onclick="showeditgender()"><i class="glyphicon glyphicon-pencil"></i></a>
                              </th>
                              <!-- edit gender -->
                              <th id="editgender" style="display:none;">
                                @if($showdetail != '')
                                  @if( $showdetail->gender == 'male')
                                    <input type="radio" name="gender" value="male" checked>Male
                                    <input type="radio" name="gender" value="female">Female
                                  @endif
                                  @if( $showdetail->gender == 'female')
                                    <input type="radio" name="gender" value="male">Male
                                    <input type="radio" name="gender" value="female" checked>Female
                                  @endif
                                @else
                                  <input type="radio" name="gender" value="male">Male
                                  <input type="radio" name="gender" value="female">Female
                                @endif
                              </th>
                              <th id="closegender" style="display:none;">
                                <a href="#" style="color:#48bb4d;" onclick="submitgender('{{ Auth::user()->id }}')"><i class="glyphicon glyphicon-ok"></i></a>
                                <a href="#" onclick="closeeditgender()"><i class="glyphicon glyphicon-remove"></i></a>
                              </th>
                              <script type="text/javascript">
                                function showeditgender() {
                                  $('#showgender').hide();
                                  $('#btndeitgender').hide();
                                  $('#editgender').fadeIn();
                                  $('#closegender').fadeIn();
                                }
                                function closeeditgender() {
                                  $('#showgender').fadeIn();
                                  $('#btndeitgender').fadeIn();
                                  $('#editgender').hide();
                                  $('#closegender').hide();
                                }
                                function submitgender(id) {
                                 var data =  $('input[name="gender"]:checked').val();
                                 console.log(data);
                                 var data2 = { Id: id ,
                                               Editgender : data
                                             };
                                 var url2 = "{{ url('/editgender') }}"; // the script where you handle the form input.
                                 $.ajax({
                                        type: "get",
                                        url: url2,
                                        data: data2 , // serializes the form's elements.
                                        success: function(result) {
                                          console.log(result);
                                          $('#showgender').html(''+result);
                                        },
                                        error: function(xhr,textStatus){ alert(textStatus);}
                                  });
                                 closeeditgender();
                                }
                              </script>
                            </tr>
                            <!-- Birthday -->
                            <tr>
                              <th style="width:160px;"><i class="glyphicon glyphicon-calendar"></i> Birthday</th>
                              @if($showdetail == '')
                                <th id="showbirthday"> - </th>
                              @else
                                @if($showdetail->birthday  == '')
                                  <th id="showbirthday"> - </th>
                                @else
                                  <th id="showbirthday">{{ $showdetail->birthday }}</th>
                                  <?php
                                  $strBD = explode('/',$showdetail->birthday)
                                   ?>
                                @endif
                              @endif
                              <th id="btnditbirthday" >
                                <a href="#" onclick="showeditbirthday()"><i class="glyphicon glyphicon-pencil"></i></a>
                              </th>
                              <!-- editHD -->
                              <th id="editbirthday" style="display:none;">
                                <div class="col-md-4">
                                        <p align="center">
                                            <select style="width:75px;" class="form-control" name="Day" id="Day">
                                              @if($showdetail == '')
                                                <option value="" disabled selected>Day</option>
                                                @for($i=1;$i<=31 ; $i++)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                              @else
                                                @if($showdetail->birthday  == '')
                                                  <option value="" disabled selected>Day</option>
                                                  @for($i=1;$i<=31 ; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                  @endfor
                                                @else
                                                  <option value="" disabled>Day</option>
                                                  @for($i=1;$i<=31 ; $i++)
                                                    @if($strBD[0] == $i)
                                                      <option value="{{ $i }}" selected>{{ $i }}</option>
                                                    @else
                                                      <option value="{{ $i }}" >{{ $i }}</option>
                                                    @endif
                                                  @endfor
                                                @endif
                                              @endif

                                            </select>
                                        </p>
                                    </div>
                                    <?php
                                    $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                                     ?>
                                    <div class="col-md-4">
                                        <p align="center">
                                            <select style="width:100px;" class="form-control" name="Month"  id="Month">
                                              @if($showdetail == '')
                                                <option value="" disabled selected>Month</option>
                                                @for($i=1;$i<=12 ; $i++)
                                                  <option value="{{ $i }}">{{ $month[$i-1] }}</option>
                                                @endfor
                                              @else
                                                @if($showdetail->birthday  == '')
                                                  <option value="" disabled selected>Month</option>
                                                  @for($i=1;$i<=12 ; $i++)
                                                    <option value="{{ $i }}">{{ $month[$i-1] }}</option>
                                                  @endfor
                                                @else
                                                  <option value="" disabled>Month</option>
                                                  @for($i=1;$i<=12 ; $i++)
                                                    @if($strBD[1] == $i)
                                                      <option value="{{ $i }}" selected>{{ $month[$i-1] }}</option>
                                                    @else
                                                      <option value="{{ $i }}" >{{ $month[$i-1] }}</option>
                                                    @endif
                                                  @endfor
                                                @endif
                                              @endif

                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p align="center">
                                            <select  style="width:80px;" class="form-control" name="Year" id="Year">
                                              @if($showdetail == '')
                                                <option value="" disabled selected>Year</option>
                                                @for($i=2017;$i >= 1930 ; $i--)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                              @else
                                                @if($showdetail->birthday  == '')
                                                  <option value="" disabled selected>Year</option>
                                                  @for($i=2017;$i >= 1930 ; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                  @endfor
                                                @else
                                                  <option value="" disabled>Year</option>
                                                  @for($i=2017;$i >= 1930 ; $i--)
                                                    @if($strBD[2] == $i)
                                                      <option value="{{ $i }}" selected>{{ $i }}</option>
                                                    @else
                                                      <option value="{{ $i }}" >{{ $i }}</option>
                                                    @endif
                                                  @endfor
                                                @endif
                                              @endif
                                            </select>
                                        </p>
                                    </div>
                              </th>
                              <th id="closeBD" style="display:none;">
                                <a href="#" style="color:#48bb4d;" onclick="submitDB('{{ Auth::user()->id }}')"><i class="glyphicon glyphicon-ok"></i></a>
                                <a href="#" onclick="closeBD()"><i class="glyphicon glyphicon-remove"></i></a>
                              </th>
                            </tr>
                            <script type="text/javascript">
                              function showeditbirthday() {
                                $('#btnditbirthday').hide();
                                $('#showbirthday').hide();
                                $('#editbirthday').fadeIn();
                                $('#closeBD').fadeIn();
                              }
                              function closeBD() {
                                $('#btnditbirthday').fadeIn();
                                $('#showbirthday').fadeIn();
                                $('#editbirthday').hide();
                                $('#closeBD').hide();
                              }
                              function submitDB(id) {
                                var day = $('#Day').val();
                                var month = $('#Month').val();
                                var year = $('#Year').val();
                                var data = day+'/'+month+'/'+year;
                                var data2 = { Id: id ,
                                              Editbirthday : data
                                            };
                                var url2 = "{{ url('/editbirthday') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       success: function(result) {
                                         console.log(result);
                                         $('#showbirthday').html(''+result);
                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                 });
                                closeBD();
                              }
                            </script>
                            </table>
                            <!-- show other -->
                            <?php
                            $topicall = DB::table('other_detail')
                                      ->where('user_id', '=', Auth::user()->id)
                                      ->get();
                             ?>


                            <table class="table" id="showother2">
                              <?php
                              foreach ($topicall as $topicalls) {
                               ?>
                               <tr id="{{ $topicalls->id }}">
                                 <th style="width:160px;" id="topic{{ $topicalls->id }}">
                                   <div id="showtopic{{ $topicalls->id }}" class="">
                                     <i class="{{ $topicalls->icon }}"></i> {{ $topicalls->topic }}
                                   </div>
                                   <div id="showedittopic{{ $topicalls->id }}" class="input-group" style="display:none;">
                                     <span class="input-group-addon"><i class="{{ $topicalls->icon }}"></i></span>
                                     <input id="inputEditTopic{{ $topicalls->id }}" type="text" class="form-control" value="{{ $topicalls->topic }}" >
                                   </div>
                                 </th>
                                 <th id="detail{{ $topicalls->id }}">
                                   <div id="showdetail{{ $topicalls->id }}" class="">
                                     {{ $topicalls->detail }}
                                   </div>
                                   <div id="showEditdetail{{ $topicalls->id }}" class="" style="display:none;">
                                     <input id="inputEditDetail{{ $topicalls->id }}" type="text" class="form-control" value="{{ $topicalls->detail }}">
                                   </div>
                                 </th>
                                 <th id="btnditOther{{ $topicalls->id }}">
                                   <a href="#" onclick="showeditother({{ $topicalls->id }})"><i class="glyphicon glyphicon-pencil"></i></a>
                                   <a href="#" onclick="deleteOther({{ $topicalls->id }})"><i class="glyphicon glyphicon-trash"></i></a>
                                 </th>
                                 <th id="closebtnditOther{{ $topicalls->id }}" style="display:none;">
                                   <a href="#" style="color:#48bb4d;" onclick="submiteditotherTopic('{{ $topicalls->id }}' , '{{ $topicalls->icon }}')"><i class="glyphicon glyphicon-ok"></i></a>
                                   <a href="#" onclick="closeeditother('{{ $topicalls->id }}')"><i class="glyphicon glyphicon-remove"></i></a>
                                 </th>
                               </tr>
                               <?php
                              }
                               ?>
                            </table>
                            <script type="text/javascript">
                              function showeditother(id) {
                                $('#showtopic'+id).hide();
                                $('#showedittopic'+id).fadeIn();
                                $('#showdetail'+id).hide();
                                $('#showEditdetail'+id).fadeIn();
                                $('#btnditOther'+id).hide();
                                $('#closebtnditOther'+id).fadeIn();
                              }
                              function closeeditother(id) {
                                $('#showtopic'+id).fadeIn();
                                $('#showedittopic'+id).hide();
                                $('#showdetail'+id).fadeIn();
                                $('#showEditdetail'+id).hide();
                                $('#btnditOther'+id).fadeIn();
                                $('#closebtnditOther'+id).hide();
                              }
                              function deleteOther(id) {
                                var data2 = { Id: id};
                                var url2 = "{{ url('/deleteOther') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       success: function(result) {
                                         console.log(result);
                                         if(result == 'success'){
                                           $('#'+id).fadeOut();
                                         }

                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                 });

                              }
                              function submiteditotherTopic(id,icon) {
                                var data2 = { Id: id,
                                              topic : $('#inputEditTopic'+id).val() ,
                                              detail : $('#inputEditDetail'+id).val() };
                                var url2 = "{{ url('/editother') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       success: function(result) {
                                         console.log(result);
                                         if(result == 'success'){
                                           $('#showtopic'+id).html('<i class="'+icon+'"></i>'+$('#inputEditTopic'+id).val());
                                           $('#showdetail'+id).html(''+$('#inputEditDetail'+id).val());
                                         }

                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                 });
                                 closeeditother(id);
                              }

                            </script>
                            <!--BTN Add other -->
                            <table>
                            <tr>
                              <th></th>
                              <th><B>You can add new details.</B></th>
                              <th>
                                <a class="btn add" onclick="openpopup()">
                                  <i class="glyphicon glyphicon-plus"></i>
                                </a>
                              </th>
                            </tr>
                          </table>
                      </form>
                    </div>
                  </div>
                </div>
             </div>
          </div>
        </div>
    </div>
</div>
<!-- popup add other topic -->
<div id="AddOther" class="modal">
  <!-- Modal content -->
  <div class="col-md-6 col-md-offset-3" style="background-color:#333; padding:10px;">
    <span class="close" onclick="closepopup()">&times;</span>
    <h4><b>Add other topic</b></h4>
    <table class="table" style="border-color:#333;">
      <!-- data add -->
     <?php
     $Icon = ["glyphicon glyphicon-asterisk","glyphicon glyphicon-music","glyphicon glyphicon-glass","glyphicon glyphicon-star","glyphicon glyphicon-film","glyphicon glyphicon-time","glyphicon glyphicon-home",
              "glyphicon glyphicon-list-alt","glyphicon glyphicon-flag","glyphicon glyphicon-bookmark","glyphicon glyphicon-map-marker","glyphicon glyphicon-info-sign","glyphicon glyphicon-gift","glyphicon glyphicon-fire",
              "glyphicon glyphicon-thumbs-up","glyphicon glyphicon-bullhorn","glyphicon glyphicon-tree-conifer","glyphicon glyphicon-phone-alt","glyphicon glyphicon-send","glyphicon glyphicon-education","glyphicon glyphicon-sunglasses",
              "glyphicon glyphicon-blackboard","glyphicon glyphicon-king","glyphicon glyphicon-globe"];
     ?>
      <tr >
        <th style="width:100px;">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Icon
            <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="width:250px; background-color:#555;">
              <li role="presentation" class="divider" style="background-color:#666;"></li>
              <li role="presentation" style="margin:0px;">
                <div class="" style="padding-left:10px;padding-rigth:10px;">
                  @for($i=0;$i < sizeof($Icon) ; $i++)
                    <a href="#" class="btn btnicon" onclick="changeIcon('{{ $Icon[$i] }}')">
                      <i class="{{ $Icon[$i] }}"></i>
                    </a>
                  @endfor
                </div>
              </li>
              <li role="presentation" class="divider" style="background-color:#666;"></li>
            </ul>
          </div>
        </th>
        <input id="icon" type="hidden" name="" value="" >
        <th>
          <input class="form-control" id="topic" type="text" name="" value="" placeholder="Topic">
          <p style="color:red;display:none;" id="wrongtopic">Plesae import topic</p>
        </th>
        <th>
          <input class="form-control" id="detail" type="text" name="" value="" placeholder="Detail">
          <p style="color:red;display:none;" id="wrongdetail">Plesae import detail</p>
        </th>
      </tr>
    </table>
    <div class="" align="right">
      <a href="#" class="btn btn-success" onclick="submitother('{{ Auth::user()->id }}')">
        Add topic
      </a>
    </div>
  </div>
</div>
<script>
  load_data();
  function openpopup() {
    $('#AddOther').fadeIn();
  }
  function closepopup() {
    $('#AddOther').fadeOut();
    $('#wrongtopic').hide();
    $('#wrongdetail').hide();
    $('#topic').val('');
    $('#detail').val('');
  }
  function changeIcon(icon) {
    $('#menu1').html('<i class="'+icon+'"></i> <span class="caret"></span>');
    $('#icon').val(icon);
  }
  function submitother(id) {
    if( $('#topic').val() == '' || $('#detail').val() == ''){
      $('#wrongtopic').fadeIn();
      $('#wrongdetail').fadeIn();
    }else{
      console.log($('#icon').val());
      var data2 = { Id: id ,
                    icon : $('#icon').val() ,
                    topic : $('#topic').val() ,
                    detail : $('#detail').val()
                  };
      var url2 = "{{ url('/addotherTopic') }}"; // the script where you handle the form input.
      $.ajax({
             type: "get",
             url: url2,
             data: data2 , // serializes the form's elements.
             success: function(result) {
               console.log(result);
               location.reload();
             },
             error: function(xhr,textStatus){ alert(textStatus);}
       });
       closepopup();
    }
  }
</script>

@else
<a href="{{ url('login') }}" id="nologin"></a>
<script>
    $('#nologin')[0].click();
</script>
@endif
@endsection
