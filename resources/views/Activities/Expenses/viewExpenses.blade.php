@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Expenses List')

@section('plugins')
    <link href="{{asset('/css/viewExpenses.css') }}" rel="stylesheet" type="text/css">
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
    @include('Activities.Expenses.viewExpensesFrm')
@stop

@section('script')
    @include('home.scripts')
    <script src="{{asset('/js/viewExpenses.js')}}" type="text/javascript"></script>
@stop