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
                <h5>User Management</h5><hr>
                <button id="createAccountant" type="button" onClick="location.href = 'create_accountant.php';" name="createAccountant"  class="btn btn-success"><i class="fas fa-user-plus"></i> Create User </button>
                <button id="editAccountant" type="button" onClick="location.href = 'edit_accountant.php';" name="editAccountant"  class="btn btn-warning"><i class="fas fa-user-edit"></i> Edit User Details </button>
                <button id="deleteAccountant" type="button" onClick="location.href = 'delete_accountant.php';" name="deleteAccountant"  class="btn btn-danger"><i class="fas fa-user-minus"></i> Delete User </button>

            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5>Account Management</h5><hr>
                <button id="createWorkAccount" type="button" onClick="location.href = 'create_work_account.php';" name="createWorkAccount"  class="btn btn-success"><i class="fas fa-plus"></i> Add Account </button>
                <button id="editWorkAccountant" type="button" onClick="location.href = 'edit_work_account.php';" name="editWorkAccountant"  class="btn btn-warning"><i class="fas fa-edit"></i> Edit Account </button>
                <button id="deleteWorkAccountant" type="button" onClick="location.href = 'delete_work_account.php';" name="deleteWorkAccountant"  class="btn btn-danger"><i class="fas fa-minus"></i> Delete Account </button>

            </div>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>