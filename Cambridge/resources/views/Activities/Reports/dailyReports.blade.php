@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Daily Report')

@section('plugins')
    <link href="{{asset('/css/charges.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/msg.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/forms.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')
@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Reports.dailyReportFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('home.scripts')
    @include('MsgBoxes.msgScript')
    <script src="{{asset('/js/dailyReport.js')}}" type="text/javascript"></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@stop