
<?php require_once '../db_connection/db.php';?>

<?php
$userID= $_SESSION['username'];
	$select = $DB_con->prepare("SELECT account.UEN AS UEN, 
	account.companyName AS companyName,  
	account.fileNumber AS fileNumber, 
	usermanageaccount.user_username 
	AS accountManagers 
	FROM account 
	INNER JOIN usermanageaccount 
	ON account.UEN = usermanageaccount.account_UEN 
	AND usermanageaccount.user_username = '$userID'");
	
	$select->execute();
	$rows = array();
	while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
		$rows[] = $result;
	}
	$userID = $_SESSION['username'];
	$query = "SELECT COUNT(*) FROM usermanageaccount WHERE user_username ='".$userID."'";
	$result = $DB_con->prepare($query); 
	$result->execute(); 
	$number_of_rows = $result->fetchColumn(); 


?>
{"meta": {
        "page": 1,
        "pages": 3,
        "perpage": 5,
		"total":<?php echo json_encode($number_of_rows);?>,
		"sort":"asc",
		"field":"username"
		
    },
	
	"data":<?php echo json_encode($rows);?>}