@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Stationary Invoice')

@section('plugins')
    <link href="{{asset('/css/forms.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/stationaryInv.css') }}" rel="stylesheet" type="text/css" media="print">
    @include('plugins.main')

@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('Invoice.numberFormat')
    @include('Invoice.stationaryInvFrm')
@stop

@section('script')
    @include('home.scripts')
@stop