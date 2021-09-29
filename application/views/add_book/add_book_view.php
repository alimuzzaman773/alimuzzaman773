<div ng-controller="addBookController">
    <div class="alert" id="error_msg">
        <div class="alert alert-success text-center ng-hide" role="alert" id="messages" ng-show="succesmsg"><div class="alert-text">{{msg}}</div></div>
        <div class="alert alert-danger text-center ng-hide" role="alert" id="messages" ng-show="errmsg"><div class="alert-text">{{msg}}</div></div>
    </div>
    <div class="card" id="">
        <div class="card-header">Add Book</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Select User</label>
                        </div>
                        <div class="col-md-6">
                            <select name="user" ng-model="formData.user" ng-options="x.email for x in users track by x.id" class="form-control" id="user" required="">
                                <option value="">Please select one</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-md btn-info margin-top30px" ng-click="AddBookRow()">Add Book</button>
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
                        <button class="btn btn-sm btn-danger" id="remove_row" ng-click="RemoveBookRow($index)"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary margin-top30px" ng-hide="hideSubmitBtn === 0" id="submitBtn" value="{{submtBtnValue}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card" id="contactListCard">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 text-left">Book List</div>
                <div class="col-md-6 text-right"></div>
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
                    <tr ng-repeat="usersBook in userAllBookList">
                        <td>{{usersBook.name}}</td>
                        <td>{{usersBook.isbn}}</td>
                        <td>{{usersBook.author}}</td>
                        <td ng-bind="formatDate(usersBook.created_on) | date:'dd - MM - yyyy'"></td>
                        <td>
                            <a href="" ng-click="editUsersBook(usersBook)" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="" ng-click="deleteUsersBook(usersBook)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>