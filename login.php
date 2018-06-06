<div>
    <h1>
        Login
    </h1>
</div>

<div>
    <form action="login_validation.php" id="login" name="login" method="POST">
        <div class="form-group">
            <label for="userid">Username</label>
            <input type="text" class="form-control" id="userid" name="username" placeholder="Enter you username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <button id="logBtn" type="submit" name="loginbtt"  class="btn"><span class="fa fa-sign-in fa-fw" aria-hidden="true"></span> Login</button>

        <div class="form-group">
            <p><a href="forgotPassword.php">Forgot Password</a></p>
        </div>

        <div class="form-group">
            <p>Don't have an account? <a href="registration.php"> Sign-up here</a></p>
        </div>

    </form>
</div>