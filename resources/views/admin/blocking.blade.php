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
  <body>
    <div canvas="container">
      <button class="js-toggle-left-slidebar btn btn-default btn-circle btn-lg"> <i class="glyphicon glyphicon-align-justify"></i> </button>
      <span style="float:right; font-size:25px; padding:10px;"><i class="glyphicon glyphicon-ban-circle"></i> Blocking</span>
      <hr style="border-color:#aaa;">
      <div class="col-md-12">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Disk</th>
                      <th>Provider</th>
                      <th>Blocking</th>
                      <th>online</th>
                      <th>created_at</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $user = User::all();
                foreach ($user as $users) {
                 ?>
                  <tr>
                      <td>{{ $users->id }}</td>
                      <td><i class="glyphicon glyphicon-user"></i> {{ $users->name }}</td>
                      <td>{{ $users->email }}</td>
                      <td>{{ number_format($users->disk,2)}}MB</td>
                      <td>{{ $users->provider }}</td>
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
                      <td>{{ $users->created_at }}</td>
                  </tr>
                  <?php
                  }
                   ?>
              </tbody>
          </table>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#Blocking').css({'backgroundColor':'rgb(91, 91, 91)',"color": "rgb(255, 255, 255)"});
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
</script>

<?php
}else{
  print 'no';
}
?>
