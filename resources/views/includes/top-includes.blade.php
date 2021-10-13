<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="session-id" content="{{ Session::getId() }}">

@if (Auth::check())
<meta name="user-id" content="{{ Auth()->user()->id ?? '' }}">
@endif

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-STJZ4CTNF7"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-STJZ4CTNF7');
</script>


<!-- all css here -->
<link rel="stylesheet" href="{{ asset('SB-Admin/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}?{{ $assetVer }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('ezone/css/animate.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/themify-icons.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/pe-icon-7-stroke.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('bootstrap-toaster/css/bootstrap-toaster.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/owl.carousel.min.css')}}?{{ $assetVer }}">

<link rel="stylesheet" href="{{ asset('css/jquery.tagit.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('css/tagit.ui-zendesk.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('css/star-rating.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/icofont.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/meanmenu.min.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/bundle.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/style.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('ezone/css/responsive.css')}}?{{ $assetVer }}">
<link rel="stylesheet" href="{{ asset('css/collapse-bs4.css')}}?{{ $assetVer }}">

@if (isMobile())
<link rel="stylesheet" href="{{ asset('css/mobile.css')}}?{{ $assetVer }}">
@endif

<link rel="stylesheet" href="{{ asset('css/custom.css')}}?{{ $assetVer }}">
<script src="{{ asset('ezone/js/vendor/modernizr-2.8.3.min.js')}}?{{ $assetVer }}"></script>

@livewireStyles
@livewireScripts

<script src="{{ asset('js/app.js')}}?{{ $assetVer }}"></script>
    
@stack('styles') 
