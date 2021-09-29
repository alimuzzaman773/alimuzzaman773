<div class="alert" id="error_msg">
    <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
    <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
</div>
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
<div class="card" id="contactListCard">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">User Book List</div>
            <div class="col-md-6 text-right">
                <a href="#!/add_user_books/{{userId}}" class="btn btn-sm btn-primary pull-right">Add User Book&nbsp;<i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-responsive text-center" id="">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>User Email</th>
                    <th>Created On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="usersBook in userAllBookList">
                    <td>{{$index + 1}}</td>
                    <td>{{usersBook.name}}</td>
                    <td>{{usersBook.isbn}}</td>
                    <td>{{usersBook.author}}</td>
                    <td>{{usersBook.email}}</td>
                    <td ng-bind="formatDate(usersBook.created_on) | date:'dd - MM - yyyy'"></td>
                    <td>
                        <a href="#!/add_user_books/{{userId}}/{{usersBook.id}}" ng-click="editUsersBook(usersBook)" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="" ng-click="deleteUsersBook(usersBook.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<img ngIf="loading" id="loading" ng-show="loading" src="<?php echo base_url('storage/images/spinnervlll.gif'); ?>">