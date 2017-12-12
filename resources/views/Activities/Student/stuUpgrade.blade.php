@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Upgrade All Students')

@section('plugins')
    <link href="{{asset('/css/charges.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/msg.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/forms.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/upgrade.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')
@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Student.stuUpgradeFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('home.scripts')
    @include('MsgBoxes.msgScript')
    <script src="{{asset('/js/studentUpgrade.js')}}" type="text/javascript"></script>
@stop