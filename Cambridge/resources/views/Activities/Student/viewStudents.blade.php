@extends('layouts.Home.homelayout')

@section('title','Cambridge School | View All Students')

@section('plugins')
    <link href="{{asset('/css/viewStudentTbl.css') }}" rel="stylesheet" type="text/css">
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
    @include('Activities.Student.viewStudentstbl')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/insertStudent.js')}}" type="text/javascript"></script>
@stop