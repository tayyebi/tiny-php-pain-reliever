<?php

/**
 * 
 * Controller class for admin panel
 * 
 */
class AdminController extends Controller {

    /**
     * IndexGET
     *
     * Index view of admin dashboard
     * 
     * @return void
     */
    function IndexGET() {

        $this->CheckAuth($_COOKIE); // Check login

        $Data = [
            'Title' => 'پنل مدیر',
        ];

        $this->Render('index', $Data);

    }


    /**
     * ItemsGET
     *
     * List the posts
     * 
     * @return void
     */
    function ItemsGET($table = "Post", $Id = null) {

        $this->CheckAuth($_COOKIE); // Check login

        // ========== Ask database for data
        $Model = $this->CallModel($table);
        $Rows = $Model->GetAdminPanelItems();
        
        // ========== Generate HTML table from SQL rows
        $HtmlTable = '';
        $field = null;
        if (count($Rows) > 0) 
        {
            $HtmlTable .= "<table class=\"table table-striped table-bordered table-sm\" id='gordarg-table'>";
            $HtmlTable .= "<thead> <tr>";
            $field = array_keys($Rows[0]);
            $fields = array();
            $j = 0;
            $HtmlTable .= "<th scope=\"col\">#</th>";
            foreach ($field as $col)
            {   
                $HtmlTable .= "<th scope=\"col\">".$col."</th>";
                array_push($fields, array(++$j, $col));
            }
            $HtmlTable .= "</tr></thead>";

            $HtmlTable .= "<tbody>";
            $j=0;
            foreach ($Rows as $row)
            {
                ++$j;
                $HtmlTable .= "<tr>";
                $HtmlTable .= "<th>" . $j . "</th>";
                for ($i=0 ; $i < sizeof($fields) ; $i++)
                {
                    $fieldname = $fields[$i][1];
                    $filedvalue = $row[$fieldname];

                    $HtmlTable .= "<td>" . $filedvalue . "</td>";
                }
                $HtmlTable .= "</tr>";
            }
            $HtmlTable .= "</tbody>";
            $HtmlTable .= "</table>";
        }
        else
        {
            $HtmlTable .= '
            <blockquote class="note note-info">
                <strong class="bq-title">Info!</strong> Nothing to show.
            </blockquote>
            ';
        }

        // ========== Generate HTML form from SQL table

        $form ='<div class="modal' . ((isset($Id) || isset($_GET['new'] )) ? ' show' : '') . '" id="basicExampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body">';
        
        $form .= "<form action=\"" . _Root . 'Admin/Items/' . $table . (isset($Id) ? "/" . $Id : '') . "\"
        class=\"gordarg-form\"
        method=\"post\">";
        
        // Is it insert or update form
        $mode = (isset($Id) ? 'update' : 'insert');

        // Get table structure
        $result = $Model->DescribeTable();

        if (count($result) > 0) {
            // output data of each row
            foreach ($result as $row) {

                if (!isset($Id)) {
                    $columns = array();
                    foreach ($result as $item)
                        array_push($columns, $item['Field']);
                    // Create an empty form
                    $values = array_fill_keys($columns, '');
                } else {
                    $values = $Model->GetItemByIdentifier(['Id'=>$Id])[0];
                }

                if ($row["Field"] != "Id") {

                    $form .= "<div class=\"form-group\">";

                    $type = $row['Type'];
                    if (strpos($type, "(") > 0)
                        $type = substr($type, 0, strpos($type, "("));

                    switch ($type){
                        case "longtext":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= '<input type="hidden" name="' . $row["Field"] . '" value="' . htmlspecialchars($values[$row["Field"]]) . '"  />';
                            $form .= '<div id="' . $row["Field"] . '" data-tiny-editor>' . $values[$row["Field"]] . '</div>';
                            break;
                        case "text":
                        case "varchar":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='text' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
                            break;
                        case "int":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='number' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
                            break; 
                        case "bigint":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='number' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
                            break; 
                        case "tinyint":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='number' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
                            break; 
                        case "decimal":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='number'  step='0.01' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
                            break;
                        case "datetime":                          
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='datetime-local' name='" . $row["Field"] . "' value='" . date('Y-m-d\TH:i') . "' >";
                            break;
                        case "bit":
                            // echo "here " . $row["Field"] . ": " . $values[$row["Field"]]; exit; // Debug
                            $form .= '
                                <label class="form-check-label" for="' . $row["Field"] . '">
                                ' . $row["Field"] . '
                                </label>
                                <input class="form-check-input" type="checkbox" name="' . $row["Field"] . '" value="' . ( $values[$row["Field"]] == '0' ? 'false' : 'true' ) . '">
                            ';
                            break;
                        default :
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='text' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
                    }

                    $form .= "</div>";
        
                }
            }
            if ($mode == 'insert')
            {
                $form .= "<input name='insert' type='submit' value='Insert' class='btn btn-primary btn-sm m-4'>";
                $form .= "</form>";
            }
            else if ($mode == 'update')
            {
                $form .= "<input name='update' type='submit' value='Update' class='btn btn-warning btn-sm m-4'>";
                $form .= "<input name='delete' type='submit' value='Delete' class='btn btn-danger btn-sm m-4'>";
                $form .= "<a href=\"admin.php?id=crud\" class='btn btn-default pink darken-1 btn-sm m-4'>Cancel</a>";
                $form .= "</form>";                
                $form .= "</div></div></div></div>";                
            }

        }


        // ========== Package the response and return view
        $Data = [
            'Title' => 'مدیریت آیتم‌ها',
            'Table' => $HtmlTable,
            'Form' => $form
        ];
        
        $this->Render('crud', $Data);   

        
    }

