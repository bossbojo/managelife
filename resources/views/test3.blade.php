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
<body style="background-color:#fff; border-color:#000;">
    <div id="app" >
        <nav class="navbar navbar-default navbar-static-top  navbar-fixed-top" style="background-color:rgb(169, 238, 193); margin-bottom:0px;">
            <div class="container-fluid" style="border-color:#000;">
                <div class="navbar-header " style="border-color:#000;">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" style="border-color:#000;">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <ul class="nav navbar-nav navbar-left">
                      <li>
                        <a class="navbar-brand" href="{{ url('/') }}" style="padding:5px; width:500px;">
                          <table>
                            <tr>
                              <td><img class="img-circle" src="{{ asset('public/logotest.png') }}" width="40px"></td>
                              <td style="font-size:15px;">กลุ่มออมทรัพย์เพื่อการผลิตบ้านโนนน้อย</td>
                            </tr>
                          </table>
                        </a>
                      </li>
                    </ul>

                    @if (Auth::guest())
                    <!-- <li><a href="{{ url('/home') }}">Home</a></li> -->
                    @else

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
                              <a href="{{ url('/home') }}">
                                <img  class="img-circle" style="{{ Auth::user()->filter }}" src="{{ asset(''.Auth::user()->avatar) }}" width="22px">
                                {{ Auth::user()->name }}
                              </a>
                            </li>
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
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="100%"> \
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
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="100%"> \
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
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="100%"> \
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
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="100%"> \
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
                                                      <img class="img-circle" style="'+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" alt="" width="100%"> \
                                                    </div>';
                                        htmlstr += '<div class="col-md-9">  \
                                                      <b>'+datacommet[i].name+'</b><span for="" style="color:#000;"> <u>have reply question</u> in your Question and Answer </span><br> \
                                                      <span for="" style="color:#000; opacity:0.5; font-size:12px;">'+datacommet[i].created_at+'</span> \
                                                    </div> \
                                                    <div class="col-md-1"> \
                                                      <i style="color:#d92ea9;" class="glyphicon glyphicon-comment"></i> \
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
    <script src="/js/app.js"></script>
    <script type="text/javascript">

      function searchShow() {
        $('#ShowBarSearch').click();
      }
    </script>
    <div class="" style="height:20px;">

    </div>
    <!--|||||||||||||||||||||||||||||||||||||||||||||| left manubar |||||||||||||||||||||||||||||||||||||||||| -->
   <table style="width:100%" >
    <tr>
      <td >
        <div><p>
        <a class="btnMenulife" href="{{ url("user") }}/'+datacommet[i].user_id+'">
        <img  class="img-circle" style="border-color:#000; '+datacommet[i].filter+'" src="'+datacommet[i].avatar+'" width="40px">&nbsp;&nbsp;
        </a>'+
        <a class="btnMenulife" href="{{ url("user") }}/'+datacommet[i].user_id+'">
        <span style="color:#000;">
          datacommet[i].name
        </span>
        </a> :
        </p></div>
      </td>
    </tr>
</body>
</html>
