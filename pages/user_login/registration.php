<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<div>
    <h1>
        Registration
    </h1>
</div>

<form id="register" name="registration" action="registration.php" method="POST">
    <?php include('reg_validation.php'); ?>
    
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
    
    
    
    <div class="form-group">
        <p>By clicking Register, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Data Use Policy</a></p>
    </div>

    <button type="submit" name="registerButton" id="registerButton" class="btn btn-log" ><span class="fa fa-handshake-o fa-fw" aria-hidden="true"></span> Register</button>

    <div class="form-group">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</form>


