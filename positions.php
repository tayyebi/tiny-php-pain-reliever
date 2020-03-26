<?php
require_once 'config.pass.php';
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>موقعیت‌های همکاری</title>

    <link rel="stylesheet" href="static/css/layout.css">
    <link rel="stylesheet" href="static/css/positions.css">
</head>
<body>
<header>
<h1>موقعیت‌های همکاری</h1>

</header>

<main>
<div class="container">

    <?php
    $select_posts_query = "SELECT *
    FROM `Positions`
    WHERE `IsActive` = 1
    ORDER BY `Id` DESC";

    $result = $conn->query($select_posts_query);
    while ($row = $result->fetch_assoc()) {
    ?>
    <div class="item">
        <h3><?php echo $row['Title'] ?></h3>
        <p><?php echo $row['JobDescription'] ?></p>
    </div>
    <?php
    }
    ?>

    <!-- <div class="loader"></div> -->

</div>
<!-- End of container -->

</main>
</body>
</html>
