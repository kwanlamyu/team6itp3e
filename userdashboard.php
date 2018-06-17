<?php include 'conn.php';?>

<?php include 'header.php';?>

<?php include 'navigation_superadmin.php';?>

<div class="container">
    <table class="table table-striped">
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
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php';?>