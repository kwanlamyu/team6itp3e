<?php include '../db_connection/conn.php';?>

<?php include '../general/header.php';?>

<?php include '../general/navigation_superadmin.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<div class="container">
	<input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search Words">

    <table id="userTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Company Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM account";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["UEN"]."</td>";
                    echo "<td>".$row["companyName"]."</td>";
                    echo "<td><button type=\"button\" class=\"btn btn-danger\">Delete</button></td>";
					echo "</tr>";
                }
            } else {
                echo "<tr> No Results Found </tr>";
            }
            $conn->close();
        ?>
        </tbody>
    </table>
	<form method="post" action="export.php">
		<input type="submit" name="export" value="CSV Export"/>
	</form>
</div>

<script language='javascript'>
	function filterTable() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("userTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
		var tds = tr[i].getElementsByTagName("td");
        var firstCol = tds[0].textContent.toUpperCase();
        var secondCol = tds[1].textContent.toUpperCase();
        if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }

	}
</script>


<?php include 'footer.php';?>
