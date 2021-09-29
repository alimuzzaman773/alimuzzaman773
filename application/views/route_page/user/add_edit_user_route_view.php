<div class="alert" id="error_msg">
    <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
    <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">Add User</div>
            <div class="col-md-6 text-left">
                <a href="#!" class="btn btn-sm btn-primary pull-right">Back To List&nbsp;<i class="fa fa-list"></i></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="row g-3 form" novalidate role="form" name="addContactForm" ng-submit="onSubmit()" method="post" id="addContact" autocomplete="off">
            <div class="col-md-6 offset-3"> 
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input id="email" ng-model="user.email" class="form-control" type="email" placeholder="Email" name="email" autocomplete="off" required="">
                <span class="text-danger ng-hide" ng-show="errorEmail">{{errorEmail}}</span> 
            </div>
            <div class="col-md-6 offset-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input id="password" ng-model="user.password" class="form-control" type="password" placeholder="Password" name="password" autocomplete="off"  required="">
                <span class="text-danger ng-hide" ng-show="errorPassword">{{errorPassword}}</span> 
            </div>
            <div class="col-md-6 offset-3">
                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <input id="password_confirmation" ng-model="user.password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation" autocomplete="off"  required="">
                <span class="text-danger ng-hide" ng-show="errorpasswordConfirmation">{{errorpasswordConfirmation}}</span> 
            </div>
            <div class="col-12">
                <input type="submit" name="submitContact" ng-if="submtBtnValue" value="{{submtBtnValue}}" class="btn btn-primary pull-right">
            </div>
        </form>
    </div>
</div>
<img ngIf="loading" id="loading" ng-show="loading" src="<?php echo base_url('storage/images/spinnervlll.gif'); ?>">