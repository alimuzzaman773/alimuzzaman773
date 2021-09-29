<div class="alert" id="error_msg">
    <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
    <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
</div>
<div class="card" id="contactListCard">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">Book List</div>
            <div class="col-md-6 text-right">
                <a href="#!/add_book" class="btn btn-sm btn-primary pull-right">Add Book&nbsp;<i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-responsive text-center" id="">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Created On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="Book in BookList">
                    <td>{{Book.name}}</td>
                    <td>{{Book.isbn}}</td>
                    <td>{{Book.author}}</td>
                    <td ng-bind="formatDate(Book.created_on) | date:'dd - MM - yyyy'"></td>
                    <td>
                        <a href="#!/add_book/{{Book.id}}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="" ng-click="deleteBook(Book.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<img ngIf="loading" id="loading" ng-show="loading" src="<?php echo base_url('storage/images/spinnervlll.gif'); ?>">