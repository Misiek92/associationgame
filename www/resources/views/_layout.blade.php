<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Gra skojarzeń</title>
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap.sandstone.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div class='side'><span class='glyphicon glyphicon-home'></span></div>
        <div class='content'>
            @yield('content')
        </div>

        <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/script.js"></script>
    </body>
</html>