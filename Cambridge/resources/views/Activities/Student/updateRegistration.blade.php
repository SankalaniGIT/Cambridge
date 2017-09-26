@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Update Student Details')

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
    @include('Activities.Student.updateRegistrationForm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
@include('plugins.autoComplete')
    <script src="{{asset('/js/studentManagement.js')}}" type="text/javascript"></script>{{--add grade and class--}}

    <script>
        $(document).ready(function() {
            src1 = "{{ route('searchAdno') }}";
            $("#adNo").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src1,
                        dataType: "json",
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 2,

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            src = "{{ route('searchName') }}";
            $("#First_name").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term : request.term,curry:$('#curriculum').val()
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 3,

            });

        });
    </script>

    <script src="{{asset('/js/fillUpdateStudents.js')}}" type="text/javascript"></script>{{--fill selected details--}}
@stop