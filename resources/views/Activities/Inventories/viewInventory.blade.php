@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Inventory Details')

@section('plugins')
    <link href="{{asset('/css/viewInventory.css') }}" rel="stylesheet" type="text/css">
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
    @include('Activities.Inventories.viewInventoryFrm')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/viewInventory.js')}}" type="text/javascript"></script>
@stop