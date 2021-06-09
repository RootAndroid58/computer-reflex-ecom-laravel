@if (isMobile())

    @include('mobile.index')

{{ die }}
@endif


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Computer Reflex - Online Shopping</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-STJZ4CTNF7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-STJZ4CTNF7');
    </script>

        @include('includes.top-includes')

        @livewireStyles
        @livewireScripts
</head>

<body>


    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- header start -->



    @livewire('basic-helper')
    
    <input type="hidden" name="toggle-compare-btn" value="{{ route('toggle-compare-btn') }}">
    









    @include('includes.bottom-includes')



</body>

</html>