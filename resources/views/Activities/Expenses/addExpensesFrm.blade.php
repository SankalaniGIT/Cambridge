<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Expense Type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postAddNewExpense')}}">
                        {{ csrf_field() }}
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-12 col-sm-12 col-xs-12" style="float: left">
                                <div class="form-group">
                                    <label for="date" class="col-md-9 control-label">Date</label>

                                    <div class="col-md-3">
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
                                <div class=" form-group{{ $errors->has('Nexp') ? ' has-error' : '' }}">
                                    <label for="Nexp" class="col-md-4 control-label">New Expense</label>

                                    <div class="col-md-8">
                                            <input type="text" class="form-control" name="Nexp"
                                                   value="{{ old('Nexp') }}" autofocus required>
                                        @if ($errors->has('Nexp'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('Nexp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>

                        </div>
                        <br>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
