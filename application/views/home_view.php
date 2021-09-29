<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login/Register Modal by Creative Tim</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <style>body{padding-top: 60px;}</style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"  crossorigin="anonymous">
        <link href="assets/css/login-register.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in</a>
                    <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></div>
                <div class="col-sm-4"></div>
            </div>


            <div class="modal fade login" id="loginModal">
                <div class="modal-dialog login animated">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Login with</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <div class="content">
                                    <div class="social">
                                        <a class="circle github" href="#">
                                            <i class="fa fa-github fa-fw"></i>
                                        </a>
                                        <a id="google_login" class="circle google" href="#">
                                            <i class="fa fa-google-plus fa-fw"></i>
                                        </a>
                                        <a id="facebook_login" class="circle facebook" href="#">
                                            <i class="fa fa-facebook fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="division">
                                        <div class="line l"></div>
                                        <span>or</span>
                                        <div class="line r"></div>
                                    </div>
                                    <div class="alert" id="error_msg">
                                        <?php
                                        if ($this->session->flashdata('msg')) {
                                            echo $this->session->flashdata('msg');
                                        }
                                        ?>
                                    </div>
                                    <div class="form loginBox">
                                        <form method="" action="" accept-charset="UTF-8" id="logInForm">
                                            <input type="text" class="txt_csrfname hidden" name="<?php echo$this->security->get_csrf_token_name(); ?>" value='<?php echo $this->security->get_csrf_hash(); ?>'>
                                            <input id="email" class="form-control" type="email" placeholder="Email" name="email" required="">
                                            <input id="password" class="form-control" type="password" placeholder="Password" required="" name="password" autocomplete="off">
                                            <input class="btn btn-default btn-login" type="button" value="Login" onclick="loginAjax()">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="content registerBox" style="display:none;">
                                    <div class="form">
                                        <form method="" id="signInForm" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                                            <input type="text" class="txt_csrfname hidden" name="<?php echo$this->security->get_csrf_token_name(); ?>" value='<?php echo $this->security->get_csrf_hash(); ?>'>
                                            <input id="remail" class="form-control" type="email" placeholder="Email" name="remail">
                                            <input id="rpassword" class="form-control" type="password" placeholder="Password" name="rpassword" autocomplete="off">
                                            <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation" autocomplete="off">
                                            <input class="btn btn-default btn-register" type="button" value="Create account" name="commit" onclick="registerAjax()">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="forgot login-footer">
                                <span>Looking to
                                    <a href="javascript: showRegisterForm();">create an account</a>
                                    ?</span>
                            </div>
                            <div class="forgot register-footer" style="display:none">
                                <span>Already have an account?</span>
                                <a href="javascript: showLoginForm();">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"  integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"  crossorigin="anonymous"></script>
    <script src="assets/js/login-register.js" type="text/javascript"></script>
    <script type="text/javascript">
                                                $(document).ready(function () {
                                                    openLoginModal();
                                                });
    </script>
</html>
