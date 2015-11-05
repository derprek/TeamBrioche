<toaster-container ></toaster-container>

<form ng-show="newWindow" ng-cloak class="add-window" ng-submit="sendMessage()" class="form-horizontal">
    
        <div class='header' ng-click="cancelAdd()">Compose a new Message</div>
        <br>

        <div class="form-group" > 
          <ui-select id="email" ng-model="newMessage.recipient" theme="bootstrap" ng-disabled="disabled" > 
            <ui-select-match placeholder="Select a Recipient.">@{{$select.selected.email}}</ui-select-match>
            <ui-select-choices repeat="recipient in RecipientList | filter: $select.search" >
               <div ng-bind-html="recipient.name | highlight: $select.search"></div>
              <small>
                email: @{{recipient.email}}
              </small>
            </ui-select-choices>
          </ui-select> 
        </div>

        <div class="form-group">
            <div class="col-sm-10">
               <input type="text" required ng-model="newMessage.title" name="title" class="form-control" placeholder="Enter a Title." required>
            </div>
        </div> 
        <br>

        <div class="form-group">
          <div class="col-sm-10">
           <textarea required class="form-control" ng-model="newMessage.content" name="content" rows="5" placeholder="What do you wish to say :)"> </textarea>
          </div>
        </div>

      <div class="form-group" style="padding-top:10%;">
        <br><br><hr>
        <span class="pull-right" style="padding-right:10%;"> <button type="submit" class="btn btn-success" ng-show="RecipientList" > <i class="fa fa-pencil"></i>  Send</button></span>
        <span class="pull-left" style="padding-left:10%;"> <button type="button" ng-click="cancelAdd()" class="btn btn-danger" >Cancel</button></span>
      </div>

</form>