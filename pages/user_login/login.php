<?php include '../general/header.php'; ?>
<!-- end::Body -->
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../../assets/app/media/img/bg/login.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img alt="" src="../../assets/app/media/img/logos/logo.png" height="100px"/>
                        </a>
                    </div>
                    <div class="m-login__signin">
                        <form class="m-login__form m-form" action="login.php" id="login" name="login" method="POST">
                            <?php include 'login_validation.php';?>
                            <div class="form-group m-form__group">
                                <!--<label for="userid">Username</label>-->
                                <input type="text" class="form-control" id="userid" name="username" placeholder="Username" autocomplete="off">
                                <span class="error"><?php echo $unameErr; ?></span>
                            </div>
                            <div class="form-group m-form__group">
                                <!--<label for="password">Password</label>-->
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span class="error"><?php echo $passErr; ?></span>
                            </div>
<!--                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--focus">
                                        <input type="checkbox" name="remember">
                                        Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="forgotPassword.php" id="m_login_forget_password" class="m-link">
                                        Forget Password ?
                                    </a>
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Forget Password ?
                                </a>
                                </div>
                            </div>-->
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit" type="submit" name="m_login_signin_submit"  class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                    LOGIN
                                </button>
                            </div>
<!--                            <div class="form-group">
                                <p>Don't have an account? <a href="registration.php"> Sign-up here</a></p>
                            </div>-->

                        </form>
                    </div>
                    <div class="m-login__account">
                        <span class="m-login__account-msg">
                            Don't have an account yet ?
                        </span>
                        &nbsp;&nbsp;
                        <a href="registration.php" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                            Sign Up
                        </a>
<!--                        <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                            Sign Up
                        </a>-->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <?php include '../general/footer.php'; ?>