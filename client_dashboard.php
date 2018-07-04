<?php include 'header.php'; ?>
<body>
    <div>
        <h1>
            Client Admin Dashboard
        </h1>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
        <button id="createAccountant" type="button" onClick="location.href = 'create_accountant.php';" name="createAccountant"  class="btn btn-success"><i class="fas fa-user-plus"></i> Create Accountant </button>
        <button id="editAccountant" type="button" onClick="location.href = 'edit_accountant.php';" name="editAccountant"  class="btn btn-warning"><i class="fas fa-user-edit"></i> Edit Accountant Details </button>
        <button id="deleteAccountant" type="button" onClick="location.href = 'delete_accountant.php';" name="deleteAccountant"  class="btn btn-danger"><i class="fas fa-user-minus"></i> Delete Accountant </button>

            </div>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>