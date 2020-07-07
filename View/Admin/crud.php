<?php

// Select data to table
echo $Data['Table'];

// Modal Trigger
// href="admin.php?id=crud&new"
echo '<button class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
    New *
</button>
' ;

// Generate form
echo $Data['Form'];

?>