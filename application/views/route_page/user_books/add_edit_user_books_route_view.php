<div class="alert" id="error_msg">
    <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
    <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
</div>
<div class="card" id="">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">Add User Book</div>
            <div class="col-md-6 text-right">
                <a href="#!/user_books/{{userId}}" class="btn btn-sm btn-primary pull-right">Back To List &nbsp;<i class="fa fa-list"></i></a>
            </div>
        </div>
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 offset-7">
                <div class="row">
                    <div class="col-md-4">
                        <label>Current User</label>
                    </div>
                    <div class="col-md-8">
                        <strong class="">{{user_details.email}}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-md btn-info margin-top30px" ng-hide="hideAddRowBtn" ng-click="AddRow()">Add Book</button>
            </div>
        </div>
        <form class="form" role="form" name="addBookForm" ng-submit="onSubmitBookForm()" id="addBookForm">
            <div class="row margin-top30px" ng-repeat="userBoo in userBooks">
                <div class="col-md-2"></div>
                <div class="col-md-2 col-md-offset-3">
                    <label for="isbn" class="form-label">Select Book</label>
                </div>
                <div class="col-md-4">
                    <select name="user[]" ng-model="userBoo.book" ng-options="x.name for x in bookList track by x.id" class="form-control" id="user" required="">
                        <option value="">Please select one</option>
                    </select>
                    <input type="hidden" name="row_id" id="row_id" value="{{rowId}}">
                </div>
                <div class="col-md-4 margin_top3px">
                    <label for="remove_row" class="form-label"></label>
                    <button class="btn btn-sm btn-danger" id="remove_row" ng-click="RemoveRow($index)"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary margin-top30px" ng-hide="hideSubmitBtn" id="submitBtn" value="{{submtBtnValue}}">
                </div>
            </div>
        </form>
    </div>
</div>
<img ngIf="loading" id="loading" ng-show="loading" src="<?php echo base_url('storage/images/spinnervlll.gif'); ?>">