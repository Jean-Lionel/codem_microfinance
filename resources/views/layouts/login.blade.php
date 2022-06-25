<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', BASE_NAME ) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="/css/bootstrap.min.css">


    <style>
        body{
           
            background: rgba(255,255,255,0.2);
        }
        .main-content{
            position: absolute;
            top: 50%;
            left: 50%;
            background-image: url(/logo/logo.png);
            transform: translate(-50%,-50%);

            width: 100%;
        }

        .special-card {
/* create a custom class so you 
   do not run into specificity issues 
   against bootstraps styles
   which tends to work better than using !important 
   (future you will thank you later)*/

background-color: #073c84;
color: white;

border: 2px solid white;
border-radius: 10px;

}

.special-card input{
    opacity: 1;

   
}

 </style>
</head>
<body>
    <div id="app">
      
    <main class="py-4 main-content">
        @yield('content')
    </main>
</div>


</body>
</html>
