<?php
require_once 'db_coupon.php';

if (isset($_POST['registerCoupon'])) {
    $type = $_POST['couponType'];
    $value = $_POST['value'];
    $maxUse = $_POST['maxUse'];

    if ($type == "") {
        $error[] = "Please select a coupon type. ";
    }

    if ($value == "") {
        $error[] = "Please enter a discount value / percentage. ";
    }

    if (!is_numeric($value) || !is_numeric($maxUse)) {
        $error[] = "Please enter a valid number. ";
    }

    if ($maxUse == "") {
        $error[] = "Please enter the maximum number of uses. ";
    }

    // Generate the coupon code
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $result = "";
    for ($i = 0; $i < 6; $i++) {
        $result .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    // Retrieve all of the registered coupon code
    $select = $DB_con->prepare("SELECT code FROM coupon");
    $select->execute();
    $couponCode = $select->fetchAll();

    if (empty($error)) {
        foreach ($couponCode as $array) {
            foreach ($array as $dbCode) {
                if ($dbCode == $result) {
                    // Generate coupon code if exist
                    $result = "";
                    for ($i = 0; $i < 6; $i++) {
                        $result .= $chars[mt_rand(0, strlen($chars) - 1)];
                    }
                }
            }
        }

        // Default value
        $recurring = 0;
        $numberOfUses = 0;

        // Insert into database
        $insertCoupon = $DB_con->prepare("INSERT INTO coupon (code, recurring, maxUses, numberOfUses, value, couponType_id) VALUES(:code, :recurring, :maxUses, :numberOfUses, :value, :couponType_id);");
        $insertCoupon->bindParam(':code', $result);
        $insertCoupon->bindParam(':recurring', $recurring);
        $insertCoupon->bindParam(':maxUses', $maxUse);
        $insertCoupon->bindParam(':numberOfUses', $numberOfUses);
        $insertCoupon->bindParam(':value', $value);
        $insertCoupon->bindParam(':couponType_id', $type);
        $insertCoupon->execute();
    }
}
?>

<html>
    <body>
        <form name='couponForm' method='post'>
            Type of coupon:
            <select name="couponType">
                <option value="1">Fixed Price</option>
                <option value="2">Percentage</option>
            </select>
            <br>
            Value:
            <input type="text" name="value">
            <br>
            Maximum number of uses:
            <input type="text" name="maxUse">
            <input type="submit" name="registerCoupon" value="Submit">

            <br><br>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo $error . "<br>";
                }
            } else {
                echo "Generated a coupon code successfully! ";
            }
            ?>


        </form>
    </body>
</html>
