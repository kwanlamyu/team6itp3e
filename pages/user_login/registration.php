<!--<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<div>
    <h1>
        Registration
    </h1>
</div>-->

<?php include '../general/header.php'; ?>
<body>
    <div class="row">
        <div class="container">
            <br>
        </div>
    </div>

    <!--<div class="row offset-lg-4">-->
    <!--<div class="card">-->
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

                <form id="registerStudent" class="m-login__form m-form" name="registration" action="register_validation.php" method="POST">
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
                        <input type="password" class="form-control m-input" id="regcpassword" name="regcpassword" placeholder="Password">
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
                        <p style="text-align: center;">By clicking Register, you agree to our <a href="#" class="">Terms and Conditions</a> and have read our <a href="#" class="">Data Use Policy</a></p>
                    </div>
                    
                    <div class="m-login__form-action">
                        <button type="submit" name="m_login_signup_submit" id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn"> Register </button>
                    </div>
                    <div class="form-group m-form__group m-login__form-sub">
                        <p style="text-align: center;">Already have an account? <a href="index.php" class="">Login here</a></p>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!--</div>
    </div>-->
    
<?php include '../general/footer.php'; ?>


