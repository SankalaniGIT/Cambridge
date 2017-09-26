<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Stationary</div>
                <div class="panel-body">

                    <div class="row">

                        <div class=" col-md-4 col-sm-12 col-xs-12">
                            <div class=" form-group{{ $errors->has('adNo') ? ' has-error' : '' }}">
                                <label for="adNo" class="col-md-3 control-label">Admission No</label>

                                <div class="col-md-9">
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
                        <div class=" col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="item" class="col-md-2 control-label">Item Name</label>

                                <div class="col-md-10">
                                    <select id="item" type="text" class="form-control" name="item"
                                            value="{{old('item')}}" required
                                            autofocus>
                                        @foreach($stationary as $st)
                                            <option value="{{ $st->st_id }}">{{ $st->st_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-3 col-sm-12 col-xs-12">
                            <div class=" form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-8">
                                    <input id="quantity" type="text" class="form-control"
                                           name="quantity" value="{{ old('quantity') }}" autofocus required>
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                                 <strong>{{ $errors->first('quantity') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-1 col-sm-12 col-xs-12">
                            <div class="col-md-1 form-group">
                                <div class="col-md-0 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary" id="btnAdd">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <form class="form-horizontal hidden" role="form" method="POST"
                      action="{{route('postStationary')}}">
                    {{ csrf_field() }}
                    <?php
                    $mytime = Carbon\Carbon::now();
                    ?>
                    <br>
                    <div class="row">
                        <div class=" col-md-4 col-sm-12 col-xs-12">
                            <div class=" form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Admission No</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="{{ old('name') }}" autofocus readonly>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="invNo" class="col-md-4 control-label">Invoice No</label>

                                <div class="col-md-8">
                                    <input id="invNo" type="text" class="form-control"
                                           name="invNo" value="{{$invNo}}" autofocus readonly>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="date" class="col-md-4 control-label">Date</label>

                                <div class="col-md-7">
                                    <input id="date" type="text" class="form-control"
                                           name="date" value="<?php echo $mytime->toDateString();?>" readonly
                                    >
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" id="stationaryTbl">
                        <table class="table table-condensed" cellspacing="0" width="90%">
                            <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
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
</div>
