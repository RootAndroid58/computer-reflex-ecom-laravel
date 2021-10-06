<!-- all js here -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script src="{{ asset('js/zoomsl.min.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('js/star-rating.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('js/tag-it.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('SB-Admin/js/bs-init.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('SB-Admin/js/chart.min.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('bootstrap-toaster/js/bootstrap-toaster.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('ezone/js/owl.carousel.min.js')}}?{{ $assetVer }}"></script>
{{-- <script src="{{ asset('js/cropper.js')}}?{{ $assetVer }}"></script> --}}
<script src="{{ asset('ezone/js/popper.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('ezone/js/plugins.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('SB-Admin/js/theme.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('ezone/js/main.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('js/lazyLoadInit.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('js/main.js')}}?{{ $assetVer }}"></script>
<script src="{{ asset('js/broadcast-listner.js')}}?{{ $assetVer }}"></script>
@stack('scripts')