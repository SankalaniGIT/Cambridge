@extends('layouts.Home.homelayout')

@section('title','Cambridge School | Pay Fees')

@section('plugins')
    <link href="{{asset('/css/msg.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/forms.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/studentUpdate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/ckBox.css') }}" rel="stylesheet" type="text/css">
    @include('plugins.main')

@stop

@section('slideShow')
@stop

@section('nav')
    @include('home.navbar')
@stop

@section('content')
    @include('auth.logout')
    @include('Activities.Revenue.payFeesfrm')
    @include('MsgBoxes.msg')
@stop

@section('script')
    @include('MsgBoxes.msgScript')
    @include('home.scripts')
    @include('plugins.autoComplete')
    {{--<script type="text/javascript" src="{{asset('/js/getAddno.js')}}"></script>--}}
    <script>
        $(document).ready(function () {


            $src1 = '{{ route('getAddNo') }}';

            $("#adNo").autocomplete({
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

            });//type "nc.." or "bc.." and press enter to get last entered admission no


            $("#ui-id-1").on("click", "li", function () {
                var data = $(this).text();
                var arr = data.split('--');
                setTimeout(set, 100, arr[1]);
            });//split admission no from name--adNo

            function set($x) {
                $('#adNo').val($x);
            }//set admission no

        });

    </script>
@stop