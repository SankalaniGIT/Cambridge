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
                          action="{{route('postAddInven')}}">
                        {{ csrf_field() }}
                        <div class="header" style="border: ridge;font-weight: 900">Add New Inventory >></div>
                        <br>
<?php
$mytime = Carbon\Carbon::now();
?>
                        <div class="row">

                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="item" class="col-md-4 control-label">Item Name</label>

                                    <div class="col-md-8">
                                            <input id="item" type="text" class="form-control" name="item"
                                                   value="{{ old('item') }}" autofocus >

                                        @if ($errors->has('item'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('item') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="qty" class="col-md-4 control-label">Quantity</label>

                                    <div class="col-md-8">
                                        <input id="qty" type="number" class="form-control" name="qty"
                                               value="{{ old('qty') }}" autofocus >

                                        @if ($errors->has('qty'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('qty') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('Pprice') ? ' has-error' : '' }}">
                                <div class=" form-group">
                                    <label for="Pprice" class="col-md-4 control-label">Purchase Price</label>

                                    <div class="col-md-8">
                                        <input id="Pprice" type="number" class="form-control" name="Pprice"
                                               value="{{ old('Pprice') }}" autofocus >

                                        @if ($errors->has('Pprice'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('Pprice') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('Sprice') ? ' has-error' : '' }}">
                                <div class=" form-group">
                                    <label for="Sprice" class="col-md-4 control-label">Selling Price</label>

                                    <div class="col-md-8">
                                        <input id="Sprice" type="number" class="form-control" name="Sprice"
                                               value="{{ old('Sprice') }}" autofocus >

                                        @if ($errors->has('Sprice'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('Sprice') }}</strong>
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
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr style="border: double">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('postUpdateInven')}}">
                        {{ csrf_field() }}
                        <div class="header" style="border: ridge;font-weight: 900">Update Inventory >></div>
                        <br>
                        <?php
                        $mytime = Carbon\Carbon::now();
                        ?>
                        <div class="row">

                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('item2') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="item2" class="col-md-4 control-label">Item Name</label>

                                    <div class="col-md-8">
                                        <select id="item2" type="text" class="form-control" name="item2"
                                               value="{{ old('item2') }}" autofocus >
                                            @foreach($inventories as $invt)
                                                <option value="{{$invt->st_id}}">{{$invt->st_type}}</option>
                                                @endforeach
                                        </select>

                                        @if ($errors->has('item2'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('item2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('qty2') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="qty2" class="col-md-4 control-label">Quantity</label>

                                    <div class="col-md-8">
                                        <input id="qty2" type="number" class="form-control" name="qty2"
                                               value="{{ old('qty2') }}" autofocus >

                                        @if ($errors->has('qty2'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('qty2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('Pprice2') ? ' has-error' : '' }}">
                                <div class=" form-group">
                                    <label for="Pprice2" class="col-md-4 control-label">Purchase Price</label>

                                    <div class="col-md-8">
                                        <input id="Pprice2" type="number" class="form-control" name="Pprice2"
                                               value="{{ old('Pprice2') }}" autofocus >

                                        @if ($errors->has('Pprice2'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('Pprice2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-sm-12 col-xs-12 form-group{{ $errors->has('Sprice2') ? ' has-error' : '' }}">
                                <div class=" form-group">
                                    <label for="Sprice2" class="col-md-4 control-label">Selling Price</label>

                                    <div class="col-md-8">
                                        <input id="Sprice2" type="number" class="form-control" name="Sprice2"
                                               value="{{ old('Sprice2') }}" autofocus >

                                        @if ($errors->has('Sprice2'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('Sprice2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-3 col-sm-6 col-xs-6 form-group{{ $errors->has('ckAdd') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="ckAdd" class="col-md-8 control-label">Add</label>
                                    <div class="col-md-4">
                                        <input id="ckAdd" type="checkbox" class="form-control" name="ckAdd" onclick="$(this).val(this.checked ? 1:0)"
                                               value="0" autofocus style="width: 30px;height: 30px;">

                                        @if ($errors->has('ckAdd'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('ckAdd') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-3 col-sm-6 col-xs-6 form-group{{ $errors->has('ckRe') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="ckRe" class="col-md-7 control-label">Remove</label>
                                    <div class="col-md-5">
                                        <input id="ckRe" type="checkbox" class="form-control" name="ckRe" onclick="$(this).val(this.checked ? 1:0)"
                                               value="0" autofocus style="width: 30px;height: 30px;">

                                        @if ($errors->has('ckRe'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('ckRe') }}</strong>
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

