var app = angular.module('learnAngular', ['ngRoute']);
app.controller('addContactFormController', function ($scope, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.contact = {};
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.succesmsg = false;
    $scope.submtBtnValue = 'Add';
    $http({
        method: 'POST',
        url: base_url + 'contact/get_contacts'
    }).then(function (response) {
        $scope.contactList = response.data.contact_list;
    });
    $scope.onSubmit = function () {
        $http({
            method: 'POST',
            url: base_url + 'contact/add_update_contact',
            data: $.param($scope.contact)
        }).then(function (response) {
            if (response.data.errors) {
                $scope.errorName = response.data.errors.name;
                $scope.errorPhone = response.data.errors.phone;
                $scope.errorCompany = response.data.errors.company;
                $scope.errorAddress = response.data.errors.address;
                $scope.contactList = response.data.contact_list;
            } else {
                $scope.errorName = null;
                $scope.errorPhone = null;
                $scope.errorCompany = null;
                $scope.errorAddress = null;
                $scope.contact = {};
                $scope.errmsg = response.data.success ? false : true;
                $scope.succesmsg = response.data.success ? true : false;
                $scope.msg = response.data.msg;
                $scope.contactList = response.data.contact_list;
                $scope.submtBtnValue = 'Add';
            }
        });
    };
    $scope.editContact = function (obj) {
        $scope.submtBtnValue = 'Update';
        $scope.contact = obj;
        $scope.contact.phone = Number(obj.phone);
    };
    $scope.deleteContact = function (id) {
        $http({
            method: 'POST',
            url: base_url + 'contact/delete_contact',
            data: $.param({id: id})
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.contactList = response.data.contact_list;
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});
app.controller('addBookController', function ($scope, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.books = [{}];
    $scope.users = {};
    $scope.data = [];
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.succesmsg = false;
    $scope.hideSubmitBtn = null;
    $scope.submtBtnValue = 'Add';
    $scope.formData = {};
    $scope.AddBookRow = function () {
        $scope.hideSubmitBtn = null;
        $scope.books.push({});
    };
    $scope.RemoveBookRow = function (i) {
        $scope.hideSubmitBtn = i;
        $scope.books.splice(i, 1);
    };
    $http({
        method: 'POST',
        url: base_url + 'add_book/get_users'
    }).then(function (response) {
        $scope.users = response.data.users_list;
    });
    $http({
        method: 'POST',
        url: base_url + 'add_book/get_books'
    }).then(function (response) {
        $scope.userAllBookList = response.data.books_list;
    });
    $scope.onSubmitBookForm = function () {
        $scope.data.push($scope.formData);
        $scope.data.push($scope.books);
        $http({
            method: 'POST',
            url: base_url + 'add_book/add_update',
            data: $scope.data
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.userAllBookList = response.data.user_all_book_list;
            $scope.books = [{}];
            $scope.formData = null;
            $scope.submtBtnValue = 'Add';
        });
    };
    $scope.editUsersBook = function (obj) {
        $scope.submtBtnValue = 'Update';
        $scope.books = [obj];
        $scope.formData.user = {id: obj.user_id};
    };
    $scope.deleteUsersBook = function (obj) {
        $http({
            method: 'POST',
            url: base_url + 'add_book/delete_book',
            data: $.param({id: obj.id, user_id: obj.user_id})
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.userAllBookList = response.data.books_list;
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});

app.config(function ($routeProvider) {
    $routeProvider
            .when("/", {
                templateUrl: base_url + "user/user_list",
                controller: 'user'
            })
            .when("/add_user/:userId?", {
                templateUrl: base_url + "user/add_edit_user",
                controller: 'add_edit_user'
            })
            .when("/books", {
                templateUrl: base_url + "books/book_list",
                controller: 'book_list'
            })
            .when("/add_book/:bookId?", {
                templateUrl: base_url + "books/add_edit_book",
                controller: 'add_edit_book'
            })
            .when("/user_books/:userId", {
                templateUrl: base_url + "user_books/user_books_list",
                controller: 'user_books_list'
            })
            .when("/add_user_books/:userId/:rowId?", {
                templateUrl: base_url + "user_books/add_edit_user_books",
                controller: 'add_edit_user_books'
            });
});
app.controller('user', function ($scope, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.loading = true;
    $scope.succesmsg = false;
    $http({
        method: 'POST',
        url: base_url + 'user/get_users'
    }).then(function (response) {
        $scope.loading = false;
        $scope.userList = response.data.users_list;
    });
    $scope.deleteUser = function (id) {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'user/delete_user',
            data: $.param({id: id})
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.userList = response.data.users_list;
            $scope.loading = false;
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});
app.controller('add_edit_user', function ($scope, $routeParams, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.loading = false;
    $scope.succesmsg = false;
    $scope.submtBtnValue = $routeParams.userId ? 'Update' : 'Add';
    $scope.errorEmail = null;
    $scope.errorPassword = null;
    $scope.passwordConfirmation = null;
    $scope.userId = $routeParams.userId;
    if ($routeParams.userId) {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'user/get_user_details',
            data: $.param({userId: $scope.userId})
        }).then(function (response) {
            $scope.loading = false;
            $scope.user = response.data.user_details;
            $scope.user.password = null;
            $scope.user.password_confirmation = null;
        });
    }
    $scope.onSubmit = function () {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'user/add_update_user',
            data: $.param({userId: $scope.userId, user: $scope.user})
        }).then(function (response) {
            $scope.loading = false;
            if (response.data.errors) {
                $scope.errorEmail = response.data.errors.email;
                $scope.errorPassword = response.data.errors.password;
                $scope.errorpasswordConfirmation = response.data.errors.password_confirmation;
            } else {
                $scope.errorEmail = null;
                $scope.errorPassword = null;
                $scope.errorpasswordConfirmation = null;
                $scope.errmsg = response.data.success ? false : true;
                $scope.succesmsg = response.data.success ? true : false;
                $scope.user = null;
                $scope.msg = response.data.msg;
                $scope.submtBtnValue = $routeParams.userId ? 'Update' : 'Add';
            }
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});
app.controller('book_list', function ($scope, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.succesmsg = false;
    $scope.loading = false;
    $http({
        method: 'POST',
        url: base_url + 'books/get_books'
    }).then(function (response) {
        $scope.BookList = response.data.book_lists;
    });
    $scope.deleteBook = function (id) {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'books/delete_book',
            data: $.param({id: id})
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.BookList = response.data.book_lists;
            $scope.loading = false;
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});
app.controller('add_edit_book', function ($scope, $routeParams, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.books = [];
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.succesmsg = false;
    $scope.hideSubmitBtn = false;
    $scope.submtBtnValue = $routeParams.bookId ? 'Update' : 'Add';
    $scope.bookId = $routeParams.bookId;
    $scope.hideAddRowBtn = $routeParams.bookId ? true : false;
    $scope.loading = false;
    if ($routeParams.bookId) {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'books/get_book_details',
            data: $.param({bookId: $scope.bookId})
        }).then(function (response) {
            $scope.loading = false;
            $scope.books = [response.data.book_details];
            $scope.hideSubmitBtn = true;
        });
    }
    $scope.AddRow = function () {
        $scope.hideSubmitBtn = true;
        $scope.books.push({});
    };
    $scope.RemoveRow = function (i) {
        $scope.hideSubmitBtn = ($scope.books.length === 1 ? false : true);
        $scope.books.splice(i, 1);
    };
    $scope.onSubmitBookForm = function () {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'books/add_update_book',
            data: $scope.books
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.books = [response.data.book_details];
            $scope.submtBtnValue = $routeParams.bookId ? 'Update' : 'Add';
            $scope.hideSubmitBtn = true;
            $scope.hideAddRowBtn = $routeParams.bookId ? true : false;
            $scope.loading = false;
        });
    };
});
app.controller('user_books_list', function ($scope, $route, $routeParams, $location, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.userBooks = [];
    $scope.userId = $routeParams.userId;
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.succesmsg = false;
    $scope.hideSubmitBtn = true;
    $scope.submtBtnValue = 'Add';
    $scope.data = [];
    $scope.rowId = null;
     $scope.loading = false;
    $http({
        method: 'POST',
        url: base_url + 'user_books/get_user_details',
        data: $.param({id: $scope.userId})
    }).then(function (response) {
        $scope.user_details = response.data.user_details;
    });
    $http({
        method: 'POST',
        url: base_url + 'user_books/get_user_books',
        data: $.param({userId: $scope.userId})
    }).then(function (response) {
        $scope.userAllBookList = response.data.user_all_book_list;
    });
    $scope.deleteUsersBook = function (id) {
         $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'user_books/delete_book',
            data: $.param({id: id, userId: $scope.userId})
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.userAllBookList = response.data.user_all_book_list;
            $scope.loading = false;
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});
app.controller('add_edit_user_books', function ($scope, $routeParams, $location, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
    $scope.userBooks = [];
    $scope.userId = $routeParams.userId;
    $scope.rowId = $routeParams.rowId;
    $scope.msg = null;
    $scope.errmsg = false;
    $scope.succesmsg = false;
    $scope.hideSubmitBtn = true;
    $scope.submtBtnValue = $routeParams.rowId ? 'Update' : 'Add';
    $scope.data = [];
    $scope.hideAddRowBtn = $routeParams.rowId ? true : false;
    $scope.loading = false;
    if ($routeParams.rowId) {
        $scope.loading = true;
        $http({
            method: 'POST',
            url: base_url + 'user_books/user_book_details',
            data: $.param({rowId: $scope.rowId})
        }).then(function (response) {
            $scope.loading = false;
            $scope.submtBtnValue = 'Update';
            $scope.hideSubmitBtn = false;
            $scope.rowId = response.data.user_book_details.id;
            var dataObj = {
                id: response.data.user_book_details.route_books_id,
                name: response.data.user_book_details.name,
                isbn: response.data.user_book_details.isbn,
                author: response.data.user_book_details.author,
                created_on: response.data.user_book_details.created_on,
                row_id: response.data.user_book_details.id,
                user_id: response.data.user_book_details.user_id
            };
            $scope.userBooks = [{book: dataObj}];
        });
    }
    $http({
        method: 'POST',
        url: base_url + 'user_books/get_user_details',
        data: $.param({id: $scope.userId})
    }).then(function (response) {
        $scope.user_details = response.data.user_details;
    });
    $http({
        method: 'POST',
        url: base_url + 'books/get_books',
    }).then(function (response) {
        $scope.bookList = response.data.book_lists;
    });
    $scope.AddRow = function () {
        $scope.hideSubmitBtn = false;
        $scope.userBooks.push({});
    };
    $scope.RemoveRow = function (i) {
        $scope.hideSubmitBtn = ($scope.userBooks.length === 1 ? true : false);
        $scope.userBooks.splice(i, 1);
    };
    $scope.onSubmitBookForm = function () {
        $scope.loading = true;
        $scope.data.push($scope.userId);
        $scope.data.push($scope.userBooks);
        $scope.data.push($scope.rowId);
        $http({
            method: 'POST',
            url: base_url + 'user_books/add_update_user_books',
            data: $scope.data
        }).then(function (response) {
            $scope.errmsg = response.data.success ? false : true;
            $scope.succesmsg = response.data.success ? true : false;
            $scope.msg = response.data.msg;
            $scope.userBooks = [];
            $scope.submtBtnValue = $routeParams.rowId ? 'Update' : 'Add';
            $scope.data = [];
            $scope.hideSubmitBtn = false;
            $scope.hideAddRowBtn = $routeParams.rowId ? true : false;
            $scope.rowId = response.data.user_book_details.id;
            var dataObj = {
                id: response.data.user_book_details.route_books_id,
                name: response.data.user_book_details.name,
                isbn: response.data.user_book_details.isbn,
                author: response.data.user_book_details.author,
                created_on: response.data.user_book_details.created_on,
                row_id: response.data.user_book_details.id,
                user_id: response.data.user_book_details.user_id
            };
            $scope.userBooks = [{book: dataObj}];
            $scope.loading = false;
        });
    };
    $scope.formatDate = function (date) {
        var dateOut = new Date(date);
        return dateOut;
    };
});