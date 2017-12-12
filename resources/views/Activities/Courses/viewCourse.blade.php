@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Course Student List')

@section('plugins')
    <link href="{{asset('/css/viewCourse.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')
    @include('plugins.printTable')
@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Courses.viewCourseFrm')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/viewCosStudent.js')}}" type="text/javascript"></script>
@stop