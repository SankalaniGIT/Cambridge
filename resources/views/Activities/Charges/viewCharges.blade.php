@extends('layouts.Home.homelayout')

@section('title','Cambridge School | View All Charges')

@section('plugins')
    <link href="{{asset('/css/charges.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')
    @include('plugins.viewTable')
@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Charges.viewChargetbl')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/charges.js')}}" type="text/javascript"></script>
@stop