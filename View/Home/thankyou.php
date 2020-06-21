<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>قدردان شماییم</title>

    <link rel="stylesheet" href="../static/css/layout.css">
    <link rel="stylesheet" href="../static/css/thankyou.css">
</head>
<body>
<header>
<h1>قدردان شماییم</h1>

</header>

<main>
<div class="container">

    <?php
    foreach ($Data['Model'] as $item) {
    ?>
    <div class="item">
        <h3><?php echo $item['Name'] ?></h3>
        <a href="<?php echo $item['Url'] ?>">🔗</a>
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
