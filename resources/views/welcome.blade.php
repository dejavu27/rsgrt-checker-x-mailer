<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>RSGRT | The Mailer x Checker</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="author" content="PH.Dejavu27(iNew Works)" /
        <meta property="fb:app_id" content="1820924578141961" />
        <meta property="og:url" content="http://rsgmailer.io/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="RSGRT | The Mailer X Checker" />
        <meta property="og:image" content="http://i.imgur.com/oNCHJrM.jpg" />
        <meta property="og:description" content="A free email creator & checkers. Just use it wisely!" />
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
        <meta name="propeller" content="051dc502d038335f6cd47151776925bf" />
        <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/plugins/iCheck/square/blue.css")}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue" style="background:#eee">
        @yield('content')
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    <script type="text/javascript" src="//go.pub2srv.com/apu.php?zoneid=816222"></script>
    <script async="async" type="text/javascript" src="//go.mobisla.com/notice.php?p=816220&interactive=1&pushup=1"></script>
    </body>
</html>