<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Upgrade Students</h2>
    <div class="panel panel-default dataTables_wrapper dt-jqueryui">
        <div class="panel-heading fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-tl ui-corner-tr">
            Student Upgrade
        </div>
        <div class="panel-body">
            <div class="row center-block">
                <div class="col-md-5 form-group">
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
                <div class="col-md-5 form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                    <label for="class" class="col-md-4 control-label">Class</label>

                    <div class="col-md-8">
                        <select id="class" type="text" class="form-control" name="class"
                                value="{{ old('class') }}" required autofocus>
                        </select>

                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <div class="col-md-4">
                        <button type="submit" id="searchBtn" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <form class="form-horizontal" role="form" method="POST"
                  action="{{route('postStuUpgrade')}}">
                {!! csrf_field() !!}

                <div class="table-responsive">
                    <table id="updateCharges" role="grid" class="table table-bordered table-striped display dataTable"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Admission No</th>
                            <th>First Name</th>
                            <th>Last name</th>
                            <th>Class Category</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Admission No</th>
                            <th>First Name</th>
                            <th>Last name</th>
                            <th>Class Category</th>
                        </tr>
                        </tfoot>
                        <tbody id="tblbody">

                        </tbody>
                    </table>

                </div>
                <hr>
                <div class="row center-block">
                    <div class="col-md-8 form-group{{ $errors->has('Uclass') ? ' has-error' : '' }}">
                        <label for="Uclass" class="col-md-5 control-label">Upgrade Class</label>

                        <div class="col-md-7">
                            <select id="Uclass" type="text" class="form-control" name="Uclass"
                                    value="{{ old('Uclass') }}" required autofocus>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                Upgrade
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br"></div>
    </div>


</div>
