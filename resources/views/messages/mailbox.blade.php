@extends('master.mailbox')

@section('sidemenubar')

    @include('partials.sidebar_home')

@endsection

@section('content')
<script src="/js/Angular_JS/messages/MailboxController.js"></script>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-inbox"></i>Mailbox</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div ng-cloak class="col-md-2">
                    <button class="btn btn-success btn-block col-md2 col-lg-2" role="button" ng-click="startAdd()">
                        </i>Compose <i class="fa fa-pencil"></i>
                    </button>
                </div>
                <div ng-cloak class="col-md-6">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#inbox" ng-click="getInbox()">
                    <span
                            class="badge pull-right" style="margin-left:2%;"
                            ng-if="totalunread()">@{{ totalunread() }}</span>Inbox </a></li>
                        <li><a data-toggle="tab" href="#sentbox" ng-click="getSentBox()" id="sendbox">Sent</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="tab-content">

                    <div id="inbox" class="tab-pane fade in active">

                        <div id="loadInbox" style="width:100%; ">

                            @include('partials.loadinganimation')

                            <div id="loadInbox_text" style="margin-left:45%;">
                                <small>
                                    Fetching your Mail....
                                </small>
                            </div>
                        </div>

                        <div ng-hide="Inbox" class="emptymsg_container" id="emptymsg" style="visibility:hidden;">
                            <h3>You have no mail.</h3>
                            <a href="#" role="button" ng-click="startAdd()"><h3>@{{errorText}}</h3></a>
                        </div>

                        <div ng-show="Inbox" ng-cloak class="col-xs-12 col-sm-9 col-md-10 col-lg-11">
                            <!-- Nav tabs -->
                            <br>
                            <h3> Inbox </h3>

                            <br>
                            <input type="text" placeholder="Search...." class="form-control"
                                   ng-model="inboxsearch.text"><br>

                            <div class="list-group"
                                 dir-paginate="inbox in Inbox | filter:inboxsearch.text | itemsPerPage: 10"
                                 pagination-id="inboxPagination">
                                <a href="/practitioner/inbox/showthread/@{{ inbox.conv_id }}"
                                   class="list-group-item"
                                   data-toggle="tooltip" title="@{{ inbox.recipient_email }}">

                                    <i ng-if="inbox.unreadcount !== 0" class="fa fa-envelope-o"></i>

                                <span class="message_sendername" ng-if="inbox.unreadcount !== 0"> <p
                                            style="margin-right:2%;"
                                            class="badge pull-left">@{{ inbox.unreadcount }}</p>
                                <p class="mailboxfontlarge"><strong>From: @{{ inbox.recipient_name }} </strong>
                                </p>  </span>

                                <span class="message_sendername" ng-if="inbox.unreadcount === 0">
                                <p class="mailboxfontlarge">From: @{{ inbox.recipient_name }} </p>  </span>

                                    <span class="" ng-if="inbox.unreadcount === 0"><small
                                                class="mailboxfontlarge">@{{ inbox.last_msg_title }}</small></span>
                                    <span class="" ng-if="inbox.unreadcount !== 0"><strong
                                                class="mailboxfontlarge">@{{ inbox.last_msg_title }}</strong></span>
                                    <hr>

                                    <div class="message_previewtext" ng-if="inbox.unreadcount === 0"><p
                                                class="mailboxfontmedium"> @{{ inbox.last_msg_content }}</p></div>
                                    <div class="message_previewtext_unread" ng-if="inbox.unreadcount !== 0"><strong
                                                class="mailboxfontmedium"> @{{ inbox.last_msg_content }}</strong>
                                    </div>
                                    <div class="message_timestamp">
                                        <small>@{{ inbox.last_msg_time }}</small>
                                    </div>

                                </a>

                            </div>


                            <div ng-if="Inbox">

                                <div ng-show="(Inbox | filter:inboxsearch.text).length == 0"
                                     class="emptyresults_container">
                                    <h3> No results found <i class="fa fa-meh-o"></i></h3>
                                </div>

                            </div>

                            <dir-pagination-controls template-url="/dirPagination.tpl.html"
                                                     pagination-id="inboxPagination"></dir-pagination-controls>

                        </div>
                    </div>

                    <!-- Sent box tab -->
                    <div id="sentbox" class="tab-pane fade">

                        <div id="loadSentbox" style="width:100%; ">

                            @include('partials.loadinganimation')

                            <div id="loadSentbox_text" style="margin-left:45%;">
                                <small>
                                    Fetching your Mail....
                                </small>
                            </div>
                        </div>

                        <div class="emptymsg_container" id="emptymsg_send" style="visibility:hidden;">
                            <h3 style="margin:0;">No Mail found.</h3>
                            <a href="#" role="button" ng-click="startAdd()"><h3>@{{errorText}}</h3></a>
                        </div>

                        <div ng-show="Sentbox" ng-cloak class="col-xs-12 col-sm-9 col-md-10 col-lg-11">
                            <br>
                            <h3> Sent Box </h3>

                            <br>
                            <input type="text" placeholder="Search...." class="form-control"
                                   ng-model="sentsearch.text"><br>

                            <div class="list-group"
                                 dir-paginate="sentbox in Sentbox | filter:sentsearch.text | itemsPerPage: 10"
                                 pagination-id="sentboxPagination">
                                <a class="list-group-item" role="button" data-toggle="collapse"
                                   href="#@{{ sentbox.id }}"
                                   aria-expanded="false" aria-controls="content">

                                    <span class="">Sent to: @{{ sentbox.receiver_name }}   </span>

                                    <span style="padding-left:2%;"><strong> @{{ sentbox.title }}</strong></span>

                                    <span style="float:right;"> <small>@{{ sentbox.created_at }}</small></span>

                                </a>

                                <div class="collapse" id="@{{ sentbox.id }}">
                                    <div class="well">
                                        <small>@{{ sentbox.content }}</small>
                                    </div>
                                </div>

                            </div>

                            <div ng-if="Sentbox">

                                <div ng-show="(Sentbox | filter:sentsearch.text).length == 0"
                                     class="emptyresults_container">
                                    <h3> No results found <i class="fa fa-meh-o"></i></h3>
                                </div>

                            </div>


                            <dir-pagination-controls template-url="/dirPagination.tpl.html"
                                                     pagination-id="sentboxPagination"></dir-pagination-controls>
                            <hr>

                        </div>
                        <!-- End of Sentbox dynamic div -->
                    </div>
                    <!-- End of Sentbox div -->
                </div>
                <!-- End of tabbed content div -->
            </div>
        </div>
        <!-- Ad -->
        @include('partials.messagewindow')

    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <br>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection

@stop