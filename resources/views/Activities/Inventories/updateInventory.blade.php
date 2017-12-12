@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Update Inventory Details')

@section('plugins')
    <link href="{{asset('/css/msg.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/forms.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/studentUpdate.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')
@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Inventories.updateInventoryFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
    @include('plugins.autoComplete')
    <script src="{{asset('/js/fillInventory.js') }}" type="text/javascript"></script>
@stop