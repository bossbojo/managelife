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
                      @if(Auth::user()->blocking != 'block')
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
                      @endif

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
                            @if(Auth::user()->blocking != 'block')
                            <li>
                              <a href="{{ url('/fileupload') }}"><i class="glyphicon glyphicon-upload"></i> FileUpload</a>
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
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                  @if(Auth::user()->blocking != 'block')
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
                                  @endif
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
    <script src="/js/app.js"></script>
    <script type="text/javascript">

      function searchShow() {
        $('#ShowBarSearch').click();
      }
    </script>
</body>
</html>
