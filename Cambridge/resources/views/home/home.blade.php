@extends('layouts.Home.homelayout')

@section('title','Cambridge School')

@section('plugins')
    @include('plugins.main')
@stop

@section('slideShow')
    @include('home.slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('home.content')
@stop


@section('script')
    @include('home.scripts')
@stop
