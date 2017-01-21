<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap-social-gh-pages\bootstrap-social.css" rel="stylesheet" type="text/css">
    <link href="/bootstrap-3.3.7\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="/jquery-3.1.1.min.js"></script>
    <script src="\bootstrap-3.3.7\js\bootstrap.min.js"></script>
    <title>Managelife</title>
    <!-- Styles -->
    <link rel="stylesheet" href="/css/scrollbar.css">
    <link rel="stylesheet" href="/css/home.css">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/scrollbar.css">
    <script src="/jquery_from/jquery.form.js" type="text/javascript" ></script>


    <link rel="stylesheet" href="/popelt.css">
    <script src="/popelt-v1.0-source.js"></script>

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
      .btn-moile{
        text-decoration: none !important;
        transition: all 0.5s;
        padding: 10px;
        font-size:20px;
        color: #555;
      }
      .btn-moile:active{
        text-decoration: none !important;
        transition: all 0.5s;
        padding: 10px;
        font-size:20px;
        color: #fff;
      }
      </style>

    <!-- Scripts -->
    <script>
    //   window.Laravel = <?php echo json_encode([  'csrfToken' => csrf_token(),]); ?>
    </script>
</head>
<body style="background-color:#111; border-color:#000;">
    <nav class="navbar navbar-default navbar-static-top  navbar-fixed-top" style="background-color:#000; border-color:#000; margin-bottom:0px; padding-top:8px;">
      <table style="width:100%; text-align:center;" >
        <tr>
          <td>
            <a href="#" class="btn-moile"><i class="glyphicon glyphicon-list-alt"></i></a>
          </td>
          <td>
            <a href="#" class="btn-moile">
              <i class="glyphicon glyphicon-user"></i>
              <span class="alert-span" > 2 </span>
            </a>
          </td>
          <td>
            <a href="#" class="btn-moile">
              <i class="glyphicon glyphicon-bell"></i>
              <span class="alert-span" > 2 </span>
            </a>
          </td>
          <td>
            <a href="#" class="btn-moile"><i class="glyphicon glyphicon-folder-open"></i></a>
          </td>
          <td>
            <a href="#" class="btn-moile"><i class="glyphicon glyphicon-briefcase"></i></a>
          </td>
          <td>
            <a href="#" class="btn-moile"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
          </td>
          <td>
            <a href="#" class="btn-moile"><i class="glyphicon glyphicon-search"></i></a>
          </td>
        </tr>
      </table>
    </nav>
</body>
</html>
