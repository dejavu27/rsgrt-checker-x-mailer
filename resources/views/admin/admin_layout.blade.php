<!DOCTYPE html>
    <html>
    <head>
        <title>RSGRT | The Mailer X Checker</title>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta property="fb:app_id" content="1820924578141961" />
        <meta property="og:url" content="http://dejavu-ccbin.com/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="RSGRT | The Mailer" />
        <meta property="og:image" content="http://i.imgur.com/V0lk92F.jpg" />
        <meta property="og:description" content="A free email creator & checkers. Just use it wisely!" />
        <meta property="profile:first_name" content="PHDejavu27(iNew Works)" />
        <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
    <div class="wrapper">

        {{-- Headers --}}
        @include('admin.admin_header')
        {{-- Sidebar --}}
        @include('admin.admin_sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('admin.admin_footer')

    </div>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#pending_users').DataTable();
            $('a[href="#collapseOne"]').click(function(){
                $('#collapseTwo').collapse('hide');
            });
            $('a[href="#collapseTwo"]').click(function(){
                $('#collapseOne').collapse('hide');
            });
        } );
    </script>
    <script type="text/javascript" src="//go.pub2srv.com/apu.php?zoneid=816222"></script>
    <script async="async" type="text/javascript" src="//go.mobisla.com/notice.php?p=816220&interactive=1&pushup=1"></script>
    </body>
</html>