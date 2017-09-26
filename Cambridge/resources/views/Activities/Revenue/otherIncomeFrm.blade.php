<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Other Incomes</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postOtherIncome')}}">
                        {{ csrf_field() }}
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12" style="float: right">
                                <div class="form-group">
                                    <label for="date" class="col-md-7 control-label">Date</label>

                                    <div class="col-md-4">
                                        <input id="date" type="text" class="form-control"
                                               name="date" value="<?php echo $mytime->toDateString();?>" readonly
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
<hr>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type" class="col-md-3 control-label">Type</label>

                                    <div class="col-md-8">
                                        <input id="type" type="text" class="form-control"
                                               name="type" value="{{ old('type') }}" autofocus>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="amount" class="col-md-3 control-label">Amount</label>

                                    <div class="col-md-8">
                                        <input id="amount" type="text" class="form-control"
                                               name="amount" value="{{ old('amount') }}" autofocus>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="display: flex;flex-direction: row;justify-content: center;">

                            <div class="col-md-12 form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
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
