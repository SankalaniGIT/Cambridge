@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Add Courses To A Student')

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
    @include('Activities.Courses.billCourseFrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
    @include('plugins.autoComplete')
    <script>
        $(document).ready(function () {

            $src1 = '{{ route('getCosAddNo') }}';

            $("#cosAdNo").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: $src1,
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 2,

            });//type "cs.." and press enter to get last entered admission no


            $("#ui-id-1").on("click", "li", function () {
                var data = $(this).text();
                var arr = data.split('--');
                setTimeout(set, 100, arr);
            });//split from state-- name--CosAdNo

            function set($x) {
                $('#cosAdNo').val($x[2]);
                $('#name').val($x[1]);
                $('#state').val($x[0]);
                if ($x[0] == 1) {
                    $('#state').prop('checked', true);
                    $('#border').css('border', '');
                    $('.err').addClass('hidden');
                }
                else if ($x[0] == 0) {
                    $('#state').prop('checked', false);
                    $('#border').css('border', 'double');
                    $('.err').removeClass('hidden');
                }
            }//set course admission no,name,state,error

        });

    </script>{{--get admission no to add courses--}}


@stop