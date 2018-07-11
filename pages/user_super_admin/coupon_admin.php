<?php include '../general/header.php';?>
<?php include '../general/navigation_superadmin.php';?>
<?php
require_once '../user_super_admin/db.php';

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
        
        //header("Location: ../user_super_admin/coupon_admin.php?inserted");
    }
}
?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Financial Statement
								</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">
										-
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">
												Generate Report
											</span>
										</a>
									</li>
									<li class="m-nav__separator">
										-
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">
												Financial Statement
											</span>
										</a>
									</li>
								</ul>
								
							</div>
							</div>
						</div>
						
						
						
							<!--begin::Portlet-->
							<div class="m-content">
							<div class="row">
							<div class="col-lg-12"> 
							<div class="m-portlet m-portlet--tab">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon m--hide">
												<i class="la la-gear"></i>
											</span>
											<h3 class="m-portlet__head-text">
												Create Coupon
											</h3>
										</div>
									</div>
								</div>
								<!--begin::Form-->
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
            } else if(isset($_GET['inserted'])) {
                echo "Generated a coupon code successfully! ";
            }
            ?>


        </form> 
								<!--end::Form-->
							</div>
							</div>
							</div>
							</div>
							<!--end::Portlet-->
					</div>
					<!-- END: Subheader -->
    </div>



	<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>