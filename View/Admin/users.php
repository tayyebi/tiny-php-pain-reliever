<?php
// require lib to allow create dynamic tables
require_once 'lib.php';

// Note: $servername is MySQL server, passwed from admin.php

// If data was posted (any button clicked)
if (isset($_POST['update'])) // update user
{
    if (isset($_POST['Password']) && isset($_POST['Confirm']))
        if ($_POST['Password'] == $_POST['Confirm'] && $_POST['Password'] != "")
        {
            $update_user_query = " ALTER USER '" . $_POST['Username'] . "'@'$servername' IDENTIFIED BY '" . $_POST['Password'] . "';";
            // OR: UPDATE mysql.user SET user='newusername',
            // password=PASSWORD('newpassword') WHERE user='root';

            mysqli_query($conn, $update_user_query);
        }
}
else if (isset($_POST['insert'])) // create user
{
    if (isset($_POST['Password']) && isset($_POST['Confirm']))
        if ($_POST['Password'] == $_POST['Confirm'])
        {
            $create_user_query = "CREATE USER '" . $_POST['Username'] . "'@'$servername' IDENTIFIED BY '" . $_POST['Password'] . "';";
            mysqli_query($conn, $create_user_query);
        }

}
else if (isset($_POST['delete'])) // delete user
{
    $drop_user_query = "DROP USER '" . $_POST['Username'] . "'@'$servername';";
    mysqli_query($conn, $drop_user_query);
}

if (isset($_POST['update']) || isset($_POST['insert']))
{    
    // Revoke all permissions
    $permissions_query = "";
    $permissions_query .= "GRANT EXECUTE ON *.* TO '" . $_POST['Username'] . "'@'$servername';";
    $permissions_query .= "REVOKE ALL, GRANT OPTION FROM '" . $_POST['Username'] . "'@'$servername';";

    // Add selected permissions
    foreach($_POST as $key => $value){
        $exp_key = explode('_', $key);
        if ($exp_key[0] == "Permission")
            if ($value == "on")
                $permissions_query .= "GRANT " . $exp_key[1] . " ON $dbname." . $exp_key[2] . " TO '" . $_POST['Username'] . "'@'$servername';";
    }

    // Allow login ):)
    $permissions_query .= "GRANT EXECUTE ON *.* TO '" . $_POST['Username'] . "'@'$servername';";
    
    // Flush Privs
    $permissions_query .= "FLUSH PRIVILEGES;";
 
    // Execute the permissions query
    mysqli_multi_query($conn, $permissions_query);

    do // Flush multi_queries in loop
    {
        // Store first result set
        if ($flusher_result=mysqli_store_result($conn))
        {
            // Fetch one and one row
            while ($flush_row=mysqli_fetch_row($flusher_result))
            {
                ;
            }
            // Free result set
            mysqli_free_result($flusher_result);
        }
    }
    while (@mysqli_next_result($conn));

    
    //  TODO: MAYBE: SHOW GRANTS username;
}


// query to select users from MySQL tables
$query ='
select
CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=users&entry=\', User , \'">\', \'Edit\', \'</a>\') as Edit,
CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=logmysql&entry=\', User , \'">\', \'Log\', \'</a>\') as Log,
Host,
User \'Username\',
Create_user_priv \'Permission to create users\',
Update_priv \'Global update privilage\',
Delete_priv \'Global delete privilage\',
password_last_changed \'Password last changed\'
from mysql.user
';

// Parse query result to HTML table
SuperLiteSql::createTable_from_sql_select_query($conn, $query);

// Modal Trigger
// In some cases, modal opens without button click
if (!isset($_GET['new']))
{
    echo '
    <a class="btn btn-danger" href="admin.php?id=users&new">
    New *
    </a>';
}
else
{
    echo '<a class="btn btn-danger" data-toggle="modal" data-target="#basicExampleModal">
    New *
    </a>';
}


$Username = isset($_GET['entry']) ? $_GET['entry'] : "";
$Permission_Transactions = "checked";
$Permission_Devices = "checked";

?>

<!-- Modal for user details input -->
<div class="modal fade <?php echo (
    (
        isset($_GET['new']) ||
        isset($_GET["entry"])
    )? 'show' : ''); ?>" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="admin.php?id=users" class="gordarg-form" method="post">
                    
                <div class="form-group"><div class="md-form">
                    Username
                    <input <?php echo isset($_GET["entry"]) ? "readonly" : "" ?> class="form-control" type="text" name="Username" value="<?php echo $Username ?>">
                </div></div>


                Permissions:
                <?php
                $query = "SELECT TABLE_NAME as `TABLE`
                ,CONCAT('<input class=\"form-control\" type=\"checkbox\" name=\"Permission_SELECT_',TABLE_NAME,'\" />') as 'SELECT'
                ,CONCAT('<input class=\"form-control\" type=\"checkbox\" name=\"Permission_INSERT_',TABLE_NAME,'\" />') as 'INSERT'
                ,CONCAT('<input class=\"form-control\" type=\"checkbox\" name=\"Permission_UPDATE_',TABLE_NAME,'\" />') as 'UPDATE'
                ,CONCAT('<input class=\"form-control\" type=\"checkbox\" name=\"Permission_DELETE_',TABLE_NAME,'\" />') as 'DELETE'
                FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='$dbname'";
                SuperLiteSql::createTable_from_sql_select_query($conn, $query);
                ?>

                <hr/>
                
                Note: If you don't want to change password,
                do not fill out the following inputs.

                <div class="form-group"><div class="md-form">
                    Password
                    <input class="form-control" type="password" name="Password" value="">
                </div></div>

                <div class="form-group"><div class="md-form">
                    Confirm    
                    <input class="form-control" type="password" name="Confirm" value="">
                </div></div>

                <?php

                if (isset($_GET['new']))
                {
                    echo "<input name='insert' type='submit' value='Insert' class='btn btn-primary btn-sm m-4'>";
                }
                else if (isset($_GET["entry"]))
                {
                    echo "<input name='update' type='submit' value='Update' class='btn btn-warning btn-sm m-4'>";
                    echo "<input name='delete' type='submit' value='Delete' class='btn btn-danger btn-sm m-4'>";
                    echo "<a href=\"admin.php?id=users\" class='btn btn-default pink darken-1 btn-sm m-4'>Cancel</a>";                
                }
                ?>

                </form>
            </div>
		</div>
    </div>
</div>