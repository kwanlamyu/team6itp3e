<html>
    <head>
        <meta charset="utf-8" />
        <title>
            Register | 3E Accounting
        </title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

        <!-- Custon CSS for Login and Registration pages -->
        <link href="Login-Registration.css" rel="stylesheet" type="text/css"/>
        
<!--        <style>
            body{
                align: center;
                background-color: #FFFFFF;
                margin-left: 50px;
                margin-right: 50px;
                padding-left: 20px;
                padding-right: 20px;

            }

            .card{
                box-shadow: 5px 5px 5px #DEDCDE;
                width: 100%;
                margin-left: 10px;
                margin-right: 90px;
                padding-left: 30px;
                padding-right: 70px;
            }

            .logo{
                align: center;
                display: block;
                margin-left: auto;
                margin-right: auto;
                height:260px;
                width: 260px;
            }

            .error {
                color: #FF0000;
            }
            
            .formhead{
                display: block;
                margin-left: auto;
                margin-right: auto;
                font-size: 30px;
                font-family: Open Sans;
            }

        </style>-->
        
    </head>

    <body>
        <div class="row ">
            <div class="container">
                <br>
            </div>
        </div>

        <div class="row offset-lg-1">
            <div class="card">
                <div class="card-body">
                    <form id="registerStudent" name="registration" action="registration.php" method="POST">
                        <?php include('reg_validation.php'); ?>
                        
                        <div class="row">
                            <h3 class="formhead">Registration</h3>
                        </div>
                       
                        <div class="row">
                            <img class="logo" src="Images/3E Accounting logo 400x400.png" alt="3E Accounting"/>
                        </div>

                        <div class="form-group">
                            <label for="reguserid">Username</label>
                            <input type="text" class="form-control" id="reguserid" name="reguserid" placeholder="Enter a username" <?php
                            if (!empty($_POST['reguserid'])) {
                                echo "value=\"" . $_POST["reguserid"] . "\"";
                            }
                            ?>>
                            <span class="error"><?php echo $unameErr; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" <?php
                            if (!empty($_POST['email'])) {
                                echo "value=\"" . $_POST["email"] . "\"";
                            }
                            ?>>
                            <span class="error"><?php echo $emailErr; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="regpassword">Password</label>
                            <input type="password" class="form-control" id="regpassword" name="regpassword" placeholder="Password">
                            <span class="error"><?php echo $passErr; ?></span>
                            <span class="error"><?php echo $twopassErr; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="regcpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="regcpassword" name="regcpassword" placeholder="Password">
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



                        <div class="form-group">
                            <p>By clicking Register, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Data Use Policy</a></p>
                        </div>

                        <button type="submit" name="registerButton" id="registerButton" class="btn btn-primary col-lg-12" ><span class="fa fa-handshake-o fa-fw" aria-hidden="true"></span> Register</button>

                        <div class="form-group">
                            <p>Already have an account? <a href="login.php">Login here</a></p>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>

</html>

