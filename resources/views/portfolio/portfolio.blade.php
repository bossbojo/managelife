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
use App\Favorite;
use App\Feedback;

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

    <!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> -->
    <link rel="stylesheet" href="{{ asset('public/dist/gridstack.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/dist/gridstack-extra.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/css/profile style.css') }}">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>

    <script src="{{ asset('public/dist/gridstack.js') }}"></script>

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
            color: white;
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
            color: white;
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
            color: white;
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
            color: white;
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
            color: white;
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
            color: white;
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
            color: white;
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
            color: white;
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
    <script>
    	//paste this code under head tag or in a seperate js file.
    	// Wait for window load
    	$(window).load(function() {
    		// Animate loader off screen
    		$(".se-pre-con").fadeOut("slow");;
    	});
    </script>
</head>
<body background="img/bg/6860999-blurry.jpg" style="background-color:#aaa;">
  <!-- icon  -->
    <!-- btn shard -->
    <?php
    $check = Favorite::find(Auth::user()->id);
    $numtof = 0;
    $usernow = 0;
    if($check != ''){
      $pieces = explode(",", $check->favorite);
      $numtof = sizeof($pieces)-1;
      for ($i=0; $i < sizeof($pieces) ; $i++) {
        if($pieces[$i] == Auth::user()->id){
          $usernow = 1;
        }
      }
    }
     ?>
  <div style="z-index:999; position:absolute; bottom:0px; padding-left:30px;">
    <div style="background-color:rgba(0, 0, 0, 0.35); border-radius:5px;  padding:5px;">
      <a href="#" class="btn btn-primary">
        <span class="fa fa-facebook"></span>
      </a>
      <a href="#" class="btn btn-danger">
        <span class="fa fa-google"></span>
      </a>
      <a href="#" class="btn btn-info">
        <span class="fa fa-twitter"></span>
      </a>
      <a href="{{ url('/feedback') }}" class="btn btn-default">
       <i style="color:rgba(166, 255, 0, 0.95); font-size:20px;" class="glyphicon glyphicon-star"></i> favorite ({{ $numtof }})
      </a>
      <a href="{{ url('/feedback') }}" class="btn btn-default">
        <i class="glyphicon glyphicon-comment"></i> Comment for this portfolio (0)
      </a>
    </div>
  </div>
  <!-- btn edit , show , custom -->
  <style media="screen">
.btn-circle {
  color: #000;
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  padding-top: 18px;
  padding-left: 17px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}
  </style>
  <div style="z-index:999; position:absolute; bottom:20px; right:50px;">
    <div style="background-color:rgba(0, 0, 0, 0.5); padding:5px; border-radius:5px;">
      <a href="{{ url('customportfolio') }}" class="btn btn-warning btn-circle btn-xl">
        <i class="glyphicon glyphicon-move"></i>
      </a>
      <a href="{{ url('listpresent') }}" class="btn btn-warning btn-circle btn-xl">
        <i class="glyphicon glyphicon-edit"></i>
      </a>
      <a href="{{ url('presentfull') }}" class="btn btn-warning btn-circle btn-xl">
        <i class="glyphicon glyphicon-fullscreen"></i>
      </a>

    </div>
  </div>


