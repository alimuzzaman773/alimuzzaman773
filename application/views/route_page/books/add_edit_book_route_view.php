<div class="alert" id="error_msg">
    <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
    <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
</div>
<div class="card" id="">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">Add Book</div>
            <div class="col-md-6 text-right">
                <a href="#!/books" class="btn btn-sm btn-primary pull-right">Back To List&nbsp;<i class="fa fa-list"></i></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-md btn-info margin-top30px" ng-hide="hideAddRowBtn" ng-click="AddRow()">Add Book</button>
            </div>
        </div>
        <form class="form" role="form" name="addBookForm" ng-submit="onSubmitBookForm()" id="addBookForm">
            <div class="row margin-top30px" ng-repeat="book in books">
                <div class="col-md-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" ng-model="book.name" id="name" name="name[]">
                </div>
                <div class="col-md-3">
                    <label for="isbn" class="form-label">Isbn</label>
                    <input type="text" class="form-control" ng-model="book.isbn" id="isbn" name="isbn[]">
                </div>
                <div class="col-md-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" ng-model="book.author" id="author" name="author[]">
                </div>
                <div class="col-md-3 margin-top30px">
                    <label for="remove_row" class="form-label"></label>
                    <button class="btn btn-sm btn-danger" id="remove_row" ng-click="RemoveRow($index)"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary margin-top30px" ng-if="hideSubmitBtn" id="submitBtn" value="{{submtBtnValue}}">
                </div>
            </div>
        </form>
    </div>
</div>
<img ngIf="loading" id="loading" ng-show="loading" src="<?php echo base_url('storage/images/spinnervlll.gif'); ?>">