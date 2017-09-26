@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Pay Expenses')

@section('plugins')
    <link href="{{asset('/css/msg.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/forms.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/stationary.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/payExp.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')

@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Expenses.payExpensesFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
    <script type="text/javascript" src="{{asset('/js/fillExpenses.js')}}"></script>

    <script>
        function removebtn(val){
            var id= $(val).closest('tr').attr('id');
            $('#'+id).remove();
        }
    </script>{{--remove row when click remove btn--}}
@stop