<html>
<head>
    <title>@yield('title')</title>

</head>
<link href="{{asset('/css/all.css') }}" rel="stylesheet" type="text/css">

@section('plugins')

@show
<body>


<div id="wrapper">
    <div class="overlay"></div>
    <div class="slideshow">
        @section('slideShow')

        @show
    </div>
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        @section('nav')

        @show
    </nav>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        @section('content')

        @show
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->


@section('script')

@show
</body>
</html>


