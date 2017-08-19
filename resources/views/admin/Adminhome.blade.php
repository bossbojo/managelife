<?php
use App\User;
if(session()->get('login') == 'ture'){

?>
@extends('admin.app')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin ML</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  </head>
  <style media="screen">
    .btnpro{

    }
    .btnpro:hover{

    }
  </style>
  <body>
    <div canvas="container">
      <button class="js-toggle-left-slidebar btn btn-default btn-circle btn-lg"> <i class="glyphicon glyphicon-align-justify"></i> </button>
      <span style="float:right; font-size:25px; padding:10px;"><i class="glyphicon glyphicon-home"></i> Home</span>
      <hr style="border-color:#aaa;">
      <div class="col-md-12">
        <div class="col-md-8">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Disk</th>
                      <th>Provider</th>
                      <th>online</th>
                      <th>created_at</th>
                  </tr>
              </thead>
              <tbody id="">
                <?php
                $user = User::all();
                foreach ($user as $users) {
                 ?>
                  <tr>
                      <td>{{ $users->id }}</td>
                      <td>
                        <a href="#" onclick="reviewUser('{{ $users->id }}')"><i class="glyphicon glyphicon-user"></i> {{ $users->name }}</a>
                      </td>
                      <td>{{ $users->email }}</td>
                      <td>{{ number_format($users->disk,2)}}MB</td>
                      <td>{{ $users->provider }}</td>
                      @if($users->online == 'true')
                        <td style="color:rgb(77, 224, 58);" align="center">{{ $users->online }} <i class="glyphicon glyphicon-record"></i></td>
                      @else
                        <td style="color:rgb(255, 18, 18);" align="center">{{ $users->online }} <i class="glyphicon glyphicon-record"></i></td>
                      @endif
                      <td>{{ $users->created_at }}</td>
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
               <div id="" class="" style="display:;">
                 <table>
                   <tr>
                     <td>
                       <img id="avataruser" src="{{ asset('public\icon.png') }}" alt="" class="img-thumbnail" width="150px">
                     </td>
                     <td style="padding:10px;">
                       ID : <span id="iduser"> - </span><br>
                       Name : <span id="nameuser"> - </span><br>
                       E-mail : <span id="emailuser"> - </span><br>
                       Gender :<span id="genderuser"> - </span><br>
                       Birthday :<span id="bduser"> - </span><br>
                       Disk :<span id="diskuser"> - </span><br>
                       Provider :<span id="provideruser"> - </span><br>
                     </td>
                   </tr>
                 </table>
                 <hr>
               </div>
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
    $('#home').css({'backgroundColor':'rgb(91, 91, 91)',"color": "rgb(255, 255, 255)"});
    $('#example').DataTable();
} );
function reviewUser(id) {
  console.log(id);
  var link = "{{ url('getdatauserto') }}/"+id;
  $.getJSON( link, function( data ) {
    var datauser = data.result;
    var datauser2 = data.result2;
    var img = datauser.avatar.split('/');
    if(img[0] == 'public'){
      img = '{{ asset('') }}'+datauser.avatar;
    }else{
      img = datauser.avatar;
    }
    if(datauser2 == null){
      $('#genderuser').html(' - ');
      $('#bduser').html(' - ');
    }else{
      $('#genderuser').html(datauser2.gender);
      $('#bduser').html(datauser2.birthday);
    }
    $('#avataruser').attr('src',img);
    $('#iduser').html(datauser.id);
    $('#nameuser').html(datauser.name);
    $('#emailuser').html(datauser.email);

    $('#diskuser').html(datauser.disk+'MB/'+datauser.limitdisk+'MB');
    $('#provideruser').html(datauser.provider);

  });
}
</script>

<?php
}else{
  print 'no';
}
?>
