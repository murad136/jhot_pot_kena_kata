<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/styles/bootstrap4/bootstrap.min.css">
    <link href="{{asset('/')}}frontEnd/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontEnd/styles/responsive.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/toastr/toastr.css">
</head>

<body>
<div class="super_container">

    <!-- Header -->
    <header class="header">

        @include('frontEnd.include.header_top_bar')
        <!-- Header Main -->
        @include('frontEnd.include.second_header_bar')

        @include('frontEnd.include.3rd_headerWithCategories')
    </header>

    <!-- Banner -->


    @yield('body')

        @include('frontEnd.include.footer')
</div>
<script src="{{asset('/')}}frontEnd/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('/')}}frontEnd/styles/bootstrap4/popper.js"></script>
<script src="{{asset('/')}}frontEnd/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/greensock/TweenMax.min.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/slick-1.8.0/slick.js"></script>
<script src="{{asset('/')}}frontEnd/plugins/easing/easing.js"></script>
<script src="{{asset('/')}}frontEnd/js/custom.js"></script>

<script src="{{asset('/')}}frontEnd/js/product_custom.js"></script>

{{--toastr & sweet-alert design--}}
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you want to delete?",
            text: "Once Delete, This will be Permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });
</script>
{{-- before  logout showing alert message --}}
<script>
    $(document).on("click", "#logout", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you want to logout?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Not Logout!");
                }
            });
    });
</script>
<script>
    @if(Session::has('messege'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>
<script src="{{ asset('/')}}admin/plugins/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(function () {
        // Summernote
        $('.textarea').summernote()
    })
</script>
</body>
</html>
