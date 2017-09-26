<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pay Expenses</div>
                <div class="panel-body">


                        {{ csrf_field() }}
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group">
                                    <label for="ExType" class="col-md-3 control-label">Expense Type</label>

                                    <div class="col-md-8">
                                        <select id="ExType" type="text" class="form-control" name="ExType"
                                                value="{{old('ExType')}}" required
                                                autofocus>
                                            @foreach($expenses as $exp)
                                                <option value="{{ $exp->expense_m_id }}">{{ $exp->expense_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
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

                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group{{ $errors->has('SenderName') ? ' has-error' : '' }}">
                                    <label for="SenderName" class="col-md-3 control-label">Sender Name</label>

                                    <div class="col-md-8">
                                        <input id="SenderName" type="text" class="form-control"
                                               name="SenderName" value="{{ old('SenderName') }}" autofocus >
                                        @if ($errors->has('SenderName'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('SenderName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{ $errors->has('ReceiverName') ? ' has-error' : '' }}">
                                    <label for="ReceiverName" class="col-md-3 control-label">Receiver Name</label>

                                    <div class="col-md-8">
                                        <input id="ReceiverName" type="text" class="form-control"
                                               name="ReceiverName" value="{{ old('ReceiverName') }}" autofocus >
                                        @if ($errors->has('ReceiverName'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('ReceiverName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-3 control-label">Description</label>

                                    <div class="col-md-8">
                                        <textarea id="description" type="text" class="form-control"
                                                  name="description" autofocus>{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="amount" class="col-md-3 control-label">Amount</label>

                                    <div class="col-md-8">
                                        <input id="amount" type="number" class="form-control"
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
                    <br>
                        <div class="row" style="display: flex;flex-direction: row;justify-content: center;">

                            <div class="col-md-12 form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary" id="btnPayAdd">
                                       Add
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>

                <form class="form-horizontal hidden" role="form" method="POST"
                      action="{{route('postPayExpenses')}}">
                    {{ csrf_field() }}
                    <br>
                    <div class="row">
                        <div class=" col-md-6 col-sm-12 col-xs-12">
                            <div class=" form-group{{ $errors->has('invNo') ? ' has-error' : '' }}">
                                <label for="invNo" class="col-md-3 control-label">Invoice No</label>

                                <div class="col-md-4">
                                    <input id="invNo" type="text" class="form-control"
                                           name="invNo" value="{{ $invNo }}" autofocus readonly>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-sm-12 col-xs-12">
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
                    <div class="row">
                        <div class=" col-md-6 col-sm-12 col-xs-12">
                            <div class=" form-group{{ $errors->has('Sname') ? ' has-error' : '' }}">
                                <label for="Sname" class="col-md-3 control-label">Sender name</label>

                                <div class="col-md-8">
                                    <input id="Sname" type="text" class="form-control"
                                           name="Sname" value="{{ old('Sname') }}" autofocus readonly>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="Rname" class="col-md-4 control-label">Receiver Name</label>

                                <div class="col-md-7">
                                    <input id="Rname" type="text" class="form-control"
                                           name="Rname" value="{{ old('Rname') }}" autofocus readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="stationaryTbl">
                        <table class="table table-condensed" cellspacing="0" width="90%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Expense Type</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tblbody">

                            </tbody>
                        </table>
                    </div>
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