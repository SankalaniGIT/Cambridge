@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Term Payment List')

@section('plugins')
    <link href="{{asset('/css/viewPayFee.css') }}" rel="stylesheet" type="text/css">
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
    @include('Activities.Reports.printTermFeeRptFrm')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/viewPayFee.js')}}" type="text/javascript"></script>
@stop