<div class="se-pre-con"></div>
  <div canvas="container" style=" background-image:url('<?=   asset($index->background); ?>'); ">
    <div class="device-xs visible-xs"></div>
    <div class="device-sm visible-sm"></div>
    <div class="device-md visible-md"></div>
    <div class="device-lg visible-lg"></div>
    <div class="device-xl visible-xl"></div>
        <!-- show portfolio -->
        <div class="" style="background-color:transparent;">
          <div class="panel-body">
            <div class=" grid-stack" style="background-color:transparent;">
            </div>
          </div>
        </div>
        <div style="height:800px;"></div>
        <!-- end show portfolio -->
  </div>
      <div off-canvas="slidebar-4 bottom overlay">
          <div class="col-md-2" style="visibility: hidden;position: absolute;">
            <div class="panel-body ">
              <form class="formall" >
                <input type="hidden" value="{{csrf_token() }}" name="_token">
                <input type="hidden" value="saveposition" name="check">
                <textarea  name="position" id="saved-data" style="width:100%; color:#000;"cols="20" rows="5" readonly="readonly"></textarea><br>
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
                  <img src="img/icon/profile.png" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget2">
                  <img src="img/icon/textandvideo.png" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget3">
                  <img src="img/icon/textandimg.png" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget4">
                  <img src="img/icon/text.png" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget5">
                  <img src="img/icon/video.png" width="65%">
                </a>
              </div>
              <div class="col-md-2">
                <a class="btn2" href="#" id="add-widget6">
                  <img src="img/icon/photo.png" width="65%">
                </a>
              </div>
            </div>
          </center>
          </div>
  		</div>

      <!-- ================================================================ End HTML ====================================================================== -->
      <?php
        $nextid = 0;
        $id_data = Dataportfolio::all();
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
      $nowlogin = Indexportfolio::find(Auth::user()->id);
      if($nowlogin->phpindex != 'undefined'){
      $iddatato = explode(",",$nowlogin->phpindex);
      for($i = 0 ; $i< sizeof($iddatato);$i++){
        $to = Dataportfolio::find($iddatato[$i]);
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
                    this.grid.removeAll();
                    var items = GridStackUI.Utils.sort(this.serializedData);
                    _.each(items, function (node, i) {
                      if(str[i]%6==0){
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' style="overflow:hidden;" ><div style="overflow:hidden;" class="grid-stack-item-content " >' +
                                              '<div class="w3-card-4 w3-margin w3-white" style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                              '<img src="{{Auth::user()->avatar}}"  style="{{Auth::user()->filter}} height:100%;width:100%;object-fit: cover;">'+
                                                '<div class="w3-container w3-padding-8" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                  '<h4><b>{{Auth::user()->name}}</b></h4>'+
                                                  '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                '</div>'+
                                                '<div class="w3-container" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';">'+
                                                  '<p style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'+
                                                '</div>'+
                                              '</div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                      }
                      if(str[i]%6==1){
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+'><div style="overflow:hidden   ;" class="grid-stack-item-content ">' +
                                                '<div class="w3-card-4 w3-margin w3-white" style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                                  '<video width="100%" controls>'+
                                                    '<source src="'+datato[arr_index[i]+""+2]+'" type="video/mp4">'+
                                                  '</video>'+
                                                  '<div class="w3-container w3-padding-8"  style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                    '<h4><b>'+datato[arr_index[i]+""+4]+'</b></h4>'+
                                                      '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                  '</div>'+
                                                  '<div class="w3-container" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';">'+
                                                      '<p style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'  +
                                                  '</div>'+
                                                '</div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);

                      }
                      if(str[i]%6==2){
                        var img = 'img/icon/photo.png';
                        if(datato[arr_index[i]+""+1] !='empty'){
                          img =datato[arr_index[i]+""+1];
                        }
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+'><div style="overflow:hidden   ;"  class="grid-stack-item-content ">' +
                                                '    <div class="w3-card-4 w3-margin w3-white" style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                                    '<img src="'+img+'" style="height:100%;width:100%;object-fit: cover;">'+
                                                    '  <div class="w3-container w3-padding-8"  style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                      '  <h4><b>'+datato[arr_index[i]+""+4]+'</b></h4>'+
                                                        '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                  '    </div>'+
                                                    '  <div class="w3-container"  style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';">'+
                                                        '<p style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'  +
                                                    '  </div>'+
                                                  '  </div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);

                      }
                      if(str[i]%6==3){
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+'><div style="overflow:hidden   ;" class="grid-stack-item-content ">' +
                                              '    <div class="w3-card-4 w3-margin w3-white"  style="background-color:'+datato[arr_index[i]+""+9]+';" >'+
                                                  '  <div class="w3-container w3-padding-8" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+7]+';">'+
                                                    '  <h4><b>'+datato[arr_index[i]+""+4]+'</b></h4>'+
                                                      '<h5>'+datato[arr_index[i]+""+5]+', <span class="w3-opacity">'+datato[arr_index[i]+""+6]+'</span></h5>'+
                                                      ' </div>'+
                                                  '  <div class="w3-container" style="background-color:'+datato[arr_index[i]+""+9]+'; color:'+datato[arr_index[i]+""+8]+';" >'+
                                                      '<p style="background-color:'+datato[arr_index[i]+""+10]+';">'+datato[arr_index[i]+""+3]+'</p>'  +

                                                  '  </div>'+
                                                '  </div>'+
                                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                      }
                      if(str[i]%6==4){
                        var img = 'public/img/icon/video.png';
                        if(datato[arr_index[i]+""+1] !='empty'){
                          img =datato[arr_index[i]+""+2];
                        }
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' style="overflow:visible;" ><div style="overflow:hidden   ;" class="grid-stack-item-content ">' +
                                '    <div class="w3-card-4 w3-margin w3-white">'+
                                '<video width="100%" controls>'+
                                  '<source src="'+datato[arr_index[i]+""+2]+'" type="video/mp4">'+
                                '</video>'+
                                    '  </div>'+
                              '</div></div>'),
                            node.x, node.y, node.width, node.height);
                      }  if(str[i]%6==5){
                        var img2 = 'public/img/icon/photo.png';
                        if(datato[arr_index[i]+""+1] !='empty'){
                          img2 =datato[arr_index[i]+""+1];
                        }
                        this.grid.addWidget($('<div id="'+arr_index[i]+'"'+' style="overflow:visible;"><div style="overflow:hidden   ;" class="parent grid-stack-item-content ">' +
                                '    <div class="w3-card-4 w3-margin w3-white">'+
                                    '<img src="'+img2+'" style="width:100%;object-fit: cover;">'+
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
                  document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-save"></i> SAVE';
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
                    setTimeout(function(){ location.reload(); }, 100);

                    $('#saved-data').val(JSON.stringify(this.serializedData, null, '    '));
                    return false;
                }.bind(this);
                //--------------------------------clearGrid-----------------------------------------

                this.clearGrid = function () {
                  if(confirm('Are you sure?')== true ){
                    i =0;
                    index = 0;
                    this.grid.removeAll();
                    return false;
                  }
                }.bind(this);

                $('#de').click(function() {
                  console.log("sss");
                  var self = this;
                  self.widgets.remove(item);
                  return false;
                });

            //--------------------------------add box-----------------------------------------
                $('#add-widget1').click(function() {
                     addNewWidget('0');
                });
                $('#add-widget2').click(function() {

                     addNewWidget('1');
                });
                $('#add-widget3').click(function() {

                     addNewWidget('2');
                });
                $('#add-widget4').click(function() {

                     addNewWidget('3');
                });
                $('#add-widget5').click(function() {

                     addNewWidget('4');
                });
                $('#add-widget6').click(function() {

                     addNewWidget('5');
                });
                function addNewWidget(ih) {
                    index_data++;
                    index++;
                    for(var s = 0 ; s<20 ; s++){
                      if(index_data%6 == ih){
                    console.log(ih);
                    var grid = $('.grid-stack').data('gridstack');
                    document.getElementById("save-grid").className  = "btn btn-danger";
                    document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-open"></i> SAVE*';
                    if(ih == 0){ // profile
                      grid.addWidget($('<div id="'+index_data+'" ><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                      '<div class="w3-card-4 w3-margin w3-white">'+
                        '<div class="topright">'+

                          '<a class="btn3" href="#" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                        '</div>'+
                        '<img src="{{Auth::user()->avatar}}" style="height:100%;width:100%;object-fit: cover;">'+
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
                        grid.addWidget($('<div id="'+index_data+'" ><div class="grid-stack-item-content " >'+
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
                      grid.addWidget($('<div id="'+index_data+'"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                  '    <div class="w3-card-4 w3-margin w3-white">'+
                  '<div class="topright">'+
                    '<a class="btn3" href="#" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                  '</div>'+
                      '<img src="img/icon/photo.png" style="height:100%;width:100%;object-fit: cover;">'+
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
                      grid.addWidget($('<div id="'+index_data+'"><div class="grid-stack-item-content " >'+
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
                      grid.addWidget($('<div id="'+index_data+'"><div class="grid-stack-item-content " >'+
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
                      grid.addWidget($('<div id="'+index_data+'"><div class="grid-stack-item-content " >'+
                      //----------------------------------------------------------------------------
                      '    <div class="w3-card-4 w3-margin w3-white">'+
                      '<div class="topright">'+
                        '<a class="btn3" href="#" style="z-index:99;" onclick="deletebox('+index_data+')" > <i class="glyphicon glyphicon-trash"></i></a>'+
                      '</div>'+
                          '<img src="img/icon/photo.png" style="height:100%;width:100%;object-fit: cover;">'+

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
                    arr_index[arr_index.length] = index_data;
                    str[str.length] = index_data;
                    // for(var s = 0 ; s<=str.length ;s++){
                    //   console.log(str[s]);
                    // }
                    // for(var s = 0 ; s<=str.length ;s++){
                    //   console.log(arr_index[s]);
                    // }

                }

                $('#de').click(this.deleteWidget);
                $('#clear-grid').click(this.clearGrid);
                $('#save-grid').click(this.saveGrid);
                $('#load-grid').click(this.loadGrid);

                this.loadGrid();
                resizeGrid();
            };
        });



    //---------------------------------------------popup tool edit---------------------------------
      var modal = document.getElementById('myModal');// Get the modal
      var modal2 = document.getElementById('myModal2');
      var modal3 = document.getElementById('myModal3');
      var modal4 = document.getElementById('myModal4');
      var modal5 = document.getElementById('myModal5');
      var modal6 = document.getElementById('myModal6');
      var modal7 = document.getElementById('myModal7');
      var modal8 = document.getElementById('myModal8');
      var span = document.getElementsByClassName("close")[0];// Get the <span> element that closes the modal
      var span2 = document.getElementsByClassName("close2")[0];
      var span3 = document.getElementsByClassName("close3")[0];
      var span4 = document.getElementsByClassName("close4")[0];
      var span5 = document.getElementsByClassName("close5")[0];
      var span6 = document.getElementsByClassName("close6")[0];
      var span7 = document.getElementsByClassName("close7")[0];
      var span8 = document.getElementsByClassName("close8")[0];
      function editbox(idindex,position) {// When the user clicks the button, open the modal
        document.getElementById("save-grid").className  = "btn btn-danger";
        document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-open"></i> SAVE*';
        console.log(idindex);
        if(position%6 == 0){
          document.getElementById("title").innerHTML = '<i class="glyphicon glyphicon-edit"></i> Edit your Profile and Description';
          document.getElementById("titledescription0").value = datato[idindex+''+5];
          document.getElementById("time0").innerHTML  = timenowget();
          document.getElementById("detail0").value = datato[idindex+''+3];
          document.getElementById("timeset0").value = timenowget();
          document.getElementById("id1").value = idindex;
          modal.style.display = "block";
        }
        if(position%6 == 1){
          document.getElementById("title2").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit your Video and Description';
          document.getElementById("titlename1").value = datato[idindex+''+4];
          document.getElementById("titledescription1").value = datato[idindex+''+5];
          document.getElementById("time1").innerHTML  = timenowget();
          document.getElementById("detail1").value = datato[idindex+''+3];
          document.getElementById("timeset1").value = timenowget();
          document.getElementById("id2").value = idindex;
          modal2.style.display = "block";
        }
        if(position%6 == 2){
          document.getElementById("title3").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit your Photo and Description';
          document.getElementById("titlename2").value = datato[idindex+''+4];
          document.getElementById("titledescription2").value = datato[idindex+''+5];
          document.getElementById("time2").innerHTML  = timenowget();
          document.getElementById("detail2").value = datato[idindex+''+3];
          document.getElementById("timeset2").value = timenowget();
          document.getElementById("id3").value = idindex;
          modal3.style.display = "block";
        }
        if(position%6 == 3){
          document.getElementById("title4").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit your Article';
          document.getElementById("titlename3").value = datato[idindex+''+4];
          document.getElementById("titledescription3").value = datato[idindex+''+5];
          document.getElementById("time3").innerHTML  = timenowget();
          document.getElementById("detail3").innerHTML = datato[idindex+''+3];
          document.getElementById("timeset3").value = timenowget();
          document.getElementById("id4").value = idindex;
          console.log(datato[idindex+''+3]);
          modal4.style.display = "block";
        }
        if(position%6 == 4){
          document.getElementById("title5").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit Video';
          document.getElementById("timeset4").value = timenowget();
          document.getElementById("id5").value = idindex;
          console.log(datato[idindex+''+3]);
          modal5.style.display = "block";
        }
        if(position%6 == 5){
          document.getElementById("title6").innerHTML = '<i class="glyphicon glyphicon-edit"></i>  Edit Photo';
          document.getElementById("timeset5").value = timenowget();
          document.getElementById("id6").value = idindex;
          console.log(datato[idindex+''+3]);
          modal6.style.display = "block";
        }
      }
      function editcolorbox(idindex,position) {
        document.getElementById("save-grid").className  = "btn btn-danger";
        document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-open"></i> SAVE*';
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
      span.onclick = function() {// When the user clicks on <span> (x), close the modal
        if(confirm('Are you sure?')== true ){
          modal.style.display = "none";
        }

      }
      span2.onclick = function() {// When the user clicks on <span> (x), close the modal
        if(confirm('Are you sure?')== true ){
          modal2.style.display = "none";
        }
      }
      span3.onclick = function() {// When the user clicks on <span> (x), close the modal
      if(confirm('Are you sure?')== true ){
          modal3.style.display = "none";
        }
      }
      span4.onclick = function() {// When the user clicks on <span> (x), close the modal
        {
          modal4.style.display = "none";
        }

      }
      span5.onclick = function() {// When the user clicks on <span> (x), close the modal
        if(confirm('Are you sure?')== true ){
          modal5.style.display = "none";
        }
      }
      span6.onclick = function() {// When the user clicks on <span> (x), close the modal
        if(confirm('Are you sure?')== true ){
          modal6.style.display = "none";
        }
      }
      span7.onclick = function() {// When the user clicks on <span> (x), close the modal
        if(confirm('Are you sure?')== true ){
          modal7.style.display = "none";
        }
      }
      span8.onclick = function() {// When the user clicks on <span> (x), close the modal
        if(confirm('Are you sure?')== true ){
          modal8.style.display = "none";
        }
      }
      window.onclick = function(event) {  // When the user clicks anywhere outside of the modal, close it

          if (event.target == modal) {
            if(confirm('Are you sure?')== true ){
              modal.style.display = "none";
            }
          }
          if (event.target == modal2) {
            if(confirm('Are you sure?')== true ){
              modal2.style.display = "none";
            }
          }
          if (event.target == modal3) {
            if(confirm('Are you sure?')== true ){
              modal3.style.display = "none";
            }
          }
          if (event.target == modal4) {
            if(confirm('Are you sure?')== true ){
              modal4.style.display = "none";
            }
          }
          if (event.target == modal5) {
            if(confirm('Are you sure?')== true ){
              modal5.style.display = "none";
            }
          }
          if (event.target == modal6) {
            if(confirm('Are you sure?')== true ){
              modal6.style.display = "none";
            }
          }
          if (event.target == modal7) {
            if(confirm('Are you sure?')== true ){
              modal7.style.display = "none";
            }
          }
          if (event.target == modal8) {
            if(confirm('Are you sure?')== true ){
              modal8.style.display = "none";
            }
          }

      }
    </script>
    <script>
    //--------------------------------delete box-----------------------------------------
    function deletebox(id) {
      if(confirm('Are you sure?')== true ){
      document.getElementById("save-grid").className  = "btn btn-danger";
      document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-open"></i> SAVE*';
      var elem = document.getElementById(id);
      elem.parentElement.removeChild(elem);
      id_delete[id_delete.length] = id;
      console.log("----------list delete id------------");
      for(var k = 0; k < id_delete.length;k++){
        console.log(id_delete[k]);
      }
      console.log("----paramat singkon 5611405545------");
    }
    }
    function deletebox2(id,s) {
      if(confirm('Are you sure?')== true ){
      document.getElementById("save-grid").className  = "btn btn-danger";
      document.getElementById("save-grid").innerHTML = '<i class="glyphicon glyphicon-floppy-open"></i> SAVE*';
      id_delete[id_delete.length] = id;
      id_delete2 += id+',';
      console.log(id_delete2);
      var elem = document.getElementById(id);
      elem.parentElement.removeChild(elem);
      console.log("----------list delete id------------");
      console.log(id_delete2);
      console.log("----paramat singkon 5611405545------");
      document.getElementById("id_delete").value = id_delete2;
      }
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
        var form = document.querySelector(".formall");
        var request = new XMLHttpRequest();
        form.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request.upload.addEventListener("progress",function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find(".progress-bar").width(percent+"%") //push percent to progress-bar
                if(percent == 100){
                  //setTimeout(function(){ document.getElementById('togo').click(); }, 900);
                  //document.getElementById("img").src=img;
                }
            });
            request.addEventListener("load",function(e){
              $form.find(".progress-bar");
            });
            var formdata = new FormData(form);
            request.open("post","portfolio"); //send to form where?? ->submit
            request.send(formdata);
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
                   setTimeout(function(){ location.reload(); }, 100);
                  }
              });
              request2.addEventListener('load',function(e){
                $form.find('.progress-bar');
              });
              var formdata = new FormData(form2);
              request2.open('post','portfolio'); //send to form where?? ->submit
              request2.send(formdata);
          });
        //---------------------------------------------video and text -------------------------------------------------------
        var form3 = document.querySelector('.videoandtext');
        var request3 = new XMLHttpRequest();
        form3.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request3.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                document.getElementById("progress-bar1").style.width = percent+'%';
                document.getElementById("progress-bar1").innerHTML = (percent | 0)+'%';
                if(percent == 100){
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request3.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form3);
            request3.open('post','portfolio'); //send to form where?? ->submit
            request3.send(formdata);
        });
        //---------------------------------------------photo and text -------------------------------------------------------
        var form4 = document.querySelector('.photoandtext');
        var request4 = new XMLHttpRequest();
        form4.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request4.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                document.getElementById("progress-bar2").style.width = percent+'%';
                document.getElementById("progress-bar2").innerHTML = (percent | 0)+'%';
                if(percent == 100){
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request4.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form4);
            request4.open('post','portfolio'); //send to form where?? ->submit
            request4.send(formdata);
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
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request5.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form5);
            request5.open('post','portfolio'); //send to form where?? ->submit
            request5.send(formdata);
        });
        //---------------------------------------------photo -------------------------------------------------------
        var form6 = document.querySelector('.photo');
        var request6 = new XMLHttpRequest();
        form6.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request6.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                document.getElementById("progress-bar4").style.width = percent+'%';
                document.getElementById("progress-bar4").innerHTML = (percent | 0)+'%';
                if(percent == 100){
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request6.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form6);
            request6.open('post','portfolio'); //send to form where?? ->submit
            request6.send(formdata);
        });
        //---------------------------------------------video -------------------------------------------------------
        var form7 = document.querySelector('.video');
        var request7 = new XMLHttpRequest();
        form7.addEventListener('submit',function(e){
            e.preventDefault();
            $form = $(this);
            request7.upload.addEventListener('progress',function(e){
                var percent = e.loaded/e.total *100;
                console.log(percent);
                $form.find('.progress-bar').width(percent+'%') //push percent to progress-bar
                document.getElementById("progress-bar3").style.width = percent+'%';
                document.getElementById("progress-bar3").innerHTML = (percent | 0)+'%';
                if(percent == 100){
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request7.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form7);
            request7.open('post','portfolio'); //send to form where?? ->submit
            request7.send(formdata);
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
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request7.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form7);
            request7.open('post','portfolio'); //send to form where?? ->submit
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
                 setTimeout(function(){ location.reload(); }, 100);
                }
            });
            request8.addEventListener('load',function(e){
              $form.find('.progress-bar');
            });
            var formdata = new FormData(form8);
            request8.open('post','portfolio'); //send to form where?? ->submit
            request8.send(formdata);
        });

    </script>
     <!--end if user don't have imgae -->
		<script src="{{ asset('public/navbarleft/slidebars.js') }}"></script>
		<script src="{{ asset('public/navbarleft/scripts.js') }}"></script>
</body>
</html>

<?php }else{ ?>

login plss
<?php } ?>
