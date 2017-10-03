<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pay Student Fees</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postPayFee')}}">
                        {{ csrf_field() }}

                        <div class="row">

                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <br>
                                <div class="row">
                                    <div class=" form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                        <label for="adNos" class="col-md-4 control-label">Admission No</label>

                                        <div class="col-md-8">
                                            <div class="input-group margin-bottom-sm">
                                            <span id="adclick" class="input-group-addon"><i
                                                        class="fa fa-search"></i></span>
                                                {!! Form::text('search_text', null,array('placeholder' =>'Search No','name'=>'adNo','autofocus','class' => 'form-control','id'=>'adNo')) !!}
                                            </div>
                                            @if ($errors->has('admission_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('admission_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Student Name</label>

                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ old('name') }}" autofocus readonly>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                                        <label for="class" class="col-md-4 control-label">Class</label>

                                        <div class="col-md-8">
                                            <input id="class" type="text" class="form-control" name="class"
                                                   value="{{ old('class') }}" autofocus readonly>

                                            @if ($errors->has('class'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('class') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('OutStandingAmt') ? ' has-error' : '' }}">
                                        <label for="OutStandingAmt" class="col-md-4 control-label">OutStanding
                                            Amount</label>

                                        <div class="col-md-8">
                                            <input id="OutStandingAmt" type="number" class="form-control"
                                                   name="OutStandingAmt"
                                                   value="{{ old('OutStandingAmt') }}" autofocus readonly>

                                            @if ($errors->has('OutStandingAmt'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('OutStandingAmt') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                        <label for="year" class="col-md-4 control-label">Year</label>

                                        <div class="col-md-8">
                                            <input id="year" type="number" class="form-control"
                                                   name="year"
                                                   value="<?php echo date('Y');?>" autofocus>

                                            @if ($errors->has('year'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>{{--close first column--}}

                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="col-md-6 form-group">

                                    <div class="col-md-6">
                                        <div class="input-group  margin-bottom-sm">
                                            <table class="table table-header-rotated">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="rotate">
                                                        <div><span>1st Payment</span></div>
                                                    </th>
                                                    <th class="rotate">
                                                        <div><span>2nd Payment</span></div>
                                                    </th>
                                                    <th class="rotate">
                                                        <div><span>3rd Payment</span></div>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th class="row-header">1<sup>st</sup> term
                                                    </th>
                                                    <td>
                                                        <label for="T1-p1"></label>
                                                        <input name="T1-p1" type="checkbox" id="T1-p1" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                    <td>
                                                        <label for="T1-p2"></label>
                                                        <input name="T1-p2" type="checkbox" id="T1-p2" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                    <td>
                                                        <label for="T1-p3"></label>
                                                        <input name="T1-p3" type="checkbox" id="T1-p3" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="row-header">
                                                        2<sup>nd</sup> term
                                                    </th>
                                                    <td>
                                                        <label for="T2-p1"></label>
                                                        <input name="T2-p1" type="checkbox" id="T2-p1" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                    <td>
                                                        <label for="T2-p2"></label>
                                                        <input name="T2-p2" type="checkbox" id="T2-p2" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                    <td>
                                                        <label for="T2-p3"></label>
                                                        <input name="T2-p3" type="checkbox" id="T2-p3" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="row-header">
                                                        3<sup>rd</sup> term
                                                    </th>
                                                    <td>
                                                        <label for="T3-p1"></label>
                                                        <input name="T3-p1" type="checkbox" id="T3-p1" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                    <td>
                                                        <label for="T3-p2"></label>
                                                        <input name="T3-p2" type="checkbox" id="T3-p2" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                    <td>
                                                        <label for="T3-p3"></label>
                                                        <input name="T3-p3" type="checkbox" id="T3-p3" value="0" onclick="$(this).val(this.checked ? 1 : 0);" readonly>
                                                        <div class="ck"></div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>{{--close second column--}}
                        </div>
                        <hr>
                        <div class="row">

                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="row">

                                    <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
                                        <label for="term" class="col-md-3 control-label">Term</label>

                                        <div class="col-md-8">
                                            <select id="term" type="text" class="form-control" name="term"
                                                    value="{{ old('term') }}"  autofocus>
                                                <option value="">Term</option>
                                            </select>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class="row">

                                    <div class="form-group{{ $errors->has('P_method') ? ' has-error' : '' }}">
                                        <label for="P_method" class="col-md-3 control-label">Payment Method</label>

                                        <div class="col-md-8">
                                            <select id="P_method" type="text" class="form-control" name="P_method"
                                                    value="{{ old('P_method') }}"  autofocus>
                                                <option class="payment" value="">Payment Method</option>
                                                <option class="payment" value="1">1st Payment</option>
                                                <option class="payment" value="2">2nd Payment</option>
                                                <option class="payment" value="3">3rd Payment</option>
                                                <option class="payment" value="4">Full Payment</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class=" col-md-4 col-sm-12 col-xs-12">
                                <div class="row">

                                    <div class="form-group{{ $errors->has('Tfee') ? ' has-error' : '' }}">
                                        <label for="Tfee" class="col-md-3 control-label">Term Fees</label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="TfeeInv" type="text" placeholder="Invoice No"
                                                       class="form-control" name="TfeeInv"
                                                       value="{{ old('TfeeInv') }}" autofocus readonly>
                                                <input id="Tfee" type="text" placeholder="Term Fees"
                                                       class="form-control" name="Tfee"
                                                       value="{{ old('Tfee') }}" autofocus readonly>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class=" col-md-4 col-sm-12 col-xs-12" id="exid">
                                <div class="row">

                                    <div class="form-group{{ $errors->has('Efee') ? ' has-error' : '' }}">
                                        <label for="Efee" class="col-md-3 control-label">Exam Fees</label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="EfeeInv" type="text" placeholder="Invoice No"
                                                       class="form-control" name="EfeeInv"
                                                       value="{{ old('EfeeInv') }}" readonly autofocus>
                                                <input id="Efee" type="text" placeholder="Exam Fees"
                                                       class="form-control" name="Efee"
                                                       value="{{ old('Efee') }}" readonly autofocus>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=" col-md-4 col-sm-12 col-xs-12" id="extraid">
                                <div class="row">

                                    <div class="form-group{{ $errors->has('ExCfee') ? ' has-error' : '' }}">
                                        <label for="ExCfee" class="col-md-3 control-label">Extra Curricular Fees</label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="ExCfeeInv" type="text" placeholder="Invoice No"
                                                       class="form-control" name="ExCfeeInv"
                                                       value="{{ old('ExCfeeInv') }}" readonly autofocus>
                                                <input id="ExCfee" type="text" placeholder="Extra Curricular Fees"
                                                       class="form-control" name="ExCfee"
                                                       value="{{ old('ExCfee') }}" readonly autofocus>
                                            </div>
                                        </div>
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