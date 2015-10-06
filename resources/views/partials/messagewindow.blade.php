   <toaster-container ></toaster-container>

  <form ng-show="newWindow" ng-cloak class="add-window" ng-submit="sendMessage()" class="form-horizontal">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css">
                  <div class='header' ng-click="cancelAdd()">Compose a new Message</div>

                      <br>
                      <div class="form-group"> 
                      <ui-select id="email" ng-model="newMessage.recipient" theme="selectize" class="form-group" style=" height: 29px;" ng-required="true"> 
                        <ui-select-match placeholder="Select a Recipient.">@{{$select.selected.email}}</ui-select-match>
                        <ui-select-choices repeat="recipient in RecipientList | filter: $select.search">
                           <div ng-bind-html="recipient.name | highlight: $select.search"></div>
                          <small>
                            email: @{{recipient.email}}
                          </small>
                        </ui-select-choices>
                      </ui-select> 
                      </div>

                      <div class="form-group">
                      <div class="col-sm-10">
                      <input type="text" ng-model="newMessage.title" name="title" class="form-control" placeholder="Enter a Title." required>
                      </div></div>
                    <br>

                      <div class="form-group">
                      <div class="col-sm-10">
                      <textarea class="form-control" ng-model="newMessage.content" name="content" rows="5" placeholder="What do you wish to say :)"> </textarea>
                      </div></div>

                    <div class="form-group" style="padding-top:20%;">
                      <br><br><hr>
                      <input type="submit" ng-show="RecipientList" value="Send" class="btn btn-primary btn-sm ">
                      <button type="button" ng-click="cancelAdd()" class="btn btn-danger btn-sm">Cancel</button>
                    </div>
                </form>