    /**
     * ItemsPOST
     * 
     * When a button on items form is clicked
     * 
     * 
     * @return void
     * 
     */
    function ItemsPOST($table = "Post", $Id = null) {
        $this->CheckAuth($_COOKIE); // Check login

        // ========== Ask database for data
        $Model = $this->CallModel($table, false);
        $conn = $Model::$Connection;

        // Plural table names
        switch ($table)
        {
            default:
                $table_id = "Id";
                $table_plural = $table . "s";
        }

        // If data was posted to update the record
        if (isset($_POST['update']))
        {
            // declare variables
            $update_query_key_values = '';

            // Get table structure
            // In this case: Potodosts table
            $result = $conn->query("DESCRIBE " . $table_plural);

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
            $update_query  = 'UPDATE ' . $table_plural . ' SET ' . $update_query_key_values . ' WHERE ' . $table_id . ' = '. $Id ;
            
            // run the query !
            mysqli_query($conn, $update_query);
        }
        else if (isset($_POST['insert']))
        {
            // declare variables
            $insert_query_keys = $insert_query_values = '';

            // Get table structure
            $result = $conn->query("DESCRIBE " . $table_plural);

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
            $insert_query  = "INSERT INTO " . $table_plural . " (" 
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
            $delete_query  = 'DELETE FROM ' . $table_plural . ' WHERE ' . $table_id . ' = '. $Id ;

            // run the query !
            mysqli_query($conn, $delete_query);
        }

        $this->RedirectResponse(_Root . "Admin/Items/" . $table);

    }

    /**
     * SuperLiteSQLGET
     *
     * Super lite sql
     * 
     * @return void
     */
    function SuperLiteSQLGET() {

        $this->CheckAuth($_COOKIE); // Check login

        // Ask database for data
        // $Model = $this->CallModel("User");
        // $Rows = $Model->GetAllUsers();

        // Package the response
        $Data = [
            'Title' => 'SuperLiteSQL',
            // 'Model' => $Rows
        ];
        
        // Render the view
        $this->Render('superlitesql', $Data);   

        
    }


    /**
     * ServerGET
     *
     * Show the server details
     * 
     * @return void
     */
    function ServerGET() {

        $this->CheckAuth($_COOKIE); // Check login

        // Ask database for data
        // $Model = $this->CallModel("User");
        // $Rows = $Model->GetAllUsers();

        // Package the response
        $Data = [
            'Title' => 'منابع سرور',
            // 'Model' => $Rows
        ];
        
        // Render the view
        $this->Render('server', $Data);   

        
    }

    /**
     * UserPOST
     *
     * Update user details
     * 
     * @return void
     */
    function UserPOST($Id = 0) {
        
        $this->CheckAuth($_COOKIE); // Check login

        // Check if Id is passed to the function
        if ($Id != 0)
        {
            // Call the model
            $Model = $this->CallModel("User");

            // Initialy set message to String.Empty
            $Message = '';

            // Check if user exist from parameters
            $Rows = $Model->GetUserById([
                'Id' => $Id
            ]);
            if (count($Rows) > 0)
            {

                // Check if new password and it's confirm match
                if ($_POST['NewPassInput'] == $_POST['ConfirmPassInput'])
                {

                    // Check former password
                    $CheckLogin = $Model->CheckLogin([
                        'Email' => $Rows[0]['Email'],
                        'Password' => (new Cryptography())->Encrypt($_POST['FormerPassInput'])
                    ]);

                    // If former password was correct
                    if (count($CheckLogin) == 1)
                    {
                        
                        // Update the password
                        $Response = $Model->UpdatePassword([
                            'Id' => $Id,
                            'Password' => (new Cryptography())->Encrypt($_POST['NewPassInput'])
                        ]);

                        // Check for database errors
                        $Message = $Response ? 'کلمه‌ی عبور کاربر به روز شد' : 'خطای پایگاه داده';
                    }
                    else
                    {
                        $Message = 'کلمه‌ی عبور پیشین معتبر نیست';
                    }
                }
                else
                {
                    $Message = 'کلمه‌ی عبور جدید با تکرار آن هم‌خوانی ندارد';
                }

                // Get the current record
                $Row = $Rows[0];

                // Return the view
                $Data = [
                    'Title' => 'مدیریت کاربر',
                    'Message' => $Message,
                    'Model' => $Row
                ];
                $this->Render('User', $Data);

                // Don't allow program to go to the next lines
                return;
            }
                
        }

        // If user id did not exist in database or sent as paramter to this method
        throw new NotFoundException("شناسه‌ی کاربری مورد نظر پیدا نشد");
    }



}