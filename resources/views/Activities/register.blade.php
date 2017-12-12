@extends('layouts.Home.homelayout')

@section('title','Cambridge School | User Registration')

@section('plugins')
    <link href="{{asset('/css/user.css')}}" rel="stylesheet" type="text/css">
    {{--@include('plugins.main')--}}
@stop

@section('slideShow')

@stop


@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('auth.register')
@stop


@section('script')
    {{--@include('home.scripts')--}}
@stop

