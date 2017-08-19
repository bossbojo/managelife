<?php
use Illuminate\Support\Facades\DB;
use App\User;
use App\Contact;
if(session()->get('login') == 'ture'){

?>
@extends('admin.app')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin ML</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="{{ asset('public\css\bubble.css') }}">
  </head>
  <body>
    <div canvas="container">
      <button class="js-toggle-left-slidebar btn btn-default btn-circle btn-lg"> <i class="glyphicon glyphicon-align-justify"></i> </button>
      <span style="float:right; font-size:25px; padding:10px;"><i class="glyphicon glyphicon-comment"></i> Contacting</span>
      <hr style="border-color:#aaa;">
      <div class="col-md-12">
        <div class="col-md-8">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Blocking</th>
                      <th>online</th>
                      <th>Contacting</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $user = User::all();
                foreach ($user as $users) {
                 ?>
                 <tr>
                     <td>{{ $users->id }}</td>
                     <td>
                       <a href="#" onclick="reviewUser('{{ $users->id }}','{{ $users->avatar }}','{{ $users->filter }}','{{ $users->name }}')">
                         <i class="glyphicon glyphicon-user"></i> {{ $users->name }}
                       </a>
                     </td>
                     <td>{{ $users->email }}</td>
                     <td align="center">
                       @if($users->blocking == 'block')
                         <a href="#" style="display:;" id="unblock{{ $users->id }}" onclick="unblock('{{ $users->id }}')"><i class="glyphicon glyphicon-ban-circle"></i> Unblock</a>
                         <a href="#" style="display:none;" id="block{{ $users->id }}" onclick="block('{{ $users->id }}')"><i class="glyphicon glyphicon-remove"></i> Block</a>
                       @else
                       <a href="#" style="display:none;" id="unblock{{ $users->id }}" onclick="unblock('{{ $users->id }}')"><i class="glyphicon glyphicon-ban-circle"></i> Unblock</a>
                       <a href="#" style="display:;" id="block{{ $users->id }}" onclick="block('{{ $users->id }}')"><i class="glyphicon glyphicon-remove"></i> Block</a>
                       @endif
                     </td>
                     @if($users->online == 'true')
                       <td style="color:rgb(77, 224, 58);" align="center">{{ $users->online }} <i class="glyphicon glyphicon-record"></i></td>
                     @else
                       <td style="color:rgb(255, 18, 18);" align="center">{{ $users->online }} <i class="glyphicon glyphicon-record"></i></td>
                     @endif
                     <td align="center">
                       <?php
                       $count = DB::table('contact')
                                 ->where([
                                   ['user_id', '=', $users->id ]
                                 ])
                                 ->count();
                        ?>
                        {{ $count }}
                     </td>
                 </tr>
                  <?php
                  }
                   ?>
              </tbody>
          </table>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default" style="border-color:#aaa;">
            <div class="panel-body">
              <span><i class="glyphicon glyphicon-user"></i> : <span id="nameuser"> - </span></span>
              <table class="table">
               <tbody id="resultview">
               </tbody>
             </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#Contacting').css({'backgroundColor':'rgb(91, 91, 91)',"color": "rgb(255, 255, 255)"});
    $('#example').DataTable();
} );
function block(id) {
  var data2 = { Id: id }
  var url2 = "{{ url('/block') }}"; // the script where you handle the form input.
  $.ajax({
         type: "get",
         url: url2,
         data: data2 , // serializes the form's elements.
         success: function(result) {
           console.log(result);
           $('#block'+id).hide();
           $('#unblock'+id).fadeIn();
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
}
function unblock(id) {
  var data2 = { Id: id }
  var url2 = "{{ url('/unblock') }}"; // the script where you handle the form input.
  $.ajax({
         type: "get",
         url: url2,
         data: data2 , // serializes the form's elements.
         success: function(result) {
           console.log(result);
           $('#unblock'+id).hide();
           $('#block'+id).fadeIn();
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
}
function reviewUser(id,avatar,filter,name) {
  $('#nameuser').html(name);
  var link = "{{ url('getcontact') }}/"+id;
  var img = avatar.split('/');
  if(img[0] == 'public'){
    img = '{{ asset('') }}'+avatar;
  }else{
    img = avatar;
  }
  var strhtml = '';
  $.getJSON( link, function( data ) {
    var datauser = data.result;
    for (var i = 0; i < datauser.length; i++) {
      strhtml += '   <tr id="contact'+datauser[i].id+'">  \
                       <td style="width:90px;">\
                         <img id="avataruser" src="'+img+'" alt="" style="'+filter+'" class="img-thumbnail" width="80px"><br>\
                       </td>\
                       <td style="padding:-10px; margin:0px;">\
                         <div class="talk-bubble tri-right left-top" >\
                           <div class="talktext"  >\
                             '+datauser[i].contact+'\
                           </div>\
                         </div>\
                         <div class="" align ="right">\
                            <a href="#" onclick="delectcontact(\''+datauser[i].id+'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> delete</a>\
                         </div>\
                       </td>\
                     </tr>';
    }
    $('#resultview').html(strhtml);
  });
}
function delectcontact(id) {
  var data2 = { Id: id }
  var url2 = "{{ url('/delectcontact') }}";
  $.ajax({
         type: "get",
         url: url2,
         data: data2 ,
         success: function(result) {
           console.log(result);
           $('#contact'+id).fadeOut();
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
}
</script>

<?php
}else{
  print 'no';
}
?>
