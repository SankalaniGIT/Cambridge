@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Add New Expense')

@section('plugins')
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
    @include('Activities.Expenses.addExpensesFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
@stop