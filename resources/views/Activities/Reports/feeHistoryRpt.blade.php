@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Fees History List')

@section('plugins')
    <link href="{{asset('/css/viewFeeHistory.css') }}" rel="stylesheet" type="text/css">
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
    @include('Activities.Reports.feeHistoryRptFrm')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/viewFeeHistory.js')}}" type="text/javascript"></script>
@stop