<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title) && !empty($title) ? $title : ''; ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"  crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <script type="text/javascript" charset="utf8" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <style>
            .container{
                max-width: 100% !important;
            }
            #contactListCard{
                margin-top: 100px;
            }
            #error_msg{
                height: 75px;
            }
            .hidden{
                display: none;
            }
            #navbarNavDropdown{
                float: right !important;
                position: relative;
            }
            #logout{
                position: absolute;
                right: 0;
            }
            .dropdown-menu[data-bs-popper] {
                left: 87%;
            }
            .margin-top30px{
                margin-top: 30px;
            }
            .margin_top3px{
                margin-top: 3px;
            }
            #routeNav li{
                display: inline;
                padding: 10px;
            }
            #routeNav li a{
                padding: 10px;
                background-color: #54c36c;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            #loading{
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
            }
        </style>
    </head>
    <body ng-app="learnAngular">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="javascript:void(0)"><?php echo isset($title) && !empty($title) ? $title : ''; ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo isset($user_email) && !empty($user_email) ? $user_email : ''; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="logout">
                        <li><a class="dropdown-item text-center" href="<?php echo base_url('add_book'); ?>">Add Book</a></li>
                        <li><a class="dropdown-item text-center" href="<?php echo base_url('contact'); ?>">Add Contact</a></li>
                        <li><a class="dropdown-item text-center" href="<?php echo base_url('one_page_route'); ?>">One Page Route</a></li>
                        <li><a class="dropdown-item text-center" href="<?php echo base_url(); ?>">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <br>