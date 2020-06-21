<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>موقعیت‌های همکاری</title>

    <link rel="stylesheet" href="../static/css/layout.css">
    <link rel="stylesheet" href="../static/css/positions.css">
</head>
<body>
<header>
<h1>موقعیت‌های همکاری</h1>

</header>

<main>
<div class="container">

    <?php
    foreach ($Data['Model'] as $item) {
    ?>
    <div class="item">
        <h3><?php echo $item['Title'] ?></h3>
        <p><?php echo $item['JobDescription'] ?></p>
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
