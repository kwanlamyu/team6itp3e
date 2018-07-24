<?php
session_start();
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '1') {
    require_once '../db_connection/db.php';
    include '../general/header.php';
    include '../general/navigation_superadmin.php';

// Retrieve all of the registered coupon code 
    $select = $DB_con->prepare("SELECT * FROM coupon");
    $select->execute();
    $couponCode = $select->fetchAll();

    print_r($couponCode);
    echo "<br>";

    if (isset($_POST['coupon'])) {
        $inputCouponCode = $_POST['couponCode'];

        if ($inputCouponCode == "") {
            $error[] = "Please enter a coupon code. ";
        }

        // Retrieve all of the registered coupon code 
        $select = $DB_con->prepare("SELECT * FROM coupon");
        $select->execute();
        $couponCode = $select->fetchAll();

        if (empty($error)) {
            $match = array();
            $noMatch = array();

            foreach ($couponCode as $dbCode) {
                foreach ($dbCode as $k => $v) {
                    if ($k == "code") {
                        if ($v == $inputCouponCode) {
                            array_push($match, "Yes match!");
                        }
                    }
                }
            }
        }

        if (!empty($match)) {
            // Retrieve the number of uses from database 
            foreach ($couponCode as $dbCode) {
                foreach ($dbCode as $k => $v) {
                    if ($v == $inputCouponCode) {
                        $string = $dbCode[4];
                        $max = $dbCode[3];
                    }
                }
            }

            $string = $string + 1;

            if ($string > $max) {
                echo "Max times used! <br>";
            } else if ($string <= $max) {
                // Insert into database 
                $updateCoupon = $DB_con->prepare("UPDATE coupon
                                        SET numberOfUses = :numOfUses
                                        WHERE code = :code");
                $updateCoupon->bindParam(':code', $inputCouponCode);
                $updateCoupon->bindParam(':numOfUses', $string);
                $updateCoupon->execute();

                header("Location: coupon.php?match");
            }
        } else {
            header("Location: coupon.php?nomatch");
        }
    }
    ?>

    <html>
        <body>
            <form name='usingCoupon' method='post'>
                Coupon Code:
                <input type="text" name="couponCode">

                <input type="submit" name="coupon" value="Apply">

                <br><br>

                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo $error . "<br>";
                    }
                } else if (isset($_GET['match'])) {
                    echo "Coupon code match! <br>";
                } else if (isset($_GET['nomatch'])) {
                    echo "Please enter a valid coupon code! <br>";
                }
                ?>

            </form> 
        </body>
    </html>

    <?php
//include footer and footer content
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '2') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>