 <div class="container">
    <!-- Create new client Modal -->
    <div class="modal fade" id="deletepersonnel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">

                                <!-- deletion form -->
                            <h4 style="text-align:center;"> <i class="fa fa-exclamation-triangle"></i>You are about to permanently delete a personnel</h4>
                            <br>
                            <small>Please type in 'delete' in the box to confirm this process.</small>
                            <br><br>

                            <input required type="text" ng-model="deleteconfirmation" name="fname" class="form-control"
                                   value="" placeholder="Enter delete to confirm" autofocus>
                            <br>

                            <div class="modal-footer">
                                <button type="submit" ng-disabled="!confirmationPassed()" class="btn btn-success pull-right">
                                    <i class="fa fa-trash"></i></i>Delete Personnel
                                </button>

                                <button type="submit" class="btn btn-danger pull-left" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Cancel
                                </button>

                            </div>
                            <!-- /.modal-footer -->
                        </form>
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