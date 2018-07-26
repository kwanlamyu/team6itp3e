
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
	AND usermanageaccount.account_user_username = '$userID'");
	
	$select->execute();
	$rows = array();
	$uniqueCompanies = array();
	while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
		$rows[] = $result;
		echo $result['accountManagers'];
	}
	
	
	for ($i = 0; $i < count($rows);$i++){
		if (!in_array($rows[$i]['UEN'],$uniqueCompanies)){
			array_push($uniqueCompanies,$rows[$i]['UEN']);
		}
	}
	
	$finalData = array();
	for ($i = 0; $i < count($uniqueCompanies); $i++){
		$accountants = "";
		$uenNo;
		$nameCompany;
		$fileNo;
		for ($x = 0; $x < count($rows); $x++){
			if (strcasecmp($rows[$i]['UEN'],$uniqueCompanies[$i]) === 0){
				if (strlen($accountants) > 0){
					$accountants .= ",";
				}
				$accountants .= $rows[$i]['accountManagers'];
				$uenNo = $rows[$i]['UEN'];
				$nameCompany = $rows[$i]['companyName'];
				$fileNo = $rows[$i]['fileNumber'];
			}
		
		}
		$finalData[$i]['UEN'] = $uenNo;
		$finalData[$i]['companyName'] = $nameCompany;
		$finalData[$i]['accountManagers'] = $accountants;
		$finalData[$i]['fileNumber'] = $fileNo;
		
	}
	$userID = $_SESSION['username'];
	$query = "SELECT COUNT(*) FROM account WHERE user_username ='".$userID."'";
	$result = $DB_con->prepare($query); 
	$result->execute(); 
	$number_of_rows = count($finalData); 


?>
{"meta": {
        "page": 1,
        "pages": 3,
        "perpage": 5,
		"total":<?php echo json_encode($number_of_rows);?>,
		"sort":"asc",
		"field":"username"
		
    },
	
	"data":<?php echo json_encode($finalData);?>}