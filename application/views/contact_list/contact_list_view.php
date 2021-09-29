<div ng-controller="addContactFormController">
    <div class="alert" id="error_msg">
        <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
        <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
    </div>
    <div class="card" id="">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 text-left">Add Contacts</div>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3 form" novalidate role="form" name="addContactForm" ng-submit="onSubmit()" method="post" id="addContact">
                <div class="col-md-6"> 
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" ng-model="contact.name" class="form-control" id="name" required="" name="name">
                    <span class="text-danger ng-hide" ng-show="errorName">{{errorName}}</span> 
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="phone">+88</label>
                        <input type="number" ng-model="contact.phone" class="form-control" id="phone" name="phone" maxlength="11" required="">
                    </div>
                    <span class="text-danger ng-hide" ng-show="errorPhone">{{errorPhone}}</span> 
                </div>
                <div class="col-6">
                    <label for="company" class="form-label">Company <span class="text-danger">*</span></label>
                    <input type="text" ng-model="contact.company" class="form-control" id="company" name="company" placeholder="1234 Main St" required="">
                    <span class="text-danger ng-hide" ng-show="errorCompany">{{errorCompany}}</span> 
                </div>
                <div class="col-6">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea cols="5" ng-model="contact.address" class="form-control" rows="1" id="address" name="address" required=""></textarea>
                    <span class="text-danger ng-hide" ng-show="errorAddress">{{errorAddress}}</span>
                </div>
                <div class="col-12">
                    <input type="submit" name="submitContact" ng-if="submtBtnValue" value="{{submtBtnValue}}" class="btn btn-primary pull-right">
                </div>
            </form>
        </div>
    </div>
    <div class="card" id="contactListCard">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 text-left">Contact List</div>
                <div class="col-md-6 text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive text-center" id=""><!--contactList-->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Address</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="cont in contactList">
                        <td>{{cont.name}}</td>
                        <td>{{cont.phone}}</td>
                        <td>{{cont.company}}</td>
                        <td>{{cont.address}}</td>
                        <td ng-bind="formatDate(cont.created_on) |  date:'dd - MM - yyyy'"></td>
                        <td>
                            <a href="" ng-click="editContact(cont)" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="" ng-click="deleteContact(cont.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>