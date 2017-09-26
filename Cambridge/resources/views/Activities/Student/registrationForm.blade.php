<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Student Registration Form</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postStudentRegistration')}}">
                        {{ csrf_field() }}

                        <div class="row center-block">
                            <?php
                            $mytime = Carbon\Carbon::now();
                            ?>

                            <div class="col-md-4 form-group">
                                <label for="date" class="col-md-4 control-label">Date</label>

                                <div class="col-md-8">
                                    <input id="date" type="text" class="form-control" name="date"
                                           value="<?php echo $mytime->toDateString();?>"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="curriculum" class="col-md-4 control-label">Curriculum</label>

                                <div class="col-md-8">
                                    <select id="curriculum" type="text" class="form-control" name="curriculum"
                                            value="{{old('curriculum')}}" required
                                            autofocus>
                                        <option value="nc" selected>NC</option>
                                        <option value="bc">BC</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4 form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-4 control-label">State</label>

                                <div class="col-md-8">
                                    <input id="state" type="checkbox" class="form-control" name="state"
                                           value="{{old('state')}}" style=" width: 30px; height: 30px;padding: 0; margin: 0;
                                           vertical-align: bottom; position: relative;top: -1px;" autofocus>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row center-block">

                            <div class="col-md-4 form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                <label for="adNo" class="col-md-4 control-label">Admission No</label>

                                <div class="col-md-8">
                                    <input id="adNoid" type="text" class="form-control" readonly name="adNo"
                                           value="{{ old('admission_no') }}" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                                <label for="grade" class="col-md-4 control-label">Grade</label>

                                <div class="col-md-8">
                                    <select id="grade" type="text" class="form-control" name="grade"
                                            value="{{ old('grade') }}" required autofocus>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                                <label for="class" class="col-md-4 control-label">Class</label>

                                <div class="col-md-8">
                                    <select id="class" type="text" class="form-control" name="class"
                                            value="{{ old('class') }}" required autofocus>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row center-block"
                             style="display: flex;flex-direction: row;justify-content: center;">

                            <div class="col-md-6 form-group{{ $errors->has('First_name') ? ' has-error' : '' }}">
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
                            <div class="col-md-6 form-group{{ $errors->has('Last_name') ? ' has-error' : '' }}">
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
                        <div class="row center-block">
                            <div class="col-md-6 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-8">
                                    <select id="gender" type="text" class="form-control" name="gender"
                                            value="{{ old('gender') }}" required autofocus>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('DOB') ? ' has-error' : '' }}">
                                <label for="DOB" class="col-md-4 control-label">Date of Birth</label>

                                <div class="col-md-8">
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
                        <br>
                        <div class="row form-headers center-block"
                             style=" border: double;padding: 10px;font-weight: bold">
                            PARENT'S DETAILS
                        </div>
                        <br>
                        <div class="row center-block">

                            <div class="col-md-4 form-group{{ $errors->has('Father_First_name') ? ' has-error' : '' }}">
                                <label for="Father_First_name" class="col-md-7 control-label">Father First name</label>

                                <div class="col-md-12">
                                    <input id="Father_First_name" type="text" class="form-control"
                                           name="Father_First_name"
                                           value="{{ old('Father_First_name') }}" autofocus>

                                    @if ($errors->has('Father_First_name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Father_First_name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('Father_Last_name') ? ' has-error' : '' }}">
                                <label for="Father_Last_name" class="col-md-7 control-label">Father Last Name</label>

                                <div class="col-md-12">
                                    <input id="Father_Last_name" type="text" class="form-control"
                                           name="Father_Last_name"
                                           value="{{ old('Father_Last_name') }}" autofocus>

                                    @if ($errors->has('Father_Last_name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Father_Last_name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('Father_tell') ? ' has-error' : '' }}">
                                <label for="Father_tell" class="col-md-7 control-label">Mobile No</label>

                                <div class="col-md-12">
                                    <input id="Father_tell" type="text" class="form-control" name="Father_tell"
                                           value="{{ old('Father_tell') }}" autofocus>

                                    @if ($errors->has('Father_tell'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Father_tell') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row center-block">

                            <div class="col-md-4 form-group{{ $errors->has('Mother_First_name') ? ' has-error' : '' }}">
                                <label for="Mother_First_name" class="col-md-7 control-label">Mother First name</label>

                                <div class="col-md-12">
                                    <input id="Mother_First_name" type="text" class="form-control"
                                           name="Mother_First_name"
                                           value="{{ old('Mother_First_name') }}" autofocus>

                                    @if ($errors->has('Mother_First_name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Mother_First_name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('mLname') ? ' has-error' : '' }}">
                                <label for="mLname" class="col-md-7 control-label">Mother Last Name</label>

                                <div class="col-md-12">
                                    <input id="mLname" type="text" class="form-control" name="mLname"
                                           value="{{ old('mLname') }}" autofocus>

                                    @if ($errors->has('mLname'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('mLname') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('Mother_tell') ? ' has-error' : '' }}">
                                <label for="Mother_tell" class="col-md-7 control-label">Mobile No</label>

                                <div class="col-md-12">
                                    <input id="Mother_tell" type="text" class="form-control" name="Mother_tell"
                                           value="{{ old('Mother_tell') }}" autofocus>

                                    @if ($errors->has('Mother_tell'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Mother_tell') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row center-block"
                             style="display: flex;flex-direction: row;justify-content: center;">
                            <div class="col-md-6 form-group{{ $errors->has('Tell') ? ' has-error' : '' }}">
                                <label for="Tell" class="col-md-7 control-label">Telephone No</label>

                                <div class="col-md-10">
                                    <input id="Tell" type="text" class="form-control" name="Tell"
                                           value="{{ old('Tell') }}" autofocus>

                                    @if ($errors->has('Tell'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Tell') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('Address') ? ' has-error' : '' }}">
                                <label for="Address" class="col-md-7 control-label">Address</label>

                                <div class="col-md-12">
                                    <textarea id="Address" type="text" class="form-control" name="Address"
                                              autofocus>{{ old('Address') }}</textarea>

                                    @if ($errors->has('Address'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                                    @endif
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
