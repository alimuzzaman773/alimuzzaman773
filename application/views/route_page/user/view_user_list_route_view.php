<div class="alert" id="error_msg">
    <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
    <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
</div>
<div class="card" id="contactListCard">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">User List</div>
            <div class="col-md-6 text-right">
                <a href="#!/add_user" class="btn btn-sm btn-primary pull-right">Add User&nbsp;<i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-responsive" id="">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Email</th>
                    <th>Created On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="user in userList">
                    <td>{{$index + 1}}</td>
                    <td>{{user.email}}</td>
                    <td ng-bind="formatDate(user.created_on) |  date:'dd - MM - yyyy'"></td>
                    <td>
                        <a href="#!/user_books/{{user.id}}" class="btn btn-sm btn-primary"><i class="fa fa-user"></i>&nbsp;&nbsp;=>&nbsp;&nbsp;<i class="fa fa-book"></i></a>
                        <a href="#!/add_user/{{user.id}}"  class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="" ng-click="deleteUser(user.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<img ngIf="loading" id="loading" ng-show="loading" src="<?php echo base_url('storage/images/spinnervlll.gif'); ?>">