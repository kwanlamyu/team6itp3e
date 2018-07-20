
<?php require_once '../db_connection/db.php';?>

<?php
	$select = $DB_con->prepare("SELECT * FROM user
	WHERE role_id=3;");
	$select->execute();
	$rows = array();
	while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
		$rows[] = $result;
	}

?>
{"meta": {
        "page": 1,
        "pages": 1,
        "perpage": -1,
        "sort": "asc",
        "field": "username"
    },
    "data":<?php echo json_encode($rows);?>} 