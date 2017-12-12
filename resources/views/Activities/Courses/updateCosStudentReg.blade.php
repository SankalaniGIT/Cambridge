@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Update Course Students Registration')

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
    @include('Activities.Courses.updateCosStudentRegFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
    @include('plugins.autoComplete')
    <script>
        $(document).ready(function() {
            src1 = "{{ route('searchCosAdno') }}";
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
            $("#ui-id-1").on("click", "li", function () {
                var data = $(this).text();
                var arr = data.split('--');
                setTimeout(set, 100, arr);
            });//split from state-- name--CosAdNo

            function set($x) {
                $('#adNo').val($x[2]);
            }
        });


    </script>
    <script src="{{asset('/js/fillUpdateCosStu.js')}}" type="text/javascript"></script>{{--fill selected details--}}
@stop