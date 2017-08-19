<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <style>
      #search input[type="text"] {
          background: #444;
          border: 0 none;
          /*font: bold 12px Arial,Helvetica,Sans-serif;*/
          font-size:10px;
          color: #777;
          width: 220px;
          padding: 6px 15px 6px 35px;
          -webkit-border-radius: 20px;
          -moz-border-radius: 20px;
          border-radius: 20px;
          text-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
          -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 3px rgba(0, 0, 0, 0.2) inset;
          -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 3px rgba(0, 0, 0, 0.2) inset;
          box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 3px rgba(0, 0, 0, 0.2) inset;
          -webkit-transition: all 0.7s ease 0s;
          -moz-transition: all 0.7s ease 0s;
          -o-transition: all 0.7s ease 0s;
          transition: all 0.7s ease 0s;
      }
      #search input[type="text"]:focus {
        width: 350px;
      }
      .alert-span{
        background-color:#888;
        color:#fff;
        border-radius:10px;
        font-size:12px;
        position:absolute;
        top:5px;
        padding-left: 5px;
        padding-right: 5px;
        margin-left: -6px;
        font-weight:bold;
      }

      .searchuser:hover{
        background-color:rgb(223, 183, 123);
      }
      </style>

    <!-- Scripts -->
    <script>
    //   window.Laravel = <?php echo json_encode([  'csrfToken' => csrf_token(),]); ?>
    </script>
</head>
<body style="background-color:#111; border-color:#000;">
    <div id="app" >
        <nav class="navbar navbar-default navbar-static-top  navbar-fixed-top" style="background-color:#000; border-color:#000; margin-bottom:0px;">
            <div class="container" style="border-color:#000;">
                <div class="navbar-header " style="border-color:#000;">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" style="border-color:#000;">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('public/logoweb.png') }}" width="75">
                    </a>
                    @if (Auth::guest())
                    <!-- <li><a href="{{ url('/home') }}">Home</a></li> -->
                    @else
                    <ul class="nav navbar-nav" style="padding: 12px 0px 10px 50px;" style="border-color:#000;">
                        <li class="dropdown">
                          <a href="#" id="ShowBarSearch" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="display:none;"></a>
                              <form autocomplete="off" action="{{ url('/searchfriends') }}" method="get" id="search">
                                  <input id="inputsearch" onclick="searchShow()" name="name_friend" type="text" size="40" placeholder="Search friends..." />
                              </form>
                            <ul class="dropdown-menu searchfriendhei" style="overflow-y:scroll;" id="style-2" role="menu">
                              <li >
                                  <a style="width:350px;" id="dataSearch">
                                     <i class="glyphicon glyphicon-search"></i> :
                                  </a>
                              </li>
                              <hr style="margin-top:2px;margin-bottom:5px; border-color:#dddddd;">
                                <li id="user_search">
                                    <a href="" style="width:350px;" align="center">
                                        <img src="{{ asset('public/icon/ajax-loader.gif') }}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <script>
                        $('#inputsearch').keyup(function(){
                          $('#dataSearch').html('<i class="glyphicon glyphicon-search"></i> : '+ $('#inputsearch').val());
                          var link = "{{ url('searchUser') }}/"+$('#inputsearch').val();
                          $.getJSON( link, function( data ){
                            var datacommet = data.result;
                            var addhtml = '';
                            var touser = '';
                            var online = '';
                            var limitshow = 0;
                            limitshow  = datacommet.length;
                            if(datacommet.length > 3){
                              $('.searchfriendhei').css('height','400px');
                            }else{
                              $('.searchfriendhei').css('height','300px');
                            }
                            addhtml = '  <table class="table">';
                            for(var i = 0;i<limitshow;i++){
                              if(datacommet[i].online == 'true'){
                                online =  '<span for="" style="color:#0fbe00;"><b>online</b></span>';
                              }else{
                                online = '<span for="" style="color:red;"><b>offline</b></span>';
                              }
                            touser = "{{ url('user') }}/"+datacommet[i].id;
                            addhtml +='<tbody>'+
                                        '   <tr>'+
                                        '  <td>'+
                                          '  <a href="'+touser+'" style="width:350px;" class="btnMenulife">'+
                                            '    <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="50px">'+
                                            '    <span for=""><b> '+datacommet[i].name+'</b></span>'+
                                          '  </a>'+
                                          '</td>'+
                                            ' <td style="width:30px; padding-top:18px;">'+
                                              online+
                                            '</td>'+
                                          ' </tr>'+
                                          '</tbody>';
                            }
                            addhtml += ' </table>';
                            $('#user_search').html(addhtml);
                            if(datacommet.length == 0){
                                $('#user_search').html('<a style="width:350px;" align="center"><i class="glyphicon glyphicon-alert"></i> <b> Not found</b></a>');
                            }
                          });
                        });
                    </script>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="border-color:#000;">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a>|</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li>
                              <a href="{{ url('/home') }}" id="gotohome">
                                <img  class="img-circle" style="{{ Auth::user()->filter }}" src="{{ asset(''.Auth::user()->avatar) }}" width="22px">
                                {{ Auth::user()->name }}
                              </a>
                            </li>
                            <li>
                              <a href="#"><i class="glyphicon glyphicon-upload"></i> FileUpload</a>
                            </li>
                             <!-- เเจ้งเตือนเพิ่มเพื่อน -->
                            <li class="dropdown">
                                <a href="#" onclick="getaddfriends('{{ Auth::user()->id }}')" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="glyphicon glyphicon-user"></i><span class="alert-span" id="AlertAddfriends">  </span>
                                </a>
                                <ul class="dropdown-menu addfriendhei" style="overflow-y:scroll;" role="menu" id="style-2">
                                    <li style="width:460px;" id="addfriendall">
                                        <a href="#" align="center">
                                            <img src="{{ asset('public') }}/icon/ajax-loader.gif" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <script>
                            setInterval(function(){ getAlertAddfriends() }, 1000);
                              function getAlertAddfriends() {
                                var link = "{{ url('getalertaddfriends') }}/"+"{{  Auth::user()->id }}";
                                $.getJSON( link, function( data ) {
                                var datacommet = data.result;
                                if(datacommet != 0){
                                    $('#AlertAddfriends').html(' '+datacommet+' ');
                                }else{
                                    $('#AlertAddfriends').html('');
                                }
                                });
                              }
                              function getaddfriends(id) {
                                var link = "{{ url('getaddfriends') }}/"+id;
                                var datacommet;
                                $.getJSON( link, function( data ) {
                                  var datacommet = data.result;
                                  var show = '';
                                  var touser = '';
                                  console.log(datacommet.length);
                                  if(datacommet.length != 0){
                                    if(datacommet.length > 3){
                                      $('.addfriendhei').css('height','300px');
                                    }else{
                                      $('.addfriendhei').css('height','200px');
                                    }
                                    show += '<table class="table"><tbody>';
                                      for (var i = 0; i < datacommet.length; i++) {
                                        touser = "{{ url('user') }}/"+datacommet[i].user_id;
                                        show += '<tr>'+
                                        '<td>'+
                                        '  <a href="'+touser+'" style="width:350px;" class="btnMenulife">'+
                                        '  <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="50px">'+
                                        '  <span for="">'+datacommet[i].name+'</span>'+
                                        '</a>'+
                                        '  </td>'+
                                        '  <td style="padding-top:20px; text-align:right;" >'+
                                        '  <a href="#" onclick="Acceptfriend(\''+datacommet[i].id+'\')" class="btn btn-primary" >Accept</a>'+
                                        '  <a href="#" onclick="Cancelfriend(\''+datacommet[i].id+'\')" class="btn btn-default" >Cancel</a>'+
                                        '</td>'+
                                        '  </tr>';
                                      }
                                    show += '</tbody></table>';
                                    $('#addfriendall').html(show);
                                  }else{
                                    $('#addfriendall').html('<a href="#" align="center"><img src="'+"{{ asset('public/icon/ajax-loader.gif') }}"+'" alt=""></a>');
                                    setTimeout(function(){
                                        $('#addfriendall').html('<a style="width:450px;" align="center"><i class="glyphicon glyphicon-alert"></i> <b> Not Requesting</b></a>');
                                    }, 3000);
                                  }
                                });
                                var data2 = { Id: "{{ Auth::user()->id }}" }
                                var url2 = "{{ url('/close_alertfriends') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                     });

                              }
                              function Acceptfriend(id) {
                                var data2 = { Id: id }
                                var url2 = "{{ url('/acceptfriend') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       success: function(result) {
                                         console.log(result);
                                         $('#AcceptfromUser').fadeOut();
                                         $('#CancelAddFriend').hide();
                                         $('#RemoveFriend').fadeIn();
                                         $('#RefusefromUser').hide();
                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                     });
                              }
                              function Cancelfriend(id) {
                                var data2 = { Id: id }
                                var url2 = "{{ url('/cancelfriend') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       success: function(result) {
                                         console.log(result);
                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                     });
                              }
                            </script>
                            <!-- เเจ้งเตือนต่างๆ -->
                            <li class="dropdown" >
                                <a href="#" onclick="addhtml('{{ Auth::user()->id  }}')" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="glyphicon glyphicon-bell"></i><span class="alert-span" id="AlertAddAll2"> </span>
                                </a>
                                <ul class="dropdown-menu" role="menu" style="height:300px; overflow-y:scroll; " id="style-2">
                                  <li style="width:450px; text-align:right;" >
                                      <a  href="#" onclick="readall('{{  Auth::user()->id  }}')" ><i class="glyphicon glyphicon-time"></i> Click for mark all readed</a>
                                  </li>
                                  <li style="width:450px;" id="showalertall">
                                        <!-- show alert  -->
                                        <a id="hideload" href="#" align="center">
                                            <img src="{{ asset('public/icon/ajax-loader.gif') }}" alt="">
                                        </a>
                                  </li>
                                </ul>
                            </li>
                            <script>
                            function readall(id) {
                              var data2 = { Id: id }
                              var url2 = "{{ url('/readall') }}"; // the script where you handle the form input.
                              $.ajax({
                                     type: "get",
                                     url: url2,
                                     data: data2 , // serializes the form's elements.
                                     success: function(result) {
                                       console.log(result);
                                     },
                                     error: function(xhr,textStatus){ alert(textStatus);}
                                   });
                            }
                            setInterval(function(){ getAlertall() }, 1000);
                              function getAlertall() {
                                var link = "{{ url('getalertall') }}/"+"{{  Auth::user()->id }}";
                                $.getJSON( link, function( data ) {
                                var datacommet = data.result;
                                if(datacommet != 0){
                                    $('#AlertAddAll2').html(' '+datacommet+' ');
                                }else{
                                    $('#AlertAddAll2').html('');
                                }
                                });
                              }
                              function addhtml(id) {
                                var link = "{{ url('getalert') }}/"+id;
                                var datacommet;
                                var htmlstr = '<table class="table"><tbody >';
                                var touer;
                                $.getJSON( link, function( data ) {
                                  datacommet = data.result;
                                  var num = datacommet.length;
                                  for (var i = 0; i < num; i++) {
                                    var imgto = datacommet[i].avatar;
                                    var img = imgto.split('/');
                                    if(img[0] == 'public'){
                                      imgto = '{{ asset("") }}'+datacommet[i].avatar;
                                    }
                                    htmlstr += '<tr>';
                                    if(datacommet[i].open == 0){
                                      htmlstr += '<td class="alert">';
                                    }else{
                                      htmlstr += '<td class="alertopen">';
                                    }
                                    if(datacommet[i].type == 'acceptfriend'){
                                        touser = "{{ url('user') }}/"+datacommet[i].friend_id+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;" class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9"> \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>Acceptance</u> You are friend </span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:#1897f2;" class="glyphicon glyphicon-user"></i> \
                                                    </div>';
                                    }
                                    if(datacommet[i].type == 'ithinkso'){
                                        touser = "{{ url('showonly') }}/"+datacommet[i].data+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;"  class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>I think so.</u> With you in your status</span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:#18cb0e;" class="glyphicon glyphicon-ok"></i> \
                                                    </div>';
                                    }
                                    if(datacommet[i].type == 'comment'){
                                        touser = "{{ url('showonly') }}/"+datacommet[i].data+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;" class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>have comment</u> in your status</span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:#d92ea9;" class="glyphicon glyphicon-comment"></i> \
                                                    </div>';
                                    }
                                    if(datacommet[i].type == 'replycomment'){
                                        touser = "{{ url('showonly') }}/"+datacommet[i].data+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;" class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>have reply comment</u> in status\'s that you comment</span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:#d92ea9;" class="glyphicon glyphicon-comment"></i> \
                                                    </div>';
                                    }
                                    if(datacommet[i].type == 'QandA'){
                                        touser = "{{ url('showQ') }}/"+datacommet[i].data+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;" class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>have reply question</u> in your Question and Answer </span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:#d92ea9;" class="glyphicon glyphicon-comment"></i> \
                                                    </div>';
                                    }
                                    if(datacommet[i].type == 'favorite'){
                                        touser = "{{ url('feedback') }}/"+datacommet[i].data+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;" class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>have favorite your portfolio</u></span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:rgb(21, 164, 217);" class="glyphicon glyphicon-briefcase"></i> \
                                                    </div>';
                                    }
                                    if(datacommet[i].type == 'feedback'){
                                        touser = "{{ url('feedback') }}/"+datacommet[i].data+'/'+datacommet[i].id;
                                        htmlstr += '<a href="'+touser+'" style="width:450px;" class="btnMenulife" style="" >';
                                        htmlstr += '<div class="col-md-2"> \
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+imgto+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>have feedback your portfolio</u> form this user</span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:rgb(139, 128, 96);" class="glyphicon glyphicon-hand-left"></i> \
                                                    </div>';
                                    }
                                      htmlstr += '</a>';
                                   htmlstr += '</td></tr>';

                                  }
                                  htmlstr += '</tbody></table>';
                                  $('#showalertall').html(htmlstr);
                                });

                              }
                              function open(id) {
                                var data2 = { Id: id }
                                var url2 = "{{ url('/openalert') }}"; // the script where you handle the form input.
                                $.ajax({
                                       type: "get",
                                       url: url2,
                                       data: data2 , // serializes the form's elements.
                                       success: function(result) {
                                         console.log(result);
                                       },
                                       error: function(xhr,textStatus){ alert(textStatus);}
                                     });
                              }
                            </script>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('settings') }}"><i class="glyphicon glyphicon-cog"></i> Setting</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('settings/changeimage') }}"><i class="glyphicon glyphicon-user"></i> Change image profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('settings/changeimagecover') }}"><i class="glyphicon glyphicon-picture"></i> Change image cover</a>
                                    </li>
                                    @if(Auth::user()->provider == 'managelife')
                                    <li>
                                        <a href="{{ url('settings/changepass') }}"><i class="glyphicon glyphicon-repeat"></i> Change Password</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ url('settings/editprofile') }}"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}" id="logout"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-log-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div style="height:50px;"></div>
        @yield('content')
    </div>

    <!-- Scripts -->

    <script type="text/javascript">

      function searchShow() {
        $('#ShowBarSearch').click();
      }
    </script>
