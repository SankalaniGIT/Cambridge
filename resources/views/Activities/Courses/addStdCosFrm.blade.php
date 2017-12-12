<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add & Update Courses of a Student</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postAddStdCos')}}">
                        {{ csrf_field() }}
                        <div class="header" style="border: ridge;font-weight: 900">Add Courses >></div>
                        <br>
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
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
                        </div>
                        <br class="err hidden">
                        <div class="row form-headers center-block" id="border"
                             style="padding: 10px;font-weight: bold">

                            <label class="err hidden" style="color: red">This Student already left in Courses!!!</label>

                        </div>
                        <br  class="err hidden">
                        <div class="row">
                            <div class="col-md-10 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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

                            <div class=" col-md-2 col-sm-12 col-xs-12 hidden">
                                <div class=" form-group">
                                    <label for="state" class="col-md-6 control-label">Student Availability</label>

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
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr style="border: double">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postUpdateStdCos')}}">
                        {{ csrf_field() }}

                        <div class="header" style="border: ridge;font-weight: 900">Update Courses >></div>
                        <br>
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12 ">
                                <div class="form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                    <label for="cosAdNo2" class="col-md-4 control-label">Admission No</label>

                                    <div class="col-md-8">
                                        <div class="input-group margin-bottom-sm">
                                            <span id="adclick" class="input-group-addon"><i
                                                        class="fa fa-search"></i></span>
                                            {!! Form::text('search_text', null,array('placeholder' =>'Search No','name'=>'cosAdNo2','autofocus','required','class' => 'form-control','id'=>'cosAdNo2')) !!}

                                        </div>
                                        @if ($errors->has('cosAdNo2'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('cosAdNo2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12">
                                <div class=" form-group">
                                    <label for="course2" class="col-md-4 control-label">Courses</label>

                                    <div class="col-md-8">
                                        <select id="course2" type="text" class="form-control" name="course2"
                                                value="{{old('course2')}}" required
                                                autofocus>
                                            @foreach($courses as $cos)
                                                <option value="{{ $cos->course_id }}">{{ $cos->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br class="err2 hidden">
                        <div class="row form-headers text-center" id="border2"
                             style="padding: 10px;font-weight: bold">

                            <label class="err2 hidden" style="color: red">This Student already left!!!</label>
                            <br class="err3 hidden">
                            <label class="err3 hidden" style="color: red">This Student not added to this Courses!!!</label>

                        </div>
                        <br  class="err2 hidden">
                        <div class="row">
                            <div class="col-md-8 form-group{{ $errors->has('name2') ? ' has-error' : '' }}">
                                <label for="name2" class="col-md-4 control-label">Student Name</label>

                                <div class="col-md-8">
                                    <input id="name2" type="text" class="form-control" name="name2"
                                           value="{{ old('name2') }}" autofocus readonly>

                                    @if ($errors->has('name2'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name2') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class=" col-md-4 col-sm-12 col-xs-12" id="st">
                                <div class=" form-group">
                                    <label for="state2" class="col-md-6 control-label">Course Status</label>

                                    <div class="col-md-6">
                                        <input id="state2" type="checkbox" class="form-control" name="state2"
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
                                        Update
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
