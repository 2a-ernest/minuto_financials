<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{config('app.name','laravel')}}</title>
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('sweet-alert/sweet-alert.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="css/style.default.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" type="text/css" />
    <!-- <link rel="stylesheet" href="css/style.shinyblue.css" type="text/css" /> -->

    <script type="text/javascript" src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/angular.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/angular-resource.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/angular-ui-router.js')}}"></script>
    <!-- <script type="text/javascript" src="{{asset('js/jquery-migrate-1.1.1.min.js')}}"></script> -->
    <!-- <script type="text/javascript" src="{{asset('js/jquery-ui-1.9.2.min.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('sweet-alert/sweet-alert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('sweet-alert/sweet-alert.init.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/modernizr.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{asset('js/jquery.cookie.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/minuto-angular/app.js')}}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

  </head>
  <body>

    <div class="mainwrapper" ng-app='minuto'>

        @yield('content')
    </div>

  </body>
</html>
