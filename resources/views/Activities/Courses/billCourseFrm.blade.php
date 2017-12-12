<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bill A Course</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postBillCourse')}}">
                        {{ csrf_field() }}
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="date" class="col-md-4 control-label">Date</label>

                                <div class="col-md-6">
                                    <input id="date" type="text" class="form-control" name="date"
                                           value="<?php echo $mytime->toDateString();?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="CosInv" class="col-md-6 control-label">Invoice No</label>

                                <div class="col-md-6">
                                    <input id="CosInv" type="text" class="form-control" name="CosInv"
                                           value="{{$inv}}"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12 ">
                                <div class="form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                    <label for="cosAdNo" class="col-md-4 control-label">Admission No</label>

                                    <div class="col-md-8">
                                        <div class="input-group margin-bottom-sm">
                                            <span id="adclicks" class="input-group-addon"><i
                                                        class="fa fa-search"></i></span>
                                            {!! Form::text('search_text', null,array('placeholder' =>'Search No','name'=>'cosAdNo','autofocus','required','class' => 'form-control','id'=>'cosAdNo')) !!}

                                        </div>
                                        @if ($errors->has('cosAdNo'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('cosAdNo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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
                        <br class="err hidden">
                        <div class="row form-headers center-block" id="border"
                             style="padding: 10px;font-weight: bold">
                            <label class="err hidden" style="color: red">This Student already left in Courses!!!</label>
                        </div>
                        <br class="err hidden">
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group">
                                    <label for="course" class="col-md-4 control-label">Courses</label>

                                    <div class="col-md-8">
                                        <select id="course" type="text" class="form-control" name="course"
                                                value="{{old('course')}}" required
                                                autofocus>
                                            @foreach($courses as $cos)
                                                <option value="{{ $cos->course_id }}">{{ $cos->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group">
                                    <label for="month" class="col-md-3 control-label">Month</label>

                                    <div class="col-md-8">
                                        <select id="month" type="text" class="form-control" name="month"
                                                value="{{old('month')}}" required
                                                autofocus>
                                            <option value="JAN">JAN</option>
                                            <option value="FEB">FEB</option>
                                            <option value="MAR">MAR</option>
                                            <option value="APR">APR</option>
                                            <option value="MAY">MAY</option>
                                            <option value="JUN">JUN</option>
                                            <option value="JUL">JUL</option>
                                            <option value="AUG">AUG</option>
                                            <option value="SEP">SEP</option>
                                            <option value="OCT">OCT</option>
                                            <option value="NOV">NOV</option>
                                            <option value="DEC">DEC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="fee" class="col-md-4 control-label">Fee Amount</label>

                                <div class="col-md-5">
                                    <input id="fee" type="number" class="form-control" name="fee"
                                           value="{{old('fee')}}"
                                            required>
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