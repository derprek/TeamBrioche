<div class="container">
    <!-- Create new client Modal -->
    <div class="modal fade" id="newclient" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span style="color:#000000">New Client</span></h4>
                </div>

                <div class="modal-body">

                    <div id="loadinganimation" style="width:100%; " ng-show="loadingSpinner">

                        @include('partials.loadinganimation')

                        <div id="allClientsLoad_text" style="text-align:center;">
                            <small style="margin:auto;">
                                Processing..Please wait
                            </small>
                        </div>

                    </div>

                    <div id="Registerform" style="width:100%;" ng-show="showForm">

                        @if (Session::has('client_registererrors'))

                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    <li>The email has already been taken.</li>
                                </ul>
                            </div>

                            @endif

                                    <!-- Registration form -->
                            <form role="form" method="POST" ng-submit="showLoadingAnimation()"
                                  action="{{ url('/admin/registerclient') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="prac_email" value="@{{ selected.practitioner.email }}">

                                <label for="fname"> Given name:*</label>
                                <input required type="text" name="fname" class="form-control"
                                       placeholder="Enter the client's given name"
                                       value="{{ old('fname') }}" autofocus>
                                <br>

                                <label for="sname"> Family name:*</label>
                                <input required type="text" name="sname" class="form-control"
                                       placeholder="Enter the client's family name"
                                       value="{{ old('sname') }}">
                                <br>

                                <label for="email"> Email Address:*</label>
                                <input required type="email" name="email" class="form-control"
                                       placeholder="Enter the client's email address"
                                       value="{{ old('email') }}">
                                <br>

                                <label for="prac_email"> Under the supervision of:*</label>
                                <ui-select id="practitioner" name="prac_email" ng-model="selected.practitioner"
                                           theme="bootstrap" class="form-group"
                                           ng-required="true">
                                    <ui-select-match
                                            placeholder="Select a Practitioner.">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices
                                            repeat="practitioner in AllPractitioners | filter: $select.search">
                                        <div ng-bind-html="practitioner.name | highlight: $select.search"></div>
                                        <small>
                                            email: @{{practitioner.email}}
                                        </small>
                                    </ui-select-choices>
                                </ui-select>

                                <label for="gender">Gender: </label>
                                <select id="genderselect" name="gender" class="form-control" theme ="bootstrap">
                                    <option value='Male'>Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                <br><br>


                                <div class="modal-footer">
                                    <button type="submit" ng-show="numberOfPractitioners()"
                                            class="btn btn-success pull-right">
                                        <i class="fa fa-check"></i> Register Client
                                    </button>

                                    <button type="submit" class="btn btn-danger pull-left"
                                            data-dismiss="modal">
                                        <i class="fa fa-times"></i> Cancel
                                    </button>

                                </div>


                                <!-- /.modal-footer -->
                            </form>
                    </div>

                </div>
                <!-- /.modal-body -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.container -->