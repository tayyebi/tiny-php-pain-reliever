<?php
abstract class SuperLiteSql {
    // Function to create tables from queries
    static function createTable_from_sql_select_query($sql_link, $query) {

        $result=mysqli_query($sql_link, $query);
  
        if ($result->num_rows > 0) 
        {
            echo "<table class=\"table table-striped table-bordered table-sm\" id='gordarg-table'>";
            echo "<thead> <tr>";
            $field = $result->fetch_fields();
            $fields = array();
            $j = 0;
            echo "<th scope=\"col\">#</th>";
            foreach ($field as $col)
            {
                echo "<th scope=\"col\">".$col->name."</th>";
                array_push($fields, array(++$j, $col->name));
            }
            echo "</tr></thead>";

            echo "<tbody>";
            $j=0;
            while($row = $result->fetch_array())
            {
                ++$j;
                echo "<tr>";
                echo "<th>" . $j . "</th>";
                for ($i=0 ; $i < sizeof($fields) ; $i++)
                {
                    $fieldname = $fields[$i][1];
                    $filedvalue = $row[$fieldname];

                    echo "<td>" . $filedvalue . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        else
        {
            echo '
            <blockquote class="note note-info">
                <strong class="bq-title">Info!</strong> Nothing to show.
            </blockquote>
            ';
        }
    }

    // This function creates an HTML form from SQL table
    static function GenerateFormFromTable($table_name, $conn, $values) {

        $form ='<div class="modal' . ((isset($values) || isset($_GET['new'] )) ? ' show' : '') . '" id="basicExampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body">';
        
        $form .= "<form action=\"admin.php?id=crud\"
        class=\"gordarg-form\"
        method=\"post\">";
        
        // Is it insert or update form
        $mode = (isset($values) ? 'update' : 'insert');

        // Get table structure
        $result = $conn->query("describe " . $table_name);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($row["Field"] != "id") {

                    $form .= "<div class=\"form-group\">";

                    $type = $row['Type'];
                    if (strpos($type, "(") > 0)
                        $type = substr($type, 0, strpos($type, "("));

                    switch ($type){
                        case "longtext":
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<textarea class=\"form-control\" name='" . $row["Field"] . "'>" . $values[$row["Field"]] . "</textarea>";
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
                            if (isset($values[$row["Field"]]))
                                $values[$row["Field"]] = date('Y-m-d\TH:i');
                            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label>";
                            $form .= "<input class=\"form-control\" type='datetime-local' name='" . $row["Field"] . "' value='" . $values[$row["Field"]] . "' >";
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

        return $form;
    }
}
?>