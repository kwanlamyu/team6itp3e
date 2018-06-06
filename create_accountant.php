<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<div>
    <h1>Create Accountant</h1>    
</div>

<div>
    <form id="createAccountant" name="createAccountant" action="create_accountant.php" method="POST">
        <?php include('accountant_validation.php'); ?>

        <div class="form-group">
            <label for="accountantid">Username</label>
            <input type="text" class="form-control" id="accountantid" name="accountantid" placeholder="Enter a username" <?php
            if (!empty($_POST['accountantid'])) {
                echo "value=\"" . $_POST["accountantid"] . "\"";
            }
            ?>>
            <span class="error"><?php echo $unameErr; ?></span>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Accountant's email" <?php
            if (!empty($_POST['email'])) {
                echo "value=\"" . $_POST["email"] . "\"";
            }
            ?>>
            <span class="error"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <label for="accountantpassword">Password</label>
            <input type="password" class="form-control" id="accountantpassword" name="accountantpassword" placeholder="Password">
            <span class="error"><?php echo $passErr; ?></span>
            <span class="error"><?php echo $twopassErr; ?></span>
        </div>

        <div class="form-group">
            <label for="accountantcpassword">Confirm Password</label>
            <input type="password" class="form-control" id="accountantcpassword" name="accountantcpassword" placeholder="Confirm Password">
            <span class="error"><?php echo $cpassErr; ?></span>
            <span class="error"><?php echo $twopassErr; ?></span>
        </div>



        <!--    <div class="form-group">
                <p>By clicking Register, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Data Use Policy</a></p>
            </div>-->

        <button type="submit" name="createButton" id="createButton" class="btn btn-log" ><span class="fa fa-handshake-o fa-fw" aria-hidden="true"></span> Create Accountant Account </button>

        <!--    <div class="form-group">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>-->

    </form>
</div>