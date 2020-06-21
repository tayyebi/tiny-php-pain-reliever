<?php
require_once 'lib.php';
?>

<!--  Required scripts to load SQL marker plugin -->
<script src="static/codemirror-5.46.0/lib/codemirror.js"></script>
<link rel="stylesheet" href="static/codemirror-5.46.0/lib/codemirror.css">
<script src="static/codemirror-5.46.0/mode/javascript/javascript.js"></script>
<script src="static/codemirror-5.46.0/addon/edit/matchbrackets.js"></script>
<script src="static/codemirror-5.46.0/sql.js"></script>
<link rel="stylesheet" href="static/codemirror-5.46.0/addon/hint/show-hint.css" />
<script src="static/codemirror-5.46.0/addon/hint/show-hint.js"></script>
<script src="static/codemirror-5.46.0/addon/hint/sql-hint.js"></script>

<?php
// If any report was selected
if (isset($_GET['entry']))
{
    $_POST['the_query'] = file_get_contents("reports/" . $_GET['entry']);
    echo '
    <div class="alert alert-primary" role="alert">
        <strong class="bq-title">Info! </strong> ' . $_GET['entry'] . '
    </div>
    ';
?>
<form method="post" >
<?php
    // Following lines will merge csv filters on
    // sql code. It will replace any variable defined
    // with @, with its related value.

    // Read CSV to array
    $csvFile = @file('reports/filters/' . $_GET['entry'] . '.csv');
    $csvData = [];
    if ($csvFile)
        foreach ($csvFile as $line) {
            $csvData[] = $l = str_getcsv($line);
        }
    // Remove first row (table header row)
    unset($csvData[0]);
    
    // Write out filters to HTML
    $csv_i = 0;
    foreach ($csvData as $l) {
        // Keep default value
        if (isset($_POST['filter']))
        {
            ++$csv_i;
            $csvData[$csv_i][3] = $l[3] = $_POST['filter_' . $l[0]];
            $csvData[$csv_i][4] = $l[4] = "";
            if (isset($_POST['enabled_' . $l[0]]))
                $csvData[$csv_i][4] = $l[4] =  "checked";
        }
        echo '<div class="form-group m-4">';
        echo '<div class="checkbox m-1">
            <label><input name="enabled_' . $l[0] . '" type="checkbox" ' . $l[4] . '>' . $l[1] . '</label>
        </div>';
        // Echo each filter's related input
        switch ($l[2]) {
            case 'number':
                echo '<input name="filter_' . $l[0] . '" type="number" value="' . $l[3] . '" class="form-control" />';
                break;

            case 'datetime':
                echo '<input type="datetime-local" id="filter_' . $l[0] . '" name="filter_' . $l[0] . '" value="' . $l[3] . '" />';
                break;
            
            default:
                echo '<input name="filter_' . $l[0] . '" type="text" value="' . $l[3] . '" class="form-control" />';
                break;
        }
        echo '</div>';
    }

    // Replace the values in query with filter values
    foreach ($csvData as $csvRow) {
        if ($csvRow[4])
        {
            $_POST['the_query'] = str_replace("@" . $csvRow[0], 
            $csvRow[3]
            , $_POST['the_query']);
        }
        else
        {
            $_POST['the_query'] = str_replace("@" . $csvRow[0], 
            "'%'"
            , $_POST['the_query']);
        }
    }
?>
<input name="filter" type="submit" class="btn btn-primary" value="Apply Filters" />
</form>
<?php
}
else
{
?>
<!--  Form to write SQL -->
<form method="post" >

    <div id="sql-input">
        <textarea name="the_query" id="code"><?php
        if (!isset($_POST['the_query']))
        {
        ?>
-- Predefined SQL code to test the functionality.
-- Running queries

    SELECT "<h1 style=\"color: green\">====Queries====</h1>" as RESULTS
    union
    SELECT Concat('<u>', `User`, '</u> is <u>' , State, '</u>:    <br/><i>' , replace(replace(Info, "<", "-"), ">", "-"), '</i>' ) FROM information_schema.PROCESSLIST

-- Databases

    union
    SELECT "<h1 style=\"color: green\">====Databases====</h1>" as RESULTS
    union
    SELECT  Concat( CONCAT(" DATABASE: ", table_schema) , CONCAT(" - SIZE: ", ROUND(SUM(data_length + index_length) / 1024 / 1024, 2), "MB") ) FROM information_schema.TABLES GROUP BY table_schema

-- Database files directory
    
    union
    SELECT "<h1 style=\"color: green\">====Data directory====</h1>" as RESULTS
    union
    SELECT @@datadir
        <?php
        }
        else
        {
            echo $_POST['the_query'];
        }
        ?></textarea>
    </div>
    <input type="submit" class="btn btn-danger pink darken-1 m-4" />

</form>
<?php
}
?>

<?php
// the_query contains posted input content or selected report content.
if (isset($_POST['the_query']))
{
    // Parse result to output
    SuperLiteSql::createTable_from_sql_select_query($conn, $_POST['the_query']);
}
?>

<!-- Run SQL marker plugin
SQL beautifier and Ctrl+Space hints
-->

<script>
    window.onload = function() {
        var mime = 'text/x-mariadb';
        // get mime type
        if (window.location.href.indexOf('mime=') > -1) {
            mime = window.location.href.substr(window.location.href.indexOf('mime=') + 5);
        }
        window.editor = CodeMirror.fromTextArea(document.getElementById('code'), {
            mode: mime,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            autofocus: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            hintOptions: {tables: {
                    Transactions: ["Id", "Submit", "SocketRequestDump", "IsSyncedWithRMTO"],
                    RmtoCalls: ["Id", "Submit", "IsSuccess", "TransactionId", "RequestDump", "ResponseDump"],
                    Devices: ["wapid", "Title", "GoingRoadCode", "CommingRoadCode", "Notes"]
                }}
        });
    };
</script>