</body>
</html>

<!-- ///////////////////////////////////////////////////////////////// end app /////////////////////////////////////////////////////////////// -->
<?php
use App\Indexportfolio;
use App\Dataportfolio;
if(Auth::guest()==''){
  $index = Indexportfolio::find(Auth::user()->id);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="{{ asset('public/navbarleft/slidebars.css') }}">
    <link rel="stylesheet" href="{{ asset('public/navbarleft/style.css') }}">
    <script src="{{ asset('public/jquery_from/jquery.form.js') }}" type="text/javascript" ></script>
    <!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> -->

    <link rel="stylesheet" href="{{ asset('public/dist/gridstack.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/dist/gridstack-extra.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/css/profile style.css') }}">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>

    <script src="{{ asset('public/dist/gridstack.js') }}"></script>
    <script src="{{ asset('public/dist/gridstack.jQueryUI.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
    <script src="{{ asset('public/popelt-v1.0-source.js') }}"></script>
    <style type="text/css">
        body {
          background-image: url('img/bg/test2.jpg');
           background-repeat: no-repeat;
        }
        .grid-stack {

        }

        .grid-stack-item-content {
            text-align: center;
            background-color: ;
        }
        .positionbtn{
          position:relative;
          background-color:#222;
          text-align: center;
          padding-top:10px;
          padding-bottom:10px;
        }
        .btn2:hover {
            transition: all 0.5s;
            -webkit-filter: invert(100%);filter: invert(100%);
        }
        .btn4 {
            transition: all 0.5s;
            color:#555;
            text-decoration: none;
        }
        .btn3:hover {
            transition: all 0.5s;
            color:#aaa;
            text-decoration: none;
        }
        .shadowbox {
          -webkit-box-shadow: 0px 0px 20px -5px rgba(0,0,0,0.75);
          -moz-box-shadow: 0px 0px 20px -5px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 20px -5px rgba(0,0,0,0.75);
        }
        /*--------------------------popup tool edit-----------------------------------*/
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 40%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close2 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close2:hover,
        .close2:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close3 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close3:hover,
        .close3:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close4 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close4:hover,
        .close4:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close5 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close5:hover,
        .close5:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close6 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close6:hover,
        .close6:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close7 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close7:hover,
        .close7:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close8 {
            color: #aaa;
            float: right;
            font-size: 28px;

        }

        .close8:hover,
        .close8:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        /*-----------------------------------------------------*/

        .modal-header {
            padding: 2px 16px;
            background-color: #353735;
            color: white;
        }

        .modal-body {padding: 2px 16px;}

        .modal-footer {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }
        .barinput[type=text] {
            margin: 8px 0;
            box-sizing: border-box;
            border: none;
            border-bottom: 1.5px solid #2ca6f4;
        }
        .parent{
            overflow: hidden;
        }
    </style>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script>
    	//paste this code under head tag or in a seperate js file.
    	// Wait for window load
    	$(window).load(function() {
    		// Animate loader off screen
    		$(".se-pre-con").fadeOut("slow");;
    	});
    </script>
</head>

<body background="img/bg/6860999-blurry.jpg" style="background-color:#aaa; ">
  <div class="positionbtn " style="display:none;" >
      <a class=" btn btn-info" href="{{ url('/home') }}">
        <i class="glyphicon glyphicon-home" ></i> HOME
      </a>
      <font size="4" color="#939393"> | </font>
      <a class="js-toggle-bottom-slidebar btn btn-info" >
        <i class="glyphicon glyphicon-th"></i> Add Box
      </a>
      <a class=" btn btn-info">
        <i class="glyphicon glyphicon-refresh"></i> Resetall
      </a>
      <a class=" btn btn-info">
        <i class="glyphicon glyphicon-remove"></i> Cancel
      </a>
      <font size="4" color="#939393"> | </font>
      <a class="btn btn-warning" href="#" >
        <i class="glyphicon glyphicon-floppy-save"></i> SAVE
      </a>
      <a class="btn btn-default"  href="#" style="background-color:;">
        <i class="glyphicon glyphicon-repeat"></i>  Load Grid
      </a>
      <a class="btn btn-default" id="clear-grid" href="#">
        Clear Grid
      </a>
      <font size="4" color="#939393"> | </font>
      <a class="btn btn-warning"  href="#" style="background-color:;">
        <i class="glyphicon glyphicon-edit"></i> Change Background
      </a>
      <font size="4" color="#939393"> | </font>
      <font size="4" color="#939393"> Edit latest :</font> <font size="4" color="#fff"> <?= $index->timedate ?>  </font>
      &nbsp;&nbsp;
      <a href="#" onclick="help()" style="color:#939393;">
        <font size="5" ><i class="glyphicon glyphicon-info-sign"></i> </font>
      </a>
  </div>
  <style media="screen">
    .boxtool{
      width:50px;
      background-color:#b1b1b1;
      border-radius:5px;
      border-color:#888;
      border-style: solid;
      border-width: 1px;
      padding: 10px;
      padding-left:12px ;
      font-size: 26px
    }
    .btntool{
      color: #000;
    }
    .btntool:hover{
      color: #555;
    }
    .btntool2{
      color: #000;
    }
    .btntool2:hover{
      color: #555;
      -webkit-filter: contrast(200%); /* Safari */
      filter: contrast(200%);
    }
  </style>
  <div class="block" style="position:absolute; top:20%; z-index:999; left:0px;" >
    <table>
      <tr>
        <td>
          <div class="boxtool">
            <a href="#" class="btntool"  id="save-grid" onclick="savedelay()" >
              <i class="glyphicon glyphicon-floppy-disk"></i>
            </a>
            <a href="#" class="btntool" id="load-grid"><i class="glyphicon glyphicon-repeat"></i></a>
            <a href="{{ url('portfolio') }}" class="btntool" ><i class="glyphicon glyphicon-briefcase"></i></a>
            <hr style="margin:0px;border-color:#888;">
            <a href="#" class="btntool2" id="changebg" onclick ="changebg()">
              <img src="{{ asset('public/icon/bg-change-icon.png') }}" alt="" width="28px">
            </a>
            <a href="#" class="btntool2 js-toggle-bottom-slidebar " id="addboxto">
              <img src="{{ asset('public/icon/text-plus-icon.png') }}" alt="" width="28px">
            </a>
            <a href="#" class="btntool2" id=""><img src="{{ asset('public/icon/pdfplus.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool2" id="add2-widget4"><img src="{{ asset('public/icon/textplus.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool2" id="add2-widget6"><img src="{{ asset('public/icon/imgplus.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool2" id="add2-widget5"><img src="{{ asset('public/icon/videoplus.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool2" id=""><img src="{{ asset('public/icon/audioplus.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool2" id="add2-widget3"><img src="{{ asset('public/icon/textandimgplus.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool2" id="add2-widget2"><img src="{{ asset('public/icon/textandvideoplus.png') }}" alt="" width="28px"></a>
            <hr style="margin:0px; margin-top:5px; border-color:#888;">
            <a href="#" class="btntool2"><img src="{{ asset('public/icon/clear.png') }}" alt="" width="28px"></a>
            <a href="#" class="btntool"><i class="glyphicon glyphicon-question-sign"></i></a>
          </div>
        </td>
        <td style="padding-top:0px;">
          <button class="btn btn-info" id="left">&laquo;</button>
          <button class="btn btn-default" id="right" style="display:none;">&raquo;</button>
        </td>
      </tr>
    </table>
  </div>
  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
    $( "#right" ).click(function() {
      $( ".block" ).animate({ "left": "+=50px" }, "slow" );
      $('#right').hide();
      $('#left').fadeIn();
    });

    $( "#left" ).click(function(){
      $( ".block" ).animate({ "left": "-=50px" }, "slow" );
      $('#left').hide();
      $('#right').fadeIn();
    });
  </script>
<div class="se-pre-con"></div>
  <div canvas="container"  style=" background-image:url('<?=   asset($index->background); ?>'); " id="bodyshow">
    <div class="device-xs visible-xs"></div>
    <div class="device-sm visible-sm"></div>
    <div class="device-md visible-md"></div>
    <div class="device-lg visible-lg"></div>
    <div class="device-xl visible-xl"></div>
        <div>
          <div  id="showalldiv">
            <div class=" grid-stack" style="background-color:transparent;">
            </div>
          </div>
        </div>
        <div class="" style="height:500px;"></div>
  </div>
      <div off-canvas="slidebar-4 bottom overlay">
          <div class="col-md-2" style="display:none;">
            <div class="panel-body ">
              <form class="formall" >
                <input type="hidden" value="{{csrf_token() }}" name="_token">
                <input type="hidden" value="saveposition" name="check">
                <textarea  name="position" id="saved-data" style="width:100%; color:#000;"cols="20" rows="5" readonly></textarea><br>
                <input type="text" class="form-control" name="indextolist" id="indextolist" style="width:100%;color:#000;">
                <input type="text" class="form-control" name="indextolist2" id="indextolist2" style="width:100%;color:#000;">
                <input type="text" class="form-control" name="idtolist" id="idtolist" style="width:100%;color:#000;">
                <input type="text" class="form-control" name="idtolist2" id="idtolist2" style="width:100%;color:#000;">
                <input type="text" class="form-control" name="datetime" id="datetime" style="width:100%;color:#000;">
                <input type="text" class="form-control" name="id_delete" id="id_delete" style="width:100%;color:#000;">
                <button type="submit" id="submitposition"class="btn btn-default" style="visibility: hidden;"></button>
              </form>
            </div>
          </div>
          <!--=================================================================== navbar ==================================================================-->
          <div class="col-md-12">
            <div class="panel-body ">
              <center>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget1">
                  <img src="{{ asset('public/img/icon/profile.pn') }}g" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget2">
                  <img src="{{ asset('public/img/icon/textandvideo.png') }}" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget3">
                  <img src="{{ asset('public/img/icon/textandimg.png') }}" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget4">
                  <img src="{{ asset('public/img/icon/text.png') }}" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget5">
                  <img src="{{ asset('public/img/icon/video.png') }}" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget6">
                  <img src="{{ asset('public/img/icon/photo.png') }}" width="65%">
                </a>
              </div>
            </div>
          </center>
          </div>
  		</div>
      <!--=================================================================== The Modal Popup ==================================================================-->
      <!-- popup edit profile  -->
        <div id="myModal" class="modal ">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                     <div class="panel panel-default" style="background-color:#fff;"><br>
                        <center>
                          <img src="{{Auth::user()->avatar}}" style="{{Auth::user()->filter}} height:40%;width:40%;object-fit: cover;"><br>
                          <h3><b>{{Auth::user()->fristname}} {{Auth::user()->lastname}}({{Auth::user()->name}})</b></h3><br>
                            <form action="" class="profile">
                              <input type="hidden" value="{{csrf_token() }}" name="_token">
                              <input type="hidden" value="profile" name="check">
                              <input type="hidden" value="" name="id1" id="id1">
                              <input type="hidden" value="" id="timeset0"  name="timeset0">
                              Title description:
                              <input class="barinput" type="text" id="titledescription0" name="titledescription0">,
                              <span class="w3-opacity" id="time0"></span><br>
                              Detail:
                              <input  style="width:70%;" class="barinput" type="text" id="detail0" name="detail0"><br>
                              <br>
                              <div align="right"  class="col-md-12"><br>
                                <div class="progress progress-striped active" >
                                    <div id="re" class="progress-bar" style="width:0%;"></div>
                                </div>
                                <button  class="btn btn-success" onclick="submit()" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button><br><br>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        <!-- popup edit video and text  -->
        <div id="myModal2" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close2 close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title2"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                      <div class="panel panel-default" style="background-color:#fff;"><br>
                            <center>
                              <form action="" class="videoandtext">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="videoandtext" name="check">
                                <input type="hidden" value="0" name="sizefilevideo" id="sizefilevideo">
                                <input type="hidden" value="" name="id2" id="id2">
                                <input type="hidden" value="" id="timeset1"  name="timeset1">
                                <img src="public/img/icon/video.png" style="height:40%;width:40%;object-fit: cover;"><br><br>
                                <!-- accept="video/mp4" -->
                                <input class="btn btn-default" type="file" id="filevideo" name="filevideo"><br>
                                <script type="text/javascript">
                                $('#filevideo').bind('change', function() {
                                  var size = ((this.files[0].size)/1024/1024).toFixed(2);
                                  //this.files[0].size gets the size of your file.

                                  $('#sizefilevideo').val(size);

                                });
                                </script>
                                Title:
                                <input class="barinput" type="text" id="titlename1" name="titlename1"><br>
                                Title description:
                                <input class="barinput" type="text" id="titledescription1" name="titledescription1">
                                ,
                                <span class="w3-opacity" id="time1"></span><br>
                                Detail:
                                <input  style="width:70%;" class="barinput" type="text" id="detail1" name="detail1"><br>
                                </center><br>
                                <div align="right"  class="col-md-12"><br>
                                  <div class="progress progress-striped active" >
                                      <div id="progress-bar1" class="progress-bar" style="width:0%;"></div>
                                  </div>
                                <button style="visibility: hidden;" name="aa" id="submit1" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
                                <a class="btn btn-success" onclick="checksizefile('filevideo','video','submit1')" ><i class="glyphicon glyphicon-ok-sign"></i> Submit</a>
                                <br><br>
                                </div>
                                </form>
                              </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup edit photo and text  -->
        <div id="myModal3" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close3 close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title3"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                      <div class="panel panel-default" style="background-color:#fff;"><br>
                        <center>
                            <form action="" class="photoandtext">
                                  <input type="hidden" value="{{csrf_token() }}" name="_token">
                                      <input type="hidden" value="photoandtext" name="check">
                                      <input type="hidden" value="" name="id3" id="id3">
                                      <input type="hidden" value="" name="sizefilephoto" id="sizefilephoto">
                                      <input type="hidden" value="" id="timeset2"  name="timeset2">
                                          <img src="public/img/icon/photo.png" style="height:40%;width:40%;object-fit: cover;" id="img1"><br><br>
                                            <input class="btn btn-default" type="file" id="filephoto" name="filephoto" accept=""><br>
                                            <script type="text/javascript">
                                            document.querySelector('#filephoto').addEventListener('change', function(){
                                              var reader = new FileReader();
                                              reader.onload = function(e) {
                                                  $('#img1').attr("src",e.target.result);
                                                  var sizefile = ((e.loaded/1024)/1024).toFixed(2);
                                                  console.log(sizefile);
                                                  $('#sizefilephoto').val(sizefile);
                                              }
                                              reader.readAsDataURL(this.files[0]);
                                              this.files = [];
                                            });
                                            </script>
                                            Title:
                                            <input class="barinput" type="text" id="titlename2" name="titlename2"><br>
                                            Title description:
                                            <input class="barinput" type="text" id="titledescription2" name="titledescription2">
                                            ,
                                            <span class="w3-opacity" id="time2"></span><br>
                                            Detail:
                                            <input  style="width:70%;" class="barinput" type="text" id="detail2" name="detail2"><br>
                                            </center><br>
                                            <div align="right"  class="col-md-12"><br>
                                              <div class="progress progress-striped active" >
                                                  <div id="progress-bar2" class="progress-bar" style="width:0%;"></div>
                                              </div>
                                              <button style="visibility: hidden;" name="aa" id="submit2" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
                                              <a class="btn btn-success" onclick="checksizefile('filephoto','img','submit2')" ><i class="glyphicon glyphicon-ok-sign"></i> Submit</a>
                                              <br><br>
                                            </div>
                                        </form>
                                </div>
                        </div>
                      </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup edit text  -->
        <div id="myModal4" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close4 close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title4"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                    <div class="panel panel-default" style="background-color:#fff;"><br>
                    <center>
                      <form action="" class="text">
                      <input type="hidden" value="{{csrf_token() }}" name="_token">
                      <input type="hidden" value="text" name="check">
                      <input type="hidden" value="" name="id4" id="id4">
                      <input type="hidden" value="" id="timeset3"  name="timeset3">
                      Title:
                      <input class="barinput" type="text" id="titlename3" name="titlename3"><br>
                      Title description:
                      <input class="barinput" type="text" id="titledescription3" name="titledescription3">
                      ,
                      <span class="w3-opacity" id="time3">'+datetime+'</span><br>
                      Detail:
                      </center>
                      &nbsp;&nbsp;<textarea  name="detail3" id="detail3" style="width:100%; height: 300px;"></textarea><br><br>
                      <div align="right"  class="col-md-12"><br>
                        <div class="progress progress-striped active" >
                            <div id="re" class="progress-bar" style="width:0%;"></div>
                        </div>
                        <button  class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button><br><br>
                      </div>
                      </form>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup edit video  -->
        <div id="myModal5" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
                <span class="close5 close_css"><i class="glyphicon glyphicon-remove"></i></span>
                <h2 id="title5"></h2>
                <br>
                <div class="col-md-12" style="color:#000;">
                  <div class="panel panel-default" style="background-color:#fff;"><br>
                            <form action="" class="videoupload">
                                <input type="hidden" value="video" name="check">
                                <input type="hidden" value="" name="id5" id="id5">
                                <input type="hidden" value="" id="timeset4"  name="timeset4">
                                <input type="hidden" value="" id="sizefilevideo2"  name="sizefilevideo2">
                                <center>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <img src="public/img/icon/video.png" style="height:40%;width:40%;object-fit: cover;"><br><br>
                                  <input class="btn btn-default" type="file" id="filevideo2" name="filevideo" ><br>
                                </center><br>
                                <script type="text/javascript">
                                document.querySelector('#filevideo2').addEventListener('change', function(){
                                  var reader = new FileReader();
                                  reader.onload = function(e) {
                                      $('#img2').attr("src",e.target.result);
                                      var sizefile = ((e.loaded/1024)/1024).toFixed(2);
                                      console.log(sizefile);
                                      $('#sizefilephoto21').val(sizefile);
                                  }
                                  reader.readAsDataURL(this.files[0]);
                                  this.files = [];
                                });
                                </script>
                                <div align="right"  class="col-md-12"><br>
                                    <div class="progress progress-striped active" >
                                          <div id="progress-bar3" class="progress-bar" style="width:0%;"></div>
                                    </div>
                                    <button style="visibility: hidden;" name="aa" id="submit3" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
                                    <a class="btn btn-success" onclick="checksizefile('filevideo2','video','submit3')" ><i class="glyphicon glyphicon-ok-sign"></i> Submit</a>
                                    <br><br>
                                </div>
                            </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup edit photo  -->
        <div id="myModal6" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close6 close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title6"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                      <div class="panel panel-default" style="background-color:#fff;"><br>
                            <center>
                              <form action="" class="photo">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="photo" name="check">
                                <input type="hidden" value="" name="id6" id="id6">
                                <input type="hidden" value="" id="sizefilephoto21"  name="sizefilephoto21">
                                <img src="public/img/icon/photo.png" id="img2" style="height:40%;width:40%;object-fit: cover;"><br><br>
                                <input class="btn btn-default" type="file" id="filephoto2" name="filephoto"  ><br>
                                <script type="text/javascript">
                                document.querySelector('#filephoto2').addEventListener('change', function(){
                                  var reader = new FileReader();
                                  reader.onload = function(e) {
                                      $('#img2').attr("src",e.target.result);
                                      var sizefile = ((e.loaded/1024)/1024).toFixed(2);
                                      console.log(sizefile);
                                      $('#sizefilephoto21').val(sizefile);
                                  }
                                  reader.readAsDataURL(this.files[0]);
                                  this.files = [];
                                });
                                </script>
                                </center><br>
                                <div align="right"  class="col-md-12"><br>
                                  <div class="progress progress-striped active" >
                                      <div id="progress-bar4" class="progress-bar" style="width:0%;"></div>
                                  </div>
                                  <button style="visibility: hidden;" name="aa" id="submit4" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
                                  <a class="btn btn-success" onclick="checksizefile('filephoto2','img','submit4')" ><i class="glyphicon glyphicon-ok-sign"></i> Submit</a>
                                <br><br>
                                </div>
                                </form>
                              </div>
                      </div>
                      </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup edit color page  -->
        <div id="myModal7" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close7 close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title7"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                      <div class="panel panel-default" style="background-color:#fff;"><br>
                            <center>
                              <form action="" class="color">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="color" name="check">
                                <input type="hidden" value="" name="idcolor" id="idcolor">
                                <input type="hidden" value="" name="type" id="type">
                                <!-- peview -->
                                <div class="w3-card-4 w3-margin w3-white" style="background-color:#222;" >
                                  <div id="bg" class="w3-container w3-padding-8" style="background-color:#222; color:#fff;">
                                    <h3><b>Title</b></h3>
                                    <h5>Title description, <span class="w3-opacity">MM DD, YYYY</span></h5>
                                  </div>
                                  <div id="bg2" class="w3-container" style="background-color:#222; color:#fff;">
                                    <p id="bg3" style="background-color:#555;">Details</p>
                                  </div>
                                </div>
                                <!-- input -->
                                <script src="{{ asset('public/jscolor.js') }}"></script>
                                <button id="b1" class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'} btn btn-info">
                                  &nbsp;&nbsp;
                                </button>
                                <input type="text" class="barinput" id="color1" name="color1" style="width:100px;">
                                <button id="b2" class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor2(this)'} btn btn-info">
                                  &nbsp;&nbsp;
                                </button>
                                <input type="text" class="barinput" id="color2" name="color2" style="width:100px;">
                                <button id="b3" class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor3(this)'} btn btn-info">
                                  &nbsp;&nbsp;
                                </button>
                                <input type="text" class="barinput" id="color3" name="color3" style="width:100px;">
                                <button id="b4" class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor4(this)'} btn btn-info">
                                  &nbsp;&nbsp;
                                </button>
                                <input type="text" class="barinput" id="color4" name="color4" style="width:100px;">
                               </center><br>
                                <div align="right"  class="col-md-12"><br>
                                <button style="visibility: hidden;" id="go" type="submit"></button>
                                <a  class="btn btn-success" onclick="onsubmit2('all')" ><i class="glyphicon glyphicon-ok-sign"></i> นำไปใช้ทั้งหมด</a>
                                <a  class="btn btn-success" onclick="onsubmit2('only')" ><i class="glyphicon glyphicon-ok-sign"></i> นำไปใช้</a>
                                <br><br>
                                </div>
                                </form>
                                <script>
                                function setTextColor(picker) {
                                  console.log('#' + picker.toString());
                                  document.getElementById('bg').style.color = '#' + picker.toString()
                                  document.getElementById('color1').value = '#' + picker.toString()
                                }
                                function setTextColor2(picker) {
                                  console.log('#' + picker.toString());
                                  document.getElementById('bg3').style.color = '#' + picker.toString()
                                  document.getElementById('color2').value = '#' + picker.toString()
                                }
                                function setTextColor3(picker) {
                                  console.log('#' + picker.toString());
                                  document.getElementById('bg').style.backgroundColor = '#' + picker.toString()
                                  document.getElementById('bg2').style.backgroundColor = '#' + picker.toString()
                                  document.getElementById('color3').value = '#' + picker.toString()
                                }
                                function setTextColor4(picker) {
                                  console.log('#' + picker.toString());
                                  document.getElementById('bg3').style.backgroundColor = '#' + picker.toString()
                                  document.getElementById('color4').value = '#' + picker.toString()
                                }
                                function onsubmit2(type) {
                                  document.getElementById('type').value = type;
                                  console.log(type);
                                  document.getElementById('go').click();
                                }
                                </script>
                              </div>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup edit photo  -->
        <div id="myModal8" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close8 close_css" style="color:#000;"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title8"></h2>
              <div id="body" class="modal-body">
                <br><div class="col-md-12" style="color:#000;">
                      <div class="panel panel-default" style="background-color:#fff;"><br>
                              <center>
                              <form action="" class="background">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="background" name="check">
                                <input type="hidden" value="" name="select" id="select">
                                <div id="settobg" style="width:200px;height:200px;">
                                  <img id="blah" src="{{ asset('public/img/icon/photo.png') }}" style="height:100%;width:100%;">
                                </div>
                                <br><br>
                                </center><br>
                                    <div class="w3-row">
                                      <a href="#" onclick="openCity(event, 'London');">
                                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><i class="glyphicon glyphicon-picture"></i> image</div>
                                      </a>
                                      <a href="#" onclick="openCity(event, 'Paris');">
                                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><i class="glyphicon glyphicon-tint"></i> color</div>
                                      </a>
                                      <a href="#" onclick="openCity(event, 'Tokyo');">
                                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><i class="glyphicon glyphicon-open"></i> Upload</div>
                                      </a>
                                    </div>
                                    <style>
                                      .blnk{
                                        padding-top: 5px;
                                        padding-right: 5px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                      }
                                    </style>
                                    <div id="London" class="w3-container city" style="display:none;">
                                      <center><br>
                                        <h4>Pick Background</h4>
                                        <div class="col-md-10 col-md-offset-1 panel panel-default" style="overflow: scroll;"  >
                                            <div align="left" class="panel-body ">
                                              <input type="hidden" value="" name="bgset" id="bgset">
                                              <?php
                                              for ($i=1; $i <= 19; $i++) {
                                               ?>
                                              <a class="btn2 blnk" style="padding:10px;"  href="#" onclick="settobg( {{ $i }} ,'img')"><img src="{{ asset('public/img/bg_port/'.$i.'.jpg') }}" width="50px" height="50px" alt="" /></a>

                                              <?php } ?>
                                            </div>
                                        </div>
                                      </center>
                                    </div>

                                    <div id="Paris" class="w3-container city" style="display:none;">
                                      <center><br>
                                      <input type="hidden" value="" name="color" id="color">
                                      <button style="width:200px;height:200px;" id="colorbg" class="jscolor {valueElement:'chosen-value', onFineChange:'setbgColor(this)'} btn btn-info">
                                        &nbsp;&nbsp;
                                      </button><br><br>
                                    </center>
                                    </div>

                                    <div id="Tokyo" class="w3-container city" style="display:none;">
                                      <center>
                                        <br>
                                        <input class="btn btn-default" type="file" id="imgInp" name="imgInp"  accept="image/*"><br>
                                      </center>
                                    </div>
                                    <script>
                                    function readURL(input) {

                                          if (input.files && input.files[0]) {
                                              var reader = new FileReader();

                                              reader.onload = function (e) {
                                                  var bgto = 'src="'+e.target.result+'"' ;
                                                  document.getElementById('select').value = 'upload';
                                                  document.getElementById('settobg').innerHTML = '<img id="blah" '+bgto+' style="height:100%;width:100%;">';

                                              }

                                              reader.readAsDataURL(input.files[0]);
                                          }
                                      }

                                      $("#imgInp").change(function(){
                                          readURL(this);
                                      });

                                     function settobg(index,type) {
                                       var arrbgimg = [ 'public/img/bg_port/1.jpg',
                                                        'public/img/bg_port/2.jpg',
                                                        'public/img/bg_port/3.jpg',
                                                        'public/img/bg_port/4.jpg',
                                                        'public/img/bg_port/5.jpg',
                                                        'public/img/bg_port/7.jpg',
                                                        'public/img/bg_port/6.jpg',
                                                        'public/img/bg_port/8.jpg',
                                                        'public/img/bg_port/9.jpg',
                                                        'public/img/bg_port/10.jpg',
                                                        'public/img/bg_port/11.jpg',
                                                        'public/img/bg_port/12.jpg',
                                                        'public/img/bg_port/13.jpg',
                                                        'public/img/bg_port/14.jpg',
                                                        'public/img/bg_port/15.jpg',
                                                        'public/img/bg_port/16.jpg',
                                                        'public/img/bg_port/17.jpg',
                                                        'public/img/bg_port/18.jpg',
                                                        'public/img/bg_port/19.jpg',
                                                      ];
                                        if(type == 'img'){
                                          document.getElementById('bgset').value = arrbgimg[index-1];
                                          document.getElementById('select').value = 'img';
                                          document.getElementById('settobg').innerHTML = '<div style="width:100%;height:100%; background-image:url(\''+arrbgimg[index-1]+'\');" ></div>';
                                        }
                                     }

                                     function setbgColor(picker) {
                                       var colorto = "background-color:#" + picker.toString()+";";
                                       document.getElementById('select').value = 'color';
                                       document.getElementById('color').value = colorto;
                                       document.getElementById('settobg').innerHTML =   '<div style="width:100%;height:100%; '+colorto+'" ></div>';

                                     }

                                    function openCity(evt, cityName) {
                                      document.getElementById('imgInp').value = "";
                                      var i, x, tablinks;
                                      x = document.getElementsByClassName("city");
                                      for (i = 0; i < x.length; i++) {
                                         x[i].style.display = "none";
                                      }
                                      tablinks = document.getElementsByClassName("tablink");
                                      for (i = 0; i < x.length; i++) {
                                         tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
                                      }
                                      document.getElementById(cityName).style.display = "block";
                                      evt.currentTarget.firstElementChild.className += " w3-border-red";
                                    }
                                    </script>
                                <div align="right"  class="col-md-12"><br>
                                  <div class="progress progress-striped active" >
                                      <div id="progress-bar5" class="progress-bar" style="width:0%;"></div>
                                  </div>
                                <button  class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button><br><br>
                                </div>
                                </form>
                              </div>
                      </div>
                      </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup คู่มือการใช้งาน  -->
        <div id="myModal9" class="modal">
          <div class="col-md-6 col-md-offset-3 modalanimate">
            <div class="panel panel-default">
              <div class="panel-body">
              <span class="close9 close_css"><i class="glyphicon glyphicon-remove"></i></span>
              <h2 id="title9"> คู่มือการใช้งาน </h2>
              <div id="body" class="modal-body"><br>
                  <div class="col-md-12" style="color:#000;">
                      <div class="panel panel-default" style="background-color:#fff;"><br>
                        <center>
                          ถ้าท่านต้องการปรับเเต่งกดปุ่มนี้ <i class="glyphicon glyphicon-move"></i><br>
                          ปุ่มนี้ <a class="btn btn-info"><i class="glyphicon glyphicon-th"></i> Add Box </a> ถ้ากดเเล้วจะมี แถบของ Box ต่าง ๆ ที่ท่านสามารถเพิ่มใน Portfolio ของท่านได้ ได้เเก่
                          <br><br><img src="img/icon/profile.png" width="40%">
                          <br><br>เป็นที่ Box <B>มีรูปและคำอธิบาย</B> ท่านสามารถอัพโหลดไฟล์ภาพต่าง ๆ ที่ท่านต้องการได้เเละยังสามารถใส่คำอธิบายต่าง ๆ
                          <br><br><img src="img/icon/textandvideo.png" width="40%">
                          <br><br>เป็นที่ Box <B>มีรูปและคำอธิบาย</B> ท่านสามารถอัพโหลดไฟล์ภาพต่าง ๆ ที่ท่านต้องการได้เเละยังสามารถใส่คำอธิบายต่าง ๆ
                          <br><br><img src="img/icon/textandimg.png" width="40%">
                          <br><br>เป็นที่ Box <B>มีรูปและคำอธิบาย</B> ท่านสามารถอัพโหลดไฟล์ภาพต่าง ๆ ที่ท่านต้องการได้เเละยังสามารถใส่คำอธิบายต่าง ๆ
                          <br><br><img src="img/icon/text.png" width="40%">
                          <br><br>เป็นที่ Box <B>มีบทความ</B> ท่านสามารถสร้างบทความของท่านเองได้ ใน Box นี้
                          <br><br><img src="img/icon/video.png" width="40%">
                          <br><br>เป็นที่ Box <B>มีรูปและคำอธิบาย</B> ท่านสามารถอัพโหลดไฟล์ภาพต่าง ๆ ที่ท่านต้องการได้เเละยังสามารถใส่คำอธิบายต่าง ๆ
                          <br><br><img src="img/icon/photo.png" width="40%">
                          <br><br>เป็นที่ Box <B>มีรูปและคำอธิบาย</B> ท่านสามารถอัพโหลดไฟล์ภาพต่าง ๆ ที่ท่านต้องการได้เเละยังสามารถใส่คำอธิบายต่าง ๆ
                      </center>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <style >
        .modal2 {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color:rgba(0, 0, 0, 0.82); /* Black w/ opacity */
        }
        </style>
        <!-- loading save -->
        <div id="savemodel" class="modal2"style="display:; z-index:999999;">
          <div class="col-md-12">
           <center>
             <div style="color:#fff;font-size: 100%; padding-top:250px;">
               <img src="{{ asset('public\img\save.gif') }}" alt="" width="250px">
             </div>
           </center>
          </div>
        </div>
        <!-- popup confirm -->
      <div id="confirm" class="modal">
        <div class="col-md-3 col-md-offset-6 modalanimate">
          <button type="button" name="button">yes</button>
          <button type="button" name="button">cancel</button>
        </div>
      </div>
    </body>
    </html>
      <!-- ================================================================ End HTML ====================================================================== -->
      <?php
        $nextid = 0;
        $id_data = dataportfolio::all();
        if($id_data!='[]'){
          foreach ($id_data as $flight) {
            if($flight->id > $nextid){
              $nextid = $flight->id;
            }
          }
          $nextid++;
        }else{
           $nextid = 1;
        }

       ?>
    <script type="text/javascript">
    //----------------------CHECK size file ---------------------------------
    function checksizefile(id,type,idsubmit) {
        var input, file;
        if (!window.FileReader) {
            console.log("The file API isn't supported on this browser yet.");
            return;
        }
        input = document.getElementById(id);

        if (!input.files[0]) {
              console.log("Please select a file before clicking 'Load'");
              setTimeout(function(){ document.getElementById(idsubmit).click(); }, 100);
        }else{
                file = input.files[0];
                var sizefile = (file.size/(1024))/1024 ; //MB
                var name = file.name+''; // Namefile
                entryArray = (name).split(".");
                var typefile = entryArray[(entryArray.length)-1] ;
                if(type=='video'){
                  if(typefile=='mp4'){
                    if(sizefile<501){
                        //-------------------go to submit ---------------------------
                        setTimeout(function(){ document.getElementById(idsubmit).click(); }, 100);
                    }else{
                        var p = new Popelt({
                        title: 'Warning!',
                        content:' Size file over 500 MB "Your file '+sizefile+' MB"',
                        modal: false
                      }).show();
                    }
                  }else{
                      var p = new Popelt({
                      title: 'Warning!',
                      content: 'Please select file mp4',
                      modal: false
                    }).show();
                  }
              }
              if(type=='img'){
                if(typefile=='jpg' || typefile=='jpeg' || typefile=='png' || typefile=='gif' ){
                  if(sizefile<6){
                      //-------------------go to submit ---------------------------
                      setTimeout(function(){ document.getElementById(idsubmit).click(); }, 100);
                  }else{
                      var p = new Popelt({
                      title: 'Warning!',
                      content:' Size file over 5 MB "Your file '+sizefile+' MB"',
                      modal: false
                    }).show();
                  }
                }else{
                    var p = new Popelt({
                    title: 'Warning!',
                    content: 'Please select file jpg , jpeg , png , gif',
                    modal: false
                  }).show();
                }
              }
      }
  }

    //-----------------------------------------------------------------------
      var id_delete = [];
      var id_delete2 = '';
      var str = <?= $index->indexbox ?>;
      var arr_index = <?= $index->id_fk ?> ;
      var x1 =[];
      var y1 = [];
      var i = 0;
      var index_data = <?= $nextid ?>;

      console.log(<?= $index ?>);
      //--------------------------------set data ---------------------------------------------------------
      var datato={};
      <?php
      $to;
      $nowlogin = indexportfolio::find(Auth::user()->id);
      if($nowlogin->phpindex != 'undefined'){
      $iddatato = explode(",",$nowlogin->phpindex);
      for($i = 0 ; $i< sizeof($iddatato);$i++){
        $to = dataportfolio::find($iddatato[$i]);
        if($to->id != ''){
        ?>
      datato[<?= $to->id ?>+""+0] = <?= $to->id ?>;  // id
      datato[<?= $to->id ?>+""+1] = <?= '\''.$to->img.'\'' ?>; // img
      datato[<?= $to->id ?>+""+2] = <?= '\''.$to->video.'\'' ?>; // video
      datato[<?= $to->id ?>+""+3] = <?= '\''.$to->text.'\'' ?>; // text
      datato[<?= $to->id ?>+""+4] = <?= '\''.$to->title.'\'' ?>; // title
      datato[<?= $to->id ?>+""+5] = <?= '\''.$to->titlesmall.'\'' ?>; // titlesmall
      datato[<?= $to->id ?>+""+6] = <?= '\''.$to->created_at.'\'' ?>; // timedate
      datato[<?= $to->id ?>+""+7] = <?= '\''.$to->colorfont1.'\'' ?>; // colorfont1
      datato[<?= $to->id ?>+""+8] = <?= '\''.$to->colorfont2.'\'' ?>; // colorfont2
      datato[<?= $to->id ?>+""+9] = <?= '\''.$to->colorbg1.'\'' ?>; // colorbg1
      datato[<?= $to->id ?>+""+10] = <?= '\''.$to->colorbg2.'\'' ?>; // colorbg2
      <?php  }
          }
      }
      ?>
      //-------------------------------------------------------------------------------------------------------
      console.log(<?= $nextid  ?>);
        $(function () {
            // thanks to http://stackoverflow.com/a/22885503
            var waitForFinalEvent=function(){var b={};return function(c,d,a){a||(a="I am BosS");b[a]&&clearTimeout(b[a]);b[a]=setTimeout(c,d)}}();
            var fullDateString = new Date();
            function isBreakpoint(alias) {
                return $('.device-' + alias).is(':visible');
            }


            var options = {
                float: false
            };
            $('.grid-stack').gridstack(options);
            function resizeGrid() {
                var grid = $('.grid-stack').data('gridstack');
                if (isBreakpoint('xs')) {
                    $('#grid-size').text('One column mode');
                } else if (isBreakpoint('sm')) {
                    grid.setGridWidth(3);
                    $('#grid-size').text(3);
                } else if (isBreakpoint('md')) {
                    grid.setGridWidth(6);
                    $('#grid-size').text(6);
                } else if (isBreakpoint('lg')) {
                    grid.setGridWidth(12);
                    $('#grid-size').text(12);
                }
            };
            $(window).resize(function () {
                waitForFinalEvent(function() {
                    resizeGrid();
                }, 300, fullDateString.getTime());
            });
            new function () {
              //--------------------------------load Grid-----------------------------------------
                this.serializedData = <?= $index->position ?>;
                this.grid = $('.grid-stack').data('gridstack');
                var index = 0;
                this.loadGrid = function () {
                    document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-disk"></i>';
                  id_delete2 = '';
                  id_delete = [];
                  document.getElementById("id_delete").value = '';
                    this.grid.removeAll();
                    var items = GridStackUI.Utils.sort(this.serializedData);
                    _.each(items, function (node, i) {
                      if(str[i]%6==0){
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' style="overflow:hidden;" ><div style="overflow:hidden;" class="grid-stack-item-content " >' +
                                              '<div class="w3-card-4 w3-margin w3-white" style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                              '<div class="topright" style="border-radius:5px;background-color:hsla(100,100%, 100%, 0.62);">'+
                                                '&nbsp;<a class="btn4 btn3" onclick="editcolorbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-cog"></i></a>'+
                                                '&nbsp;<a class="btn4 btn3" onclick="editbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-edit"></i></a>'+
                                                '&nbsp;<a class="btn4 btn3" href="#"  onclick="deletebox2('+arr_index[i]+','+i+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                                              '&nbsp;</div>'+
                                              '<img src="{{ asset(Auth::user()->avatar) }}" style=" {{Auth::user()->filter}} height:100%;width:100%;object-fit: cover;">'+
                                                '<div class="w3-container w3-padding-8" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                  '<h4><b>{{Auth::user()->fristname}} {{Auth::user()->lastname}} ({{Auth::user()->name}})</b></h4>'+
                                                  '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                '</div>'+
                                                '<div class="w3-container" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';">'+
                                                  '<p class="paddingtext" style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'+
                                                '</div>'+
                                              '</div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                      }
                      if(str[i]%6==1){
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+'><div style="overflow:hidden   ;" class="grid-stack-item-content ">' +
                                                '<div class="w3-card-4 w3-margin w3-white" style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                                '<div class="topright" style="z-index:99;" style="border-radius:5px;background-color:hsla(100,100%, 100%, 0.62);">'+
                                                  '&nbsp;<a class="btn4 btn3" onclick="editcolorbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-cog"></i></a>'+
                                                  '&nbsp;<a class="btn4 btn3"  onclick="editbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-edit"></i></a>'+
                                                  '&nbsp;<a class="btn4 btn3"  href="#" onclick="deletebox2('+arr_index[i]+','+i+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                                                '&nbsp;</div>'+
                                                  '<video width="100%" controls>'+
                                                    '<source src="'+datato[arr_index[i]+""+2]+'" type="video/mp4">'+
                                                  '</video>'+
                                                  '<div class="w3-container w3-padding-8"  style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                    '<h4><b>'+datato[arr_index[i]+""+4]+'</b></h4>'+
                                                      '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                  '</div>'+
                                                  '<div class="w3-container" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';">'+
                                                      '<p class="paddingtext" style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'  +
                                                  '</div>'+
                                                '</div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);

                      }
                      if(str[i]%6==2){
                        var img = 'public/img/icon/photo.png';
                        if(datato[arr_index[i]+""+1] !='empty'){
                          img =datato[arr_index[i]+""+1];
                        }
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+'><div style="overflow:hidden   ;"  class="grid-stack-item-content ">' +
                                                '    <div class="w3-card-4 w3-margin w3-white" style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                                '<div class="topright" style="border-radius:5px;background-color:hsla(100,100%, 100%, 0.62);">'+
                                                  '&nbsp;<a class="btn4 btn3" onclick="editcolorbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-cog"></i></a>'+
                                                  '&nbsp;<a class="btn4 btn3" onclick="editbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-edit"></i></a>'+
                                                  '&nbsp;<a class="btn4 btn3" href="#" onclick="deletebox2('+arr_index[i]+','+i+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                                                '&nbsp;</div>'+
                                                    '<img src="'+img+'" style="height:100%;width:100%;object-fit: cover;">'+
                                                    '  <div class="w3-container w3-padding-8"  style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                      '  <h4><b>'+datato[arr_index[i]+""+4]+'</b></h4>'+
                                                        '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                  '    </div>'+
                                                    '  <div class="w3-container"  style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';">'+
                                                        '<p class="paddingtext" style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'  +
                                                    '  </div>'+
                                                  '  </div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);

                      }
                      if(str[i]%6==3){
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' ><div style="overflow:hidden   ; " class="grid-stack-item-content ">' +
                                              '    <div class="w3-card-4 w3-margin w3-white"  style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                              '<div class="topright" style="border-radius:5px;background-color:hsla(100,100%, 100%, 0.62);">'+
                                                '&nbsp;<a class="btn4 btn3" onclick="editcolorbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-cog"></i></a>'+
                                                '&nbsp;<a class="btn4 btn3" onclick="editbox('+arr_index[i]+','+ str[i]+')" href="#"> <i class="glyphicon glyphicon-edit"></i></a>'+
                                                '&nbsp;<a class="btn4 btn3" href="#" onclick="deletebox2('+arr_index[i]+','+i+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                                              '&nbsp;</div>'+
                                                  '  <div class="w3-container w3-padding-8" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                    '  <h4><b>'+datato[arr_index[i]+""+4]+'</b></h4>'+
                                                      '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                '    </div>'+

                                                  '  <div class="w3-container" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';" >'+
                                                      '<p class="paddingtext" style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'  +

                                                  '  </div>'+
                                                '  </div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                      }
                      if(str[i]%6==4){
                        var img = '{{ asset('') }}img/icon/video.png';
                        if(datato[arr_index[i]+""+1] !='empty'){
                          img =datato[arr_index[i]+""+2];
                        }
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' style="overflow:visible;" ><div style="overflow:hidden   ;" class="grid-stack-item-content ">' +
                                '    <div class="w3-card-4 w3-margin w3-white">'+
                                '<div class="topright" style="z-index:99;border-radius:5px;background-color:hsla(100,100%, 100%, 0.62);">'+
                                  '&nbsp;<a class="btn4 btn3" onclick="editbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-edit"></i></a>'+
                                  '&nbsp;<a class="btn4 btn3" href="#" onclick="deletebox2('+arr_index[i]+','+i+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                                '&nbsp;</div>'+
                                '<video width="100%" controls>'+
                                  '<source src="'+datato[arr_index[i]+""+2]+'" type="video/mp4">'+
                                '</video>'+
                                    '  </div>'+
                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                      }  if(str[i]%6==5){
                        var img2 = '{{ asset('') }}public/img/icon/photo.png';
                        if(datato[arr_index[i]+""+1] !='empty'){
                          img2 =datato[arr_index[i]+""+1];
                        }
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' style="overflow:visible;"><div style="overflow:hidden   ;" class="parent grid-stack-item-content ">' +
                                '    <div class="w3-card-4 w3-margin w3-white">'+
                                '<div class="topright" style="border-radius:5px;background-color:hsla(100,100%, 100%, 0.62);">'+
                                  '&nbsp;<a class="btn4 btn3" onclick="editbox('+arr_index[i]+','+str[i]+')" href="#"> <i class="glyphicon glyphicon-edit"></i></a>'+
                                  '&nbsp;<a class="btn4 btn3" href="#" onclick="deletebox2('+arr_index[i]+','+i+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                                '&nbsp;</div>'+
                                    '<img src="'+img2+'" style="width:100%;height:100%;">'+
                                  '  </div>'+
                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                        }
                            index = i;
                    }, this);
                    return false;
                }.bind(this);
                //--------------------------------save Grid-----------------------------------------
                this.saveGrid = function () {
                  document.getElementById("save-grid").innerHTML = '<i style="color:red;" class="glyphicon glyphicon-floppy-save"></i>';
                  i = 0;
                    this.serializedData = _.map($('.grid-stack > .grid-stack-item:visible'), function (el) {
                        el = $(el);
                        var node = el.data('_gridstack_node');
                        x1[i] = node.x;
                        y1[i] = node.y;
                        i++;
                        return {x: node.x,y: node.y,width: node.width,height: node.height};
                      }, this);
                    //-----------------------------------Delete ID follow--------------------------------------
                    for(var k = 0;k<i;k++){
                      //console.log("pre "+arr_index[k]);
                      for(var j = 0 ;j<id_delete.length;j++){
                        //console.log("Delete "+id_delete[j]);
                          if(arr_index[k]==id_delete[j]){
                          //  arr_index[k]=0;
                          var  removed = arr_index.splice(k, 1);
                          }
                      }
                    }

                    //--------------------------------sort follow point-----------------------------------------
                    var x2;
                    var y2;
                    var str2;
                    var tmp;
                    var s = [];
                    var arr_index2 = {};
                    for(var j = 0 ;j<i;j++){
                           x2 = x1[j]+"";
                           y2 = y1[j]+"";
                           str2 = str[j]+"";
                           if(y2.length<2){
                                 tmp = y2;
                                 y2 = "0"+tmp;
                           }
                           if(x2.length<2){
                                tmp = x2;
                                x2 = "0"+tmp;
                           }
                           if(str2.length<2){
                             tmp = str2;
                             str2 = "0"+tmp;
                           }
                           console.log(y2+":"+x2+":"+str2);
                           s[j] = y2+""+x2+""+str2;
                           arr_index2[s[j]] = arr_index[j];
                    }
                    s.sort();
                    console.log('-----------save---------------');
                    for(var j = 0 ;j<i;j++){
                           console.log(s[j]+" get "+s[j].charAt((s[j].length)-1));
                    }
                    var idtolist;
                    var idtolist2;
                    var indextolist2;
                    for(var j = 0 ;j<i;j++){
                           console.log(arr_index2[s[j]]+" ID ");
                    }
                    var indextolist;
                    if(s.length==1){
                        indextolist = "["+s[0].charAt((s[0].length)-1)+']';
                        indextolist2 = s[0].charAt((s[0].length)-1);
                        idtolist = "["+arr_index2[s[0]]+"]";
                        idtolist2 = arr_index2[s[0]];
                    }else if(s.length == 2){
                      indextolist = "["+s[0].charAt((s[0].length)-1)+','+
                                        s[1].charAt((s[1].length)-1)+']';
                      indextolist2 = s[0].charAt((s[0].length)-1)+','+
                                     s[1].charAt((s[1].length)-1);
                      idtolist = "["+arr_index2[s[0]]+","+
                                     arr_index2[s[1]]+"]";
                      idtolist2 = arr_index2[s[0]]+","+
                                  arr_index2[s[1]];
                    }else{
                      for(var j = 0 ; j<s.length ;j++){
                        if(j==0){
                          indextolist = "["+s[j].charAt((s[j].length)-1)+',';
                          indextolist2 = s[j].charAt((s[j].length)-1)+',';
                          idtolist = "["+arr_index2[s[j]]+",";
                          idtolist2 = arr_index2[s[j]]+",";
                        }
                        if(j>=1&&j<=s.length-2){
                          indextolist += s[j].charAt((s[j].length)-1)+',';
                          indextolist2 += s[j].charAt((s[j].length)-1)+',';
                          idtolist += arr_index2[s[j]]+",";
                          idtolist2 += arr_index2[s[j]]+",";
                        }
                        if(j==s.length-1){
                          indextolist += s[j].charAt((s[j].length)-1)+']';
                          indextolist2 += s[j].charAt((s[j].length)-1);
                          idtolist += arr_index2[s[j]]+"]";
                          idtolist2 += arr_index2[s[j]];
                        }
                      }
                    }
                    document.getElementById("idtolist").value = idtolist;
                    document.getElementById("idtolist2").value = idtolist2;
                    document.getElementById("indextolist").value = indextolist;
                    document.getElementById("indextolist2").value = indextolist2;
                    document.getElementById("datetime").value = timenowget();
                    setTimeout(function(){ document.getElementById('submitposition').click(); }, 100);
                    $('#saved-data').val(JSON.stringify(this.serializedData, null, '    '));
                    return false;
                }.bind(this);
                //--------------------------------clearGrid-----------------------------------------

                this.clearGrid = function () {
                  var p = new Popelt({
                		title: 'Are you sure you want to do ClearGrid?',
                		content: '',
                		closeButton: false,
                		escClose: false,
                		modal: true
                	});
                	p.addButton('Yes', function(){
                    i =0;
                    index = 0;
                    this.grid.removeAll();
                    return false;
                		p.close();
                	});
                	p.addCancelButton();
                	p.show();



                }.bind(this);

                $('#de').click(function() {
                  console.log("sss");
                  var self = this;
                  self.widgets.remove(item);
                  return false;
                });

            //--------------------------------add box-----------------------------------------
                $('#add-widget1').click(function() { addNewWidget('0');  });
                $('#add-widget2').click(function() { addNewWidget('1');  });
                $('#add-widget3').click(function() { addNewWidget('2');  });
                $('#add-widget4').click(function() { addNewWidget('3');  });
                $('#add-widget5').click(function() { addNewWidget('4');  });
                $('#add-widget6').click(function() { addNewWidget('5');  });
                //------------toolbar---------------------------------------
                $('#add2-widget2').click(function() { addNewWidget('1');  });
                $('#add2-widget3').click(function() { addNewWidget('2');  });
                $('#add2-widget4').click(function() { addNewWidget('3');  });
                $('#add2-widget5').click(function() { addNewWidget('4');  });
                $('#add2-widget6').click(function() { addNewWidget('5');  });
                function addNewWidget(ih) {
                    index_data++;
                    index++;
                    for(var s = 0 ; s<20 ; s++){
                      if(index_data%6 == ih){
                    console.log(ih);
                    var grid = $('.grid-stack').data('gridstack');
                    document.getElementById("save-grid").innerHTML = '<i style="color:red;" class="glyphicon glyphicon-floppy-open"></i>';
                    if(ih == 0){ // profile
                      grid.addWidget($('<div id="'+index_data+'" style="display:none;"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                      '<div class="w3-card-4 w3-margin w3-white">'+
                        '<div class="topright">'+

                          '<a class="btn3" href="#" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                        '</div>'+
                        '<img src="{{Auth::user()->avatar}}" style="{{Auth::user()->filter}} height:100%;width:100%;object-fit: cover;">'+
                          '<div class="w3-container w3-padding-8">'+
                            '<h3><b>{{Auth::user()->fristname}}&nbsp;&nbsp;{{Auth::user()->lastname}} ({{Auth::user()->name}})</b></h3>'+
                            '<h5>Title description, <span class="w3-opacity">MM DD, YYYY</span></h5>'+
                            '</div>'+
                            '<div class="w3-container">'+
                            '<p>balh.............balh.............'+index_data+'</p>'  +
                          '</div>'+
                        '</div>'+
                      //----------------------------------------------------------------------------
                    '</div></div>'), 0, 0, 2,6, true);
                    }
                    if(ih == 1){ // video and text
                        grid.addWidget($('<div id="'+index_data+'" style="display:none;"><div class="grid-stack-item-content " >'+
                        //----------------------------------------------------------------------------
                      '<div class="w3-card-4 w3-margin w3-white">'+
                      '<div class="topright" style="z-index:99;">'+
                        '<a class="btn3" href="#" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                      '</div>'+
                        '<video width="100%" controls>'+
                          '<source src="mov_bbb.mp4" type="video/mp4">'+
                        '</video>'+
                        '<div class="w3-container w3-padding-8">'+
                          '<h3><b>TITLE VIDEO</b></h3>'+
                            '<h5>Title description, <span class="w3-opacity">MM DD, YYYY</span></h5>'+
                        '</div>'+
                        '<div class="w3-container">'+
                            '<p>balh.............balh.............'+index_data+'</p>'  +
                        '</div>'+
                      '</div>'+
                        //----------------------------------------------------------------------------
                      '</div></div>'), 0, 0, 4,6, true);
                    }
                    if(ih == 2){ // photo and text
                      grid.addWidget($('<div id="'+index_data+'" style="display:none;"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                  '    <div class="w3-card-4 w3-margin w3-white">'+
                  '<div class="topright">'+
                    '<a class="btn3" href="#" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                  '</div>'+
                      '<img src="public/img/icon/photo.png" style="height:100%;width:100%;object-fit: cover;">'+
                      '  <div class="w3-container w3-padding-8">'+
                        '  <h3><b>TITLE PHOTO</b></h3>'+
                          '<h5>Title description, <span class="w3-opacity">MM DD, YYYY</span></h5>'+
                    '    </div>'+

                      '  <div class="w3-container">'+
                          '<p>balh.............balh.............'+index_data+'</p>'  +
                      '  </div>'+
                    '  </div>'+
                      //----------------------------------------------------------------------------
                    '</div></div>'), 0, 0, 2,6, true);
                    }
                    if(ih == 3){ // text all
                      grid.addWidget($('<div id="'+index_data+'" style="display:none;"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                  '    <div class="w3-card-4 w3-margin w3-white">'+
                  '<div class="topright">'+
                    '<a class="btn3" href="#" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                  '</div>'+
                      '  <div class="w3-container w3-padding-8">'+
                        '  <h3><b>TITLE Article</b></h3>'+
                          '<h5>Title description, <span class="w3-opacity">MM DD, YYYY</span></h5>'+
                    '    </div>'+

                      '  <div class="w3-container">'+
                          '<p>balh.............balh.............</p>'  +
                          '<p>balh.............balh.............</p>'  +
                      '  </div>'+
                    '  </div>'+
                      //----------------------------------------------------------------------------
                    '</div></div>'), 0, 0, 2,3, true);
                    }
                    if(ih == 4){
                      grid.addWidget($('<div id="'+index_data+'" style="display:none;"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                      '    <div class="w3-card-4 w3-margin w3-white">'+
                      '<div class="topright" style="z-index:99;">'+
                        '<a class="btn3" href="#"  onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                      '</div>'+
                      '<video width="100%" controls>'+
                        '<source src="" type="video/mp4">'+
                      '</video>'+
                        '  </div>'+
                      //----------------------------------------------------------------------------
                    '</div></div>'), 0, 0, 4,4, true);
                    }
                    if(ih == 5){
                      grid.addWidget($('<div id="'+index_data+'" style="display:none;"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                      '    <div class="w3-card-4 w3-margin w3-white">'+
                      '<div class="topright">'+
                        '<a class="btn3" href="#" style="z-index:99;" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                      '</div>'+
                          '<img src="public/img/icon/photo.png" style="height:100%;width:100%;object-fit: cover;">'+

                        '  </div>'+
                      //----------------------------------------------------------------------------
                    '</div></div>'), 0, 0, 3,6, true);
                    }

                    s=50;
                  }
                  if(s<30){
                    index_data++
                  }
                }
                $( "#"+index_data ).fadeIn( "slow" );
                //  $('#addboxto').click();
                goToByScrolls(index_data);
                // document.getElementById(index_data).focus();
                // goToByScroll("#"+index_data);
                    arr_index[arr_index.length] = index_data;
                    str[str.length] = index_data;
                }

                $('#de').click(this.deleteWidget);
                $('#clear-grid').click(this.clearGrid);
                $('#save-grid').click(this.saveGrid);
                $('#load-grid').click(this.loadGrid);

                this.loadGrid();
                resizeGrid();
            };
        });
  function goToByScrolls(id){
    console.log(id);
    var positionId =  $('#'+id).position();
    console.log(positionId);
    $("#bodyshow").animate({ scrollTop: positionId.top }, 250);
  }


    //---------------------------------------------popup tool edit---------------------------------
      function confirmclosebox(id) {
        var p = new Popelt({
          title: 'Are you sure you want to do this?',
          closeButton: false,
          escClose: false,
          modal: true
        });
        p.addButton('Yes','btn btn-danger', function(){
          console.log('close box edit');
          document.getElementById(id).style.display = "none";
          p.close();
        });
        p.addCancelButton();
        p.show();
      }
      var modal = document.getElementById('myModal');// Get the modal
      var modal2 = document.getElementById('myModal2');
      var modal3 = document.getElementById('myModal3');
      var modal4 = document.getElementById('myModal4');
      var modal5 = document.getElementById('myModal5');
      var modal6 = document.getElementById('myModal6');
      var modal7 = document.getElementById('myModal7');
      var modal8 = document.getElementById('myModal8');
      var modal9 = document.getElementById('myModal9');
      var modal10 = document.getElementById('myModal10');
      var span = document.getElementsByClassName("close")[0];// Get the <span> element that closes the modal
      var span2 = document.getElementsByClassName("close2")[0];
      var span3 = document.getElementsByClassName("close3")[0];
      var span4 = document.getElementsByClassName("close4")[0];
      var span5 = document.getElementsByClassName("close5")[0];
      var span6 = document.getElementsByClassName("close6")[0];
      var span7 = document.getElementsByClassName("close7")[0];
      var span8 = document.getElementsByClassName("close8")[0];
      var span9 = document.getElementsByClassName("close9")[0];
      var span10 = document.getElementsByClassName("close10")[0];
      function editbox(idindex,position) {// When the user clicks the button, open the modal
        document.getElementById("save-grid").innerHTML = '<i style="color:red;" class="glyphicon glyphicon-floppy-save"></i>';
        console.log(idindex);
        if(position%6 == 0){
          document.getElementById("title").innerHTML = '<i class="glyphicon glyphicon-edit"></i> Edit your Profile and Description';
          document.getElementById("titledescription0").value = datato[idindex+''+5];
          document.getElementById("detail0").value = datato[idindex+''+3];
          document.getElementById("id1").value = idindex;
          modal.style.display = "block";
        }
        if(position%6 == 1){
          document.getElementById("title2").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit your Video and Description';
          document.getElementById("titlename1").value = datato[idindex+''+4];
          document.getElementById("titledescription1").value = datato[idindex+''+5];
          document.getElementById("detail1").value = datato[idindex+''+3];
          document.getElementById("id2").value = idindex;
          modal2.style.display = "block";
        }
        if(position%6 == 2){
          document.getElementById("title3").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit your Photo and Description';
          document.getElementById("titlename2").value = datato[idindex+''+4];
          document.getElementById("titledescription2").value = datato[idindex+''+5];
          document.getElementById("detail2").value = datato[idindex+''+3];
          document.getElementById("id3").value = idindex;
          modal3.style.display = "block";
        }
        if(position%6 == 3){
          document.getElementById("title4").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit your Article';
          document.getElementById("titlename3").value = datato[idindex+''+4];
          document.getElementById("titledescription3").value = datato[idindex+''+5];
          document.getElementById("detail3").innerHTML = datato[idindex+''+3];
          document.getElementById("id4").value = idindex;
          console.log(datato[idindex+''+3]);
          modal4.style.display = "block";
        }
        if(position%6 == 4){
          document.getElementById("title5").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit Video';
          document.getElementById("id5").value = idindex;
          console.log(datato[idindex+''+3]);
          modal5.style.display = "block";
        }
        if(position%6 == 5){
          document.getElementById("title6").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit Photo';
          document.getElementById("id6").value = idindex;
          console.log(datato[idindex+''+3]);
          modal6.style.display = "block";
        }
      }
      function editcolorbox(idindex,position) {
document.getElementById("save-grid").innerHTML = '<i style="color:red;" class="glyphicon glyphicon-floppy-save"></i>';
        document.getElementById("idcolor").value = idindex;
        document.getElementById("title7").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit Color';
        document.getElementById('bg').style.color =  datato[idindex+''+7];
        document.getElementById('bg3').style.color  =  datato[idindex+''+8];
        document.getElementById('bg').style.backgroundColor = datato[idindex+''+9];
        document.getElementById('bg2').style.backgroundColor = datato[idindex+''+9];
        document.getElementById('bg3').style.backgroundColor = datato[idindex+''+10];
        document.getElementById('color1').value = datato[idindex+''+7];
        document.getElementById('color2').value = datato[idindex+''+8];
        document.getElementById('color3').value = datato[idindex+''+9];
        document.getElementById('color4').value = datato[idindex+''+10];
        document.getElementById('b1').style.backgroundColor = datato[idindex+''+7];
        document.getElementById('b2').style.backgroundColor = datato[idindex+''+8];
        document.getElementById('b3').style.backgroundColor = datato[idindex+''+9];
        document.getElementById('b4').style.backgroundColor = datato[idindex+''+10];
        modal7.style.display = "block";
      }
      function changebg() {
        modal8.style.display = "block";
      }
      function help() {
        modal9.style.display = "block";
      }
      function savedelay() {
        $('#savemodel').fadeIn();
      }
//---------------------------------close---------------------------------------
      span.onclick = function() {// When the user clicks on <span> (x), close the modal
        confirmclosebox('myModal');
      }
      span2.onclick = function() {
        confirmclosebox('myModal2');
      }
      span3.onclick = function() {
        confirmclosebox('myModal3');
      }
      span4.onclick = function() {
        confirmclosebox('myModal4');
      }
      span5.onclick = function() {
        confirmclosebox('myModal5');
      }
      span6.onclick = function() {
        confirmclosebox('myModal6');
      }
      span7.onclick = function() {
        confirmclosebox('myModal7');
      }
      span8.onclick = function() {
        confirmclosebox('myModal8');
      }
      span9.onclick = function() {
        document.getElementById('myModal9').style.display = "none";
      }
      span10.onclick = function() {
        confirmclosebox('myModal10');
      }
    </script>
    <script>
    //--------------------------------delete box-----------------------------------------
    function deletebox(id) {
      var p = new Popelt({
        title: 'Are you sure you want to delete?',
        closeButton: false,
        escClose: false,
        modal: true
      });
      p.addButton('Yes','btn btn-danger', function(){
        console.log('delete ok :'+id);
        document.getElementById("save-grid").innerHTML = '<i style="color:red;" class="glyphicon glyphicon-floppy-save"></i>';
        var elem = document.getElementById(id);
        elem.parentElement.removeChild(elem);
        id_delete[id_delete.length] = id;
        for(var k = 0; k < id_delete.length;k++){
          console.log(id_delete[k]);
        }
        p.close();
      });
      p.addCancelButton();
      p.show();
    }
    function deletebox2(id,s) {
      var p = new Popelt({
        title: 'Are you sure you want to delete?',
        closeButton: false,
        escClose: false,
        modal: true
      });
      p.addButton('Yes','btn btn-danger', function(){
        document.getElementById("save-grid").innerHTML = '<i style="color:red;" class="glyphicon glyphicon-floppy-save"></i>';
        id_delete[id_delete.length] = id;
        id_delete2 += id+',';
        console.log(id_delete2);
        var elem = document.getElementById(id);
        elem.parentElement.removeChild(elem);
        console.log(id_delete2);
        document.getElementById("id_delete").value = id_delete2;
        p.close();
      });
      p.addCancelButton();
      p.show();
    }
    //------------------------------datetime---------------------------------------------
    function timenowget() {
      var currentdate = new Date();
      var datetime = currentdate.getDate() + "/"
              + (currentdate.getMonth()+1)  + "/"
              + currentdate.getFullYear() + " @ "
              + currentdate.getHours() + ":"
              + currentdate.getMinutes() + ":"
              + currentdate.getSeconds();
    return datetime;
    }

      //-------------------------------------------------formall------------------------------------------------------
        var formformall = document.querySelector(".formall");
        var requestformall = new XMLHttpRequest();
        formformall.addEventListener('submit',function(e){
            e.preventDefault();
            $formformall = $(this);
            requestformall.upload.addEventListener("progress",function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $formformall.find(".progress-bar").width(percent+"%") //push percent to progress-bar
                if(percent == 100){
                  setTimeout(function(){ location.reload(); }, 1200);
                  //document.getElementById("img").src=img;
                }
            });
            var formdataformall = new FormData(formformall);
            requestformall.open("post","{{ url('/saveportfolioall') }}"); //send to form where?? ->submit
            requestformall.send(formdataformall);
        });
        //--------------------------------------------------profile------------------------------------------------------
          var form2 = document.querySelector('.profile');
          var request2 = new XMLHttpRequest();
          form2.addEventListener('submit',function(e){
              console.log('aaaa');
              e.preventDefault();
              $form = $(this);
              request2.upload.addEventListener('progress',function(e){
                  var percent = e.loaded/e.total *100;
                  console.log(percent);
                  $form.find('.progress-bar').width(percent+'%') //push percent to progress-ba
                  if(percent == 100){
                   setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
                   //setTimeout(function(){ location.reload(); }, 100);
                  }
              });
              request2.addEventListener('load',function(e){
                $form.find('.progress-bar');
              });
              var formdata = new FormData(form2);
              request2.open('post',"{{ url('/saveprofileport') }}"); //send to form where?? ->submit
              request2.send(formdata);
          });
        //---------------------------------------------video and text -------------------------------------------------------
        $('.videoandtext').ajaxForm({
          type: "POST",
          url: "{{ url('/savevideotextport') }}",
          dataType: 'html', // serializes the form's elements.
          uploadProgress: function (event,position,total,percent) {
            document.getElementById("progress-bar1").style.width = percent+'%';
            document.getElementById("progress-bar1").innerHTML = (percent | 0)+'%';
            console.log(percent);
          },
          success: function(result) {
            console.log(result);
            if(result == 'success'){
               setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
            }
          },
          error: function(xhr,textStatus){ alert(textStatus);}
        });
        //---------------------------------------------photo and text -------------------------------------------------------
        $('.photoandtext').ajaxForm({
          type: "POST",
          url: "{{ url('/savephototextport') }}",
          dataType: 'html', // serializes the form's elements.
          uploadProgress: function (event,position,total,percent) {
            document.getElementById("progress-bar2").style.width = percent+'%';
            document.getElementById("progress-bar2").innerHTML = (percent | 0)+'%';
            console.log(percent);
          },
          success: function(result) {
            console.log(result);
            if(result == 'success'){
               setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
            }
          },
          error: function(xhr,textStatus){ alert(textStatus);}
        });
        //---------------------------------------------text -------------------------------------------------------
        var form5 = document.querySelector('.text');
        var request5 = new XMLHttpRequest();
        form5.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request5.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                if(percent == 100){
                 setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
                }
            });
            request5.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form5);
            request5.open('post',"{{ url('/savetextport') }}"); //send to form where?? ->submit
            request5.send(formdata);
        });
        //---------------------------------------------photo -------------------------------------------------------
        $('.photo').ajaxForm({
          type: "POST",
          url: "{{ url('/savephotoport') }}",
          dataType: 'html', // serializes the form's elements.
          uploadProgress: function (event,position,total,percent) {
            document.getElementById("progress-bar4").style.width = percent+'%';
            document.getElementById("progress-bar4").innerHTML = (percent | 0)+'%';
            console.log(percent);
          },
          success: function(result) {
            console.log(result);
            if(result == 'success'){
               setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
            }
          },
          error: function(xhr,textStatus){ alert(textStatus);}
        });

        //---------------------------------------------video -------------------------------------------------------
         $('.videoupload').ajaxForm({
           type: "POST",
           url: "{{ url('/savevideoport') }}",
           dataType: 'html', // serializes the form's elements.
           uploadProgress: function (event,position,total,percent) {
            document.getElementById("progress-bar3").style.width = percent+'%';
            document.getElementById("progress-bar3").innerHTML = (percent | 0)+'%';
             console.log(percent);
           },
           success: function(result) {
             console.log(result);
             if(result == 'success'){
                setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
             }
           },
           error: function(xhr,textStatus){ alert(textStatus);}
         });
        //---------------------------------------------color -------------------------------------------------------
        var form7 = document.querySelector('.color');
        var request7 = new XMLHttpRequest();
        form7.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request7.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                if(percent == 100){
                 setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
                }
            });
            request7.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form7);
            request7.open('post',"{{ url('/savecolorport') }}"); //send to form where?? ->submit
            request7.send(formdata);
        });
        //-----------------------------------------background ---------------------------------------------------
        var form8 = document.querySelector('.background');
        var request8 = new XMLHttpRequest();
        form8.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request8.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                document.getElementById("progress-bar5").style.width = percent+'%';
                document.getElementById("progress-bar5").innerHTML = (percent | 0)+'%';
                if(percent == 100){
                  setTimeout(function(){ document.getElementById('save-grid').click(); }, 100);
                }
            });
            request8.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form8);
            request8.open('post',"{{ url('/savebgportfolio') }}"); //send to form where?? ->submit
            request8.send(formdata);
        });
    </script>
     <!--end if user don't have imgae -->
		<script src="{{ asset('public/navbarleft/slidebars.js') }}"></script>
		<script src="{{ asset('public/navbarleft/scripts.js') }}"></script>


<?php }else{ ?>
    <a id="togo" href="{{ url('/home') }}"></a>
   <script>
    document.getElementById('togo').click();
   </script>
<?php } ?>
