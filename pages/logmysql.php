<?php
require_once 'lib.php';
?>
<p>
    <a type="button" href="index.php?id=users" class="btn btn-info">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</p>
<?php
// This page, lists `mysql_general_log` table contents,
// Which is a table inside app database which mirrors some
// rows of MySQL server's general logs table.
// For more details on this operations, please refer to
// related deamon service.
// $entry is the username that passed to this page to review
// a user activity.
if (isset($_GET['entry']))
{
    $username = $_GET['entry'];
    $query = "
    SELECT * FROM mysql_general_log WHERE user_host LIKE '%[" . $username . "]%'
    ";
    SuperLiteSql::createTable_from_sql_select_query($conn, $query);
}
?>