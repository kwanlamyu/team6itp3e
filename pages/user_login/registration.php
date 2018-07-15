<?php include '../general/header.php'; ?>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2 m-login--signup" id="m_login" style="background-image: url(../../assets/app/media/img/bg/login.jpg);">
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
                    </div>

                    <form id="registerStudent" class="m-login__form m-form" name="registration" action="registration.php" method="POST">
                        <?php include('register_validation.php'); ?>

                        <div class="form-group m-form__group">
                            <!--<label for="fullname">Username</label>-->
                            <input type="text" class="form-control m-input" id="fullname" name="fullname" placeholder="Enter a username" <?php
                            if (!empty($_POST['fullname'])) {
                                echo "value=\"" . $_POST["fullname"] . "\"";
                            }
                            ?>>
                            <span class="error"><?php echo $unameErr; ?></span>
                        </div>

                        <div class="form-group m-form__group">
                            <!--<label for="email">Email</label>-->
                            <input type="email" class="form-control m-input" id="email" name="email" placeholder="Enter your email" <?php
                            if (!empty($_POST['email'])) {
                                echo "value=\"" . $_POST["email"] . "\"";
                            }
                            ?>>
                            <span class="error"><?php echo $emailErr; ?></span>
                        </div>

                        <div class="form-group m-form__group">
                            <!--<label for="regpassword">Password</label>-->
                            <input type="password" class="form-control m-input" id="regpassword" name="regpassword" placeholder="Password">
                            <span class="error"><?php echo $passErr; ?></span>
                            <span class="error"><?php echo $twopassErr; ?></span>
                        </div>

                        <div class="form-group m-form__group">
                            <!--<label for="regcpassword">Confirm Password</label>-->
                            <input type="password" class="form-control m-input" id="regcpassword" name="regcpassword" placeholder="Retype Password">
                            <span class="error"><?php echo $cpassErr; ?></span>
                            <span class="error"><?php echo $twopassErr; ?></span>
                        </div>

                        <!--                        <div class="form-group">
                                                    <label for="companyname">Company Name</label>
                                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name">
                                                    <span class="error"><?php echo $companynameErr; ?></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="uennumber">UEN/ACRA Number</label>
                                                    <input type="text" class="form-control" id="uennumber" name="uennumber" placeholder="UEN Number">
                                                    <span class="error"><?php echo $uennumberErr; ?></span>
                                                </div>-->



                        <div class="form-group m-form__group m-login__form-sub">
                            <p style="text-align: center;">By clicking Register, you agree to our <a href="#" data-toggle="modal" data-target="#m_modal_2">Terms and Conditions</a> and have read our <a href="#" data-toggle="modal" data-target="#m_modal_3">Data Use Policy</a></p>
                        </div>

                        <div class="m-login__form-action">
                            <button type="submit" name="m_login_signup_submit" id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn"> Register </button>
                        </div>
                        <div class="form-group m-form__group m-login__form-sub">
                            <p style="text-align: center;">Already have an account? <a href="login.php" class="">Login here</a></p>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--begin::T&C Modal -->
    <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Terms & Conditions
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sociis natoque penatibus et magnis. Mattis pellentesque id nibh tortor id aliquet. Tellus molestie nunc non blandit massa enim nec. Arcu dictum varius duis at.
                    </p>
<!--                    <p>
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
                    </p>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <!--                    <button type="button" class="btn btn-primary">
                                            Save changes
                                        </button>-->
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin:: Data Use Policy Modal-->
    <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Data Use Policy
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
<!--                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sociis natoque penatibus et magnis. Mattis pellentesque id nibh tortor id aliquet. Tellus molestie nunc non blandit massa enim nec. Arcu dictum varius duis at.
                    </p>-->
                    <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                    </p><!--
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
                    </p>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <!--                    <button type="button" class="btn btn-primary">
                                            Save changes
                                        </button>-->
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <?php include '../general/footer.php'; ?>


