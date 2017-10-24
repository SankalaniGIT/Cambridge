<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Register School Students in Courses</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postAddSclStu')}}">
                        {{ csrf_field() }}

                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12 ">
                                <div class="form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                    <label for="cosAdNo" class="col-md-4 control-label">Admission No</label>

                                    <div class="col-md-5">
                                        <input id="cosAdNo" type="text" class="form-control" readonly name="cosAdNo"
                                               value="{{ $adNo }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-md-6" style="float: left">
                                <div class="form-group">
                                    <label for="date" class="col-md-5 control-label">Date</label>

                                    <div class="col-md-5">
                                        <input id="date" type="text" class="form-control"
                                               name="date" value="<?php echo $mytime->toDateString();?>" readonly
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class=" col-md-8 col-sm-12 col-xs-12">
                                <div class=" form-group{{ $errors->has('adNo') ? ' has-error' : '' }}">
                                    <label for="adNos" class="col-md-4 control-label">School Admission No</label>

                                    <div class="col-md-8">
                                        <div class="input-group margin-bottom-sm">
                                            <span id="adclick" class="input-group-addon"><i
                                                        class="fa fa-search"></i></span>
                                            {!! Form::text('search_text', null,array('placeholder' =>'Search No','name'=>'adNo','autofocus','required','class' => 'form-control','id'=>'adNo')) !!}

                                        </div>
                                        @if ($errors->has('adNo'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('adNo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class=" form-group">
                                    <label for="state" class="col-md-5 control-label">State</label>

                                    <div class="col-md-6">
                                        <input id="state" type="checkbox" class="form-control" name="state"
                                               onclick="$(this).val(this.checked ? 1 : 0);"
                                               value="1" style=" width: 30px; height: 30px;padding: 0; margin: 0;
                                           vertical-align: bottom; position: relative;top: -1px;" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="display: flex;flex-direction: row;justify-content: center;">

                            <div class="col-md-12 form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
