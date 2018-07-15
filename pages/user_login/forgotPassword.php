<?php include '../general/header.php'; ?>
<!-- end::Body -->
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2 m-login--forget-password" id="m_login" style="background-image: url(../../assets/app/media/img/bg/login.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img alt="" src="../../assets/app/media/img/logos/logo.png" height="100px"/>
                        </a>
                    </div>
                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Forgotten Password ?
                            </h3>
                            <div class="m-login__desc">
                                Enter your email to reset your password:
                            </div>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">
                                    Request
                                </button>
                                &nbsp;&nbsp;
                                <button type="button" onclick="location.href ='login.php'" id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../general/footer.php'; ?>