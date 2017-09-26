<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Course Students Registration Form</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postCosStuReg')}}">
                        {{ csrf_field() }}

                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-4 col-sm-12 col-xs-12 ">
                                <div class="form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                    <label for="adNo" class="col-md-4 control-label">Admission No</label>

                                    <div class="col-md-8">
                                        <input id="adNoid" type="text" class="form-control" readonly name="adNo"
                                               value="{{ $adNo }}" required >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class=" form-group">
                                    <label for="state" class="col-md-5 control-label">State</label>

                                    <div class="col-md-6">
                                        <input id="state" type="checkbox" class="form-control" name="state" onclick="$(this).val(this.checked ? 1 : 0);"
                                               value="1" style=" width: 30px; height: 30px;padding: 0; margin: 0;
                                           vertical-align: bottom; position: relative;top: -1px;" checked >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label for="date" class="col-md-3 control-label">Date</label>

                                    <div class="col-md-8">
                                        <input id="date" type="text" class="form-control"
                                               name="date" value="<?php echo $mytime->toDateString();?>" readonly
                                        >
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('First_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="First_name" class="col-md-4 control-label">Student First Name</label>

                                    <div class="col-md-8">
                                        <input id="First_name" type="text" class="form-control" name="First_name"
                                               value="{{ old('First_name') }}" autofocus>

                                        @if ($errors->has('First_name'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('First_name') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('Last_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="Last_name" class="col-md-4 control-label">Student Last Name</label>

                                    <div class="col-md-8">
                                        <input id="Last_name" type="text" class="form-control" name="Last_name"
                                               value="{{ old('Last_name') }}" autofocus>

                                        @if ($errors->has('Last_name'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('Last_name') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-8">
                                    <select id="gender" type="text" class="form-control" name="gender"
                                            value="{{ old('gender') }}" required autofocus>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group{{ $errors->has('nic') ? ' has-error' : '' }}">
                                <label for="nic" class="col-md-4 control-label">NIC</label>

                                <div class="col-md-8">
                                    <input id="nic" type="text" class="form-control" name="nic"
                                           value="{{ old('nic') }}" autofocus>

                                    @if ($errors->has('nic'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group {{ $errors->has('DOB') ? ' has-error' : '' }}"
                                 style="right: -30px">
                                <label for="DOB" class="col-md-5 control-label">Date of Birth</label>

                                <div class="col-md-7">
                                    <input id="DOB" type="date" class="form-control" name="DOB"
                                           value="{{ old('DOB') }}" autofocus>

                                    @if ($errors->has('DOB'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('DOB') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('school') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="school" class="col-md-4 control-label">School</label>

                                    <div class="col-md-8">
                                        <input id="school" type="text" class="form-control" name="school"
                                               value="{{ old('school') }}" autofocus>

                                        @if ($errors->has('school'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('school') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="grade" class="col-md-4 control-label">Grade</label>

                                    <div class="col-md-8">
                                        <input id="grade" type="text" class="form-control" name="grade"
                                               value="{{ old('grade') }}" autofocus>

                                        @if ($errors->has('grade'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('grade') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="address" class="col-md-4 control-label">Address</label>

                                    <div class="col-md-8">
                                        <input id="address" type="text" class="form-control" name="address"
                                               value="{{ old('address') }}" autofocus>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="tel" class="col-md-4 control-label">Telephone No</label>

                                    <div class="col-md-8">
                                        <input id="tel" type="text" class="form-control" name="tel"
                                               value="{{ old('tel') }}" autofocus>

                                        @if ($errors->has('tel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tel') }}</strong>
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
