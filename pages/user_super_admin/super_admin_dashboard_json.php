
<?php require_once '../db_connection/db.php';?>

<?php
	$select = $DB_con->prepare("SELECT * FROM user WHERE role_id = 2 AND companyName='".$_SESSION['company']."'");
	$select->execute();
	$rows = array();
	while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
		$rows[] = $result;
	}
	
	$result = $DB_con->prepare("SELECT COUNT(*) FROM user WHERE role_id = 2"); 
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