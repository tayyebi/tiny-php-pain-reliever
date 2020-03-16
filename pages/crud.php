<?php
    // This page, will create a table,
    // some forms, and all functionalities
    // to create, update, and delete rows
    // in that table.
    require_once 'lib.php';
?>

<form method="get" class="form-inline">
    <input type="hidden" name="id" value="crud" />
    <select name="table" class="form-control inline">
        <option value="Posts">Posts</option>
        <option value="Keywords">Keywords</option>
        <option value="Podcasts">Podcasts</option>
        <option value="Supports">Supports</option>
    </select>
    <input type="submit" value="Switch" class="btn btn-primary" />
</form>

<?php
    // Defined table, id, and default table select query
    // TODO: Dynamically generate the data below
    $table_name = 'Posts';
    $table_id = 'Id';
    $select_query = 'SELECT
    CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Posts&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
    CONCAT(\'<a class="btn btn-sm btn-default" href="view.php?id=\', id , \'">\', \'View\', \'</a>\') as View,
    Id
    , Submit
    ,`Title`
    ,`Publisher`
    FROM `Posts`';
    if (isset($_GET['table']))
    {
        $table_name  = $_GET['table'];
        switch ($_GET['table'])
        {
            case "Keywords":
                $table_id = 'Id';
                $table_name = 'Keywords';
                $select_query = 'SELECT
                CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Keywords&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
                Id
                ,`Title`
                FROM `Keywords`';
                break;
            case "Podcasts":
                $table_id = 'Id';
                $table_name = 'Podcasts';
                $select_query = 'SELECT
                CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Podcasts&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
                Id
                ,`Title`
                ,`EpisodeNumber`
                ,`PublishDate`
                FROM `Podcasts`';
                break;
            case "Supports":
                $table_id = 'Id';
                $table_name = 'Supports';
                $select_query = 'SELECT
                CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Supports&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
                Id
                ,`Name`
                ,`Url`
                ,`IsAuthor`
                ,`IsFan`
                ,`IsContributer`
                ,`IsCoach`
                ,`IsDonater`
                ,`IsMedia`
                FROM `Supports`';
                break;
        }
    }

    // If data was posted
    if (isset($_POST['update']))
    {
        // declare variables
        $update_query_key_values = '';

        // Get table structure
        // In this case: Potodosts table
        $result = $conn->query("DESCRIBE " . $table_name);

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["Field"] != $table_id) { // because of auto increment
                // dont insert comma for the last record
                if ($update_query_key_values != '')
                    $update_query_key_values .= ', ';
                
                // apend keys to keys array
                $update_query_key_values .= '`' . $row["Field"] . '` = ';

                // Get field type
                // if it was a stirng, add quote in first and last of value
                $type = $row['Type'];
                if (strpos($type, "(") > 0)
                    $type = substr($type, 0, strpos($type, "("));
                $symbol = '';
                if ($type == "varchar"
                or $type == "datetime"
                or $type == "text"
                or $type == "longtext"
                or $type == "char" ) {
                    $symbol = '\'';
                }

                
                // If value is posted and its not null
                if (! isset( $_POST[ $row["Field"] ] ) ) {
                    $update_query_key_values .= "NULL" ;
                }
                else if ($_POST[ $row["Field"] ] == ''
                    and ( $type == "int" or $type == "bit" or $type == "decimal" )
                ) {
                    $update_query_key_values .= "NULL" ;
                }
                else {
                    // append value to values array
                    $update_query_key_values .= $symbol . $_POST[ $row["Field"] ]  . $symbol;
                }
            }
        }

        // assemble final query
        $update_query  = 'UPDATE ' . $table_name . ' SET ' . $update_query_key_values . ' WHERE ' . $table_id . ' = '. $_POST[$table_id] ;
        
        // run the query !
        mysqli_query($conn, $update_query);
    }
    else if (isset($_POST['insert']))
    {
        // declare variables
        $insert_query_keys = $insert_query_values = '';

        // Get table structure
        $result = $conn->query("DESCRIBE " . $table_name);

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["Field"] != $table_id) { // because of auto increment
                // dont insert comma for the last record
                if ($insert_query_keys != '')
                    $insert_query_keys .= ', ';
                
                // apend keys to keys array
                $insert_query_keys .= '`' . $row["Field"] . '`';

                // Get field type
                // if it was a stirng, add quote in first and last of value
                
                $type = $row['Type'];
                if (strpos($type, "(") > 0)
                    $type = substr($type, 0, strpos($type, "("));
                $symbol = '';
                if ($type == "varchar"
                or $type == "datetime"
                or $type == "text"
                or $type == "longtext"
                or $type == "char" ) {
                    $symbol = '\'';
                }
                
                // dont insert comma for the last record
                if ($insert_query_values != '')
                    $insert_query_values .= ', ';
                // If value is posted and its not null
                if (! isset( $_POST[ $row["Field"] ] ) ) {
                    $insert_query_values .= "NULL" ;
                }
                else if ($_POST[ $row["Field"] ] == ''
                    and ( $type == "int" or $type == "bit" or $type == "decimal" )
                ) {
                    $insert_query_values .= "NULL" ;
                }
                else {
                    // append value to values array
                    $insert_query_values .= $symbol . $_POST[ $row["Field"] ]  . $symbol;
                }
            }
        }

        // assemble final query
        $insert_query  = "INSERT INTO " . $table_name . " (" 
        . $insert_query_keys
        . ") VALUES ("
        . $insert_query_values
        . ")" ;
        
        // run the query !
        mysqli_query($conn, $insert_query);

    }
    else if (isset($_POST['delete']))
    {
        // assemble final query
        $delete_query  = 'DELETE FROM ' . $table_name . ' WHERE ' . $table_id . ' = '. $_POST[ $table_id ] ;

        // run the query !
        mysqli_query($conn, $delete_query);
    }

    // Select data to table
    SuperLiteSql::createTable_from_sql_select_query($conn, $select_query);
    
    // Select entry values
    $values = null;
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    parse_str(parse_url($actual_link)['query'],$params);
    if (isset($params['entry']))
    {
        $result= mysqli_query($conn, 
            "SELECT * FROM " . $table_name . " WHERE " . $table_id . "=" . $params['entry'] . " LIMIT 1"
        );
        while($values = $result->fetch_array())
            // select only one :)
            break;
    }


    // Modal Trigger
    // href="admin.php?id=crud&new"
    echo '<button class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
        New *
    </button>
    ' ;

    // Generate form
    echo SuperLiteSql::GenerateFormFromTable($table_name, $conn, $values);

?>