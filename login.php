<html>
    <head>
        <meta charset="utf-8" />
        <title>
            Login | 3E Accounting
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
                    <form action="login_validation.php" id="login" name="login" method="POST">
                        <div class="row">
                            <h3 class="formhead">Login</h3>
                        </div>
                        
                        <div class="row">
                            <img class="logo" src="Images/3E Accounting logo 400x400.png" alt="3E Accounting"/>
                        </div>
                        <div class="form-group">
                            <label for="userid">Username</label>
                            <input type="text" class="form-control" id="userid" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <p><a href="forgotPassword.php">Forgot Password</a></p>
                        </div>
                        <br>
                        <button id="logBtn" type="submit" name="loginbtt"  class="btn btn-primary col-lg-12"><span class="fa fa-sign-in fa-fw" aria-hidden="true"></span> Login</button>
                        <hr>
                        <div class="form-group">
                            <p>Don't have an account? <a href="registration.php"> Sign-up here</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </body>
    <footer>

    </footer>
</html>