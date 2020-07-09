<?php

// Modal Trigger
// href="admin.php?id=crud&new"
echo '<button class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
    New *
</button>
' ;

// Select data to table
echo $Data['Table'];

// Generate form
echo $Data['Form'];

?>