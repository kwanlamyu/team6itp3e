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
                    
                    <div class="m-login__signup">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Sign Up
                            </h3>
                            <div class="m-login__desc">
                                Enter your details to create your account:
                            </div>
                        </div>
                        <?php include('../user_login/register_validation.php'); ?>
                        <form id="register" name="registration" class="m-login__form m-form" action="register_validation.php" method="POST">
                            <?php // include('../user_login/register_validation.php'); ?>

                            <div class="form-group m-form__group">
                                <input class="form-control m-input" id="fullname" type="text" placeholder="Fullname" name="fullname" <?php
                                if (!empty($_POST['fullname'])) {
                                    echo "value=\"" . $_POST["fullname"] . "\"";
                                }
                                ?>>
                                <span class="error"><?php echo $unameErr; ?></span>
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" autocomplete="off" <?php
                                if (!empty($_POST['email'])) {
                                    echo "value=\"" . $_POST["email"] . "\"";
                                }
                                ?>>
                                <span class="error"><?php echo $emailErr; ?></span>
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" id="regpassword" type="password" placeholder="Password" name="password">
                                <span class="error"><?php echo $passErr; ?></span>
                                <span class="error"><?php echo $twopassErr; ?></span>
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" id="regcpassword" type="password" placeholder="Confirm Password" name="rpassword">
                                <span class="error"><?php echo $cpassErr; ?></span>
                                <span class="error"><?php echo $twopassErr; ?></span>
                            </div>
                            <div class="row form-group m-form__group m-login__form-sub">
                                <div class="col m--align-left">
                                    <label class="m-checkbox m-checkbox--focus">
                                        <input type="checkbox" name="agree">
                                        I Agree the
                                        <a href="#" class="m-link m-link--focus" data-toggle="modal" data-target="#m_modal_2">
                                            terms and conditions
                                        </a>
                                        .
                                        <span></span>
                                    </label>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button type="submit" id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
                                    Sign Up
                                </button>
                                &nbsp;&nbsp;
                                <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Modal title
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    <script>
    jQuery(document)
    .ready(function() {
        var s = $("#m_login");
        s.addClass("m-login--signup")
    });
    </script>
    <?php include '../general/footer.php'; ?>
