<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pay Admission & Refund</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postAdmissionRef')}}">
                        {{ csrf_field() }}
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group">
                                    <label for="InvNo" class="col-md-3 control-label">Invoice No</label>

                                    <div class="col-md-5">
                                        <input id="InvNo" type="text" class="form-control"
                                               name="InvNo" value="{{$AddInv}}" readonly>

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
                        <br>
                        <div class="row">
                            <div class=" col-md-4 col-sm-12 col-xs-12">
                                <div class=" form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                    <label for="adNos" class="col-md-4 control-label">Admission No</label>

                                    <div class="col-md-8">
                                        <div class="input-group margin-bottom-sm">
                                            <span id="adclick" class="input-group-addon"><i
                                                        class="fa fa-search"></i></span>
                                            {!! Form::text('search_text', null,array('placeholder' =>'Search No','name'=>'adNo','autofocus','class' => 'form-control','id'=>'adNo')) !!}

                                        </div>
                                        @if ($errors->has('adNo'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('adNo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4 col-sm-12 col-xs-12" id="partPaymentid">
                                <div class="form-group">
                                    <label for="Payment_Type" class="col-md-4 control-label">Payment Type</label>

                                    <div class="col-md-8">
                                        <select id="Payment_Type" type="text" class="form-control" name="Payment_Type"
                                                value="{{old('Payment_Type')}}" required
                                                autofocus>
                                            <option value="Full" selected>Full Payment</option>
                                            <option value="Part">Part Payment</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="category" class="col-md-4 control-label">Category</label>

                                    <div class="col-md-8">
                                        <select id="category" type="text" class="form-control" name="category"
                                                value="{{old('category')}}" required
                                                autofocus>
                                            <option value="Admission Fee" selected>Admission Fee</option>
                                            <option value="Refundable Deposit">Refundable Deposit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-headers center-block" id="border"
                             style="padding: 10px;font-weight: bold">

                            <label id="admissionErr" class="hidden" style="color: red">Admission Fee already
                                paid!!!</label>
                            <label id="admission1stPartErr" class="hidden" style="color: red">Admission Fee 1st Part
                                already paid!!!</label>
                            <label id="refundErr" class="hidden" style="color: red">Refund already paid!!!</label>

                        </div>
                        <br>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-3 control-label">Name</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control"
                                               name="name" value="{{ old('name') }}" autofocus readonly>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                                    <label for="class" class="col-md-3 control-label">Class</label>

                                    <div class="col-md-8">
                                        <input id="class" type="text" class="form-control"
                                               name="class" value="{{ old('class') }}" autofocus readonly>
                                        @if ($errors->has('class'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('class') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="amount" class="col-md-3 control-label">Amount</label>

                                    <div class="col-md-8">
                                        <input id="amount" type="text" class="form-control"
                                               name="amount" value="{{ old('amount') }}" autofocus readonly>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                                    <label for="discount" class="col-md-3 control-label">Discount</label>

                                    <div class="col-md-8">
                                        <input id="discount" type="text" class="form-control"
                                               name="discount" value="{{ old('discount') }}" autofocus>
                                        @if ($errors->has('discount'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('discount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hidden" id="partRow">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group {{ $errors->has('1stPart') ? ' has-error' : '' }}">
                                    <label for="1stPart" class="col-md-3 control-label">1<sup>st</sup> Part
                                        Amount</label>

                                    <div class="col-md-8">
                                        <input id="1stPart" type="text" class="form-control"
                                               name="1stPart" value="{{ old('1stPart') }}" autofocus>
                                        @if ($errors->has('1stPart'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('1stPart') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group {{ $errors->has('2ndPart') ? ' has-error' : '' }}">
                                    <label for="2ndPart" class="col-md-3 control-label">2<sup>nd</sup> Part
                                        Amount</label>

                                    <div class="col-md-8">
                                        <input id="2ndPart" type="text" class="form-control"
                                               name="2ndPart" value="{{ old('2ndPart') }}" autofocus>
                                        @if ($errors->has('2ndPart'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('2ndPart') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: flex;flex-direction: row;justify-content: center;">

                            <div class="col-md-12 form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Pay Fees
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